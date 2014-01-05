<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="clear"></div>
<div class="idx"><img src="<?php echo HOME_THEME_PATH; ?>images/ad.jpg" width="100%" /></div>
<div class="clear"></div>
<div class="news">
	<div class="news_l">
		<link href="<?php echo HOME_THEME_PATH; ?>images/slide.css" type="text/css" rel="stylesheet">
        <div id="myslide" style="width:305px;height:325px">
            <table width="100%" cellSpacing="0" cellPadding="0">
            <tr>
            <td class="pic" id="bimg" style="height:281px">
            	<!--查询推荐位2（首页幻灯）的内容，field需要用到的字段（不填表示全部），按displayorder（后台指定排序）排序-->
                <?php $return = $this->list_tag("action=module flag=2 field=thumb,title,url order=displayorder,updatetime num=5"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
                <div class="<?php if ($key==0) { ?>dis<?php } else { ?>undis<?php } ?>" name="f">
                <a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>" <?php if ($t['target']) { ?>target="_blank"<?php } ?>><img alt="<?php echo $t['title']; ?>" style="width:305px;height:281px;" src="<?php echo dr_thumb($t['thumb'], 300, 280); ?>" border="0"></a>
                </div>
                <?php } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删除-->
                <table id="font_hd" width="100%" cellSpacing="0" cellPadding="0">
                <tr>
                <td class="title" id="info">
                <?php $return = $this->list_tag("action=module flag=2 field=thumb,title,url order=displayorder,updatetime num=5"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
                <div class="<?php if ($key==0) { ?>dis<?php } else { ?>undis<?php } ?>" name="f">
                <a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>" <?php if ($t['target']) { ?>target="_blank"<?php } ?>><?php echo $t['title']; ?></a>
                </div>
                <?php } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删-->
                </td>
                <td id="simg" nowrap="nowrap" style="text-align:right">
               <?php $return = $this->list_tag("action=module flag=2 field=thumb,title,url order=displayorder,updatetime num=5"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
                <div class="<?php if ($key==0) {  } else { ?>f1<?php } ?>" onclick=play(x[<?php echo $key; ?>],<?php echo $key; ?>) name="f"><?php echo $key+1; ?></div>
                <?php } } ?><!--如果查询为空，error变量会返回错误提示，正式上线建议-->
                </td>
                </tr>
                </table>
                <script src="<?php echo HOME_THEME_PATH; ?>js/slide.js"></script>
            </td>
            </tr>
            </table>
        </div>
    </div>
	<div class="news_c">
		<ul>
        <!--查询推荐位1（首页中间）的内容，field需要用到的字段（不填表示全部），按displayorder（后台指定排序）排序-->
        <?php $return = $this->list_tag("action=module flag=1 field=title,url order=displayorder,updatetime num=15"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
        <li <?php if ($key%5==0) { ?>class="tt"<?php } ?>><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php if ($key%5==0) {  echo dr_strcut($t['title'], 45, '');  } else {  echo dr_strcut($t['title'], 24, '');  } ?></a></li>
        <?php } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删-->
		</ul>
	</div>
	<div class="news_r">
		<div class="tit"><h4 class="l">今日视点</h4></div>
		<ul>
			<!--查询推荐位3（今日视点）的内容，field需要用到的字段（不填表示全部），按displayorder（后台指定排序）排序-->
            <?php $return = $this->list_tag("action=module flag=3 field=thumb,title,url,description order=displayorder,updatetime num=5"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) {  if ($key<2) { ?>
            <li class="pic"><img src="<?php echo dr_thumb($t['thumb'], 70, 60); ?>" width="70" height="60" align="left" /><span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 20); ?></a></span><div class="into"><?php echo dr_strcut($t['description'], 30); ?></div></li>
			<?php } else { ?>
			<li class="nopic"><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 40); ?></a></li>
			<?php }  } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删-->
		</ul>
	</div>
</div>
<div class="clear"></div>	
<div class="newstwo">
    <div class="newstwo_l">
        <h4>推荐阅读</h4>
        <div class="clear"></div>
        <ul>
            <!--查询推荐位4（推荐阅读）的内容，field需要用到的字段（不填表示全部），按displayorder（后台指定排序）排序-->
            <?php $return = $this->list_tag("action=module flag=4 field=thumb,title,url,description order=displayorder,updatetime num=0,6"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) {  if ($key==0) { ?>
            <li class="pic"><img src="<?php echo dr_thumb($t['thumb'], 108, 82); ?>" width="108" align="left" /><span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 25); ?></a></span><div class="into"><?php echo dr_strcut($t['description'], 70); ?></div></li>
            <?php } else { ?>
            <li class="nopic"><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 40); ?></a></li>
            <?php }  } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删-->
        </ul>
        <ul>
            <!--查询推荐位4（推荐阅读）的内容，field需要用到的字段（不填表示全部），按displayorder（后台指定排序）排序-->
            <?php $return = $this->list_tag("action=module flag=4 field=thumb,title,url,description order=displayorder,updatetime num=6,6"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) {  if ($key==0) { ?>
            <li class="pic"><img src="<?php echo dr_thumb($t['thumb'], 108, 82); ?>" width="108" align="left" /><span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 25); ?></a></span><div class="into"><?php echo dr_strcut($t['description'], 70); ?></div></li>
            <?php } else { ?>
            <li class="nopic"><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 40); ?></a></li>
            <?php }  } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删-->
        </ul>
    </div>
	<div class="newstwo_r">
		<h4 class="l">新闻焦点</h4>
        <ul>
            <!--查询推荐位5（新闻焦点）的内容，field需要用到的字段（不填表示全部），按displayorder（后台指定排序）排序-->
            <?php $return = $this->list_tag("action=module flag=5 field=thumb,title,url,description order=displayorder,updatetime num=5"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) {  if ($key<2) { ?>
            <li class="pic"><img src="<?php echo dr_thumb($t['thumb'], 70, 60); ?>" width="70" height="60" align="left" /><span><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 20); ?></a></span><div class="into"><?php echo dr_strcut($t['description'], 30); ?></div></li>
            <?php } else { ?>
            <li class="nopic"><a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>"><?php echo dr_strcut($t['title'], 35); ?></a></li>
            <?php }  } }  echo $error; ?><!--如果查询为空，error变量会返回错误提示，正式上线建议删-->
        </ul>
    </div>
</div>
<div class="clear"></div>
<div class="idx"><img src="<?php echo HOME_THEME_PATH; ?>images/ad.jpg" width="100%" /></div>
<div class="clear"></div>
<!--循环输出顶级栏目下面的子栏目及其内容，运用到了双list循环标签因此需要定义返回值return=c（都懂得）-->
<?php $return_c = $this->list_tag("action=category pid=0  return=c"); if ($return_c) extract($return_c); $count_c=count($return_c); if (is_array($return_c)) { foreach ($return_c as $key_c=>$c) { ?>
<div class="newsthree">
    <div class="h1">
        <h4 class="l"><?php echo $c['name']; ?></h4>
        <div class="r">
        	<!--循环输出当前栏目下面的子栏目，运用到了双list循环标签因此需要定义返回值return=c（都懂得）-->
        	<?php $return_c2 = $this->list_tag("action=category pid=$c[id]  return=c2"); if ($return_c2) extract($return_c2); $count_c2=count($return_c2); if (is_array($return_c2)) { foreach ($return_c2 as $key_c2=>$c2) { ?>
            <a href="<?php echo $c2['url']; ?>" title="<?php echo $c2['name']; ?>"><?php echo $c2['name']; ?></a>
            <?php } }  echo $error; ?>
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