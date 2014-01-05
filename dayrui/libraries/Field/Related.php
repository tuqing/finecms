<?php

/**
 * Dayrui Website Management System
 *
 * @since		version 2.0.8
 * @author		Dayrui <dayrui@gmail.com>
 * @license     http://www.dayrui.com/license
 * @copyright   Copyright (c) 2011 - 9999, Dayrui.Com, Inc.
 */

class F_Related extends A_Field {
	
	/**
     * 构造函数
     */
    public function __construct() {
		parent::__construct();
		$this->name = '内容关联'; // 字段名称
		$this->fieldtype = array('TEXT' => ''); // TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... )
		$this->defaulttype = 'TEXT'; // 当用户没有选择字段类型时的缺省值
    }
	
	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) {
	
		$_option = '';
		$_module = $this->ci->get_cache('module',  SITE_ID);
		
		if ($_module) {
			foreach ($_module as $dir) {
				$_option.= '<option value="'.$dir.'" '.($dir == $option['module'] ? 'selected' : '').'>'.$dir.'</option>';
			}
		}
		$option['width'] = isset($option['width']) ? $option['width'] : '80%';
		
		return '<tr>
                    <th><font color="red">*</font>&nbsp;'.lang('html-010').'：</th>
                    <td>
                    <select name="data[setting][option][module]">
					'.$_option.'
					</select>
					<div class="onShow">'.lang('html-011').'</div>
                    </td>
                </tr>
				<tr>
                    <th>'.lang('265').'：</th>
                    <td>
                    <input type="text" class="input-text" size="10" name="data[setting][option][width]" value="'.$option['width'].'">
					<div class="onShow">'.lang('290').'</div>
                    </td>
                </tr>';
	}
	
	/**
	 * 字段输出
	 */
	public function output($value) {
		return $value;
	}
	
	/**
	 * 字段入库值
	 */
	public function insert_value($field) {
		
		$data = $this->ci->post[$field['fieldname']];
		$value = !$data ? '' : implode(',', $data);
		
		$this->ci->data[$field['ismain']][$field['fieldname']] = $value;
	}
	
	/**
	 * 字段表单输入
	 *
	 * @param	string	$cname	字段别名
	 * @param	string	$name	字段名称
	 * @param	array	$cfg	字段配置
	 * @param	string	$value	值
	 * @return  string
	 */
	public function input($cname, $name, $cfg, $value = NULL, $id = 0) {
		// 字段显示名称
		$text = (isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? '<font color="red">*</font>' : '').'&nbsp;'.$cname.'：';
		// 表单宽度设置
		$width = isset($cfg['option']['width']) && $cfg['option']['width'] ? $cfg['option']['width'] : '80%';
		// 表单附加参数
		$attr = isset($cfg['validate']['formattr']) && $cfg['validate']['formattr'] ? $cfg['validate']['formattr'] : '';
		// 字段提示信息
		$tips = isset($cfg['validate']['tips']) && $cfg['validate']['tips'] ? '<div class="onShow" id="dr_'.$name.'_tips">'.$cfg['validate']['tips'].'</div>' : '';
		// 禁止修改
		$disabled = !IS_ADMIN && $id && $value && isset($cfg['validate']['isedit']) && $cfg['validate']['isedit'] ? 'disabled' : ''; 
		// 模块名称
		$module = isset($cfg['option']['module']) ? $cfg['option']['module'] : '';
		//
		$tpl = '<li id="files_'.$name.'_{id}" style="padding-right:10px;cursor:move;"><a href="javascript:;" onclick="dr_remove_file(\''.$name.'\',\'{id}\')"><img align="absmiddle" src="'.SITE_URL.'dayrui/statics/images/b_drop.png"></a>&nbsp;{value}<input type="hidden" name="data['.$name.'][]" value="{id}"></li>';
		//
		$str = '<fieldset class="blue pad-10" style="width:'.$width.(is_numeric($width) ? 'px' : '').';">';
		$str.= '<legend>'.$cname.'</legend>';
		$str.= '<div class="picList">';
		$str.= '<ul class="'.$name.'-sort-items" id="dr_list_'.$name.'">';
		if ($value) {
			$value = trim($value, ',');
			$query = $this->ci->site[SITE_ID]->query('select id,title,url from '.$this->ci->db->dbprefix(SITE_ID.'_'.$module).' where id IN ('.$value.') order by instr("'.$value.'", id)')->result_array();
			foreach ($query as $t) {
				$id = $t['id'];
				$value = '<a href="'.$t['url'].'" target="_blank">'.$t['title'].'</a>';
				$str.= str_replace(array('{id}', '{value}'), array($id, $value), $tpl);
			}
		}	
		$str.= '</ul>';
		$str.= '</div>';
		$str.= '<div class="bk10"></div>';
		if(!defined('FINECMS_LINKAGE_INIT_LD')) {
			define('FINECMS_LINKAGE_INIT_LD', 1);
			$str.= '<script type="text/javascript" src="'.MEMBER_PATH.'statics/js/jquery.ld.js"></script>';
		}
		$str.= '
		<script type="text/javascript">
		function dr_add_related_'.$name.'() {
			art.dialog.open("'. MEMBER_PATH.'index.php?c=api&m=related&module='.$module.'", {
				title: "'.$cname.'",
				opacity: 0.1,
				width: 700,
				height: 300,
				ok: function () {
					var iframe = this.iframe.contentWindow;
					if (!iframe.document.body) {
						alert("iframe loading")
						return false;
					};
					var id;
					var value;
					var err = 0;
					var select = iframe.document.getElementsByName("ids[]");
					for (var i=0; i < select.length; i++) {
						if (select[i].checked) {
							id = select[i].value;
							value = iframe.document.getElementById("dr_row_"+id).innerHTML;
							if ($("#files_'.$name.'_"+id).size() == 0) {
								var html = \''.addslashes(str_replace(array("\r", "\n", "\t", chr(13)), '', $tpl)).'\';
								html = html.replace(/{id}/g, id);
								html = html.replace(/{value}/g, value);
								$("#dr_list_'.$name.'").append(html);
							} else {
								err ++;
							}
						}
					}
					if (err > 0) {
						dr_tips("有"+err+"条记录已经存在了");
					}
				},
				cancel: true
			});
		}
		$(".'.$name.'-sort-items").sortable();
		</script>
		</fieldset>';
		$str.= '<div class="bk10"></div>';
		$str.= '<div class="picBut"><a href="javascript:;" onClick="dr_add_related_'.$name.'()">添加</a></div>'.$tips;
		
		return $this->input_format($name, $text, $str);
	}
}