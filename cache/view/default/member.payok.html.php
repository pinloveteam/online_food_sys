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
</head>
<body>
<?php include cls_resolve::on_resolve('/default\/member_header')?>
<div class="main">
	<div style="float:left;width:100%;height:5px;font-size:0px">&nbsp;</div>
	<?php include cls_resolve::on_resolve('/default\/member_left')?>
	<div style="float:left;width:730px;">
		<div class="member_right1">恭喜！您的订单已经提交！</div>
		<div class="member_right3" style="font-size:14px">
			<li>订单编号：<span style="color:#ff8800;"><?php echo $obj_order['order_number'];?></span></li>
			<li>订单金额：<span style="color:#ff8800;font-size:20px">￥<?php echo $obj_order['order_total_pay'];?></span></li>
			<?php if($obj_order['order_pay_method'] =='afterpayment'){?>
			<li>支付方式：<span style="color:#ff8800;">货到付款</span></li>
			<li><input type="button" name="btn_detail" value="查看详情" class="btn_bg3" onclick="window.open('<?php echo fun_get::url(array('app_act'=>''));?>','_self');"></li>
			<?php } else if($obj_order['order_pay_method'] == 'repayment') { ?>
			<li>支付方式：<span style="color:#ff8800;">预付款</span><span style="color:#888888">(已支付)</span></li>
			<li><input type="button" name="btn_detail" value="查看详情" class="btn_bg3" onclick="window.open('<?php echo fun_get::url(array('app_act'=>''));?>','_self');"></li>
			<?php } else { ?>
			<li>支付方式：<span style="color:#ff8800;"><?php echo $obj_order['paymethod'];?></span></li>
				<?php if($timeout == 1){?>
					<li style="border:1px #FF9800 solid;background:#FAEEDD;margin-top:20px;color:#ff0000">&nbsp;&nbsp;&nbsp;&nbsp;订单已过期，请重新点餐</li>
				<?php } else { ?>
					<li><input type="button" name="btn_pay" value="立即支付" class="btn_bg2" onclick="window.open('<?php echo fun_get::url(array('id'=>$id,'app_act'=>'order_pay'));?>','_blank');"></li>
					<li style="border:1px #FF9800 solid;background:#FAEEDD;margin-top:20px;color:#ff0000">&nbsp;&nbsp;&nbsp;&nbsp;请在<?php echo $delay_time;?> 前完成支付，否则订单将被取消</li>
				<?php }?>
			<?php }?>
			
		</div>
	</div>
</div>
<?php include cls_resolve::on_resolve('/default\/footer')?>
</body>
</html>