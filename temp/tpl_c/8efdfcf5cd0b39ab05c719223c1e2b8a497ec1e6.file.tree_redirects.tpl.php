<?php /* Smarty version Smarty-3.1.12, created on 2013-11-19 21:48:37
         compiled from "tpl/backend/weblife/common/tree_redirects.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1726015278528bc095ef9025-87673969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8efdfcf5cd0b39ab05c719223c1e2b8a497ec1e6' => 
    array (
      0 => 'tpl/backend/weblife/common/tree_redirects.tpl',
      1 => 1363380425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1726015278528bc095ef9025-87673969',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'arItems' => 0,
    'selID' => 0,
    'marginLevel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_528bc09605dfb6_49283217',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528bc09605dfb6_49283217')) {function content_528bc09605dfb6_49283217($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arItems']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['selID']->value==$_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['disabled']){?> disabled<?php }?>> &nbsp;&nbsp;&nbsp;<?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$_smarty_tpl->tpl_vars['marginLevel']->value);?>
L... <?php echo $_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
 &nbsp; </option>
<?php if (!empty($_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['subcategories'])){?><?php echo $_smarty_tpl->getSubTemplate ('common/tree_redirects.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arItems'=>$_smarty_tpl->tpl_vars['arItems']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['subcategories'],'selID'=>$_smarty_tpl->tpl_vars['selID']->value,'marginLevel'=>$_smarty_tpl->tpl_vars['marginLevel']->value+2), 0);?>
<?php }?>
<?php endfor; endif; ?><?php }} ?>