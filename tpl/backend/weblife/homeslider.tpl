<div class="hero-unit">
    <h3><{$smarty.const.BANNERS}></h3>
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
	    <input type="text" name="title" placeholder="Image title" value="<{$item.title}>" class="span6" />
	</div>
	<div class="controls controls-row">
	    <label for="title">Link:</label>
	    <input type="text" name="url" placeholder="Image link" value="<{$item.url}>" class="span6" />
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
		    <textarea id="categorytext" name="descr" style="width: 100%; height: 300px"><{$item.descr}></textarea>
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
	<div class="form-actions">
	    <button type="submit" name="submit" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save changes</button>
	    <button type="submit" name="submit_apply" class="btn btn-info" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Apply changes</button>
	    <button type="submit" name="submit_add" class="btn btn-success" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save & create</button>
	    <button type="reset" name="submit_clear" class="btn btn-warning" onclick="if(window.confirm('Вы уверены?')) {this.reset()}; return false">Clear</button>
	    <button type="submit" name="submit_cancel" class="btn btn-inverse" onclick="if(window.confirm('Уйти со страницы без сохранения изменений?')) {window.location='<{$arrPageData.current_url}>'}; return false;">Cancel</button>
	    <button type="submit" name="submit_delete" class="btn btn-danger" onclick="if(window.confirm('Внимание! Страница будет удалена со всех языков. Продолжить?')) {window.location='<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false">Delete</button>
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
	</div>
    </div>
<!--/settings--> 
</form>

<{* +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ *}>
<{else}>
    <form method="post" action="<{$arrPageData.current_url|cat:"&task=reorderItems"}>" name="reorderItems">
	<table class="table table-bordered table-hover admin-list tinytable">
	    <thead>
		<tr>
		    <th class="center" width="12"><{$smarty.const.HEAD_ID}></th>
		    <th><{$smarty.const.HEAD_NAME}></th>
		    <th class="center" width="30"><{$smarty.const.HEAD_SORT}></th>
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
		   <td class="center">
		       <input type="text" name="arOrder[<{$items[i].id}>]" id="arOrder_<{$items[i].id}>" class="field_smal" value="<{$items[i].order}>" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
		   </td>
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
<{if $items|@count>2}>
	    <tfoot>
		<tr>
		    <td colspan="2">
			<{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}>
		    </td>
		    <td colspan="4">
			<button name="submit_order" class="btn btn-primary" type="submit" >Apply Page Reorder</button>
		    </td>
		</tr>
	    </tfoot>
<{/if}>
	</table>
    </form>
</div>
<{/if}>

<{if $arrPageData.task!='addItem' && $arrPageData.task!='editItem'}>
<div class="row-fluid">
    <a class="btn btn-primary" href="<{$arrPageData.current_url|cat:"&task=addItem"}>"><i class="icon-plus icon-white"></i> <{$smarty.const.ADMIN_ADD_NEW}></a>
</div>
<{/if}>