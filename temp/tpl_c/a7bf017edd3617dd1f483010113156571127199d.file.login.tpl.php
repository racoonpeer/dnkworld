<?php /* Smarty version Smarty-3.1.12, created on 2013-08-20 20:23:22
         compiled from "tpl/backend/weblife/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9165658855213a60a8b0ea9-31676611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7bf017edd3617dd1f483010113156571127199d' => 
    array (
      0 => 'tpl/backend/weblife/login.tpl',
      1 => 1363380425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9165658855213a60a8b0ea9-31676611',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'refresh' => 0,
    'arrPageData' => 0,
    'bannedTime' => 0,
    'messages' => 0,
    'showCode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5213a60a9b9b82_83143623',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5213a60a9b9b82_83143623')) {function content_5213a60a9b9b82_83143623($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
<?php if (!empty($_smarty_tpl->tpl_vars['refresh']->value['head'])){?>
        <?php echo $_smarty_tpl->tpl_vars['refresh']->value['head'];?>

<?php }?>
        <title><?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['headTitle'];?>
</title>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251">
        <meta http-equiv="imagetoolbar" content="no">
	<link href="/css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['css_dir'];?>
admin.css" />
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['images_dir'];?>
weblife.ico" />
	<script src="/js/jquery/jquery-<?php echo @WLCMS_JQUERY_VERSION;?>
.min.js" type="text/javascript"></script>
        <script src="/js/jquery/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="/js/bootstrap/bootstrap.js" type="text/javascript"></script>
<?php if ($_smarty_tpl->tpl_vars['bannedTime']->value>0){?>
        <script type="text/javascript">
            <!--
            var banTimerID = null;
            function updateBanTimer(){
                var banDate = new Date(<?php echo $_smarty_tpl->tpl_vars['bannedTime']->value;?>
*1000); // seconds*1000 in JavaScripts Milisecons Timestamp
                var nowDate = new Date();
                if( banDate >= nowDate && document.getElementById('banTimer') != null &&
                    nowDate.getFullYear() == banDate.getFullYear() &&
                    nowDate.getMonth()    == banDate.getMonth() &&
                    nowDate.getDate()     == banDate.getDate() ) {
                        var totalRemains = (banDate.getTime()-nowDate.getTime());
                        var RemainsSec=(parseInt(totalRemains/1000));
                        var RemainsFullDays=(parseInt(RemainsSec/(24*60*60)));
                        var secInLastDay=RemainsSec-RemainsFullDays*24*3600;
                        var RemainsFullHours=(parseInt(secInLastDay/3600));
                        //if (RemainsFullHours<10){RemainsFullHours="0"+RemainsFullHours};
                        var secInLastHour=secInLastDay-RemainsFullHours*3600;
                        var RemainsMinutes=(parseInt(secInLastHour/60));
                        //if (RemainsMinutes<10){RemainsMinutes="0"+RemainsMinutes};
                        var lastSec=secInLastHour-RemainsMinutes*60;
                        //if (lastSec<10){lastSec="0"+lastSec};
                        document.getElementById('banTimer').innerHTML = /*RemainsFullHours+" hours "+*/RemainsMinutes+' min '+lastSec+' sec';
                        document.loginForm.Submit2.disabled=true;
                } else if(banTimerID != null) {
                    clearInterval(banTimerID);
                    document.loginForm.Submit2.disabled=false;
                }

            }
            function checkForm(form){
                if(banTimerID != null){
                       form.submit();
                       return true;
                } else form.Submit2.disabled=true;
                return false;
            }
            banTimerID = setInterval("updateBanTimer()", 1000);
            //-->
        </script>
<?php }?>
    </head>
    <body style="background-color: #f5f5f5; padding: 40px 0;">
<?php if (!empty($_smarty_tpl->tpl_vars['refresh']->value['head'])||!empty($_smarty_tpl->tpl_vars['refresh']->value['body'])){?>
    <?php echo $_smarty_tpl->tpl_vars['refresh']->value['body'];?>

<?php }else{ ?>
	<div class="container">
	    <form class="form-signin" name="loginForm" action="" method="post" onsubmit="<?php if ($_smarty_tpl->tpl_vars['bannedTime']->value>0){?>return checkForm(this);<?php }?>">
	      <h4 class="form-signin-heading">Welcome to administration <a href="http://weblife.ua" style="text-decoration:none;">&reg;</a></h4>
<?php if (!empty($_smarty_tpl->tpl_vars['messages']->value['top'])){?>
		<div class="alert alert-error">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <?php echo $_smarty_tpl->tpl_vars['messages']->value['top'];?>

		</div>
<?php }?>
		<input type="text" name="login" value="" class="input-block-level" placeholder="Login" />
		<input type="password" name="pass" class="input-block-level" placeholder="Password" />
		<?php if ($_smarty_tpl->tpl_vars['showCode']->value){?>
		<div>
			<img style="float: left; margin: 0px 7px 0px 0px" alt="code" src="/interactive/cv_img.php?zone=admin" border="0">
			<input class="field" type="text" id="fConfirmationCode" name="fConfirmationCode" value="" style="width:73px; margin-top:3px;" maxlength="<?php echo @IVALIDATOR_MAX_LENTH;?>
" />
		    </td>
		</div>
		<?php }?>
		<button class="btn btn-large btn-primary" name="Submit2" type="submit">Enter</button>
<?php if (!empty($_smarty_tpl->tpl_vars['messages']->value['bottom'])){?>
		<div class="alert alert-block">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <?php echo $_smarty_tpl->tpl_vars['messages']->value['bottom'];?>

		</div>
<?php }?>
	    </form>
	</div>
    
<?php }?>
    </body>
</html><?php }} ?>