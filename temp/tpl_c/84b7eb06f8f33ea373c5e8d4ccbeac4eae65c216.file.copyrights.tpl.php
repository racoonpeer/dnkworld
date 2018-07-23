<?php /* Smarty version Smarty-3.1.12, created on 2013-11-17 16:49:11
         compiled from "tpl/frontend/smart/core/copyrights.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1965667716517bae8e161a86-18832246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84b7eb06f8f33ea373c5e8d4ccbeac4eae65c216' => 
    array (
      0 => 'tpl/frontend/smart/core/copyrights.tpl',
      1 => 1379013857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1965667716517bae8e161a86-18832246',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_517bae8e1f2924_46119681',
  'variables' => 
  array (
    'objSettingsInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517bae8e1f2924_46119681')) {function content_517bae8e1f2924_46119681($_smarty_tpl) {?><!-- ++++++++++++++ Start COPYRIGHTS Block +++++++++++++++++++++++++++++++++ -->
<small>
    <?php echo nl2br($_smarty_tpl->tpl_vars['objSettingsInfo']->value->copyright);?>

</small>


<!-- ++++++++++++++ End COPYRIGHTS Block +++++++++++++++++++++++++++++++++++ -->
<?php }} ?>