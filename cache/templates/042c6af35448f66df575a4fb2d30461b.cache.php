<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<style type="text/css">
html{ _overflow-y:scroll }
tr { height:23px;}
.td { height:20px;overflow:hidden}
</style>
<div id="main_frameid" class="pad-10" style="_margin-right:-12px;_width:98.9%;">
	<script type="text/javascript">
    $(function(){
        $.getScript("http://www.dayrui.com/index.php?c=sys&m=news");
        $.getScript("http://www.dayrui.com/index.php?c=sys&m=juan");
        $.getScript("http://www.dayrui.com/index.php?c=sys&m=license&domain=<?php echo SITE_URL; ?>&admin=<?php echo SELF; ?>&version=<?php echo DR_VERSION_ID; ?>");
        if ($.browser.msie && parseInt($.browser.version) < 8) $('#browserVersionAlert').show();
        if (screen.width <= 900) $('#screenAlert').show();
		<?php if ($member['adminid'] == 1) { ?>
		$.getScript("http://www.dayrui.com/index.php?c=sys&m=store&data=<?php echo $store; ?>&admin=<?php echo SELF; ?>");
		<?php } ?>
    }); 
    </script>
	<div class="explain-col mb10" id="screenAlert" style="display:none"><font color="#FF0000"><?php echo lang('html-243'); ?></font></div>
	<div class="explain-col mb10" id="browserVersionAlert" style="display:none"><font color="#FF0000"><?php echo lang('html-018'); ?></font></div>
	<div class="col-2 lf mr10" style="width:48%">
		<h6><?php echo lang('html-019'); ?></h6>
		<div class="content" style="height:170px;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="24%" align="right"><?php echo lang('html-035'); ?>：</td>
              <td width="25%"><div class="td">&nbsp;<?php echo $admin['username']; ?>&nbsp;<?php if ($admin['realname']) { ?>(<?php echo $admin['realname']; ?>)<?php } ?></div></td>
              <td width="20%" align="right"><?php echo lang('html-021'); ?>：</td>
              <td width="35%">&nbsp;<?php echo $admin['role']['name']; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang('html-020'); ?>：</td>
              <td><div class="td">&nbsp;<?php echo dr_date($admin['lastlogintime']); ?></div></td>
              <td align="right"><?php echo lang('html-022'); ?>：</td>
              <td>&nbsp;<a href="http://www.baidu.com/baidu?wd=<?php echo $admin['lastloginip']; ?>" target=_blank><?php echo $admin['lastloginip']; ?></a></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang('html-023'); ?>：</td>
              <td><div class="td">&nbsp;<?php echo dr_date($admin['logintime']); ?></div></td>
              <td align="right"><?php echo lang('html-024'); ?>：</td>
              <td>&nbsp;<a href="http://www.baidu.com/baidu?wd=<?php echo $admin['lastloginip']; ?>" target=_blank><?php echo $admin['loginip']; ?></a></td>
            </tr>
            </table>
            <div class="bk20 hr"><hr></div>
            <table width="96%" style="margin-top:10px;">
			<tbody>
			<tr>
				<td width="25%" align="center"><a href="<?php echo dr_url('site/config'); ?>"><img width="40" height="40" src="<?php echo SITE_PATH; ?>dayrui/statics/images/m3.png"></a></td>
				<td width="25%" align="center"><a href="<?php echo dr_url('module/index'); ?>"><img width="40" height="40" src="<?php echo SITE_PATH; ?>dayrui/statics/images/m2.png"></a></td>
				<td width="25%" align="center"><a href="<?php echo dr_url('application/index'); ?>"><img width="40" height="40" src="<?php echo SITE_PATH; ?>dayrui/statics/images/m4.png"></a></td>
				<td width="25%" align="center"><a href="<?php echo dr_url('member/home/index'); ?>"><img width="40" height="40" src="<?php echo SITE_PATH; ?>dayrui/statics/images/m1.png"></a></td>
			</tr>
			<tr>
				<td height="33" align="center"><a href="<?php echo dr_url('site/config'); ?>"><?php echo lang('060'); ?></a></td>
				<td height="33" align="center"><a href="<?php echo dr_url('module/index'); ?>"><?php echo lang('073'); ?></a></td>
				<td height="33" align="center"><a href="<?php echo dr_url('application/index'); ?>"><?php echo lang('219'); ?></a></td>
				<td height="33" align="center"><a href="<?php echo dr_url('member/home/index'); ?>"><?php echo lang('237'); ?></a></td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
    <div class="col-2 col-auto">
        <h6><?php echo lang('html-029'); ?></h6>
        <div class="content" style="height:170px;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="18%" align="right"><?php echo lang('html-030'); ?>：</td>
              <td width="20%">&nbsp;<?php echo DR_VERSION; ?>&nbsp; <span id="finecms_version"></span></td>
              <td width="20%" align="right"><?php echo lang('html-031'); ?>：</td>
              <td width="45%">&nbsp;<a href="http://www.dayrui.com/cms/" target="_blank">FineCMS for <?php echo DR_NAME; ?></a></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang('html-032'); ?>：</td>
              <td>&nbsp;PHP <?php echo PHP_VERSION; ?></td>
              <td align="right"><?php echo lang('html-033'); ?>：</td>
              <td>&nbsp;MySql <?php echo $sqlversion; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang('html-034'); ?>：</td>
              <td colspan="3">&nbsp;<?php echo dr_strcut($_SERVER['SERVER_SOFTWARE'], 70); ?></td>
            </tr>
            </table>
            <div class="bk20 hr"><hr></div>
			<div id="finecms_license">
			
			</div>
         </div>
    </div>
    <div class="bk10"></div>
    <div class="col-2 lf mr10" style="width:48%">
        <h6><?php echo lang('html-037'); ?></h6>
        <div class="content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="20%" align="right"><?php echo lang('html-038'); ?>：</td>
              <td>&nbsp;<a href="http://www.finecms.net/home.php?mod=space&amp;uid=1" target="_blank">dayrui</a></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang('html-039'); ?>：</td>
              <td>
              &nbsp;<a href="http://www.finecms.net/home.php?mod=space&amp;uid=849" target="_blank">jess</a>
              &nbsp;<a href="http://www.finecms.net/home.php?mod=space&amp;uid=2029" target="_blank">chunjie</a>
              &nbsp;<a href="http://www.finecms.net/home.php?mod=space&amp;uid=2030" target="_blank">fanfan</a>
              </td>
            </tr>
            <tr>
              <td align="right" valign="top" style="padding-top:2px;">感谢捐赠者：</td>
              <td style="padding-right:5px;padding-top:2px;"><div id="finecms_juan" ></div></td>
            </tr>
			<tr>
              <td align="right" valign="top" style="padding-top:2px;">捐赠我们：</td>
              <td><a href="http://www.finecms.net/forum.php?mod=viewthread&tid=918" target="_blank">http://www.finecms.net/forum.php?mod=viewthread&tid=918</a></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang('html-041'); ?>：</td>
              <td>
              &nbsp;<a href="http://www.dayrui.com" target="_blank">官方网站</a>
              &nbsp;<a href="http://store.dayrui.com" target="_blank">应用商城</a>
              &nbsp;<a href="http://i.dayrui.com" target="_blank">客服中心</a>
              &nbsp;<a href="http://www.finecms.net" target="_blank">技术论坛</a>
              </td>
            </tr>
            </table>
        </div>
    </div>
    <div class="col-2 col-auto">
        <h6><?php echo lang('html-036'); ?></h6>
        <div class="content" id="finecms_news">
        
        </div>
    </div>
</div>
</body>
</html>