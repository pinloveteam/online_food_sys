<div class="menu">
	<div class="main">
		<div class="logo"><a href="index.php"><img src="/webcss/default/images/logo.gif"></a></div>
		<div class="div_m2">
		<li <?php if($app=='index' && $app_act=='default'){?> class='x_sel'<?php } else { ?>onmouseover="kj.addClassName(this,'x_sel');" onmouseout="kj.delClassName(this,'x_sel');" onclick="window.location='index.php';"<?php }?>>首页</li>
		<li <?php if($app=='index' && $app_act=='help'){?> class='x_sel'<?php } else { ?>onmouseover="kj.addClassName(this,'x_sel');" onmouseout="kj.delClassName(this,'x_sel');" onclick="window.location='index.php?app_act=help';"<?php }?>>关于我们</li>
		<?php if(fun_is::com('msg')){?>
		<li <?php if($app=='index' && $app_act=='msg'){?> class='x_sel'<?php } else { ?>onmouseover="kj.addClassName(this,'x_sel');" onmouseout="kj.delClassName(this,'x_sel');" onclick="window.location='index.php?app_act=msg';"<?php }?>>顾客留言</li>
		<?php }?>
		<?php if($this_login_user->uid>0){?>
		<li <?php if($app=='member'){?> class='x_sel'<?php } else { ?>onmouseover="kj.addClassName(this,'x_sel');" onmouseout="kj.delClassName(this,'x_sel');" onclick="window.location='index.php?app=member';"<?php }?>>会员中心</li>
		<?php }?>
		</div>
		<div class="div_top a2">
			<div class="x_1">
			您好<?php echo $this_login_user->uname;?>，欢迎光临！
			<?php if($this_login_user->uid>0){?>
				<?php if($this_login_user->type=='shop'){?><a href="?app=shop">【店铺管理】</a><?php }?><?php if($this_login_user->is_admin()){?>&nbsp;&nbsp;<a href="master.php" target="_blank">【后台管理】</a><?php }?>
				&nbsp;&nbsp;<a href="common.php?app=sys&app_act=login.out">【退出】</a>
			<?php } else { ?>
			【<a href="?app_act=login">登录</a>】【<a href="?app_act=reg">免费注册</a>】
			<?php }?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:window.external.AddFavorite(location.href,document.title);">收藏本站</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:js_header_top.share('');">分享好友</a>
			</div>
			<div class="x_2">
			<li class="share_qzone" title="分享到QQ空间" onclick="js_header_top.share('qzone');">&nbsp;</li>
			<li class="share_sina" title="分享到新浪微博" onclick="js_header_top.share('sina');">&nbsp;</li>
			<li class="share_qqweibo" title="分享到QQ微博" onclick="js_header_top.share('qqweibo');">&nbsp;</li>
			<li class="share_kaixin" title="分享到开心网" onclick="js_header_top.share('kaixin');">&nbsp;</li>
			<li class="share_renren" title="分享到人人网" onclick="js_header_top.share('renren');">&nbsp;</li>
			<li class="share_douban" title="分享到豆瓣" onclick="js_header_top.share('douban');">&nbsp;</li>
			</div>
		</div>
	</div>
</div>
<script src="/webcss/default/share.js"></script>
<script>
var js_header_top = new function() {
	this.share = function(type) {
		var o = {"title":"<?php echo cls_config::get("title","share");?>" , "cont":"<?php echo cls_config::get("cont","share");?>" , "pic":"<?php echo fun_get::html_url(cls_config::get('pic','share') , 1);?>" , "type" : type , "url" : "<?php echo cls_config::get("domain","base");?>"}
		share.to(o);
	}
}
</script>