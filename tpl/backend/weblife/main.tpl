<div class="hero-unit">
    <h3><{$smarty.const.ADMIN_MAIN_TITLE}></h3>
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
<!-- +++++++++++++++++ SHOW ADD OR EDIT ITEM FORM ++++++++++++++++++++++ -->
<{if $arrPageData.task=='addItem' || $arrPageData.task=='editItem'}>
<form method="post" action="<{$arrPageData.current_url|cat:"&task="|cat:$arrPageData.task}><{if $arrPageData.itemID>0}><{''|cat:"&itemID="|cat:$arrPageData.itemID}><{/if}>" name="<{$arrPageData.task}>Form" onsubmit="return formCheck(this);" enctype="multipart/form-data">
<!--content-->
    <div class="span8">
	<fieldset><legend>Page content</legend>	</fieldset>
	
	<div class="controls controls-row">
	    <label for="title">Title:</label>
	    <input type="text" name="title" placeholder="Page title (HTML)" value="<{$item.title}>" class="span6" />
	    <input type="hidden" name="created" value="<{$item.created}>" />
	</div>

	<div class="controls controls-row">
	    <label for="pid">Parent:</label>
	    <select name="pid" id="pid" onchange="" <{if $item.id==1}>disabled<{/if}> class="span6">
		<option value="0"> &nbsp;&nbsp;&nbsp;- - Root Level - -&nbsp;&nbsp;&nbsp; </option>
<{section name=i loop=$categoryTree}>
		<option value="<{$categoryTree[i].id}>" <{if $item.pid==$categoryTree[i].id OR (empty($item.pid) && $arrPageData.pid==$categoryTree[i].id)}>selected<{/if}>><{$categoryTree[i].title}></option>
