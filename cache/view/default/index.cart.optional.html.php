<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo cls_config::get("site_title","sys");?>-购物车</title>
<meta name="keywords" content="<?php echo cls_config::get("keywords","sys");?>"/>
<meta name="description" content="<?php echo cls_config::get("description","sys");?>"/>
<link rel="stylesheet" type="text/css" href="/webcss/common/images/common.css"/>
<link rel="stylesheet" type="text/css" href="/webcss/common/images/expand.css"/>
<link rel="stylesheet" type="text/css" href="/webcss/default/images/css.css"/>
<script src="<?php echo cls_config::get("dirpath","base");?>/common.php?app=sys&app_act=web.config&app_ajax=1"></script>
<script src="/webcss/common/js/kj.js"></script>
<script src="/webcss/common/js/kj.ajax.js"></script>
<script src="/webcss/common/js/kj.dialog.js"></script>
<script src="/webcss/common/js/kj.alert.js"></script>
<script src="/webcss/common/js/kj.rule.js"></script>
</head>
<body>
<?php include cls_resolve::on_resolve('/default\/header')?>
<form name="frm_main" method="post" action="?app=ajax&app_act=saveorder" onsubmit="return thisjs.save();">
<input type="hidden" name="cart_ids" value="">
<div class="main">
	<div id="id_shop_0">
	<div class="div_3" id="id_list_0">
		<div class="x_tit1"><li class="x_col1">序号</li><li class="x_col2 main_w4">所选菜品</li><li class="x_col3">金额小计</li><li class="x_col4">操作</li></div>
		<?php foreach($cart_list['cart'] as $key=>$cart){ ?>
		<div class="x_list1"><div class="x_col1"><?php echo $cart['index'];?></div><div class="x_col2 main_w4">
			<?php foreach($cart['ids'] as $menu){ ?>
			<li class="x_menu" style="background:url(<?php echo $cart_list['menu']['id_'.$menu]['menu_pic_small'];?>)" onmouseover="kj.show(kj.obj('img',this));"  onmouseout="kj.hide(kj.obj('img',this));" onclick="thisjs.cart_del(this , 0 , <?php echo $cart_list['menu']['id_'.$menu]['menu_id'];?> , '<?php echo $cart_list['menu']['id_'.$menu]['menu_price'];?>' )" title="<?php echo $cart_list['menu']['id_'.$menu]['menu_title'];?>"><img src="/webcss/default/images/btn_del.gif" style="display:none"></li>
			<li class="x_plus">&nbsp;</li>
			<?php }?>
		</div><div class="x_col3 x_sel1"><span class="menu_price"><?php echo $cart['price'];?></span>元</div><div class="x_col4"><span onclick="thisjs.cart_remove(this , 0)" style="cursor:pointer" class="x_sel2">【删除此列】</span></div></div>
		<?php }?>
	</div>
	<script>
	kj.onload(function(){
		thisjs.shopid = 0;
		thisjs.shop_minleast =  kj.toint("<?php echo $dispatch_min_price;?>");
		thisjs.shop_oneminleast = kj.toint("<?php echo $optional_select['mintotal'];?>");
		thisjs.minleast = thisjs.shop_minleast;
		if('<?php echo $last_area_id;?>' != '') {
			thisjs.infosel(kj.obj("#id_info_radior<?php echo $last_area_id;?>") ,"<?php echo $last_area_id;?>");
		}
	});
	</script>
	<div class="div_4" id="id_score_0"<?php if(empty($score_money_scale)){?>style='display:none'<?php }?>}>
		<div class="x_1">积分抵扣<br>100积分可抵1元</div>
		<div class="x_2 main_w5"><input type='text' name='score' value="" class="txtbox1 pTxtL100" onblur="thisjs.score_input(0);" onkeyup="thisjs.score_input(0);" id="id_score_input"> × 100&nbsp;&nbsp;您还有 <span class="x_sel3" id="id_my_score"><?php echo $score_total;?></span> 积分，可抵扣 <span class="x_sel3"><?php echo $score_money;?></span> 元</div>
	</div>
	<?php if(count($shop_act)>0){?>
	<div class="div_4" style="height:auto">
		<div class="x_1">优惠活动</div>
		<div class="x_2 main_w5" style="line-height:25px;height:auto;color:#ff8800"  id="id_act_0">
		</div>
	</div>
	<?php }?>
	<div class="div_5" id="id_total_0">
		合计金额：<span class="x_sel1">￥</span><span id="id_shop_total_0" class="x_sel1"><?php echo $cart_list['price'];?></span> (菜品金额) - <span class="x_sel1"<?php if(empty($score_money_scale)){?>style='display:none'<?php }?>}>￥</span><span id="id_shop_score_0" class="x_sel1"<?php if(empty($score_money_scale)){?>style='display:none'<?php }?>}>0</span> <?php if(!empty($score_money_scale)){?>(积分抵扣)- <?php }?> <span class="x_sel1">￥</span><span id="id_shop_act_0" class="x_sel1">0</span> (优惠金额) = <span class="x_sel2">￥</span><span id="id_shop_price_0" class="x_sel2"><?php echo $cart_list['price'];?></span>&nbsp;&nbsp;&nbsp;
	</div>
	</div>
	<div class="div_4">
		<div class="x_1">配送信息：(<font style="color:#ff0000">*</font>)</div>
		<div class="x_3 main_w5" id="id_address_info">
		<?php foreach($this_info["list"] as $item){ ?>
			<table class="x_box1<?php if($last_area_id==$item['info_id']){?> x_sel1<?php }?>" id="id_info_<?php echo $item['info_id'];?>">
				<tr><td style="color:#0099FF" width="150px" valign="top"><label><input name="area_select" type="radio" id="id_info_radior<?php echo $item['info_id'];?>" value="<?php echo $item['info_id'];?>" <?php if($last_area_id==$item['info_id']){?> checked<?php }?> onclick="thisjs.infosel(this ,<?php echo $item['info_id'];?>);">&nbsp;<span  id="id_info_name<?php echo $item['info_id'];?>"><?php echo $item['info_name'];?>（<?php echo $item['info_sex'];?>）</span></label></td>
				<td valign="top" id="id_info_base<?php echo $item['info_id'];?>">
				<?php echo $item['info_area'];?>&nbsp; — &nbsp;<?php echo $item['info_louhao1'];?><?php if(!empty($item['info_company'])){?> — <?php echo $item['info_company'];?>/<?php echo $item['info_depart'];?><?php }?><br>
				固话：<?php echo $item['info_tel'];?> <?php if($item['info_telext']!=''){?>转 <?php echo $item['info_telext'];?><?php }?> / 手机：<?php echo $item['info_mobile'];?>
				<?php $arr=explode(",",$item["info_area_allid"]);?>
				<?php $dispatch=$dispatch_min_price;?>
				<?php foreach($arr as $areaid){ ?>
					<?php if(isset($areainfo['area']['id_' . $areaid]['dispatch_price']) && $areainfo['area']['id_' . $areaid]['dispatch_price']>0 ){?> 
					<?php $dispatch=$areainfo['area']['id_'.$areaid]['dispatch_price'];?>
					<?php }?>
				<?php }?>
				<span class="x_sel2" id="id_dispatch_<?php echo $item['info_id'];?>"><br>起送价：<?php echo $dispatch;?></span>
				</td>
				<td width="120px" valign="top"><a href="javascript:thisjs.info_edit(<?php echo $item['info_id'];?>);">[ 编辑 ]</a><a href="javascript:thisjs.info_del(<?php echo $item['info_id'];?>);">[ 删除 ]</a></td></tr>
			</table>
		<?php }?>
		
			<table class="x_box1<?php if(count($this_info['list'])<1){?> x_sel1<?php }?>" <?php if($this_info['isover']){?> style='display:none'<?php }?>>
				<tr><td style="color:#0099FF" width="150px" valign="top"><label><input type="radio" name="area_select" value="0" id="id_new_info_radior"<?php if(count($this_info['list'])<1){?> checked<?php }?> onclick="thisjs.infosel(this,'0');" >使用新地址</label></td>
				<td valign="top" id="id_new_infocol">
				<table <?php if(count($this_info['list'])>0){?> style="display:none"<?php }?> id="id_new_infosel">
				<tr><td>所在区域：<span style="color:#ff0000">*</span></td><td>
					<input type="hidden" name="area_id" id="id_area_id" value="">
					<input type="hidden" name="area_allid" id="id_area_allid" value="">
					<input type="hidden" name="area" id="id_area" value="">
					<select name="info_area_id[]" onchange="thisjs.changearea(this.value,0);" id="id_area_0">
						<option value=""></option>
					<?php foreach($areainfo["default"] as $item){ ?>
						<option value="<?php echo $item['area_id'];?>"><?php echo $item['area_name'];?></option>
					<?php }?>
					</select>
					<?php for($i=1;$i<$areainfo["depth"];$i++){ ?>
						<select name="info_area_id[]" onchange="thisjs.changearea(this.value,<?php echo $i;?>);" id="id_area_<?php echo $i;?>" required ruletips='请选择您所在地区范围'>
						</select>
					<?php }?>					
					&nbsp;&nbsp;<span class="x_sel2">起送价：</span><span class="x_sel2" id="id_dispatch_0"><?php echo $dispatch_min_price;?></span>
					</td></tr>
				<tr><td>具体位置：<span style="color:#ff0000">*</span></td><td>
						<input name="louhao1" type="text" class="pTxt1" id="textfield" maxlength="20" value=""  onFocus="this.className='pTxt2';" onBlur="this.className='pTxt1';" style="width:200px">&nbsp;
						<input name="louhao2" type="hidden" value="">				
				</td></tr>
				</td></tr>
				<tr><td>收 件 人：<span style="color:#ff0000">*</span></td><td>
					<input name="name" type="text" class="pTxt1" id="textfield" maxlength="5" style="margin-right:3px;" onFocus="this.className='pTxt2';" onBlur="this.className='pTxt1';">
					<label><input name="sex" type="radio" value="先生" checked>先生</label> 
					<label><input type="radio" name="sex" value="小姐">小姐</label><span class="txt_gary"> (如果有同事与您同姓，建议您填全名!)</span>				
				
				</td></tr>
				<tr><td>手机号码：</td><td>
					<input name="mobile" type="text" class="pTxt1" id="textfield" maxlength="11" onFocus="this.className='pTxt2';" onBlur="this.className='pTxt1';">
				
				</td></tr>
				<tr><td>固定电话：</td><td>
							  <input name="tel" type="text" class="pTxt1" id="textfield" style="margin-right:3px;" maxlength="8" value="八位数字不带区号" onFocus="if(this.value=='八位数字不带区号')this.value=''; this.className='pTxt2';" onBlur="if(this.value=='')this.value='八位数字不带区号'; this.className='pTxt1';">
							  <input name="telext" type="text" class="pTxt1" id="textfield2" maxlength="4" value="分机选填" onFocus="if(this.value=='分机选填')this.value=''; this.className='pTxt2';" onBlur="if(this.value=='')this.value='分机选填'; this.className='pTxt1';">
				</td></tr>
				<tr><td>公司部门：</td><td>
					<input name="company" type="text" class="pTxt1" id="textfield" style="margin-right:3px;" maxlength="12" value="公司名称-选填"  onFocus="if(this.value=='公司名称-选填')this.value=''; this.className='pTxt2';" onBlur="if(this.value=='')this.value='公司名称-选填'; this.className='pTxt1';">
					<input name="depart" type="text" class="pTxt1" id="textfield2" maxlength="5" value="部门-选填"  onFocus="if(this.value=='部门-选填')this.value=''; this.className='pTxt2';" onBlur="if(this.value=='')this.value='部门-选填'; this.className='pTxt1';">				
				</table>
				</td></tr>
			</table>
			<table class="x_box1 x_sel1" id="id_edit_infodiv" style="display:none">
				<tr><td style="color:#0099FF" width="150px" valign="top"><input type="radio" name="area_select" id="id_new_edit_radior">编辑信息</td>
				<td valign="top" id="id_info_editcol">
				</td></tr>
				<tr><td style="color:#0099FF" width="150px" valign="top"></td>
				<td valign="top"><a href="javascript:thisjs.info_save();"><img src="/webcss/default/images/btn_submit2.gif"></a>&nbsp;&nbsp;<a href="javascript:thisjs.info_cancel(true);">取消</a>			</td></tr>
			</table>
		</div>
	</div>
	<div class="div_4" id="id_score_0">
		<div class="x_1">送餐时间(<font style="color:#ff0000">*</font>)</div>
		<div class="x_2 main_w5"> 
		<select name="arrive">
		<?php if(count($cart_list["arrivetime"])>0){?>
			<option value="">请选择您期望外卖送达的时间</option>
			<?php foreach($cart_list["arrivetime"] as $item=>$key){ ?>
			<option value="<?php echo $item;?>"><?php echo $key;?></option>
			<?php }?>
		<?php } else { ?>
			<option value="">今天送餐已结束，明天再来吧</option>
		<?php }?>
		</select>
		<span class="txt_gary"></span></div>
	</div>
	<div class="div_4" id="id_score_0">
		<div class="x_1">支付方式</div>
		<div class="x_2 main_w5" style="height:auto;line-height:30px"> 
		<?php if(in_array('afterpayment',$paymethod)){?><label><input type="radio" name="paymethod" value="afterpayment" checked>货到付款</label><br><?php }?>
		<?php if(in_array('repayment',$paymethod)){?><label><input type="radio" name="paymethod" id="id_repayment" value="repayment"<?php if($user_repayment<$cart_list['price']){?> disabled<?php }?>>预付款支付</label>&nbsp;&nbsp;<span style="color:#888888">您当前预付款为 <?php echo $user_repayment;?></span> <span id="id_repayment_beta" style="color:#888888"><?php if($user_repayment<$cart_list['price']){?>不够支付<?php }?></span><br><?php }?>
		<?php if(in_array('onlinepayment',$paymethod)){?>
			<?php foreach($arr_pay as $item => $key){ ?>
				<?php if(!empty($key['state'])){?>
					<label><input type="radio" name="paymethod" value="<?php echo $item;?>"><?php echo $key['fields']['title'];?></label><br>
				<?php }?>
			<?php }?>
		<?php }?>
		</div>
	</div>
	<div class="div_4" id="id_score_0">
		<div class="x_1">索取发票</div>
		<div class="x_2 main_w5"> 
		 <select name="ticket" class="pTxt1" id="id_ticket" style="margin-right:3px; width:252px" onchange="thisjs.score_refresh(1)">
		<?php foreach($cart_list["ticket"] as $item=>$key){ ?>
		<option value="<?php echo $item;?>"><?php echo $key;?></option>
		<?php }?>
		</select>
		</div>
	</div>
	<div class="div_4" id="id_score_0">
		<div class="x_1">备注</div>
		<div class="x_2 main_w5"> 
		<textarea name="beta" cols='50' rows='2' class="pTxt1"></textarea>
		</div>
	</div>
	<div class="div_5">
		<a href="javascript:thisjs.submit(0);"><img src="/webcss/default/images/btn_submit2.gif"></a>
	</div>
