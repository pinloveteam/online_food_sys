<div class="member_left">
    	<div class="memver_L_idBox">
        	<div class="memver_L_idPhoto"><img src="/webcss/default/images/sir.gif"></div>
        	<div class="memver_L_idName">您好，<span class="txt_orangeB"><?php echo $this_login_user->uname;?></span> !</div>
            <div class="memver_L_idVIP">等级：<img src="/webcss/default/images/vip<?php echo $loginuser_level;?>.png" align="absmiddle"></div>
            <div class="memver_L_idIntegral">积分：<span class="txt_redB"><?php echo $this_login_user->get_score();?></span> 分</div>
            <div class="memver_L_idExperience1">经验值：<span class="txt_redB"><?php echo $loginuser_experience;?></span> 点</div>
            <div class="memver_L_idExperience2">
            	<div class="memver_L_idExperience3">成长状态：</div>
            	<div class="memver_L_idExperience4" style="width:<?php echo $experience_process;?>px;white-space:nowrap;"><?php echo $loginuser_experience;?> / <?php echo $loginuser_experience_next;?> &nbsp;</div>
            </div>
            <div class="memver_L_idExperience5">仅需<font class="txt_redB"> <?php echo $loginuser_experience_poor;?> </font>点经验值, 晋升为<font class="txt_orangeB"> V<?php echo $loginuser_level_next;?> </font>会员。</div>
        </div>
    
    	<div class="memver_L_top"><img src="/webcss/default/images/title_member.gif"></div>
        <?php if(in_array('repayment',$paymethod)){?>
		<div class="memver_L_menu_out" onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';" onClick="location='?app=member&app_act=repayment'">我的预付款</div>
		<?php }?>
        <div onClick="location='?app=member'"<?php if(fun_get::get('app_act')==''){?>  class="memver_L_menu_over"<?php } else { ?>onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';" class="memver_L_menu_out"<?php }?>>订单明细</div>
        <div<?php if(fun_get::get('app_act')=='myvip'){?> class="memver_L_menu_over"<?php } else { ?> class="memver_L_menu_out" onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';"<?php }?> onClick="location='?app=member&app_act=myvip'">会员等级 + 经验值</div>
        <div<?php if(fun_get::get('app_act')=='myintegral'){?> class="memver_L_menu_over"<?php } else { ?> class="memver_L_menu_out" onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';"<?php }?> onClick="location='?app=member&app_act=myintegral'">我的积分</div>
        <!-- div class="memver_L_menu_out" onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';" onClick="location='?app=member&app_act=info'">配送地址</div -->
		<?php if(fun_is::com('msg')){?>
        <div<?php if(fun_get::get('app_act')=='msg'){?> class="memver_L_menu_over"<?php } else { ?> class="memver_L_menu_out" onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';"<?php }?> onClick="location='?app=member&app_act=msg'">我的留言</div>
		<?php }?>
        <div<?php if(fun_get::get('app_act')=='pwd'){?> class="memver_L_menu_over"<?php } else { ?> class="memver_L_menu_out" onMouseOver="this.className='memver_L_menu_over';" onMouseOut="this.className='memver_L_menu_out';"<?php }?> onClick="location='?app=member&app_act=pwd'">修改密码</div>
        <div class="memver_L_btm"></div>
  </div>