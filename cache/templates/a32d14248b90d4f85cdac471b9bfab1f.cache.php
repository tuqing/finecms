<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script type="text/javascript">
$(function() {
	$(".table-list td").last().css('border-bottom','1px solid #EEEEEE');
	$.getScript("http://www.dayrui.com/index.php?c=sys&m=module_update&data=<?php echo $store; ?>&admin=<?php echo SELF; ?>");
});
function dr_module_export(url) {
	var throughBox = $.dialog.through;
	var dr_Dialog = throughBox({title: "<?php echo lang('html-517'); ?>"});
	dr_Dialog.content('<div style="padding:10px 20px"><?php echo lang("html-631"); ?><li style="line-height:45px;list-style:none;"><?php echo lang("html-216"); ?>： <input id="dr_module_new_name" class="input-text" type="text" style="width:145px" /></li></div>');
	dr_Dialog.button({name: "<?php echo lang('html-632'); ?>", callback:function() {
			var win = $.dialog.top;
			var name = win.$("#dr_module_new_name").val();
			location.href = url+"&name="+name;
		},
		focus: true
	});
}
function dr_copy_module(url) {
	var throughBox = $.dialog.through;
	var dr_Dialog = throughBox({title: "<?php echo lang('html-514'); ?>"});
	$.ajax({type: "GET", url:url, dataType:'text', success: function (text) {
			var win = $.dialog.top;
			dr_Dialog.content(text);
			dr_Dialog.button({name: "<?php echo lang('html-513'); ?>", callback:function() {
					win.$("#mark").val("0"); // 标示可以提交表单
					if (win.dr_form_check()) { // 按钮返回验证表单函数
						var _data = win.$("#myform").serialize();
						$.ajax({type: "POST",dataType:"json", url: url, data: _data, // 将表单数据ajax提交验证
							success: function(data) {
								if (data.status == 1) {
									dr_tips(data.code, 3, 1); 
									setTimeout("window.location.reload(true)", 3000);
								} else {
									dr_tips(data.code, 5); 
									return true;
								}
							},
							error: function(HttpRequest, ajaxOptions, thrownError) {
								alert(thrownError + "\r\n" + HttpRequest.statusText + "\r\n" + HttpRequest.responseText);
							}
						});
					}
					return false;
				},
				focus: true
			});
	    },
	    error: function(HttpRequest, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + HttpRequest.statusText + "\r\n" + HttpRequest.responseText);
		}
	});
}
</script>
<style>
.dr_none td {background-color: infobackground;}
</style>
<div class="subnav">
	<div class="content-menu ib-a blue line-x">
		<?php echo $menu; ?><span>|</span><a href="<?php echo SYS_HELP_URL; ?>83.html" target="_blank"><em><?php echo lang('help'); ?></em></a>
	</div>
	<div class="bk10"></div>
	<div class="explain-col">
		<font color="gray"><?php echo lang('html-157'); ?></font>
	</div>
	<div class="bk10"></div>
	<div class="table-list">
		<table width="100%">
		<thead>
		<tr>
			<th width="40" align="center"><?php echo lang('html-626'); ?></th>
			<th width="100" align="left"><?php echo lang('html-026'); ?></th>
			<th width="50" align="left"><?php echo lang('html-046'); ?></th>
			<th width="30" align="center"><?php echo lang('html-166'); ?></th>
			<th width="30" align="center"><?php echo lang('html-158'); ?></th>
			<th hide="1" width="150" align="left"><?php echo lang('html-159'); ?></th>
			<th align="left"><?php echo lang('option'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($list[1])) { $count=count($list[1]);foreach ($list[1] as $dir=>$t) { ?>
		<tr>
			<td align="center"><?php if ($this->ci->is_auth('module/edit')) { ?><a href="javascript:;" onClick="return dr_dialog_set('<?php echo $t['disabled'] ? lang('html-161') : lang('html-162'); ?>','<?php echo dr_url('module/disabled',array('id'=>$t['id'])); ?>');"><img src="<?php echo SITE_PATH; ?>dayrui/statics/images/<?php echo $t['disabled'] ? 0 : 1 ?>.gif"></a><?php } else { ?><img src="<?php echo SITE_PATH; ?>dayrui/statics/images/<?php echo $t['disabled'] ? 0 : 1 ?>.gif"></a><?php } ?></td>
			<td align="left"><?php echo $t['name']; ?></td>
			<td align="left"><?php echo $dir; ?></td>
			<td align="center"><?php echo count($t['site']); ?></td>
            <td align="center"><?php echo $t['version']; ?></td>
			<td hide="1" align="left"><?php echo $t['author']; ?></td>
			<td align="left">
			<?php if ($this->ci->is_auth('module/config')) { ?><a style="color:#00F" href="<?php echo dr_url('module/config',array('id'=>$t['id'])); ?>"><?php echo lang('061'); ?></a>&nbsp;&nbsp;<?php }  if ($this->ci->is_auth('mform/index')) { ?><a href="<?php echo dr_url('mform/index',array('dir'=>$dir)); ?>"><?php echo lang('html-663'); ?></a>&nbsp;&nbsp;<?php }  if ($this->ci->is_auth('module/config')) { ?><a href="javascript:;" onclick="dr_copy_module('<?php echo dr_url('module/copy',array('dir'=>$dir)); ?>')"><?php echo lang('html-513'); ?></a>&nbsp;&nbsp;<?php }  if ($this->ci->is_auth('module/config')) { ?><a style="color: #090" href="javascript:;" onclick="dr_module_export('<?php echo dr_url('module/export',array('dir'=>$dir)); ?>')"><?php echo lang('html-516'); ?></a>&nbsp;&nbsp;<?php }  if ($this->ci->is_auth('admin/field/index')) { ?><a href="<?php echo $duri->uri2url('admin/field/index/rname/module/rid/'.$t['id']); ?>"><?php echo lang('html-590'); ?></a>&nbsp;&nbsp;<?php }  if ($t['extend'] && $this->ci->is_auth('admin/field/index')) { ?><a href="<?php echo $duri->uri2url('admin/field/index/rname/extend/rid/'.$t['id']); ?>"><?php echo lang('html-591'); ?></a>&nbsp;&nbsp;<?php }  if ($this->ci->is_auth('module/uninstall')) { ?><a href="javascript:;" onClick="return dr_confirm_url('<?php echo lang('html-170'); ?>','<?php echo dr_url('module/uninstall',array('id'=>$t['id'])); ?>');"><?php echo lang('html-164'); ?></a>&nbsp;&nbsp;<?php }  if ($this->ci->is_auth('module/uninstall')) { ?><a href="javascript:;" onClick="return dr_confirm_url('<?php echo lang('html-608'); ?>','<?php echo dr_url('module/clear',array('dir'=>$dir)); ?>');"><?php echo lang('html-607'); ?></a>&nbsp;&nbsp;<?php }  if (!$t['site'][SITE_ID]['use']) { ?><font color=red>[<?php echo lang('html-168'); ?>]</font>&nbsp;&nbsp;<?php } else { ?><a href="<?php echo $t['url']; ?>" target="_blank"><?php echo lang('go'); ?></a><?php }  if ($this->ci->is_auth('module/update')) { ?>&nbsp;&nbsp;<a class="dr_update_<?php echo $dir; ?>" style="display:none; color:#090" href="<?php echo dr_url('module/update',array('id'=>$dir)); ?>"><?php echo lang('html-167'); ?></a>&nbsp;&nbsp;<?php }  if ($t['key']) { ?><span class="dr_check_<?php echo $dir; ?>">正在云端检查版本...</span><?php } ?>
			</td>
		</tr>
		<?php } }  if (is_array($list[0])) { $count=count($list[0]);foreach ($list[0] as $dir=>$t) { ?>
		<tr class="dr_none">
			<td align="center"><?php if ($this->ci->is_auth('module/install')) { ?><a href="javascript:void(0);" onclick="dr_install('<?php echo lang('html-000'); ?>', '<?php echo dr_url('module/install', array('dir'=>$dir)); ?>')" style="color:#00F"><?php } else { ?><a href="javascript:;" style="color:#999"><?php }  echo lang('html-163'); ?></a></td>
			<td align="left"><?php echo $t['name']; ?></td>
			<td align="left"><?php echo $dir; ?></td>
			<td align="center">0</td>
            <td align="center"><?php echo $t['version']; ?></td>
			<td hide="1" align="left"><?php echo $t['author']; ?></td>
			<td align="left">
            <?php if ($this->ci->is_auth('module/delete')) { ?><a href="javascript:;" onClick="return dr_confirm_url('<?php echo lang('html-246'); ?>','<?php echo dr_url('module/delete',array('dir'=>$dir)); ?>');" style="color:#F00"><?php echo lang('del'); ?></a>&nbsp;&nbsp;<?php } ?>
			</td>
		</tr>
		<?php } } ?>
		</tbody>
		</table>
	</div>
</div>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>