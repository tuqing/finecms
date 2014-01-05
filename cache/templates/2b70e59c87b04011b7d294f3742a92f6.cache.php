<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script type="text/javascript">
$(function() {
	setTimeout(function(){ location.href = "<?php echo $url; ?>"; }, 100);
});
</script>
<div class="subnav">
	<div class="content-menu ib-a blue line-x">
		<?php echo $menu; ?>
	</div>
	<div class="bk10"></div>
	<div class="table-list" id="online">
		<div style="text-align:center; padding:80px;">
        	<img src="<?php echo SITE_URL; ?>dayrui/statics/images/loading-yun.gif" />
            正在努力访问云端服务器 ...
        </div>
	</div>
</div>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>