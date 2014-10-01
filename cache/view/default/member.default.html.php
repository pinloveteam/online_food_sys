<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo cls_config::get("site_title","sys");?>-会员中心</title>
<meta name="keywords" content="<?php echo cls_config::get("keywords","sys");?>"/>
<meta name="description" content="<?php echo cls_config::get("description","sys");?>"/>
<link rel="stylesheet" type="text/css" href="/webcss/common/images/common.css"/>
<link rel="stylesheet" type="text/css" href="/webcss/common/images/expand.css"/>
<link rel="stylesheet" type="text/css" href="/webcss/default/images/css.css"/>
<link rel="stylesheet" type="text/css" href="/webcss/default/images/member.css"/>
<script src="<?php echo cls_config::get("dirpath","base");?>/common.php?app=sys&app_act=web.config&app_ajax=1"></script>
<script src="/webcss/common/js/kj.js"></script>
<script src="/webcss/common/js/kj.page.js"></script>
<script src="/webcss/common/js/kj.ajax.js"></script>
<style>
.me_state_float{position:absolute;}
</style>
</head>
<body>
<?php include cls_resolve::on_resolve('/default\/member_header')?>
<div class="main">
	<div style="float:left;width:100%;height:5px;font-size:0px">&nbsp;</div>
	<?php include cls_resolve::on_resolve('/default\/member_left')?>
	<div style="float:left;width:730px;">
		<div class="member_right1">订单明细</div>
		<div class="member_right3" style="font-size:12px;">
		<?php foreach($order_list['list'] as $item=>$key){ ?>
			<div class="member_right9a">
				<div class="member_right9b">• <font class="txt_redB"><?php echo $item;?></font>（<?php echo fun_get::weekday($item);?>）</div>
			
				<?php foreach($key as $order){ ?>
				<div class="member_right9c">
					<div style="float:left;width:90%">&nbsp;&nbsp;&nbsp;<a href="index.php?app_act=shop&id=<?php echo $order['order_shop_id'];?>" style="color:#888888"><?php echo $order_list['shop']['id_'.$order['order_shop_id']];?></a></div>
					<div class="member_right9d1"><font class="txt_orangeB"><?php echo $order['addtime'];?></font><br><?php echo $order['order_name'];?>/<?php echo $order['order_sex'];?></div>
					<div class="member_right9d2">
					<?php foreach($order['menu'] as $menu){ ?>
						<div class="member_right9f" >
							<div class="member_right9f1" style="height:auto">
							<?php $price=0;?>
							<?php foreach($menu as $item){ ?>
								<?php $price+=$order_list['price']['id_'.$item];?>
								<li style="float:left;padding-left:10px"><?php echo $order_list['menu']['id_'.$item]['menu_title'];?></li>
							<?php }?>
							</div>
							<div class="member_right9f2">￥<?php echo $price;?> × <?php echo $order['menunum'][implode(',',$menu)];?> = ￥<?php echo $order['menunum'][implode(',',$menu)]*$price;?></div>
						</div>
					<?php }?>
					</div>
					<div class="member_right9d3">总计：<?php echo $order['order_total'];?><?php if(!empty($order['order_score_money'])){?><br>抵扣：<?php echo $order['order_score_money'];?><?php }?><?php if(!empty($order['order_favorable'])){?><br>优惠：<?php echo $order['order_favorable'];?><?php }?><br>应付：<font class="txt_redB"><?php echo $order['order_total_pay'];?></font></div>
				</div>
				<?php }?>
			</div>
		<?php }?>
		</div>

			
		<div class="pPage" id="id_pPage" style="margin-top:20px">
		<?php echo $order_list['pagebtns'];?>
		</div>        
	</div>
</div>
<?php include cls_resolve::on_resolve('/default\/footer')?>
</body>
</html>