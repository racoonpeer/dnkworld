<?php /* Smarty version Smarty-3.1.12, created on 2013-11-17 16:49:10
         compiled from "tpl/frontend/smart/module/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:610687408517baf48d029d3-60558144%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a87bb09cf531bb80a23459b9fc2c782da5cb18bc' => 
    array (
      0 => 'tpl/frontend/smart/module/home.tpl',
      1 => 1379008932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '610687408517baf48d029d3-60558144',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_517baf490cd389_83158615',
  'variables' => 
  array (
    'arCategory' => 0,
    'arrItems' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517baf490cd389_83158615')) {function content_517baf490cd389_83158615($_smarty_tpl) {?><div class="row-fluid">
    <?php echo $_smarty_tpl->getSubTemplate ('core/homeslider.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="row-fluid">
    <div class="span9">
	<div class="story shadowbox">
	    <br />
	    <article>
<?php if (!empty($_smarty_tpl->tpl_vars['arCategory']->value['text'])){?>
	    <?php echo $_smarty_tpl->tpl_vars['arCategory']->value['text'];?>

<?php }else{ ?>
		<br />
		<br />
		<br />
		<center><?php echo @NO_CONTENT;?>
</center>
<?php }?>
	    </article>
	</div>
    </div>
    <div class="span3">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arrItems']->value['arCategories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <div class="album-headline shadowbox">
            <h4 class="title-serif">
                <?php echo $_smarty_tpl->tpl_vars['arrItems']->value['arCategories'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>

            </h4>
            <a class="image" href="<?php echo $_smarty_tpl->getSubTemplate ('core/href.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arItem'=>$_smarty_tpl->tpl_vars['arrItems']->value['arCategories'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]), 0);?>
" title="<?php echo $_smarty_tpl->tpl_vars['arrItems']->value['arCategories'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
">
                <img src="<?php echo $_smarty_tpl->tpl_vars['arrItems']->value['arCategories'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['arrItems']->value['arCategories'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
" align="top" />
            </a>
        </div>
        <div>
            <img src="/images/site/smart/slides/shadow_min.png" alt="" align="top" style="display: block;"/>
        </div>
<?php endfor; endif; ?>    
    </div>
</div><?php }} ?>