<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dayrui Website Management System
 *
 * @since		version 2.1.1
 * @author		Dayrui <dayrui@gmail.com>
 * @license     http://www.dayrui.com/license
 * @copyright   Copyright (c) 2011 - 9999, Dayrui.Com, Inc.
 */
	
class Space extends M_Controller {

	private $space;
	
    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
		if (!$this->member['group']['allowspace']) $this->member_msg(lang('m-342'));
		$this->load->model('space_model');
		$this->space = $this->space_model->get($this->uid);
    }
	
    /**
     * 空间资料
     */
    public function index() {
	
		$error = NULL;
		$field = $this->get_cache('member', 'spacetable');
		$editspace = $this->get_cache('member', 'setting', 'space', 'edit');
		
		if (IS_POST) {
		
			$name = $this->input->post('name');
			$name = $name ? $name : $this->space['name'];
			$post = $this->validate_filter($field, $this->space);
			
			if (isset($post['error'])) {
				if (IS_AJAX) exit(dr_json(0, $post['msg'], $post['error'])); // AJAX返回
				$data = $this->input->post('data', TRUE);
				$error = $post['msg'];
			} else {
			
				if ($name) {
					
					$post[1]['name'] = !$editspace && $this->space['name'] ? $this->space['name'] : $name;
					$error = $this->space_model->update($this->uid, $post[1]);
					
					if ($error) {
						$this->attachment_handle($this->uid, $this->db->dbprefix('space').'-'.$this->uid, $field, $this->space);
					}
					
					if ($error == 0) {
						// 名称重复
						$error = lang('m-239');
					} elseif ($error == 1) {
						// 操作成功
						$this->member_msg(lang('000'), dr_url('space/index'), 1);
					} else {
						// 操作成功,等待审核
						$this->member_msg(lang('m-240'), dr_url('space/index'), 2);
					}
				} else {
					$error = lang('m-241');
				}
			}
		} else {
			$data = $this->space;
		}
		
		$this->template->assign(array(
			'data' => $data,
			'error' => $error,
			'field' => $field,
			'myfield' => $this->field_input($field, $data, TRUE, 'uid'),
			'newspace' => $this->space ? 0 : 1,
			'editspace' => $editspace,
		));
		$this->template->display('space_index.html');
    }
	
	
	/**
     * 空间模板
     */
	public function template() {
		
		$style = $this->input->get('style');
		if ($style && $this->space['style'] != $style) {
			$rule = dr_string2array(@file_get_contents(FCPATH.'member/templates/'.$style.'/rule.php'));
			if ($style == 'default' || isset($rule[$this->markrule])) {
				$this->db
					 ->where('uid', (int)$this->uid)
					 ->update($this->db->dbprefix('space'), array('style' => $style));
				$this->member_msg(lang('m-319'), dr_member_url('space/template'), 1);
			} else {
				$this->member_msg(lang('m-320'));
			}
		}
		
		$list = array();
		$data = array_diff(dr_dir_map(FCPATH.'member/templates/', 1), array('admin', 'member'));
		if ($data) {
			foreach ($data as $dir) {
				$tpl = array(
					'name' => $dir,
					'preview' => MEMBER_URL.'templates/'.$dir.'/preview.jpg'
				);
				$rule = dr_string2array(@file_get_contents(FCPATH.'member/templates/'.$dir.'/rule.php'));
				if ($dir == 'default') {
					$list[] = $tpl;
				} elseif ($rule && isset($rule[$this->markrule])) {
					$list[] = $tpl;
				}
			}
		}
		$this->template->assign(array(
			'list' => $list,
			'style' => $this->space['style'] ? $this->space['style'] : 'default',
		));
		$this->template->display('space_template.html');
	}
	
}