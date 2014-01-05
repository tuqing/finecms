<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dayrui Website Management System
 *
 * @since		version 2.0.0
 * @author		Dayrui <dayrui@gmail.com>
 * @license     http://www.dayrui.com/license
 * @copyright   Copyright (c) 2011 - 9999, Dayrui.Com, Inc.
 * @filesource	svn://www.dayrui.net/v2/dayrui/controllers/admin/theme.php
 */

require FCPATH.'dayrui/core/D_File.php';

class Theme extends D_File {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
		$this->path = FCPATH.'dayrui/statics/';
		$this->template->assign(array(
			'path' => $this->path,
			'furi' => 'admin/theme/',
			'auth' => 'admin/theme/',
			'menu' => $this->get_menu(array(
				lang('231') => 'admin/theme/index'
			)),
		));
    }
	
}