<?php if ($fn_include = $this->_include("header.html", "/")) include($fn_include); ?>
<script language="javascript">
// 选中导航菜单
$("#dr_nav_10").attr("class", "curr");
</script>
<div class="newshot">
    <ul>
        <!--循环栏目作为导航栏目，pid=0表示顶级栏目-->
        <?php $return = $this->list_tag("action=category pid=0"); if ($return) extract($return); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { ?>
        <!--下面那句if表示当前栏目时就加粗高亮显示-->
        <li <?php if (in_array($catid, $t['catids'])) { ?> style="font-weight:bold;"<?php } ?>><a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a></li>
        <?php } }  echo $error; ?>
    </ul>
</div>