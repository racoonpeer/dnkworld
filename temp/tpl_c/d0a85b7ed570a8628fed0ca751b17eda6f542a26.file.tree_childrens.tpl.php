<?php /* Smarty version Smarty-3.1.12, created on 2013-11-19 21:48:37
         compiled from "tpl/backend/weblife/tree_childrens.tpl" */ ?>
<?php /*%%SmartyHeaderCode:597626201528bc095d7f7d0-20260638%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0a85b7ed570a8628fed0ca751b17eda6f542a26' => 
    array (
      0 => 'tpl/backend/weblife/tree_childrens.tpl',
      1 => 1363380425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '597626201528bc095d7f7d0-20260638',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'arrChildrens' => 0,
    'dependID' => 0,
    'arrPageData' => 0,
    'itemID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_528bc095ee1b49_75601787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528bc095ee1b49_75601787')) {function content_528bc095ee1b49_75601787($_smarty_tpl) {?>
                    <optgroup label="">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arrChildrens']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <option value="<?php echo $_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['dependID']->value==$_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']||(empty($_smarty_tpl->tpl_vars['dependID']->value)&&$_smarty_tpl->tpl_vars['arrPageData']->value['pid']==$_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'])){?>  selected<?php }?><?php if ($_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']==$_smarty_tpl->tpl_vars['itemID']->value){?> disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['margin'];?>
<?php echo $_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
 &nbsp; ( <?php if ($_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['active']==0){?>неактивна, <?php }?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutitle'], 'UTF-8');?>
 ) &nbsp; </option>
<?php if (!empty($_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['childrens'])){?>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<?php echo $_smarty_tpl->getSubTemplate ('tree_childrens.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('itemID'=>$_smarty_tpl->tpl_vars['itemID']->value,'dependID'=>$_smarty_tpl->tpl_vars['dependID']->value,'arrChildrens'=>$_smarty_tpl->tpl_vars['arrChildrens']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['childrens']), 0);?>

<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<?php }?>
<?php endfor; endif; ?>
                    </optgroup>

<?php }} ?>