<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dayrui Website Management System
 *
 * @since		version 2.0.2
 * @author		Dayrui <dayrui@gmail.com>
 * @license     http://www.dayrui.com/license
 * @copyright   Copyright (c) 2011 - 9999, Dayrui.Com, Inc.
 */
 
class Update extends M_Controller {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
		//$this->db->db_debug = FALSE;
    }

    /**
     * 2.1.1 更新程序
     */
    public function index() {
	
		if (DR_VERSION_ID != 14) $this->admin_msg('升级完成，请更新全站缓存在刷新页面', '', 1);
		
		$page = (int)$this->input->get('page');
		if (!$page) $this->admin_msg('正在升级数据...', dr_url('update/index', array('page' => $page + 1)), 2);
		
		switch($page) {
			case 1:
				$this->admin_msg('正在转存URL规则...', dr_url('update/index', array('page' => $page + 1)), 2);
				break;
			default:
				$this->admin_msg('升级完成，请更新全站缓存在刷新页面', '', 1);
				break;
		}
    }
}