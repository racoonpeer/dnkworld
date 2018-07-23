<?php /* Smarty version Smarty-3.1.12, created on 2013-11-19 21:48:34
         compiled from "tpl/backend/weblife/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1689604232528bc09282f758-10522531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1c0146504e9b0edb75169531097c9fe32cc853e' => 
    array (
      0 => 'tpl/backend/weblife/main.tpl',
      1 => 1363383625,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1689604232528bc09282f758-10522531',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'arrPageData' => 0,
    'item' => 0,
    'categoryTree' => 0,
    'arrPageTypes' => 0,
    'arrMenuTypes' => 0,
    'arModules' => 0,
    'iItem' => 0,
    'arrModules' => 0,
    'arrRedirects' => 0,
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_528bc0932af2f0_53578529',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528bc0932af2f0_53578529')) {function content_528bc0932af2f0_53578529($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Volumes/DATA/htdocs/dnkworld/www/include/smarty/plugins/modifier.date_format.php';
?><div class="hero-unit">
    <h3><?php echo @ADMIN_MAIN_TITLE;?>
</h3>
</div>
<?php if (!empty($_smarty_tpl->tpl_vars['arrPageData']->value['errors'])||!empty($_smarty_tpl->tpl_vars['arrPageData']->value['messages'])){?>
<div class="row-fluid">
    <div class="alert <?php if (!empty($_smarty_tpl->tpl_vars['arrPageData']->value['errors'])){?>alert-error<?php }elseif(!empty($_smarty_tpl->tpl_vars['arrPageData']->value['messages'])){?>alert-success<?php }?>">
	<button type="button" class="close" data-dismiss="alert">X</button>
    <?php if (!empty($_smarty_tpl->tpl_vars['arrPageData']->value['errors'])){?>
	<?php echo implode($_smarty_tpl->tpl_vars['arrPageData']->value['errors'],'<br/>');?>

    <?php }elseif(!empty($_smarty_tpl->tpl_vars['arrPageData']->value['messages'])){?>
	<?php echo implode($_smarty_tpl->tpl_vars['arrPageData']->value['messages'],'<br/>');?>

    <?php }?>
    </div>
</div>
<?php }?>

<div class="row-fluid">
<!-- ++++++++++ Start BreadCrumb +++++++++++++++++++++++++++++++++++++++++++ -->
    <?php echo $_smarty_tpl->getSubTemplate ('common/breadcrumb.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arrBreadCrumb'=>$_smarty_tpl->tpl_vars['arrPageData']->value['arrBreadCrumb']), 0);?>

<!-- ++++++++++ End BreadCrumb +++++++++++++++++++++++++++++++++++++++++++++ -->
</div>

<div class="row-fluid">
<!-- +++++++++++++++++ SHOW ADD OR EDIT ITEM FORM ++++++++++++++++++++++ -->
<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['task']=='addItem'||$_smarty_tpl->tpl_vars['arrPageData']->value['task']=='editItem'){?>
<form method="post" action="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=")).($_smarty_tpl->tpl_vars['arrPageData']->value['task']);?>
<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['itemID']>0){?><?php echo (('').("&itemID=")).($_smarty_tpl->tpl_vars['arrPageData']->value['itemID']);?>
<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['task'];?>
Form" onsubmit="return formCheck(this);" enctype="multipart/form-data">
<!--content-->
    <div class="span8">
	<fieldset><legend>Page content</legend>	</fieldset>
	
	<div class="controls controls-row">
	    <label for="title">Title:</label>
	    <input type="text" name="title" placeholder="Page title (HTML)" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" class="span6" />
	    <input type="hidden" name="created" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['created'];?>
" />
	</div>

	<div class="controls controls-row">
	    <label for="pid">Parent:</label>
	    <select name="pid" id="pid" onchange="" <?php if ($_smarty_tpl->tpl_vars['item']->value['id']==1){?>disabled<?php }?> class="span6">
		<option value="0"> &nbsp;&nbsp;&nbsp;- - Root Level - -&nbsp;&nbsp;&nbsp; </option>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['categoryTree']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<option value="<?php echo $_smarty_tpl->tpl_vars['categoryTree']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['pid']==$_smarty_tpl->tpl_vars['categoryTree']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']||(empty($_smarty_tpl->tpl_vars['item']->value['pid'])&&$_smarty_tpl->tpl_vars['arrPageData']->value['pid']==$_smarty_tpl->tpl_vars['categoryTree']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['categoryTree']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</option>
<?php if (!empty($_smarty_tpl->tpl_vars['categoryTree']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['childrens'])){?>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
		<?php echo $_smarty_tpl->getSubTemplate ('tree_childrens.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('itemID'=>$_smarty_tpl->tpl_vars['item']->value['id'],'dependID'=>$_smarty_tpl->tpl_vars['item']->value['pid'],'arrChildrens'=>$_smarty_tpl->tpl_vars['categoryTree']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['childrens']), 0);?>

<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<?php }?>
<?php endfor; endif; ?>
	    </select>
	</div>

	<div class="controls controls-row description-data">
<!--tab controls-->
	    <ul class="nav nav-tabs" id="tabBar">
		<li class="active">
		    <a href="#fdescr" data-toggle="tab">Full description</a>
		</li>
		<li>
		    <a href="#shdescr" data-toggle="tab">Short description</a>
		</li>
	    </ul>
<!--/tab controls-->  
<!--tab panels-->
	    <div class="tab-content">
<!--full description-->
		<div class="tab-pane active" id="fdescr">
		    <textarea id="categorytext" name="text" style="width: 100%; height: 300px"><?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>
</textarea>
		    <a onclick="toggleEditor('categorytext');"><i class="icon icon-edit"></i> Toggle editor</a>
		</div>
<!--/full description-->
<!--short description-->
		<div class="tab-pane" id="shdescr">
		    <textarea id="categorydescr" name="descr" style="width: 100%; height: 300px"><?php echo $_smarty_tpl->tpl_vars['item']->value['descr'];?>
</textarea>
		    <a onclick="toggleEditor('categorydescr');"><i class="icon icon-edit"></i> Toggle editor</a>
		</div>
<!--/short description-->
	    </div>
<!--/tab panels-->	    
	</div>
	
	<fieldset><legend>Images</legend></fieldset>
	<div class="controls controls-row image-data">
	    <table class="table table-bordered">
		<thead>
		    <tr>
			<th>Select image:</th>
			<th>Preview:</th>
			<th>Width:</th>
			<th>Height:</th>
			<th>Delete</th>
		    </tr>
		</thead>
		<tbody>
		    <tr>
			<td>
			    <input name="image" type="file"<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image'])){?> onchange="if(this.value.length){this.form.image_delete.disabled=true;}else{this.form.image_delete.disabled=false;}; this.form.image_w.value='';this.form.image_h.value='';"<?php }?> />
			</td>
			<td>
			    <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image'])){?><a href="javascript:popUp('<?php echo ($_smarty_tpl->tpl_vars['arrPageData']->value['files_url']).($_smarty_tpl->tpl_vars['item']->value['image']);?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
</a><?php }?>
			</td>
			<td>
			    <input class="span12" name="image_w" id="image_w" type="text" placeholder="Width" value="<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image'])){?><?php echo $_smarty_tpl->tpl_vars['item']->value['arImageData']['w'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['def_img_param']['w'];?>
<?php }?>" size="2" />
			</td>
			<td>
			    <input class="span12" name="image_h" id="image_h" type="text" placeholder="Height" value="<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image'])){?><?php echo $_smarty_tpl->tpl_vars['item']->value['arImageData']['h'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['def_img_param']['h'];?>
<?php }?>" size="2" />
			</td>
			<td>
			    <input id="image_delete" name="image_delete" type="checkbox" value="1"<?php if (empty($_smarty_tpl->tpl_vars['item']->value['image'])){?> disabled<?php }?> />
			</td>
		    </tr>
		</tbody>
	    </table>
	</div>
			    
	<fieldset><legend>SEO content</legend></fieldset>
	<div class="controls controls-row seo-data">
	    <label for="seo_title">SEO title:</label>
	    <input type="text" class="span6" name="seo_title" id="seo_title" placeholder="Page title (not HTML)" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['seo_title'];?>
" />
	</div>
	<div class="controls controls-row seo-data">
	    <label for="seo_path">SEO url:</label>
	    <div class="input-append">
		<input type="text" class="span6" name="seo_path" id="seo_path" placeholder="Page alias" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['seo_path'];?>
" />
		<button class="btn" type="button" onclick="if(this.form.title.value.length==0){ alert('Введите заголовок страницы!'); this.form.title.focus(); return false; }else{ generateSeoPath(this.form.seo_path, this.form.title.value, '<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['module'];?>
'); }">
		    Generate!
		</button>
	    </div>
	</div>
	
	<div class="form-actions">
	    <button type="submit" name="submit" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save changes</button>
	    <button type="submit" name="submit_apply" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Apply changes</button>
	    <button type="submit" name="submit_add" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save & create</button>
	    <button type="reset" name="submit_clear" class="btn" onclick="if(window.confirm('Вы уверены?')) {this.reset()}; return false">Clear</button>
	    <button type="submit" name="submit_cancel" class="btn" onclick="if(window.confirm('Уйти со страницы без сохранения изменений?')) {window.location='<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['current_url'];?>
'}; return false;">Cancel</button>
<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['task']=='editItem'&&$_smarty_tpl->tpl_vars['item']->value['id']>10){?>
	    <button type="submit" name="submit_delete" class="btn" onclick="if(window.confirm('Внимание! Страница будет удалена со всех языков. Продолжить?')) {window.location='<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=deleteItem&itemID=")).($_smarty_tpl->tpl_vars['item']->value['id']);?>
'}; return false">Delete</button>
<?php }?>
	</div>
    </div>
<!--/content-->

<!--settings-->
    <div class="span4">
	<div class="accordion" id="accordion">
	    <div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Page settings</a>
		</div>
		<div id="collapseOne" class="accordion-body collapse in">
		    <div class="accordion-inner">
			<div class="conreols controls-row">
			    <label for="active">Publish page:</label>
			    <select name="active" id="active" class="span6">
				<option value="1"> <?php echo @OPTION_YES;?>
 </option>
				<option value="0"<?php if ($_smarty_tpl->tpl_vars['item']->value['active']==0){?> selected<?php }?>> <?php echo @OPTION_NO;?>
 </option>
			    </select>
			</div>
			<div class="conreols controls-row">
			    <label for="order">Order:</label>
			    <input type="text" name="order" id="order" placeholder="Sort order" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
" class="span6" />
			</div>
			<hr />
			<div class="controls controls-row">
			    <label for="pagetype">Page type:</label>
			    <select name="pagetype" id="pagetype" class="span12" <?php if ($_smarty_tpl->tpl_vars['item']->value['menutype']==8){?> disabled<?php }?>>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arrPageTypes']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $_smarty_tpl->tpl_vars['arrPageTypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['pagetype'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['pagetype']==$_smarty_tpl->tpl_vars['arrPageTypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['pagetype']){?> selected<?php }?>> &nbsp; <?php echo $_smarty_tpl->tpl_vars['arrPageTypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
 &nbsp; </option>
<?php endfor; endif; ?>
			    </select>
			</div>	
			<div class="controls controls-row">
			    <label for="menutype">Menu type:</label>
			    <select name="menutype" id="menutype" class="span12" <?php if ($_smarty_tpl->tpl_vars['item']->value['menutype']==8){?> disabled<?php }?>>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arrMenuTypes']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $_smarty_tpl->tpl_vars['arrMenuTypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['menutype']==$_smarty_tpl->tpl_vars['arrMenuTypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype']){?> selected<?php }?>> &nbsp; <?php echo $_smarty_tpl->tpl_vars['arrMenuTypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
 &nbsp; </option>
<?php endfor; endif; ?>
			    </select>
			</div>
			<div class="controls controls-row">
			    <label for="module">Page module:</label>
			    <select name="module" id="module" class="span12"<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['submodules'])){?> disabled<?php }?>>
				<option value=""> &nbsp; Not selected &nbsp; </option>
<?php  $_smarty_tpl->tpl_vars['iItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['iItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arModules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['iItem']->key => $_smarty_tpl->tpl_vars['iItem']->value){
$_smarty_tpl->tpl_vars['iItem']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['iItem']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['module']==$_smarty_tpl->tpl_vars['iItem']->value){?> selected<?php }?><?php if (isset($_smarty_tpl->tpl_vars['arrModules']->value[$_smarty_tpl->tpl_vars['iItem']->value])&&$_smarty_tpl->tpl_vars['item']->value['module']!=$_smarty_tpl->tpl_vars['iItem']->value&&!in_array($_smarty_tpl->tpl_vars['iItem']->value,$_smarty_tpl->tpl_vars['item']->value['arParentModules'])){?> disabled<?php }?>> &nbsp; <?php echo $_smarty_tpl->tpl_vars['iItem']->value;?>
 &nbsp; <?php if (isset($_smarty_tpl->tpl_vars['arrModules']->value[$_smarty_tpl->tpl_vars['iItem']->value])){?> (<?php echo $_smarty_tpl->tpl_vars['arrModules']->value[$_smarty_tpl->tpl_vars['iItem']->value]['title'];?>
) &nbsp; <?php }?></option>
<?php } ?>
			    </select>
			</div>
			<div class="controls controls-row">
			    <label for="access">Page access:</label>
			    <select id="access" name="access"<?php if ($_smarty_tpl->tpl_vars['item']->value['id']>0){?> onchange="manageSubAccessInput(this, this.form.sub_access);"<?php }?> slass="span6">
				<option value="1"> <?php echo @OPTION_YES;?>
 </option>
				<option value="0"<?php if ($_smarty_tpl->tpl_vars['item']->value['access']==0){?> selected<?php }?>> <?php echo @OPTION_NO;?>
 </option>
			    </select>
			    <label for="sub_access">All children:</label>
			    <input id="sub_access" name="sub_access" type="checkbox" value="1"<?php if ($_smarty_tpl->tpl_vars['item']->value['access']==0){?> readonly  checked<?php }elseif(!$_smarty_tpl->tpl_vars['item']->value['id']){?> disabled<?php }?> onclick="if(this.readonly){return false;}" />
			    <?php if ($_smarty_tpl->tpl_vars['item']->value['access']==0){?><script type="text/javascript">document.getElementById('sub_access').readonly = true;</script><?php }?> 
			</div>
			<hr />
			<div class="controls controls-row">
			    <label for="redirectid">Redirect page:</label>
			    <select name="redirectid" id="redirectid" onchange="toggleFormState(this.form, 'main');" class="span12"<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['redirecturl'])){?> disabled<?php }?>>
				<option value="">&nbsp;&nbsp;&nbsp;- - Select page to redirect - -&nbsp;&nbsp;&nbsp;</option>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arrRedirects']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if (!empty($_smarty_tpl->tpl_vars['arrRedirects']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['categories'])){?>
				<optgroup label="<?php echo $_smarty_tpl->tpl_vars['arrRedirects']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutitle'];?>
">
<?php echo $_smarty_tpl->getSubTemplate ('common/tree_redirects.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arItems'=>$_smarty_tpl->tpl_vars['arrRedirects']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['categories'],'selID'=>$_smarty_tpl->tpl_vars['item']->value['redirectid'],'marginLevel'=>0), 0);?>

				</optgroup>
<?php }?>
<?php endfor; endif; ?>
			    </select>
			</div>
			<div class="controls controls-row">
			    <label>
				<input id="redirectype" name="redirectype" onchange="toggleFormState(this.form, 'main');" type="checkbox" value="1" onclick="manageSelections(this, this.form.redirectid, this.form.redirecturl);"<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['redirecturl'])){?> checked<?php }?> />
				Custom url redirect:
			    </label>
			    <input id="redirecturl" name="redirecturl" type="text" placeholder="Custom redirect url" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['redirecturl'];?>
" class="span12"<?php if (empty($_smarty_tpl->tpl_vars['item']->value['redirecturl'])){?> disabled<?php }?> />
			</div>
		  </div>
		</div>
	    </div>
	    <div class="accordion-group">
		<div class="accordion-heading">
		    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">META content</a>
		</div>
		<div id="collapseTwo" class="accordion-body collapse">
		<div class="accordion-inner">
		    
		    <div class="controls controls-row">
			<label for="meta_key">META keywords:</label>
			<textarea name="meta_key" id="meta_key" class="span12" rows="4"><?php echo $_smarty_tpl->tpl_vars['item']->value['meta_key'];?>
</textarea>
		    </div>
		    
		    <div class="controls controls-row">
			<label for="meta_key">META description:</label>
			<textarea name="meta_descr" id="meta_descr" class="span12" rows="4"><?php echo $_smarty_tpl->tpl_vars['item']->value['meta_descr'];?>
</textarea>
		    </div>
		    
		    <div class="controls controls-row">
			<label for="meta_robots">META robots:</label>
			<select name="meta_robots" id="meta_robots">
			    <option value=""> &nbsp; Not select &nbsp; </option>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['arrPageData']->value['robots']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    <option value="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['robots'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['meta_robots']==$_smarty_tpl->tpl_vars['arrPageData']->value['robots'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]){?> selected<?php }?>> &nbsp; <?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['robots'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']];?>
 &nbsp; </option>
<?php endfor; endif; ?>
			</select>
		    </div>
		    
		</div>
		</div>
	    </div>
	</div>
    </div>
<!--/settings-->    
</form>
			
<script type="text/javascript">
    $(function () {
	$('#tabBar a:first').tab('show');
    })
</script>

<?php if (!empty($_smarty_tpl->tpl_vars['item']->value['redirectid'])||!empty($_smarty_tpl->tpl_vars['item']->value['redirecturl'])){?>
<script type="text/javascript">
    toggleFormState(document.<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['task'];?>
Form, 'main');
</script>
<?php }?>

<!-- +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ -->
<?php }else{ ?>
<form method="post" action="<?php echo ($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=reorderItems");?>
" name="reorderItems">
    <table class="table table-bordered table-hover admin-list tinytable">
	<thead>
	    <tr>
		<th class="center" width="12">Id</th>
		<th align="left">Title</th>
		<th class="center" width="30">Order</th>
		<th class="center" width="45">Last<br/>Update</th>
		<th class="center" width="27">Redi-<br/>rect</th>
		<th class="center" width="45">Module</th>
		<th class="center" width="25">Menu<br/>Type</th>
		<th class="center" width="25">Page<br/>Type</th>
		<th class="center" width="25">Publish</th>
		<th class="center" width="25">Ac-<br/>cess</th>
		<th class="center" width="40">Sub<br/>Pages</th>
		<th class="center" width="22">Edit</th>
		<th class="center" width="35">Delete</th>
	    </tr>
	</thead>
	<tbody>
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
         <tr>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center"><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
</td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
"><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center">
                <input type="text" name="arOrder[<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
]" id="arOrder_<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" class="field_smal" value="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['order'];?>
" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
            </td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['modified'],"%d.%m.%y");?>
</td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center"><?php if (empty($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['redirectid'])&&empty($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['i']['index']]['redirecturl'])){?><?php echo @OPTION_NO;?>
<?php }else{ ?><?php echo @OPTION_YES;?>
<?php }?></td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center"><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['module'];?>
</td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center">
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype']!=8){?>
                <a href="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
&task=changeMenuType&status=<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mn_type']>0&&$_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mn_type']<count($_smarty_tpl->tpl_vars['arrMenuTypes']->value)){?><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mn_type'];?>
<?php }else{ ?>0<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arMenuType']['title'];?>
, (С‚РёРї <?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype'];?>
)" onclick="return confirm('РЎРјРµРЅРёС‚СЊ С‚РёРї РјРµРЅСЋ?');">
<?php }?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arMenuType']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arMenuType']['title'];?>
, (С‚РёРї <?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype'];?>
)" title="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arMenuType']['title'];?>
, (С‚РёРї <?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype'];?>
)" />
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype']!=8){?>
                </a>
<?php }?>
            </td>
           <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center">
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype']!=8){?>
               <a href="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
&task=changePageType&status=<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['pn_type']>0&&$_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['pn_type']<count($_smarty_tpl->tpl_vars['arrPageTypes']->value)){?><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['pn_type'];?>
<?php }else{ ?>0<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arPageType']['title'];?>
" onclick="return confirm('РЎРјРµРЅРёС‚СЊ С‚РёРї СЃС‚СЂР°РЅРёС†С‹?');">
<?php }?>
                   <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arPageType']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arPageType']['title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['arPageType']['title'];?>
" />
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['menutype']!=8){?>
               </a>
<?php }?>
            </td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center">
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['active']==1){?>
                <a href="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=publishItem&status=0&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="Publication">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
check.gif" alt="Publication" title="Publication" />
                </a>
<?php }else{ ?>
                <a href="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=publishItem&status=1&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="No Publication">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
un_check.gif" alt="No Publication" title="No Publication" />
                </a>
<?php }?>
            </td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center"><?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['access']){?><?php echo @OPTION_YES;?>
<?php }else{ ?><?php echo @OPTION_NO;?>
<?php }?></td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center">
                <a href="<?php echo ((($_smarty_tpl->tpl_vars['arrPageData']->value['admin_url']).('&pid=')).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'])).($_smarty_tpl->tpl_vars['arrPageData']->value['filter_url']);?>
" title="Add/View SubPages">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
add_tree.gif" alt="Add/View SubPages" title="Add/View SubPages" />
                </a>
                <?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['childrens']){?><small class="subchildrens"><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['childrens'];?>
</small><?php }?>
            </td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center" >
                <a href="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=editItem&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="Edit">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
edit.gif" alt="Edit" />
                </a>
            </td>
            <td id="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['idb'];?>
" class="center">
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']>10){?>
                <a href="<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=deleteItem&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" onclick="return confirm('Р’С‹ СѓРІРµСЂРµРЅС‹? РЎС‚СЂР°РЅРёС†Р° СѓРґР°Р»РёС‚СЃСЏ СЃСЂР°Р·Сѓ СЃРѕ РІСЃРµС… СЏР·С‹РєРѕРІ Рё СЃРѕ РІСЃРµРјРё РїРѕРґСЃС‚СЂР°РЅРёС†Р°РјРё!');" title="Delete!">
                   <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
delete.gif" alt="Delete!" title="Delete!" />
                </a>
<?php }else{ ?>
                Denied
<?php }?>
            </td>
        </tr>
<?php endfor; endif; ?>
	</tbody>
<?php if (count($_smarty_tpl->tpl_vars['items']->value)>1){?>
	<tfoot>
	    <tr>
		<td id="body1" colspan="2">
		    <?php echo @SITE_COUNT_RECORDS;?>
<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['total_items'];?>

		</td>
		<td id="body1" colspan="11">
		    <input name="submit_order" class="btn btn-primary" type="submit" value="Apply Page Reorder"/>
		</td>
	    </tr>
	</tfoot>
<?php }?>
    </table>
<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['total_pages']>1){?>
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <?php echo $_smarty_tpl->getSubTemplate ('pager.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('arrPager'=>$_smarty_tpl->tpl_vars['arrPageData']->value['pager'],'page'=>$_smarty_tpl->tpl_vars['arrPageData']->value['page'],'showTitle'=>1,'showFirstLast'=>0,'showPrevNext'=>0,'subClass'=>'centered'), 0);?>

<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<?php }?>
</form>
<?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['task']!='addItem'&&$_smarty_tpl->tpl_vars['arrPageData']->value['task']!='editItem'){?>
<div class="row-fluid">
    <a class="btn btn-primary" href="<?php echo ($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=addItem");?>
"><i class="icon-plus icon-white"></i> <?php echo @ADMIN_ADD_NEW;?>
</a>
</div>
<?php }?>

<script type="text/javascript">
    function formCheck(form){
    }
    function manageSubAccessInput(main, slave) {
        if(main.value==0){
             slave.readonly = true;
             slave.checked = true;
        } else {
             slave.readonly = false;
             slave.checked = false;
        }
    }
    function itemsShowHide(f) {
        var display = '';
        if(f.redirectid.value.length > 0 || f.redirecturl.value.length > 0 || f.redirectype.checked)
            display = 'none';
        var bts = new Array('menuContent', /*'menuImage', */'menuConfig', 'menuMeta', 'menuSEO');
        if(bts.length > 0){
            for(var i=0; i < bts.length; i++){
                document.getElementById(bts[i]).style.display = display;
            }
        }
    }
</script><?php }} ?>