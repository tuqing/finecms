<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="clear"></div>
<div class="idx"><img src="<?php echo HOME_THEME_PATH; ?>images/ad.jpg" width="100%" /></div>
<div class="clear"></div>

<!--循环输出当前栏目下面的子栏目及其内容，运用到了双list循环标签因此需要定义返回值return=c（都懂得）-->
<?php $return_c = $this->list_tag("action=category pid=$catid  return=c"); if ($return_c) extract($return_c); $count_c=count($return_c); if (is_array($return_c)) { foreach ($return_c as $key_c=>$c) { ?>
<div class="newsthree">
    <div class="h1">
        <h4 class="l"><?php echo $c['name']; ?></h4>
        <div class="r">
            <a href="<?php echo $c['url']; ?>">更多>></a>
		</div>
    </div>
	<div class="clear"></div>
	<div class="newsthree_l">
		<ul>
        	<!--循环输出当前栏目下面的数据，我们按缩略图排序，因为第一行要输出一个图片，你懂得！-->
        	<?php $return = $this->list_tag("action=module catid=$c[id] field=thumb,title,url,description order=thumb,updatetime num=8"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) {  if ($key==0) { ?>
            <li class="pic"><img src="<?php echo dr_thumb($t['thumb'], 108, 82); ?>" width="108" height="82" align="left" /><span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 25); ?></a></span><div class="into"><?php echo dr_strcut($t['description'], 70); ?></div></li>
            <?php } else { ?>
            <li class="nopic"><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 44); ?></a></li>
            <?php }  } }  echo $error; ?>
		</ul>
	</div>
	<div class="newsthree_c">
		<ul>
        	<!--循环输出当前栏目下面的数据，我们按最新排序-->
        	<?php $return = $this->list_tag("action=module catid=$c[id] field=title,url,updatetime order=updatetime num=12"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
            <li><span class="date">[<?php echo dr_date($t['_updatetime'], 'm-d'); ?>]</span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 40); ?></a></li>
            <?php } }  echo $error; ?>
		</ul>	
	</div>
	<div class="newsthree_r">
		<div class="tit"><h4 class="l">阅读排行</h4></div>
		<div class="clear"></div>
		<ul>
		<!--循环输出当前栏目下面的数据，我们按点击排序-->
        <?php $return = $this->list_tag("action=module catid=$c[id] field=title,url order=hits num=10"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
        <li><span <?php if ($key<3) { ?>class="one"<?php } ?>><?php echo $key+1; ?></span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 33); ?></a></li>
        <?php } }  echo $error; ?>
		</ul>
	</div>
</div>
<div class="clear"></div>
<?php } }  echo $error; ?>
<div class="idx"><img src="<?php echo HOME_THEME_PATH; ?>images/ad.jpg" width="100%" /></div>
<div class="clear"></div>
<?php if ($fn_include = $this->_include("footer.html", "/")) include($fn_include); ?><script type="text/javascript" src="http://www.vfinecms.com/index.php?c=cron"></script>