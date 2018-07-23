<div class="hero-unit">
    <h3><{$smarty.const.BLOGNEWS}></h3>
</div>
<{if !empty($arrPageData.errors) OR !empty($arrPageData.messages)}>
<div class="row-fluid">
    <div class="alert <{if !empty($arrPageData.errors)}>alert-error<{elseif !empty($arrPageData.messages)}>alert-success<{/if}>">
	<button type="button" class="close" data-dismiss="alert">X</button>
    <{if !empty($arrPageData.errors)}>
	<{$arrPageData.errors|@implode:'<br/>'}>
    <{elseif !empty($arrPageData.messages)}>
	<{$arrPageData.messages|@implode:'<br/>'}>
    <{/if}>
    </div>
</div>
<{/if}>

<div class="row-fluid">
<!-- ++++++++++ Start BreadCrumb +++++++++++++++++++++++++++++++++++++++++++ -->
    <{include file='common/breadcrumb.tpl' arrBreadCrumb=$arrPageData.arrBreadCrumb}>
<!-- ++++++++++ End BreadCrumb +++++++++++++++++++++++++++++++++++++++++++++ -->
</div>

<div class="row-fluid">
<{* +++++++++++++++++ SHOW ADD OR EDIT ITEM FORM ++++++++++++++++++++++ *}>
<{if $arrPageData.task=='addItem' || $arrPageData.task=='editItem'}>
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
<form method="post" action="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task="|cat:$arrPageData.task}><{if $arrPageData.itemID>0}><{''|cat:"&itemID="|cat:$arrPageData.itemID}><{/if}>" name="<{$arrPageData.task}>Form" onsubmit="return formCheck(this);" enctype="multipart/form-data">
<!--content-->
    <div class="span8">
	<fieldset><legend>Page content</legend>	</fieldset>
	<div class="controls controls-row">
	    <label for="title">Title:</label>
	    <input type="text" name="title" placeholder="Page title (HTML)" value="<{$item.title}>" class="span6" />
	</div>
<{if !empty($categoryTree)}>
	<div class="controls controls-row">
	    <label for="category">Category:</label>
	    <select name="arCategories[]" id="category" class="span6" size="5" multiple>
<{section name=i loop=$categoryTree}>
		<option value="<{$categoryTree[i].id}>" <{if in_array($categoryTree[i].id, $item.arCategories)}>selected<{/if}>><{$categoryTree[i].title}></option>
