<?php /* Smarty version Smarty-3.1.12, created on 2013-04-28 19:37:44
         compiled from "tpl/frontend/smart/module/gallery.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38811684517d48058f6221-62505896%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81b2dee322d51da97303517465c1f56db292e0c8' => 
    array (
      0 => 'tpl/frontend/smart/module/gallery.tpl',
      1 => 1367167050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38811684517d48058f6221-62505896',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_517d4806b16234_61086751',
  'variables' => 
  array (
    'item' => 0,
    'items' => 0,
    'arCategory' => 0,
    'arrModules' => 0,
    'arrPageData' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517d4806b16234_61086751')) {function content_517d4806b16234_61086751($_smarty_tpl) {?><!-- Галлерея начало -->
<?php if (!empty($_smarty_tpl->tpl_vars['item']->value)||!empty($_smarty_tpl->tpl_vars['items']->value)){?>


<?php if (!empty($_smarty_tpl->tpl_vars['item']->value)){?>
<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic pull-right"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h1>
</hgroup>
<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['arGalleries'])){?>
<div class="row-fluid">
    <ul class="album-nav">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['item']->value['arGalleries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<li>
	    <a href="<?php echo $_smarty_tpl->getSubTemplate ('core/href_auto.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arCategory'=>$_smarty_tpl->tpl_vars['arCategory']->value,'arItem'=>$_smarty_tpl->tpl_vars['item']->value['arGalleries'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']],'params'=>''), 0);?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['arGalleries'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['arGalleries'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a>
	</li>
<?php endfor; endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<br />
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['images'])){?>
<div class="row-fluid">
    <div class="iGallery">
	<div class="screen">
	    <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['images'][0]['src'];?>
" align="top" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['images'][0]['descr'];?>
" />
	    <div class="descr">
		<p class="caption">
<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['images'][0]['descr'])){?>
		    <?php echo $_smarty_tpl->tpl_vars['item']->value['images'][0]['descr'];?>

<?php }?>
		</p>
	    </div>
	</div>
	<a class="control prev" href="javascript:void(0);" title="Предыдущая">&nbsp;</a>
	<a class="control next" href="javascript:void(0);" title="Следующая">&nbsp;</a>
	<div class="filmstrip">
	    <div>
		<ul>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['item']->value['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		    <li>
			<a class="<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['i']['first']){?>active<?php }?>" href="javascript:void(0);" data-caption="<?php echo $_smarty_tpl->tpl_vars['item']->value['images'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descr'];?>
" data-index="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['i']['index'];?>
" data-src="<?php echo $_smarty_tpl->tpl_vars['item']->value['images'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
">
			    <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['images'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['pre'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['images'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descr'];?>
" align="top">
			</a>
		    </li>
<?php endfor; endif; ?>
		</ul>
		<div class="clearfix"></div>
	    </div>
	</div>
    </div>
</div>
<div class="overlay-black"></div>
<div class="gallery-cover" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
')"></div>
<script type="text/javascript">    
    $(document).ready(function(){
	IGallery.init();
    });
</script>
<?php }?>


<?php }elseif(!empty($_smarty_tpl->tpl_vars['items']->value)){?>
    
<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic"><?php echo $_smarty_tpl->tpl_vars['arCategory']->value['title'];?>
</h1>
</hgroup>
<div class="row-fluid">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['items']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <div class="span3">
	<div class="album-headline shadowbox">
	    <h4 class="title-serif" style="margin-top: 0;">
		<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>

	    </h4>
	    <a class="image" href="<?php echo $_smarty_tpl->getSubTemplate ('core/href_auto.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arCategory'=>$_smarty_tpl->tpl_vars['arrModules']->value['gallery'],'arItem'=>$_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']],'params'=>''), 0);?>
" title="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
">
		<img src="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
" align="top" />
	    </a>
	</div>
    </div>
<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['i']['iteration']%4==0){?>
</div>
<div class="row-fluid">
<?php }?>
<?php endfor; endif; ?>
</div>
<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['total_pages']>1){?>
<div class="row-fluid">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<?php echo $_smarty_tpl->getSubTemplate ('core/pager.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arrPager'=>$_smarty_tpl->tpl_vars['arrPageData']->value['pager'],'page'=>$_smarty_tpl->tpl_vars['arrPageData']->value['page'],'showTitle'=>0,'showFirstLast'=>0,'showPrevNext'=>0,'showAll'=>0), 0);?>

<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
</div>
<?php }?>
	
<?php }?>

<?php }else{ ?>
<?php echo $_smarty_tpl->getSubTemplate ('core/static.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>
<!--Галлерея конец-->

<?php }} ?>