</div>
<script><!--
var thisjs = new function() {
	this.cart = [];//
	this.minleast = 0;
	this.oneminleast = 0;//单份最低外送价
	this.info_id = 0;//当前选中编辑的地址id
	this.saveinfo = false;//是否正在保存
	this.is_alert = false;
	this.shopid = 0;
	this.score = <?php echo $score_total;?>;//当前积分
	this.act_list = <?php if(count($shop_act)>0){?><?php echo fun_format::json($shop_act);?><?php } else { ?>[]<?php }?>;//时间条件优惠金额
	this.timeout = [];
	this.arealist = <?php echo fun_format::json($areainfo["list"]);?>;//json格式，指定id包函的子地区
	this.areainfo = <?php echo fun_format::json($areainfo["area"]);?>;//对应id地区详细信息
	this.depth = <?php echo $areainfo["depth"];?>;//当前地区深度
	this.defaultval = []//当前选择值

	this.init = function() {
		var str = kj.cookie_get("cart_ids");
		var arr = str.split("||");
		var cart = [];
		for(i = 0 ; i < arr.length ; i++) {
			arr_2 = arr[i].split(":");
			cart["id_"+arr_2[0]] = []
			if(arr_2.length>1) {
				arr_3 = arr_2[1].split("|");
				for(j = 0 ; j < arr_3.length ; j++) {
					arr_4 = arr_3[j].split(",");
					cart["id_"+arr_2[0]][j] = arr_4;
				}
			}
		}
		this.cart = cart;
	}
	this.cart_del = function(o , shopid , menuid ,price) {
		var p1 = kj.parent(o , "div");
		var p2 = kj.parent(p1 , "div");
		var p3 = kj.obj(".x_list1" ,kj.parent(p2 , "div"));
		var p4 = kj.obj("li" ,p1);
		var obj_plus = kj.obj(".x_plus" ,p1);
		var index = kj.index(kj.obj(".x_menu" ,p1) , o);//当前菜器，在菜品中的索引
		var index2 = kj.index(p3 , p2);//行所在索引
		var index3 = kj.index(p4 , o ,true);//当前菜器，在li中的索引,计算有没有plus，有则删除
		var id = 'id_'+shopid;
		if(!(id in this.cart)) return;
		//删除左边加号
		if(obj_plus.length>index3) {
			kj.remove(obj_plus[index3-1]); 
		} else if(p4.length>1) {
			kj.remove(p4[index3+1]); 
		}
		//移除菜品li
		kj.remove(o);
		//cart 中移除
		this.cart[id][index2].removeat(index);
		//如果当前行都删除了，则移除行
		if(this.cart[id][index2].length<1) {
			this.cart[id].removeat(index2);
			kj.remove(p3[index2]);
			//如果当前店没有餐了，则删除当前店显示
			if(this.cart[id].length<1) {
				this.cart.remove(id);
				kj.remove("#id_shop_"+shopid);
			}
		}
		var obj_price = kj.obj(".menu_price" , p2);
		var total = kj.toint(obj_price[0].innerHTML);
		//算价
		obj_price[0].innerHTML = total - kj.toint(price);
		this.refresh_price(shopid);
	}
	//移除行
	this.cart_remove = function(o , shopid) {
		var p1 = kj.parent(o,"div");
		var p2 = kj.parent(p1,"div");
		var p3 = kj.parent(p2,"div");
		var arr_list = kj.obj(".x_list1" , p3);
		var index = kj.index(arr_list , p2 ,true);
		kj.remove(p2);
		var id = 'id_'+shopid;
		this.cart[id].removeat(index);
		//如果当前店没有餐了，则删除当前店显示
		if(this.cart[id].length<1) {
			this.cart.remove(id);
				kj.remove("#id_shop_"+shopid);
		}
		this.refresh_price(shopid);
	}
	//刷新价格
	this.refresh_price = function(shopid) {
		if(!shopid) shopid = thisjs.shopid;
		var shop = kj.obj("#id_shop_"+shopid);
		var obj_price = kj.obj(".menu_price" , shop);
		var obj_score = kj.obj(":score" , shop);
		var price = 0;
		var score = 0;
		if(obj_score && obj_score.length>0) score = kj.toint(obj_score[0].value);
		var i,j,x;
		for(i = 0 ; i < obj_price.length; i++) {
			x = obj_price[i].innerHTML;
			x = x.replace('￥','');
			price+=kj.toint(x);
		}
		kj.set("#id_shop_total_"+shopid,"innerHTML",price);
		//先刷新活动计价
		this.act_where_money(price);
		var act_price = 0;
		if(kj.obj('#id_shop_act_'+shopid)) act_price = kj.toint(kj.obj('#id_shop_act_'+shopid).innerHTML);
		var total = price - score - act_price;
		if(total<0 && obj_score && obj_score.length>0) {
			if(this.is_alert == false) {
				this.is_alert = true;
				alert("积分不能大于菜品金额，请重新输入");
				this.is_alert = false;
			}
			total = price;
			obj_score[0].value = 0;
			score = 0;
			obj_score[0].focus();
		}
		kj.set("#id_shop_score_"+shopid,'innerHTML',score);
		kj.set("#id_shop_price_"+shopid,"innerHTML",total);
		//预付款达到条件，检测
		var obj = kj.obj("#id_repayment");
		if(obj) {
			if(kj.toint(total)>kj.toint('<?php echo $user_repayment;?>')) {
				obj.disabled = true;
				kj.set("#id_repayment_beta" , "innerHTML" , "不够支付");
			} else {
				obj.disabled = false;
				kj.set("#id_repayment_beta" , "innerHTML" , "");
			}
		}
		return total;
	}
	this.info_del = function(id) {
		if(!confirm("确定要删除吗？")) {
			return;
		}
		kj.ajax.get("?app=ajax&app_act=del_info&id="+id , function(data) {
			var obj_data=kj.json(data);
			thisjs.submiting = false;
			if(obj_data.isnull) {
				alert("操作失败");
			} else {
				if('code' in obj_data && obj_data.code=='0') {
					kj.remove("#id_info_"+id);
				}else{
					if("msg" in obj_data){
						alert(obj_data.msg);
					}else{
						alert("操作失败");
					}
				}
			}
		});
	}
	//选择收货地址时
	this.infosel = function(o ,id){
		if(this.info_id) {
			this.info_cancel();
			this.info_id=0;
		}
		var val,x;
		val = kj.toint(o.value);
		if(val > 0) {
			kj.hide("#id_new_infosel");
		} else {
			kj.show("#id_new_infosel");
		}
		kj.delClassName(kj.obj("#id_address_info table") , "x_sel1");
		kj.addClassName(kj.parent(o , 'table'), "x_sel1");
		var html = kj.obj("#id_dispatch_" + id).innerHTML;
		html = html.replace('<br>起送价：','');
		thisjs.minleast = kj.toint(html);
	}
	//编辑已有收货地址
	this.info_edit = function(id) {
		if(id>0) {
			if(thisjs.info_id) kj.show("#id_info_" + thisjs.info_id);
			thisjs.info_id = id;
			kj.delClassName(kj.obj("#id_address_info table") , "x_sel1");
			kj.addClassName(kj.obj("#id_edit_infodiv") , "x_sel1");
			kj.ajax("?app=<?php echo $app;?>&app_module=<?php echo $app_module;?>&app_act=getinfo&id=" + id , function(data) {
				var obj = kj.json(data);
				if(! obj.isnull) {
					thisjs.editinfo = obj;
					document.frm_main.louhao1.value=obj.info_louhao1;
					document.frm_main.louhao2.value=obj.info_louhao2;
					document.frm_main.company.value=obj.info_company;
					document.frm_main.depart.value=obj.info_depart;
					document.frm_main.name.value=obj.info_name;
					document.frm_main.tel.value=obj.info_tel;
					document.frm_main.telext.value=obj.info_telext;
					document.frm_main.mobile.value=obj.info_mobile;
					for(var i = 0 ; i < document.frm_main.sex.length ; i++ ) {
						if(document.frm_main.sex[i].value == obj.info_sex) {
							document.frm_main.sex[i].checked = true;
							break;
						}
					}
					if(obj.info_area_allid!='') {
						obj.info_area_allid += '';
						var arr = obj.info_area_allid.split(",");

						//加载默认值选中
						thisjs.select_sel(kj.obj("#id_area_0") , arr[0]);
						for(var i=0 ; i < thisjs.depth ; i++) {
							if(arr.length<=i) break;
							if(kj.obj("#id_area_"+i).selectedIndex > 0) {
								thisjs.changearea(arr[i],i,arr[i+1]);
							} else {
								if(kj.obj("#id_area_"+(i+1))) kj.obj("#id_area_"+(i+1)).style.display="none";
							}
						}

					}
					var obj_col = kj.obj("#id_info_editcol");
					var obj_table = kj.obj("table" , obj_col);
					if(obj_table.length<1) {
						obj_col.appendChild(kj.obj("#id_new_infosel"));
					}
					kj.insert_after("#id_address_info" , "#id_info_" + thisjs.info_id , "#id_edit_infodiv");
					kj.show("#id_new_infosel");
					kj.show("#id_edit_infodiv");
					kj.hide("#id_info_" + thisjs.info_id);
					kj.obj("#id_new_edit_radior").checked=true;

				}
			});
		}
	}
	//取消编辑
	this.info_cancel = function(cancel) {
		var obj_col = kj.obj("#id_new_infocol");
		var obj_table = kj.obj("table" , obj_col);
		if(obj_table.length<1) {
			obj_col.appendChild(kj.obj("#id_new_infosel"));
		}
		kj.hide("#id_info_" + thisjs.info_id);
		kj.hide("#id_new_infosel");
		kj.hide("#id_edit_infodiv");
		kj.show("#id_info_" + thisjs.info_id);
		if(cancel) kj.obj("#id_info_radior"+thisjs.info_id).checked=true;
		if(thisjs.info_id>0) {
			kj.addClassName(kj.obj("#id_info_"+thisjs.info_id), "x_sel1");
		}

	}
	//提交收货信息
	this.info_save = function() {
		var area = kj.obj("#id_area").value;
		var area_allid = kj.obj("#id_area_allid").value;
		var area_id = kj.obj("#id_area_id").value;
		var sex='';
		if(this.chk_info() == false) return;
		if(document.frm_main.sex[0].checked) {
			sex = document.frm_main.sex[0].value;
		} else if(document.frm_main.sex[1].checked){
			sex = document.frm_main.sex[1].value;
		}
		var company = (document.frm_main.company.value=='' || document.frm_main.company.value=='公司名称-选填') ? '' :  document.frm_main.company.value;
		var depart = (document.frm_main.depart.value=='' || document.frm_main.depart.value=='部门-选填') ? '' :  document.frm_main.depart.value;
		var data = {"id":this.info_id,"name":document.frm_main.name.value,"area":area,"area_id":area_id,"area_allid":area_allid,"louhao1":document.frm_main.louhao1.value,"louhao2":document.frm_main.louhao2.value,"company":company,"depart":depart,"sex":sex,"tel":document.frm_main.tel.value,"telext":document.frm_main.telext.value,"mobile":document.frm_main.mobile.value};
		thisjs.saveinfo = true;
		kj.ajax.post("?app=ajax&app_module=<?php echo $app_module;?>&app_act=saveinfo" , data ,function(data){
			var obj_data=kj.json(data);
			thisjs.saveinfo = false;
			if(obj_data.isnull) {
				alert("保存失败");
			} else {
				if('code' in obj_data && obj_data.code=='0') {
					kj.alert.show("保存成功");
					var sex = document.frm_main.sex[0].value;
					var str;
					if(document.frm_main.sex[1].checked) sex = document.frm_main.sex[1].value;
					//修改
					var html = '';
					html = document.frm_main.name.value + "（" + sex + "）";
					kj.set("#id_info_name"+thisjs.info_id , "innerHTML" , html);
					html = 	kj.obj("#id_area").value + " — " + document.frm_main.louhao1.value;
					if(document.frm_main.company.value!='' && document.frm_main.company.value!='公司名称-选填') {
						html+= " — " + document.frm_main.company.value;
						if(document.frm_main.depart.value!='部门-选填' && document.frm_main.depart.value!='') html+= "/" + document.frm_main.depart.value;
					}
					html += "<br>固话：" + document.frm_main.tel.value;
					if(document.frm_main.telext.value!="") html += " 转 " + document.frm_main.telext.value;
					html += "/ 手机：" + document.frm_main.mobile.value
					html += '<span class="x_sel2" id="id_dispatch_' + thisjs.info_id + '"><br>起送价：' + kj.obj("#id_dispatch_0").innerHTML;
					kj.set("#id_info_base"+thisjs.info_id , "innerHTML" , html);
					thisjs.info_cancel(true);
				}else{
					if("msg" in obj_data){
						kj.alert(obj_data.msg);
					}else{
						kj.alert("操作失败");
					}
				}
			}
		});
	}
	this.select_sel = function(obj,val) {
		var is_sel = false;
		for(var i = 0 ; i < obj.length; i++) {
			if(obj[i].value == val) {
				obj[i].selected = true;
				is_sel = true;
				break;
			}
		}
		if(!is_sel && obj.length>0 ) obj[0].selected = true;
	}
	//提交定单
	this.submit = function(){
		thisjs.refresh_price();
		var total = kj.toint(kj.obj("#id_shop_total_" + this.shopid).innerHTML);
		var minleast = thisjs.minleast;
		var shopid = this.shopid;
		if(minleast == 0) minleast = thisjs.shop_minleast;
		if(total<minleast){
			alert("定餐金额必须达到￥"+minleast+"，才起送");
			return;
		}
		var arr_o=kj.obj(".priceB");
		var obj_row_price = kj.obj(".menu_price");
		for(var i = 0 ; i < obj_row_price.length ; i++ ) {
			if(this.shop_oneminleast>0 && this.shop_oneminleast > kj.toint(obj_row_price[i].innerHTML) )	{
				alert("单份定单价须大于￥" + this.shop_oneminleast+"，才起送");
				return;
			}
		}
		if(document.frm_main.arrive.value=="") {
			alert("请选择送餐时间");
			document.frm_main.arrive.focus();
			return;
		}
		if( this.score_refresh(1) == false ) return;
		if(kj.obj("#id_new_info_radior").checked) {
			if(this.chk_info() == false) return;
		}
		//取当前购物车值
		var arr_1 = [];
		for(i = 0 ; i < this.cart['id_'+shopid].length ; i++) {
			arr_1[arr_1.length] = this.cart['id_'+shopid][i].join(",");
		}
		if(arr_1.length<1) {
			alert("当前购物车为空，请选好菜品再来下单");
			return false;
		}
		document.frm_main.cart_ids.value = shopid + ":" + arr_1.join("|");
		kj.ajax.post(document.frm_main,function(data){
			var obj_data=kj.json(data);
			if(obj_data.isnull) {
				alert("操作失败");
			} else {
				if('code' in obj_data && obj_data.code=='0') {
					//清空当前店铺购物车
					var str = kj.cookie_get("cart_ids");
					var arr = [];
					if(str) arr = str.split("||");
					for(i = 0 ; i < arr.length ; i++) {
						arr_2 = arr[i].split(":");
						if(arr_2[0] == thisjs.shopid) {
							arr.removeat(i);break;
						}
					}
					var str_ids = arr.join("||");
					kj.cookie_set("cart_ids" , str_ids , 24);
					kj.alert.show("订餐成功" , function(){
						window.open("?app=member&app_act=payok&id="+obj_data.id,"_self");
					});
				}else{
					if("msg" in obj_data){
						alert(obj_data.msg);
					}else{
						alert("下单失败");
					}
				}
			}
		});
	}
	//检查用户信息合法性
	this.chk_info = function() {
			if(document.frm_main.company.value=="公司名称-选填")  document.frm_main.company.value="";
			if(document.frm_main.depart.value=="部门-选填")  document.frm_main.depart.value="";
			if(document.frm_main.tel.value=="八位数字不带区号")  document.frm_main.tel.value="";
			if(document.frm_main.telext.value=="分机选填")  document.frm_main.telext.value="";

			//kj.rule.form(document.frm_main);
			for(var i = 0 ; i < this.depth ; i++) {
				x = kj.obj("#id_area_" + i);
				if(x && x.value=="" && x.style.display=='') {
					alert("请选择您所在地区范围");
					x.focus();
					return false;
				}
			}
			if(document.frm_main.louhao1.value=="") {
				alert("请填写您所在具体位置");
				document.frm_main.louhao1.focus();
				return false;
			}
			if(document.frm_main.name.value=="") {
				alert("请填写收件人信息");
				document.frm_main.name.focus();
				return false;
			}

			if(document.frm_main.tel.value=='' && document.frm_main.mobile.value=='') {
				alert("电话与手机必须填一项");
				document.frm_main.tel.focus();
				return false;
			}
			if(document.frm_main.tel.value!='' && !kj.rule.types.tel(document.frm_main.tel.value)) {
				alert("输入电话格式不正确");
				document.frm_main.tel.focus();
				return false;
			}
			if(document.frm_main.mobile.value!='' && !kj.rule.types.mobile(document.frm_main.mobile.value)) {
				alert("输入手机格式不正确");
				document.frm_main.mobile.focus();
				return false;
			}

			return true;
	}
	//当输入积分抵扣，或选择发票时，验证积分
	this.score_refresh = function(type) {
		var obj_ticket = kj.obj("#id_ticket")
		var obj_score_input = kj.obj("#id_score_input");
		var score= kj.toint(obj_score_input.value)*100;
		var score_ticket = kj.toint(obj_ticket.value);
		var is_ok = true;
		val = this.score - score - score_ticket;
		if(val < 0) {
			if(this.is_alert == false) {
				this.is_alert = true;
				alert("您的积分不足");
				this.is_alert = true;
			}
			if(type == 1) {
				val = this.score - score;
				obj_ticket.options[0].selected = true;
				obj_ticket.focus();
			} else {
				val = this.score - score_ticket;
				obj_score_input.value = 0;
				obj_score_input.focus();
			}
			is_ok = false;
		}
		kj.obj("#id_my_score").innerHTML = val;
		return is_ok;
	}
	this.score_input = function(shopid) {
		this.score_refresh(0);
		this.refresh_price(shopid);
	}
	this.act_where_money = function(total_price) {
		var act_money = 0;
		if(this.act_list.length>0) {
			var obj_box = kj.obj('#id_act_' + this.shopid);
			var obj_act,price,val,num;
			for(var i = 0; i < this.act_list.length ; i++) {
				obj_act = kj.obj("#id_act_"+this.shopid+"_"+this.act_list[i]['act_id']);
				price = this.get_act_money(this.act_list[i]['act_id'] , this.act_list[i]['act_method'] , this.act_list[i]['act_method_val'] , total_price);
				if(this.act_list[i]['act_where'] == '1') {//达到指定金额
					if(this.act_list[i]['where_val']<=total_price) {
						if(!obj_act) {
						    obj_act=document.createElement("li");
							obj_act.id="id_act_"+this.shopid+"_"+this.act_list[i]['act_id'];
							obj_act.innerHTML = this.act_list[i]['act_name'] + "<input type='hidden' name='act_money[]' value='"+price+"' id='id_act_money_"+this.act_list[i]['act_id']+"'><input type='hidden' name='shop_act_id[]' value='"+this.act_list[i]['act_id']+"'>";
							obj_box.appendChild(obj_act);
						} else {
							kj.set("#id_act_money_"+this.act_list[i]['act_id'],"value",price);
						}
					} else {
						if(obj_act) kj.remove(obj_act);//移除
					}
				} else if(this.act_list[i]['act_where'] == '3' || this.act_list[i]['act_where'] == '4') {//指定数量 或 指定时间指定数量
					num = (kj.obj(".x_list1")) ? kj.obj(".x_list1").length : 0;
					if(this.act_list[i]['where_val']<=num) {
						if(!obj_act) {
						    obj_act=document.createElement("li");
							obj_act.id="id_act_"+this.shopid+"_"+this.act_list[i]['act_id'];
							obj_act.innerHTML=this.act_list[i]['act_name'] + "<input type='hidden' name='act_money[]' value='"+price+"' id='id_act_money_"+this.act_list[i]['act_id']+"'><input type='hidden' name='shop_act_id[]' value='"+this.act_list[i]['act_id']+"'>";
							obj_box.appendChild(obj_act);
						} else {
							kj.set("#id_act_money_"+this.act_list[i]['act_id'],"value",price);
						}
					} else {
						if(obj_act) kj.remove(obj_act);//移除
					}
				} else if(this.act_list[i]['act_where'] == '2') {
					if(!obj_act) {
						obj_act=document.createElement("li");
						obj_act.id="id_act_"+this.shopid+"_"+this.act_list[i]['act_id'];
						obj_act.innerHTML=this.act_list[i]['act_name'] + "<input type='hidden' name='act_money[]' value='"+price+"' id='id_act_money_"+this.act_list[i]['act_id']+"'><input type='hidden' name='shop_act_id[]' value='"+this.act_list[i]['act_id']+"'>";
						obj_box.appendChild(obj_act);
					} else {
						kj.set("#id_act_money_"+this.act_list[i]['act_id'],"value",price);
					}
				}
				if(this.act_list[i]['act_where'] == '4' || this.act_list[i]['act_where'] == '2') {
					val = 'id_'+ this.act_list[i]['act_id'];
					if(!this.timeout[val]) this.timeout[val] = setTimeout("thisjs.cancel_time_act("+this.act_list[i]['act_id']+");",this.act_list[i]['time']);
				}
			}
		}
		var obj_price = kj.obj(":act_money[]");
		for(i = 0;i<obj_price.length;i++) {
			act_money+=kj.toint(obj_price[i].value);
		}
		if(kj.obj("#id_shop_act_" + this.shopid)) kj.obj("#id_shop_act_" + this.shopid).innerHTML = act_money;
	}
	this.cancel_time_act = function(act_id) {
		for(var i = 0; i < this.act_list.length ; i++) {
			if(this.act_list[i]['act_id'] == act_id) {
				this.act_list.removeat(i);
				kj.alert.show("超过时间取消【"+this.act_list[i]['act_name']+"】优惠");
			}
		}
		kj.remove("#id_act_"+this.shopid+"_"+act_id);
		this.refresh_price();
	}
	this.get_act_money = function(id , method , method_val, total_price) {
		var money = 0;
		switch(method) {
			case 2://打折
				money = total_price - parseInt(total_price*kj.toint(method_val));
				break;
			case 5://立减多少
				money = kj.toint(method_val);
				break;
			case 6://每份优惠多少
				var num = (kj.obj(".x_list1")) ? kj.obj(".x_list1").length : 0;
				money = kj.toint(method_val) * num;
				break;
		}
		return money;
	}
	<?php if($this_login_user->uid<1){?>
	this.on_login = function() {
		kj.ajax.post(document.frmlogin , function(data) {
			var obj_data=kj.json(data);
			if(obj_data.isnull) {
				alert("系统繁忙，请稍后再来试试");
			} else {
				if(obj_data.code == 0) {
					location.reload(true);
				} else {
					if('msg' in obj_data && obj_data.msg) {
						alert(obj_data.msg);
					} else {
						alert("系统繁忙，请稍后再来试试");
					}
					if('show_code' in obj_data && obj_data.show_code == '1') {
						kj.show(".verify_code");
					}
				}
			}
		});
		return false;
	}

	this.show_verify = function() {
		var objpic = kj.obj("#id_verify_pic");
		if(objpic.src.indexOf("verifycode")<0) {
			objpic.src = '<?php echo cls_config::get("dirpath","base");?>/common.php?app=sys&app_act=verifycode';
		}
		kj.show('#id_verify_pic');
	}
	this.verify_refresh = function() {
		kj.obj("#id_verify_pic").src='<?php echo cls_config::get("web_url","base");?>/common.php?app=sys&app_act=verifycode&app_contenttype=img&app_rnd='+Math.random();
	}
	<?php }?>
	//地区下拉发生改变时触发
	this.changearea = function(val , index , defautval) {
		var obj,i,ii;
		index++;
		//当index大于深度时跳出
		if(index>this.depth) return;
		//发生改变后，重置之后的地区下拉
		for(i = index ; i < this.depth; i++) {
			obj = kj.obj("#id_area_" + i);
			if(!obj) break;
			obj.options.length = 0;
			if(i>index) {
				if(kj.obj("#id_area_" + i)) kj.obj("#id_area_" + i).style.display = 'none';
			}
		}
		var key = "id_" + val;
		if(!(key in this.arealist) || !("length" in this.arealist[key]) || !kj.obj("#id_area_" + index)) {
			//跳出则刷新当前地区值
			if(kj.obj("#id_area_" + index)) kj.obj("#id_area_" + index).style.display = 'none';
			if(val!='') {
				for(i = 0; i <10 ;i++) {
					if(key in this.areainfo && kj.toint(this.areainfo[key]["dispatch_price"])>0) {
						this.minleast = this.areainfo[key]["dispatch_price"];
						break;
					}
					if(key in this.areainfo && 'area_pid' in this.areainfo[key] && this.areainfo[key]["area_pid"]) {
						key = "id_" + this.areainfo[key]["area_pid"];
					} else {
						this.minleast = this.shop_minleast;
						break;
					}
				}
			}
			kj.obj("#id_dispatch_0").innerHTML = this.minleast;
			this.refresh_area_val();
			return;
		}
		kj.add_option("#id_area_" + index , '' , '');
		for(i = 0 ; i < this.arealist["id_"+val].length ; i++ ) {
			obj = kj.obj("#id_area_" + index);
			ii = this.arealist["id_"+val][i];
			if( !("id_" + ii in this.areainfo ) ) continue;
			kj.add_option(obj , this.areainfo["id_" + ii]["area_name"] , ii);
			//选中默认值
			if(obj.options[i+1].value == defautval) {
				obj.options[i+1].selected=true;
			}
		}
		if(kj.obj("#id_area_" + index)) kj.obj("#id_area_" + index).style.display = '';
		if(val!='') {
			for(i = 0; i <10 ;i++) {
				if(key in this.areainfo && kj.toint(this.areainfo[key]["dispatch_price"])>0) {
					this.minleast = this.areainfo[key]["dispatch_price"];
					break;
				}
				if(key in this.areainfo && 'area_pid' in this.areainfo[key] && this.areainfo[key]["area_pid"]) {
					key = "id_" + this.areainfo[key]["area_pid"];
				} else {
					this.minleast = this.shop_minleast;
					break;
				}
			}
		}
		kj.obj("#id_dispatch_0").innerHTML = this.minleast;
		this.changearea(obj.value , index);
		this.refresh_area_val();
	}
	this.refresh_area_val = function() {
		var obj = kj.obj(":info_area_id[]");
		var arr_id = [];
		var arr_val = [];
		var id = 0;
		for(var i = 0 ; i < obj.length ; i++) {
			if(obj[i].value != '') {
				if( !("id_" + obj[i].value in this.areainfo ) ) continue;
				arr_id[arr_id.length] = obj[i].value;
				arr_val[arr_val.length] = ('area_val' in this.areainfo["id_" + obj[i].value]) ? this.areainfo["id_" + obj[i].value]["area_val"] : this.areainfo["id_" + obj[i].value]["area_name"];
			} else {
				break;
			}
		}
		if(arr_id.length>0) {
			kj.obj("#id_area_id").value = arr_id[arr_id.length-1];
		} else {
			kj.obj("#id_area_id").value = '';
		}
		kj.obj("#id_area_allid").value = arr_id.join(",");
		kj.obj("#id_area").value = arr_val.join(" ");
	}
}
kj.onload(function(){
	<?php if($this_login_user->uid<1){?>
		var obj = kj.obj('#id_loginbox');
		if(obj) {
			this.shopbox_html = obj.innerHTML;
			kj.remove(obj);
		}
		kj.dialog({'html':this.shopbox_html,'id':'shopbox','type':'html','title':'','w':373,'showbtnmax':false,'showbtnclose':false,'showbtnhide':false});
	<?php }?>
	thisjs.init();
	<?php if(count($shop_act)>0){?>
		thisjs.refresh_price();
	<?php }?>
});
--></script>
</form>
<?php include cls_resolve::on_resolve('/default\/footer')?>
<?php if($this_login_user->uid<1){?>
<div id="id_loginbox" style="display:none">
	<form name="frmlogin" method="post" action="common.php?app=sys&app_act=login.verify" onsubmit="return thisjs.on_login();">
	<div class="login_c" style="margin-top:0px;border:0px">
		<div class="login_c1">用户：</div>
		<div class="login_c2">
			<input type="text" name="uname" class="pTxt1 pTxtL250"/>
		</div>
		<div class="login_c1">密码：</div>
		<div class="login_c2">			
<input name="pwd" type="password" class="pTxt1 pTxtL250"/></div>
		<div class="login_c1 verify_code"<?php if(!$verfifycode){?> style="display:none"<?php }?>>验证码：</div>
		<div class="login_c2 verify_code"<?php if(!$verfifycode){?> style="display:none"<?php }?>><span style="float:left"><input name="verifycode" type="text" class="pTxt1 pTxtL100"  onfocus="thisjs.show_verify();"/></span><span style="float:left;padding-left:10px"><img src="/webcss/default/" id="id_verify_pic" onclick="thisjs.verify_refresh();" style="display:none"></span></div>

		<div class="login_c1"></div>
		<div class="login_c2"><label><input type="checkbox" name="autologin" value="1" checked>下次自动登录</label></div>
		<div class="login_c3"><input type="submit" name="btn_submit" value=" " style="background:url(/webcss/default/images/btn_submit2.gif) no-repeat;width:185px;height:55px;border:0px"></div>
		<div class="login_c4"><a href="?app=index&app_act=findpwd">[ 找回密码 ]</a></div>
		
		<div class="login_c5">一分钟轻松注册，就可以方便订餐！[<a href="?app=index&app_act=reg" class="link_red2" style="color:#ff0000"> 免费注册 </a>]</div>
	</div>
	</form>
</div>
<?php }?>
</body>
</html>