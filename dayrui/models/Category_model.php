<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dayrui Website Management System
 *
 * @since		version 2.1.0
 * @author		Dayrui <dayrui@gmail.com>
 * @license     http://www.dayrui.com/license
 * @copyright   Copyright (c) 2011 - 9999, Dayrui.Com, Inc.
 */
	
class Category_model extends CI_Model {
	
	public $link;
	public $prefix;
	public $tablename;
	private	$categorys;
	
	/*
	 * ��Ŀģ����
	 */
    public function __construct() {
        parent::__construct();
		$this->link = $this->site[SITE_ID];
		$this->prefix = $this->link->dbprefix(SITE_ID.'_'.APP_DIR);
		$this->tablename = $this->link->dbprefix(SITE_ID.'_'.APP_DIR.'_category');
    }
	
	/*
	 * ��Ŀ��ԱȨ��
	 *
	 * @param	intval	$id
	 * @return	array
	 */
	public function get_permission($id) {
	
		$data = $this->link
					 ->where('id', $id)
					 ->select('permission')
					 ->limit(1)
					 ->get($this->tablename)
					 ->row_array();

		return dr_string2array($data['permission']);
	}
	
	/*
	 * ��Ŀ����
	 *
	 * @param	intval	$id
	 * @return	array
	 */
	public function get($id) {
	
		$data = $this->link
					 ->where('id', $id)
					 ->limit(1)
					 ->get($this->tablename)
					 ->row_array();

		if (isset($data['setting'])) $data['setting'] = dr_string2array($data['setting']);
		if (isset($data['permission'])) $data['permission'] = dr_string2array($data['permission']);
		
		return $data;
	}
	
	/*
	 * ��Ŀȫ������
	 *
	 * @return	array
	 */
	public function get_data() {
	
		$data = array();
		$_data = $this->link
					  ->order_by('displayorder ASC,id ASC')
					  ->get($this->tablename)
					  ->result_array();
		if (!$_data) return $data;
		
		foreach ($_data as $t) {
			$data[$t['id']]	= $t;
		}
		
		return $data;
	}
	
	/*
	 * �������
	 *
	 * @param	array	$names	��Ŀ�����б�
	 * @param	array	$data	��������
	 * @return	int				�ɹ�����
	 */
	public function add_all($names, $data) {
	
		if (!$names) return 0;
		
		$count = 0;
		$_data = explode(PHP_EOL, $names);
		
		foreach ($_data as $t) {
		
			list($name, $dir) = explode('|', $t);
			$name = trim($name);
			if (!$name) continue;
			if (!$dir) $dir	= dr_word2pinyin($name);
			if ($this->dirname_exitsts($dir)) $dir .= rand(0,99);
			
			$this->link->insert($this->tablename, array(
				'pid' => (int)$data['pid'],
				'pids' => '',
				'name' => $name,
				'show' => $data['show'],
				'thumb' => $data['thumb'],
				'letter' => $dir{0},
				'dirname' => $dir,
				'setting' => dr_array2string($data['setting']),
				'pdirname' => '',
				'childids' => '',
				'displayorder' => (int)$data['displayorder']
			));
			
			$count ++;
		}
		$this->repair();
		
		return $count;
	}
	
	/**
	 * ���
	 *
	 * @param	array	$data
	 * @return	intval
	 */
	public function add($data) {
	
		if (!$data || !$data['dirname']) return lang('019');
		if ($this->dirname_exitsts($data['dirname'])) return lang('111');
		
		$this->link->insert($this->tablename, array(
			'pid' => (int)$data['pid'],
			'pids' => '',
			'name' => trim($data['name']),
			'show' => $data['show'],
			'thumb' => $data['thumb'],
			'letter' => $data['letter'] ? $data['letter'] : $data['dirname']{0},
			'dirname' => $data['dirname'],
			'setting' => dr_array2string($data['setting']),
			'pdirname' => '',
			'childids' => '',
			'displayorder' => (int)$data['displayorder']
		));
		
		$id = $this->link->insert_id();
		$this->repair();
		
		return $id;
	}
	
	/**
	 * �޸�
	 *
	 * @param	intval	$id
	 * @param	array	$data
	 * @return	string
	 */
	public function edit($id, $data, $_data) {
	
		if (!$data || !$data['dirname']) return lang('019');
		if ($this->dirname_exitsts($data['dirname'], $id)) return lang('111');
		
		if (!isset($data['setting']['admin'])) $data['setting']['admin'] = array();
		if (!isset($data['setting']['member'])) $data['setting']['member'] = array();
		
		// �����ԱȨ������
		$permission = $data['rule'];
		if ($_data['permission']) {
			foreach ($_data['permission'] as $i => $t) {
				unset($t['show'], $t['forbidden'], $t['add'], $t['edit'], $t['del']);
				$permission[$i] = $permission[$i] ? $permission[$i]+$t : $t;
			}
		}
		
		$this->link->where('id', $id)->update($this->tablename, array(
			'pid' => (int)$data['pid'],
			'name' => $data['name'],
			'show' => $data['show'],
			'thumb' => $data['thumb'],
			'letter' => $data['letter'] ? $data['letter'] : $data['dirname']{0},
			'dirname' => $data['dirname'],
			'setting' => dr_array2string(array_merge($_data['setting'], $data['setting'])),
			'permission' => dr_array2string($permission),
			'displayorder' => (int)$data['displayorder']
		));
		$this->repair();
		
		return lang('014');
	}
	
