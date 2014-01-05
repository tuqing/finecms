<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $meta_title; ?></title>
	<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
	<meta name="description" content="<?php echo $meta_description; ?>" />
	<!--非授权用户请保留FineCMS的信息-->
	<meta name="author" content="dayrui.com" />
	<meta name="Copyright" content="FineCMS v<?php echo DR_VERSION; ?>" />
    <link href="<?php echo HOME_THEME_PATH; ?>images/home.css" rel="stylesheet" />
	<!--关键JS--> 
	<script type="text/javascript">var memberpath = "<?php echo MEMBER_PATH; ?>";</script>
	<script type="text/javascript" src="<?php echo MEMBER_PATH; ?>statics/js/<?php echo SITE_LANGUAGE; ?>.js"></script>
	<script type="text/javascript" src="<?php echo MEMBER_PATH; ?>statics/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo MEMBER_PATH; ?>statics/js/jquery.artDialog.js?skin=default"></script>
	<script type="text/javascript" src="<?php echo MEMBER_PATH; ?>statics/js/dayrui.js"></script>
	<!--[if IE 6]>
	<script src="<?php echo HOME_THEME_PATH; ?>js/ie6png.js" type="text/javascript"></script>
	<script type="text/javascript">
	   EvPNG.fix('div, ul, img, li, input'); 
	</script>
	<![endif]-->
    <script type="text/javascript">
    $(function(){
		// 回到顶部
		$("#back-to-top").hide();
		$(window).scroll(function(){
		 if ($(window).scrollTop()>100){
			$("#back-to-top").fadeIn(1500);
			} else {
			$("#back-to-top").fadeOut(1500);
			}
		});
		$("#back-to-top").click(function(){
			$('body,html').animate({scrollTop:0},1000);
			return false;
		});
		// 搜索
		$("#dr_headSel li").click(function(){
			if($('#keyword').val()=='请输入搜索内容，如：FineCMS') $('#keyword').val('');
			$("#dr_headSel").toggle();
			var dir = $(this).attr('dir');
			var name = $(this).children('a').html();
			$("#dr_headSlected").html(name);
			$("#dr_module").val(dir);
		});
	});
	
	function dr_head_show_hide(){
		$("#dr_headSel").toggle();
	}
	
	function dr_top_search() {
		var keyword = $('#keyword').val();
		if (keyword == '请输入关键字') keyword = '';
		if (!keyword) {
			alert("请输入关键字");
			return;
		}
		// 按模块组合搜索地址
		var module = $("#dr_module").val();
		if (module) {
			window.location.href='<?php echo SITE_URL; ?>'+module+'/index.php?c=search&keyword='+keyword;
		} else {
			alert("你没有选择模块呢");
		}
	}
	</script>
</head>
<body>
<div id="back-to-top" style="display: block;"><a href="#top">TOP</a></div>
<!--网站头部 begin-->
<div class="head">
	<div class="idx" style="margin-top:0px">
        <div class="l">
            <div id="loginForm">
                <div id="haslogin"><script type="text/javascript" src="<?php echo SITE_URL; ?>member/index.php?c=api&m=userinfo"></script></div>
            </div>
        </div>
        <div class="r">
        	<!--下面4个链接我就写死了哦-->
   			<a href="<?php echo SITE_URL; ?>" class="bgone"><b>首页</b></a>
       	 	<a href="javascript:void(0);" onclick="dr_set_homepage('<?php echo SITE_URL; ?>')">设为首页</a>
        	<a href="javascript:void(0);" onclick="dr_add_favorite('<?php echo SITE_URL; ?>','<?php echo SITE_TITLE; ?>')">加入收藏</a>
   			<a href="<?php echo SITE_URL; ?>index.php?c=api&m=desktop&site=<?php echo SITE_ID; ?>&module=<?php echo APP_DIR; ?>">放在桌面</a>
        	<!--调用type=1的网站导航数据-->
        	<?php $return = $this->list_tag("action=navigator type=1 num=10"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
            <a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>" <?php if ($t['target']) { ?>target="_blank"<?php } ?>><?php echo $t['name']; ?></a>
            <?php } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删除-->
   			<a href="<?php echo SITE_URL; ?>index.php?c=home&m=select_template"><?php if ($is_mobile) { ?>电脑版<?php } else { ?>手机版<?php } ?></a>
        </div>
    </div>
</div>
<div class="ilogo">
	<div class="logo"><a href="<?php echo SITE_URL; ?>" title="<?php echo SITE_TITLE; ?>"><img src="<?php echo HOME_THEME_PATH; ?>images/logo.png" /></a></div>
	<!-----搜索条----->
	<div class="sc">
 		<div class="scbox">
     		<div class="selSearch">
				<div class="nowSearch" onclick="dr_head_show_hide()" id="dr_headSlected">...</div>
				<div class="btnSel"><a></a></div>
				<div class="clear"></div>
                <ul class="selOption" id="dr_headSel" style="display:none;">
                	<!--action=cache是缓存调用标签，name=module是调用模块缓存数据，下面是为了循环显示当前站点的模块-->
                    <?php $i=0;  $return = $this->list_tag("action=cache name=module"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
                    <!--将第一个作为默认搜索模块-->
                    <?php if ($i==0 || $t['dirname']==APP_DIR) { ?>
                    <script type="text/javascript">
					$("#dr_module").val("<?php echo $t['dirname']; ?>");
					$("#dr_headSlected").html("<?php echo $t['name']; ?>");
					</script>
                    <?php } ?>
                    <li dir="<?php echo $t['dirname']; ?>"><a href="javascript:void(0);"><?php echo $t['name']; ?></a></li>
                    <?php $i++;  } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删除-->
                </ul>
			</div>
			<input type="input" id="keyword" onfocus="this.value=(this.value=='请输入关键字')?'':this.value" onblur="this.value=(this.value=='')?'请输入关键字':this.value" class="SC_input"><input id="dr_module" type="hidden" value="<?php echo APP_DIR; ?>" />
      		<input name="" onclick="dr_top_search();" type="button" value="&nbsp;" class="scbtn" align="left" />
		</div>
       	<div class="clear"></div>
        <!--只有模块页面才有tag功能，首页不具备此功能所以不显示-->
        <div class="sc_tags">
        <?php if (APP_DIR) { ?>
	  	热搜TAGS：  
        <!--此标签用于调用tag标签，非当前模块需要加上model=模块名称,num=显示条数-->
        <?php $return = $this->list_tag("action=tag num=10"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
        <a href="<?php echo $t['url']; ?>" title="点击量：<?php echo $t['hits']; ?>"><?php echo $t['name']; ?></a>
        <?php } }  } else { ?>
        FineCMS v2，这是一套神奇的系统！
        <?php } ?>
        </div>
	</div>
    <!-----搜索条结束----->
</div>
<div class="nav">
    <ul class="dr_nav">
		<li id="dr_nav_0"><a href="<?php echo SITE_PATH; ?>">首页</a></li>
        <!--调用type=0的网站导航数据-->
        <?php $return = $this->list_tag("action=navigator type=0 num=10"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
        <li id="dr_nav_<?php echo $t['id']; ?>"><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>" <?php if ($t['target']) { ?>target="_blank"<?php } ?>><?php echo $t['name']; ?></a></li>
        <?php } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删除-->
	</ul>
</div>
<!--网站头部 end-->