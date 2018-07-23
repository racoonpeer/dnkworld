<?php /* Smarty version Smarty-3.1.12, created on 2013-04-27 13:55:07
         compiled from "tpl/backend/weblife/langs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2091225730517bae8b7095a3-03192531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccaebb2363057cb14a8516ea74437e6678bc262e' => 
    array (
      0 => 'tpl/backend/weblife/langs.tpl',
      1 => 1363380425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2091225730517bae8b7095a3-03192531',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'arrLangs' => 0,
    'lang' => 0,
    'lnKey' => 0,
    'arLangsUrls' => 0,
    'arLnItem' => 0,
    'arrPageData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_517bae8b9c12f1_24850484',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517bae8b9c12f1_24850484')) {function content_517bae8b9c12f1_24850484($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['arrLangs']->value)>1){?>
    <li class="dropdown">
	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
	    <img src="/images/<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
.gif" alt="<?php echo $_smarty_tpl->tpl_vars['arrLangs']->value[$_smarty_tpl->tpl_vars['lang']->value]['title'];?>
" /> <?php echo @SITE_LANGUAGE;?>
:
	    <b class="caret"></b>
	</a>
	<ul class="dropdown-menu">
<?php  $_smarty_tpl->tpl_vars['arLnItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arLnItem']->_loop = false;
 $_smarty_tpl->tpl_vars['lnKey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arrLangs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arLnItem']->key => $_smarty_tpl->tpl_vars['arLnItem']->value){
$_smarty_tpl->tpl_vars['arLnItem']->_loop = true;
 $_smarty_tpl->tpl_vars['lnKey']->value = $_smarty_tpl->tpl_vars['arLnItem']->key;
?>
	    <li class="dropdown">
		<a class="dropdown-toggle" href="<?php echo $_smarty_tpl->tpl_vars['arLangsUrls']->value[$_smarty_tpl->tpl_vars['lnKey']->value];?>
" title="<?php echo $_smarty_tpl->tpl_vars['arLnItem']->value['title'];?>
"<?php if ($_smarty_tpl->tpl_vars['lnKey']->value==$_smarty_tpl->tpl_vars['lang']->value){?> id="activeLang"<?php }?>>
		    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['images_dir'];?>
<?php echo $_smarty_tpl->tpl_vars['arLnItem']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['arLnItem']->value['title'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['arLnItem']->value['title'];?>

		</a>
	    </li>
<?php } ?>
	</ul>
    </li>
<?php }?>

<?php }} ?>