<{if !empty($categoryTree[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
		<{include file='tree_childrens.tpl' itemID=$item.id dependID=$item.pid arrChildrens=$categoryTree[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
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
		    <textarea id="categorytext" name="text" style="width: 100%; height: 300px"><{$item.text}></textarea>
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
			    <{if !empty($item.image)}><a href="javascript:popUp('<{$arrPageData.files_url|cat:$item.image}>')"><{$item.image}></a><{/if}>
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
	
	<div class="form-actions">
	    <button type="submit" name="submit" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save changes</button>
	    <button type="submit" name="submit_apply" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Apply changes</button>
	    <button type="submit" name="submit_add" class="btn btn-primary" onclick="if(this.form.title.value.length==0) {alert('Введите название страницы!'); return false;}">Save & create</button>
	    <button type="reset" name="submit_clear" class="btn" onclick="if(window.confirm('Вы уверены?')) {this.reset()}; return false">Clear</button>
	    <button type="submit" name="submit_cancel" class="btn" onclick="if(window.confirm('Уйти со страницы без сохранения изменений?')) {window.location='<{$arrPageData.current_url}>'}; return false;">Cancel</button>
<{if $arrPageData.task=='editItem' && $item.id>10}>
	    <button type="submit" name="submit_delete" class="btn" onclick="if(window.confirm('Внимание! Страница будет удалена со всех языков. Продолжить?')) {window.location='<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false">Delete</button>
<{/if}>
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
			<hr />
			<div class="controls controls-row">
			    <label for="pagetype">Page type:</label>
			    <select name="pagetype" id="pagetype" class="span12" <{if $item.menutype==8}> disabled<{/if}>>
<{section name=i loop=$arrPageTypes}>
				<option value="<{$arrPageTypes[i].pagetype}>"<{if $item.pagetype==$arrPageTypes[i].pagetype}> selected<{/if}>> &nbsp; <{$arrPageTypes[i].title}> &nbsp; </option>
<{/section}>
			    </select>
			</div>	
			<div class="controls controls-row">
			    <label for="menutype">Menu type:</label>
			    <select name="menutype" id="menutype" class="span12" <{if $item.menutype==8}> disabled<{/if}>>
<{section name=i loop=$arrMenuTypes}>
				<option value="<{$arrMenuTypes[i].menutype}>"<{if $item.menutype==$arrMenuTypes[i].menutype}> selected<{/if}>> &nbsp; <{$arrMenuTypes[i].title}> &nbsp; </option>
<{/section}>
			    </select>
			</div>
			<div class="controls controls-row">
			    <label for="module">Page module:</label>
			    <select name="module" id="module" class="span12"<{if !empty($item.submodules)}> disabled<{/if}>>
				<option value=""> &nbsp; Not selected &nbsp; </option>
<{foreach name=i item=iItem from=$arModules}>
				<option value="<{$iItem}>"<{if $item.module==$iItem}> selected<{/if}><{if isset($arrModules.$iItem) && $item.module!=$iItem && !in_array($iItem, $item.arParentModules)}> disabled<{/if}>> &nbsp; <{$iItem}> &nbsp; <{if isset($arrModules.$iItem)}> (<{$arrModules[$iItem].title}>) &nbsp; <{/if}></option>
<{/foreach}>
			    </select>
			</div>
			<div class="controls controls-row">
			    <label for="access">Page access:</label>
			    <select id="access" name="access"<{if $item.id>0}> onchange="manageSubAccessInput(this, this.form.sub_access);"<{/if}> slass="span6">
				<option value="1"> <{$smarty.const.OPTION_YES}> </option>
				<option value="0"<{if $item.access==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
			    </select>
			    <label for="sub_access">All children:</label>
			    <input id="sub_access" name="sub_access" type="checkbox" value="1"<{if $item.access==0}> readonly  checked<{elseif !$item.id}> disabled<{/if}> onclick="if(this.readonly){return false;}" />
			    <{if $item.access==0}><script type="text/javascript">document.getElementById('sub_access').readonly = true;</script><{/if}> 
			</div>
			<hr />
			<div class="controls controls-row">
			    <label for="redirectid">Redirect page:</label>
			    <select name="redirectid" id="redirectid" onchange="toggleFormState(this.form, 'main');" class="span12"<{if !empty($item.redirecturl)}> disabled<{/if}>>
				<option value="">&nbsp;&nbsp;&nbsp;- - Select page to redirect - -&nbsp;&nbsp;&nbsp;</option>
<{section name=i loop=$arrRedirects}>
<{if !empty($arrRedirects[i].categories)}>
				<optgroup label="<{$arrRedirects[i].menutitle}>">
<{include file='common/tree_redirects.tpl' arItems=$arrRedirects[i].categories selID=$item.redirectid marginLevel=0}>
				</optgroup>
<{/if}>
<{/section}>
			    </select>
			</div>
			<div class="controls controls-row">
			    <label>
				<input id="redirectype" name="redirectype" onchange="toggleFormState(this.form, 'main');" type="checkbox" value="1" onclick="manageSelections(this, this.form.redirectid, this.form.redirecturl);"<{if !empty($item.redirecturl)}> checked<{/if}> />
				Custom url redirect:
			    </label>
			    <input id="redirecturl" name="redirecturl" type="text" placeholder="Custom redirect url" value="<{$item.redirecturl}>" class="span12"<{if empty($item.redirecturl)}> disabled<{/if}> />
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
			
<script type="text/javascript">
    $(function () {
	$('#tabBar a:first').tab('show');
    })
</script>

<{if !empty($item.redirectid) OR !empty($item.redirecturl)}>
<script type="text/javascript">
    toggleFormState(document.<{$arrPageData.task}>Form, 'main');
</script>
<{/if}>

<!-- +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ -->
<{else}>
<form method="post" action="<{$arrPageData.current_url|cat:"&task=reorderItems"}>" name="reorderItems">
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
<{section name=i loop=$items}>
         <tr>
            <td id="<{$items[i].idb}>" class="center"><{$items[i].id}></td>
            <td id="<{$items[i].idb}>"><{$items[i].title}></td>
            <td id="<{$items[i].idb}>" class="center">
                <input type="text" name="arOrder[<{$items[i].id}>]" id="arOrder_<{$items[i].id}>" class="field_smal" value="<{$items[i].order}>" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
            </td>
            <td id="<{$items[i].idb}>" class="center"><{$items[i].modified|date_format:"%d.%m.%y"}></td>
            <td id="<{$items[i].idb}>" class="center"><{if empty($items[i].redirectid) AND empty($items[i].redirecturl)}><{$smarty.const.OPTION_NO}><{else}><{$smarty.const.OPTION_YES}><{/if}></td>
            <td id="<{$items[i].idb}>" class="center"><{$items[i].module}></td>
            <td id="<{$items[i].idb}>" class="center">
<{if $items[i].menutype!=8}>
                <a href="<{$arrPageData.current_url|cat:"&itemID="|cat:$items[i].id}>&task=changeMenuType&status=<{if $items[i].mn_type>0 && $items[i].mn_type<$arrMenuTypes|@count}><{$items[i].mn_type}><{else}>0<{/if}>" title="<{$items[i].arMenuType.title}>, (С‚РёРї <{$items[i].menutype}>)" onclick="return confirm('РЎРјРµРЅРёС‚СЊ С‚РёРї РјРµРЅСЋ?');">
<{/if}>
                    <img src="<{$arrPageData.system_images}><{$items[i].arMenuType.image}>" alt="<{$items[i].arMenuType.title}>, (С‚РёРї <{$items[i].menutype}>)" title="<{$items[i].arMenuType.title}>, (С‚РёРї <{$items[i].menutype}>)" />
<{if $items[i].menutype!=8}>
                </a>
<{/if}>
            </td>
           <td id="<{$items[i].idb}>" class="center">
<{if $items[i].menutype!=8}>
               <a href="<{$arrPageData.current_url|cat:"&itemID="|cat:$items[i].id}>&task=changePageType&status=<{if $items[i].pn_type>0 && $items[i].pn_type<$arrPageTypes|@count}><{$items[i].pn_type}><{else}>0<{/if}>" title="<{$items[i].arPageType.title}>" onclick="return confirm('РЎРјРµРЅРёС‚СЊ С‚РёРї СЃС‚СЂР°РЅРёС†С‹?');">
<{/if}>
                   <img src="<{$arrPageData.system_images}><{$items[i].arPageType.image}>" alt="<{$items[i].arPageType.title}>" title="<{$items[i].arPageType.title}>" />
<{if $items[i].menutype!=8}>
               </a>
<{/if}>
            </td>
            <td id="<{$items[i].idb}>" class="center">
<{if $items[i].active==1}>
                <a href="<{$arrPageData.current_url|cat:"&task=publishItem&status=0&itemID="|cat:$items[i].id}>" title="Publication">
                    <img src="<{$arrPageData.system_images}>check.gif" alt="Publication" title="Publication" />
                </a>
<{else}>
                <a href="<{$arrPageData.current_url|cat:"&task=publishItem&status=1&itemID="|cat:$items[i].id}>" title="No Publication">
                    <img src="<{$arrPageData.system_images}>un_check.gif" alt="No Publication" title="No Publication" />
                </a>
<{/if}>
            </td>
            <td id="<{$items[i].idb}>" class="center"><{if $items[i].access}><{$smarty.const.OPTION_YES}><{else}><{$smarty.const.OPTION_NO}><{/if}></td>
            <td id="<{$items[i].idb}>" class="center">
                <a href="<{$arrPageData.admin_url|cat:'&pid='|cat:$items[i].id|cat:$arrPageData.filter_url}>" title="Add/View SubPages">
                    <img src="<{$arrPageData.system_images}>add_tree.gif" alt="Add/View SubPages" title="Add/View SubPages" />
                </a>
                <{if $items[i].childrens}><small class="subchildrens"><{$items[i].childrens}></small><{/if}>
            </td>
            <td id="<{$items[i].idb}>" class="center" >
                <a href="<{$arrPageData.current_url|cat:"&task=editItem&itemID="|cat:$items[i].id}>" title="Edit">
                    <img src="<{$arrPageData.system_images}>edit.gif" alt="Edit" />
                </a>
            </td>
            <td id="<{$items[i].idb}>" class="center">
<{if $items[i].id>10}>
                <a href="<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$items[i].id}>" onclick="return confirm('Р’С‹ СѓРІРµСЂРµРЅС‹? РЎС‚СЂР°РЅРёС†Р° СѓРґР°Р»РёС‚СЃСЏ СЃСЂР°Р·Сѓ СЃРѕ РІСЃРµС… СЏР·С‹РєРѕРІ Рё СЃРѕ РІСЃРµРјРё РїРѕРґСЃС‚СЂР°РЅРёС†Р°РјРё!');" title="Delete!">
                   <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" title="Delete!" />
                </a>
<{else}>
                Denied
<{/if}>
            </td>
        </tr>
<{/section}>
	</tbody>
<{if $items|@count>1}>
	<tfoot>
	    <tr>
		<td id="body1" colspan="2">
		    <{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}>
		</td>
		<td id="body1" colspan="11">
		    <input name="submit_order" class="btn btn-primary" type="submit" value="Apply Page Reorder"/>
		</td>
	    </tr>
	</tfoot>
<{/if}>
    </table>
<{if $arrPageData.total_pages>1}>
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=0 showPrevNext=0 subClass='centered'}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
</form>
<{/if}>
</div>

<{if $arrPageData.task!='addItem' && $arrPageData.task!='editItem'}>
<div class="row-fluid">
    <a class="btn btn-primary" href="<{$arrPageData.current_url|cat:"&task=addItem"}>"><i class="icon-plus icon-white"></i> <{$smarty.const.ADMIN_ADD_NEW}></a>
</div>
<{/if}>

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
</script>