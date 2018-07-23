<?php /* Smarty version Smarty-3.1.12, created on 2013-04-27 13:55:07
         compiled from "tpl/backend/weblife/userinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1766617080517bae8b60c5b9-94579871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '184f9c1c4533eaab0413525fffd77b054d88eef2' => 
    array (
      0 => 'tpl/backend/weblife/userinfo.tpl',
      1 => 1363380425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1766617080517bae8b60c5b9-94579871',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'objUserInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_517bae8b6fe729_54079785',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517bae8b6fe729_54079785')) {function content_517bae8b6fe729_54079785($_smarty_tpl) {?><p class="navbar-text pull-right">
    <?php echo @ADMIN_HELLO;?>
, <?php if (!empty($_smarty_tpl->tpl_vars['objUserInfo']->value->firstname)){?><?php echo ucfirst($_smarty_tpl->tpl_vars['objUserInfo']->value->firstname);?>
<?php }else{ ?><?php echo ucfirst($_smarty_tpl->tpl_vars['objUserInfo']->value->login);?>
<?php }?>!
</p><?php }} ?>