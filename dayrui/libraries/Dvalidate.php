<?php

/**
 * Dayrui Website Management System
 *
 * @since		version 2.0.5
 * @author		Dayrui <dayrui@gmail.com>
 * @license     http://www.dayrui.com/license
 * @copyright   Copyright (c) 2011 - 9999, Dayrui.Com, Inc.
 */

/**
 * ������У��
 */

class Dvalidate {
	
	private $ci;

	/**
     * ���캯��
     */
    public function __construct() {
		$this->ci = &get_instance();
    }

	/**
	 * ��������
	 *
	 * @param   $value	��ǰ�ֶ��ύ��ֵ
	 * @param   �Զ����ֶβ���1
	 * @param   �Զ����ֶβ���2
	 * @param   �Զ����ֶβ���3 ...
	 * @return  true��ͨ�� , falseͨ��
	 */
	public function __test($value,  $p1) {
		return TRUE;
	}
	
	/**
	 * ��֤��Ա�����Ƿ����
	 *
	 * @param   $value	��ǰ�ֶ��ύ��ֵ
	 * @return  true��ͨ�� , falseͨ��
	 */
	public function check_member($value) {
		if (!$value) return TRUE;
		if ($value == 'guest') return FALSE;
		return $this->ci->db->where('username', $value)->count_all_results('member') ? FALSE : TRUE;
	}
	
	/**
	 * ��֤�ֻ������Ƿ����
	 *
	 * @param   $value	��ǰ�ֶ��ύ��ֵ
	 * @return  true��ͨ�� , falseͨ��
	 */
	public function check_phone($value) {
		if (!$value) return TRUE;
		if (strlen($value) == 11 && is_numeric($value)) return FALSE;
		return TRUE;
	}
}