<{if !empty($categoryTree[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
		<{include file='multitree_childrens_multiselect.tpl' dependIDS=$item.arCategories arrChildrens=$categoryTree[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
	    </select>
	</div>
<{/if}>
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
		    <textarea id="categorytext" name="fulldescr" style="width: 100%; height: 300px"><{$item.fulldescr}></textarea>
		    <a onclick="toggleEditor('categorytext');"><i class="icon icon-edit"></i> Toggle editor</a>
		</div>
    <!--/full description-->
    <!--short description-->
		<div class="tab-pane" id="shdescr">
		    <textarea id="categorydescr" name="descr" style="width: 100%; height: 300px"><{$item.descr}></textarea>
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
			    <input name="image" type="file"<{if !empty($item.image)}> onchange="if(this.value.length){this.form.image_delete.disabled=true;}else{this.form.image_delete.disabled=false;}; this.form.image_w.value='';this.form.image_h.value='';"<{/if}> />
			</td>
			<td>
			    <{if !empty($item.image)}><a href="/interactive/ajax.php?zone=admin&action=modalExpand&type=image&path=<{$arrPageData.files_url|cat:$item.image}>" data-toggle="modal" data-target="#modal-container"><{$item.image}></a><{/if}>
			</td>
			<td>
			    <input class="span12" name="image_w" id="image_w" type="text" placeholder="Width" value="<{if !empty($item.image)}><{$item.arImageData.w}><{else}><{$arrPageData.def_img_param.w}><{/if}>" size="2" />
			</td>
			<td>
			    <input class="span12" name="image_h" id="image_h" type="text" placeholder="Height" value="<{if !empty($item.image)}><{$item.arImageData.h}><{else}><{$arrPageData.def_img_param.h}><{/if}>" size="2" />
			</td>
			<td>
			    <input id="image_delete" name="image_delete" type="checkbox" value="1"<{if empty($item.image)}> disabled<{/if}> />
			</td>
		    </tr>
		</tbody>
	    </table>
	</div>
	<div class="controls controls-row">
	    <a class="btn btn-large <{if $arrPageData.task=='addItem'}>disabled<{/if}>" href="<{if $arrPageData.task=='editItem'}>/admin.php?module=blog_files_uploadify&ajax=1&pmodule=<{$arrPageData.module}>&pid=<{if $item.id}><{$item.id}><{else}>0<{/if}>&files_params=<{$arrPageData.images_params|serialize|base64_encode|urlencode}><{else}>javascript:void(0);<{/if}>" <{if $arrPageData.task=='editItem'}>onclick="return hs.htmlExpand(this, { headingText:'<{$smarty.const.GALLERY}>', objectType:'iframe', preserveContent: false, width:900 });"<{/if}>>
		<i class="icon icon-file"></i> Batch upload
	    </a>
<{if $arrPageData.task=='addItem'}>
	    <span class="help-block">Available only after page creation.</span>
<{/if}>
	</div>
<{if $arrPageData.task=='editItem' AND $item.comments>0}>
	<fieldset><legend>Comments</legend></fieldset>
	<div class="controls controls-row comments-data">
	    <a class="btn btn-large" href="/admin.php?module=comments_manager&ajax=1&pmodule=<{$arrPageData.module}>&pid=<{$item.id}>" onclick="return hs.htmlExpand(this, { headingText:'<{$smarty.const.COMMENTS}>', objectType:'iframe', preserveContent: false, width:900 });">
		<i class="icon icon-edit"></i> Edit comments (<{$item.comments}>)
	    </a>
	</div>
<{/if}>
	<fieldset><legend>SEO content</legend></fieldset>
	<div class="controls controls-row seo-data">
	    <label for="seo_title">SEO title:</label>
	    <input type="text" class="span6" name="seo_title" id="seo_title" placeholder="Page title (not HTML)" value="<{$item.seo_title}>" />
	</div>
	<div class="controls controls-row seo-data">
	    <label for="seo_path">SEO url:</label>
	    <div class="input-append">
		<input type="text" class="span6" name="seo_path" id="seo_path" placeholder="Page alias" value="<{$item.seo_path}>" />
		<button class="btn" type="button" onclick="if(this.form.title.value.length==0){ alert('Введите заголовок страницы!'); this.form.title.focus(); return false; }else{ generateSeoPath(this.form.seo_path, this.form.title.value, '<{$arrPageData.module}>'); }">
		    Generate!
		</button>
	    </div>
	</div>
	<fieldset><legend>Filters</legend></fieldset>
	<div class="controls controls-row filters-data">
	    <a class="btn btn-large" href="/admin.php?module=tags_manager&ajax=1&pmodule=<{$arrPageData.module}>&pid=<{$item.id}>" onclick="return hs.htmlExpand(this, { headingText:'<{$smarty.const.TAGS_MANAGER}>', objectType:'iframe', preserveContent: false, width:800 });">
		<i class="icon icon-edit"></i> <{$smarty.const.TAGS_MANAGER}>
	    </a>
	</div>
	<br />
	<div class="controls controls-row filters-data">
	    <select name="filters[]" id="filters" multiple>
<{section name=i loop=$arrPageData.filters}>
		<option value="<{$arrPageData.filters[i].id}>" <{if in_array($arrPageData.filters[i].id, $item.filters)}>selected<{/if}>><{$arrPageData.filters[i].title}></option>
<{/section}>
	    </select>
	</div>
	<div class="form-actions">
	    <div class="btn-toolbar">
		<div class="btn-group">
		    <button type="submit" name="submit" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save changes</button>
		    <button type="submit" name="submit_apply" class="btn" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Apply changes</button>
		    <button type="submit" name="submit_add" class="btn" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save & create</button>
		</div>
		<div class="btn-group">
		    <button type="reset" name="submit_clear" class="btn" onclick="if(window.confirm('Вы уверены?')) {this.reset()}; return false">Clear</button>
		    <button type="submit" name="submit_cancel" class="btn" onclick="if(window.confirm('Уйти со страницы без сохранения изменений?')) {window.location='<{$arrPageData.current_url}>'}; return false;">Cancel</button>
		</div>
		<div class="btn-group">
		    <button type="submit" name="submit_delete" class="btn btn-danger" onclick="if(window.confirm('Внимание! Страница будет удалена со всех языков. Продолжить?')) {window.location='<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false">Delete</button>
		</div>
	    </div>
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
				<option value="1"> <{$smarty.const.OPTION_YES}> </option>
				<option value="0"<{if $item.active==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
			    </select>
			</div>
			<div class="conreols controls-row">
			    <label for="order">Order:</label>
			    <input type="text" name="order" id="order" placeholder="Sort order" value="<{$item.order}>" class="span6" />
			</div>
			<div class="conreols controls-row">
			    <label>Date created:</label>
			    <input type="hidden" name="created" value="<{$item.created}>" />
			    <input type="text" name="createdDate" id="createdDate" placeholder="Date" value="<{$item.createdDate}>" class="span6" />
			    <input type="text" name="createdTime" id="createdTime" placeholder="Time" value="<{$item.createdTime}>" class="span6" />
			    <button class="btn" onclick="clearInput('createdDate'); return false;">Clear</button>
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
			<textarea name="meta_key" id="meta_key" class="span12" rows="4"><{$item.meta_key}></textarea>
		    </div>
		    <div class="controls controls-row">
			<label for="meta_key">META description:</label>
			<textarea name="meta_descr" id="meta_descr" class="span12" rows="4"><{$item.meta_descr}></textarea>
		    </div>
		    <div class="controls controls-row">
			<label for="meta_robots">META robots:</label>
			<select name="meta_robots" id="meta_robots">
			    <option value=""> &nbsp; Not select &nbsp; </option>
<{section name=i loop=$arrPageData.robots}>
			    <option value="<{$arrPageData.robots[i]}>"<{if $item.meta_robots==$arrPageData.robots[i]}> selected<{/if}>> &nbsp; <{$arrPageData.robots[i]}> &nbsp; </option>
<{/section}>
			</select>
		    </div>
		</div>
		</div>
	    </div>
	</div>
    </div>
<!--/settings--> 
</form>

<{* +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ *}>
<{else}>

<{if !empty($categoryTree)}>
    <form action="" method="get" name="filterForm" class="form-horizontal">
	<div class="filter_box">
	    Выберите категорию: &nbsp;
	    <input type="hidden" name="module" value="<{$arrPageData.module}>" />
	    <select name="cid" onchange="this.form.submit()">
<{section name=i loop=$categoryTree}>
		<option value="<{$categoryTree[i].id}>"<{if $arrPageData.cid==$categoryTree[i].id}>  selected<{/if}>><{$categoryTree[i].margin}><{$categoryTree[i].title}> &nbsp; [items: <{if isset($arCidCntItems[$categoryTree[i].id])}><{$arCidCntItems[$categoryTree[i].id]}><{else}>0<{/if}>] &nbsp; <{if $categoryTree[i].active==0}>( неактивен ) &nbsp; <{/if}></option>
<{if !empty($categoryTree[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
		<{include file='common/tree_childrens.tpl' dependID=0 arrChildrens=$categoryTree[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
	    </select>
	</div>
    </form>
</div>
<div class="row-fluid">
<{/if}>
    <table class="table table-bordered table-hover admin-list tinytable">
	<thead>
	    <tr>
		<th class="center" width="12"><{$smarty.const.HEAD_ID}></th>
		<th><{$smarty.const.HEAD_NAME}></td>
		<th class="center" width="100"><{$smarty.const.COMMENTS}></td>
		<th class="center" width="120"><{$smarty.const.HEAD_DATE_ADDED}></th>
		<th class="center" width="25"><{$smarty.const.HEAD_PUBLICATION}></th>
		<th class="center" width="22"><{$smarty.const.HEAD_EDIT}></th>
		<th class="center" width="35"><{$smarty.const.HEAD_DELETE}></th>
	    </tr>
	</thead>
	<tbody>
<{section name=i loop=$items}>
	    <tr>
		<td class="center"><{$items[i].id}></td>
		<td><{$items[i].title}></td>
		<td class="center"><span class="badge"><{$items[i].comments}></span></td>
		<td class="center"><{$items[i].created|date_format:"%d.%m.%Y %H:%M:%S"}></td>
		<td class="center">
<{if $items[i].active==1}>
		    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=publishItem&status=0&itemID="|cat:$items[i].id}>" title="Publication">
			<img src="<{$arrPageData.system_images}>check.gif" alt="Publication" title="Publication" />
		    </a>
<{else}>
		    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=publishItem&status=1&itemID="|cat:$items[i].id}>" title="No Publication">
			<img src="<{$arrPageData.system_images}>un_check.gif" alt="No Publication" title="No Publication" />
		    </a>
<{/if}>
		</td>
		<td class="center" >
		    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=editItem&itemID="|cat:$items[i].id}>" title="Edit">
			<img src="<{$arrPageData.system_images}>edit.gif" alt="Edit" />
		    </a>
		</td>
		<td class="center">
		    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$items[i].id}>" onclick="return confirm('Вы уверены? Страница удалится сразу со всех языков!');" title="Delete!">
		       <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" title="Delete!" />
		    </a>
		</td>
	    </tr>
<{/section}>
	</tbody>
<{if $items|@count>1}>
	<tfoot>
	    <tr>
		<td colspan="7">
		    <{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}>
		</td>
	    </tr>
	</tfoot>
<{/if}>
    </table>
</div>

<{if $arrPageData.total_pages>1}>
<div class="row-fluid">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=0 showPrevNext=0 subClass='centered'}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
</div>
<{/if}>    

<{/if}>

<{if $arrPageData.task!='addItem' && $arrPageData.task!='editItem'}>
<div class="row-fluid">
    <a class="btn btn-primary" href="<{$arrPageData.current_url|cat:"&task=addItem"}>"><i class="icon-plus icon-white"></i> <{$smarty.const.ADMIN_ADD_NEW}></a>
</div>
<{/if}>