	/*
	 * ͬ������
	 *
	 * @param	array	$data
	 * @param	array	$syn
	 * @return	NULL
	 */
	public function syn($data, $_data, $syn) {
	
		if (!$data || !$syn) return NULL;
		
		//�����ԱȨ������
		$permission = $data['rule'];
		if ($_data['permission']) {
			foreach ($_data['permission'] as $i => $t) {
				unset($t['show'], $t['forbidden'], $t['add'], $t['edit'], $t['del']);
				$permission[$i] = $permission[$i] ? $permission[$i]+$t : $t;
			}
		}
		
		foreach ($syn as $id) {
		
			$_data = $this->get($id);
			
			// ������Ŀ����Ŀ������Ȩ�޻���
			if (!$_data['child']) {
				$_permission = $permission;
			} else {
				$_permission = NULL;
			}
			
			$this->link
				 ->where('id', $id)
				 ->update($this->tablename, array(
					'setting' => dr_array2string($data['setting']),
					'permission' => dr_array2string($_permission)
				 ));
		}
		
		return NULL;
	}
	
	/**
	 * Ŀ¼�Ƿ����
	 *
	 * @param	array	$data
	 * @return	bool
	 */
	private function dirname_exitsts($dir, $id = 0) {
		return $dir ? $this->link
						   ->where('dirname', $dir)
						   ->where('id<>', $id)
						   ->count_all_results($this->tablename) : 1;
	}
	
	/**
	 * �ҳ���Ŀ¼�б�
	 *
	 * @param	array	$data
	 * @return	bool
	 */
	private function get_categorys($data = array()) {
	
		if (is_array($data) && !empty($data)) {
			foreach ($data as $catid => $c) {
				$this->categorys[$catid] = $c;
				$result = array();
				foreach ($this->categorys as $_k => $_v) {
					if ($_v['pid']) $result[] = $_v;
				}
			}
		} 
		
		return true;
	}
	
	
	/**
	 * ��ȡ����ĿID�б�
	 * 
	 * @param	integer	$catid	��ĿID
	 * @param	array	$pids	��Ŀ¼ID
	 * @param	integer	$n		���ҵĲ��
	 * @return	string
	 */
	private function get_pids($catid, $pids = '', $n = 1) {
	
		if ($n > 5 || !is_array($this->categorys) || !isset($this->categorys[$catid])) return FALSE;
		
		$pid = $this->categorys[$catid]['pid'];
		$pids = $pids ? $pid.','.$pids : $pid;
		
		if ($pid) {
			$pids = $this->get_pids($pid, $pids, ++$n);
		} else {
			$this->categorys[$catid]['pids'] = $pids;
		}
		
		return $pids;
	}
	
	/**
	 * ��ȡ����ĿID�б�
	 * 
	 * @param	$catid	��ĿID
	 * @return	string
	 */
	private function get_childids($catid) {
	
		$childids = $catid;
		
		if (is_array($this->categorys)) {
			foreach ($this->categorys as $id => $cat) {
				if ($cat['pid'] && $id != $catid && $cat['pid'] == $catid) {
					$childids .= ','.$this->get_childids($id);
				}
			}
		}
		
		return $childids;
	}
	
	/**
	 * ��ȡ����Ŀ·��
	 * 
	 * @param	$catid	��ĿID
	 * @return	string
	 */
	public function get_pdirname($catid) {
	
		if ($this->categorys[$catid]['pid']==0) return '';
		
		$t = $this->categorys[$catid];
		$pids = $t['pids'];
		$pids = explode(',', $pids);
		$catdirs = array();
		krsort($pids);
		
		foreach ($pids as $id) {
			if ($id == 0) continue;
			$catdirs[] = $this->categorys[$id]['dirname'];
			if ($this->categorys[$id]['pdirname'] == '') break;
		}
		krsort($catdirs);
		
		return implode('/', $catdirs).'/';
	}
	
	/**
     * �޸���Ŀ����
	 */
	public function repair() {
	
		$this->categorys = $categorys = array();
		$this->categorys = $categorys = $this->get_data(); // ȫ����Ŀ����
		$this->get_categorys($categorys); // ������Ŀ¼
		
		if (is_array($this->categorys)) {
		
			foreach ($this->categorys as $catid => $cat) {
				$pids = $this->get_pids($catid);
				$childids = $this->get_childids($catid);
				$child = is_numeric($childids) ? 0 : 1;
				$pdirname = $this->get_pdirname($catid);
				if ($categorys[$catid]['pdirname'] != $pdirname 
				|| $categorys[$catid]['pids'] != $pids 
				|| $categorys[$catid]['childids'] != $childids 
				|| $categorys[$catid]['child'] != $child) {
				
					// ��������ʵ�ʲ����ϲŸ������ݱ�
					$this->link->where('id', $cat['id'])->update($this->tablename, array(
						'pids' => $pids,
						'child' => $child,
						'childids' => $childids,
						'pdirname' => $pdirname
					));
				}
			}
		}
	}
}