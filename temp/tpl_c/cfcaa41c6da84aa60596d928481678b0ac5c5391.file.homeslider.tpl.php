<?php /* Smarty version Smarty-3.1.12, created on 2013-08-20 20:23:40
         compiled from "tpl/backend/weblife/homeslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19643861405213a61c7a8e72-93432497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfcaa41c6da84aa60596d928481678b0ac5c5391' => 
    array (
      0 => 'tpl/backend/weblife/homeslider.tpl',
      1 => 1363383947,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19643861405213a61c7a8e72-93432497',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'arrPageData' => 0,
    'item' => 0,
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5213a61cbb7382_61816215',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5213a61cbb7382_61816215')) {function content_5213a61cbb7382_61816215($_smarty_tpl) {?><div class="hero-unit">
    <h3><?php echo @BANNERS;?>
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

<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['task']=='addItem'||$_smarty_tpl->tpl_vars['arrPageData']->value['task']=='editItem'){?>
<script type="text/javascript">
<!--
    function formCheck(form){
    }
    $(document).ready(function() {
        $('#createdDate').datepicker({dateFormat:'yy-mm-dd'});
        //$('#createdDate').datepicker('setDate', 'Now');   // http://www.linkexchanger.su/2009/103.html
    });
//-->
</script>
<form method="post" action="<?php echo ((($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).($_smarty_tpl->tpl_vars['arrPageData']->value['filter_url'])).("&task=")).($_smarty_tpl->tpl_vars['arrPageData']->value['task']);?>
<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['itemID']>0){?><?php echo (('').("&itemID=")).($_smarty_tpl->tpl_vars['arrPageData']->value['itemID']);?>
<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['task'];?>
Form" onsubmit="return formCheck(this);" enctype="multipart/form-data">
<!--content-->
    <div class="span8">
	<fieldset><legend>Page content</legend>	</fieldset>
	<div class="controls controls-row">
	    <label for="title">Title:</label>
	    <input type="text" name="title" placeholder="Image title" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" class="span6" />
	</div>
	<div class="controls controls-row">
	    <label for="title">Link:</label>
	    <input type="text" name="url" placeholder="Image link" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
" class="span6" />
	</div>
	<div class="controls controls-row description-data">
    <!--tab controls-->
	    <ul class="nav nav-tabs" id="tabBar">
		<li class="active">
		    <a href="#fdescr" data-toggle="tab">Description</a>
		</li>
	    </ul>
    <!--/tab controls-->  
    <!--tab panels-->
	    <div class="tab-content">
    <!--full description-->
		<div class="tab-pane active" id="fdescr">
		    <textarea id="categorytext" name="descr" style="width: 100%; height: 300px"><?php echo $_smarty_tpl->tpl_vars['item']->value['descr'];?>
</textarea>
		    <a onclick="toggleEditor('categorytext');"><i class="icon icon-edit"></i> Toggle editor</a>
		</div>
    <!--/full description-->
	    </div>
    <!--/tab panels-->	    
	</div>
	<fieldset><legend>Image</legend></fieldset>
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
			    <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image'])){?><a href="/interactive/ajax.php?zone=admin&action=modalExpand&type=image&path=<?php echo ($_smarty_tpl->tpl_vars['arrPageData']->value['files_url']).($_smarty_tpl->tpl_vars['item']->value['image']);?>
" data-toggle="modal" data-target="#modal-container"><?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
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
	<div class="form-actions">
	    <button type="submit" name="submit" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save changes</button>
	    <button type="submit" name="submit_apply" class="btn btn-info" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Apply changes</button>
	    <button type="submit" name="submit_add" class="btn btn-success" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save & create</button>
	    <button type="reset" name="submit_clear" class="btn btn-warning" onclick="if(window.confirm('Вы уверены?')) {this.reset()}; return false">Clear</button>
	    <button type="submit" name="submit_cancel" class="btn btn-inverse" onclick="if(window.confirm('Уйти со страницы без сохранения изменений?')) {window.location='<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['current_url'];?>
'}; return false;">Cancel</button>
	    <button type="submit" name="submit_delete" class="btn btn-danger" onclick="if(window.confirm('Внимание! Страница будет удалена со всех языков. Продолжить?')) {window.location='<?php echo (($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=deleteItem&itemID=")).($_smarty_tpl->tpl_vars['item']->value['id']);?>
'}; return false">Delete</button>
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
			<div class="conreols controls-row">
			    <label>Date created:</label>
			    <input type="hidden" name="created" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['created'];?>
" />
			    <input type="text" name="createdDate" id="createdDate" placeholder="Date" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['createdDate'];?>
" class="span6" />
			    <input type="text" name="createdTime" id="createdTime" placeholder="Time" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['createdTime'];?>
" class="span6" />
			    <button class="btn" onclick="clearInput('createdDate'); return false;">Clear</button>
			</div>
		  </div>
		</div>
	    </div>
	</div>
    </div>
<!--/settings--> 
</form>


<?php }else{ ?>
    <form method="post" action="<?php echo ($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=reorderItems");?>
" name="reorderItems">
	<table class="table table-bordered table-hover admin-list tinytable">
	    <thead>
		<tr>
		    <th class="center" width="12"><?php echo @HEAD_ID;?>
</th>
		    <th><?php echo @HEAD_NAME;?>
</th>
		    <th class="center" width="30"><?php echo @HEAD_SORT;?>
</th>
		    <th class="center" width="25"><?php echo @HEAD_PUBLICATION;?>
</th>
		    <th class="center" width="22"><?php echo @HEAD_EDIT;?>
</th>
		    <th class="center" width="35"><?php echo @HEAD_DELETE;?>
</th>
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
		   <td class="center"><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
</td>
		   <td><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</td>
		   <td class="center">
		       <input type="text" name="arOrder[<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
]" id="arOrder_<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" class="field_smal" value="<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['order'];?>
" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
		   </td>
		   <td class="center">
<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['active']==1){?>
			<a href="<?php echo ((($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).($_smarty_tpl->tpl_vars['arrPageData']->value['filter_url'])).("&task=publishItem&status=0&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="Publication">
			    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
check.gif" alt="Publication" title="Publication" />
			</a>
<?php }else{ ?>
			<a href="<?php echo ((($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).($_smarty_tpl->tpl_vars['arrPageData']->value['filter_url'])).("&task=publishItem&status=1&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="No Publication">
			    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
un_check.gif" alt="No Publication" title="No Publication" />
			</a>
<?php }?>
		    </td>
		    <td class="center" >
			<a href="<?php echo ((($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).($_smarty_tpl->tpl_vars['arrPageData']->value['filter_url'])).("&task=editItem&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="Edit">
			    <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
edit.gif" alt="Edit" />
			</a>
		    </td>
		    <td class="center">
			<a href="<?php echo ((($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).($_smarty_tpl->tpl_vars['arrPageData']->value['filter_url'])).("&task=deleteItem&itemID=")).($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" onclick="return confirm('Вы уверены? Страница удалится сразу со всех языков!');" title="Delete!">
			   <img src="<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['system_images'];?>
delete.gif" alt="Delete!" title="Delete!" />
			</a>
		    </td>
		</tr>
<?php endfor; endif; ?>
	    </tbody>
<?php if (count($_smarty_tpl->tpl_vars['items']->value)>2){?>
	    <tfoot>
		<tr>
		    <td colspan="2">
			<?php echo @SITE_COUNT_RECORDS;?>
<?php echo $_smarty_tpl->tpl_vars['arrPageData']->value['total_items'];?>

		    </td>
		    <td colspan="4">
			<button name="submit_order" class="btn btn-primary" type="submit" >Apply Page Reorder</button>
		    </td>
		</tr>
	    </tfoot>
<?php }?>
	</table>
    </form>
</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['arrPageData']->value['task']!='addItem'&&$_smarty_tpl->tpl_vars['arrPageData']->value['task']!='editItem'){?>
<div class="row-fluid">
    <a class="btn btn-primary" href="<?php echo ($_smarty_tpl->tpl_vars['arrPageData']->value['current_url']).("&task=addItem");?>
"><i class="icon-plus icon-white"></i> <?php echo @ADMIN_ADD_NEW;?>
</a>
</div>
<?php }?><?php }} ?>