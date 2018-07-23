<div id="sectionTitle"><{$smarty.const.CATALOGS}></div>
<div id="messages" class="<{if !empty($arrPageData.errors)}>error<{elseif !empty($arrPageData.messages)}>info<{else}>hidden_block<{/if}>">
<{if !empty($arrPageData.errors)}>
    <{$arrPageData.errors|@implode:'<br/>'}>
<{elseif !empty($arrPageData.messages)}>
    <{$arrPageData.messages|@implode:'<br/>'}>
<{/if}>
</div>
<div id="mod_panel">
<{if $arrPageData.task!='addItem' && $arrPageData.task!='editItem'}>
    <div class="head-links">
    <{$arrPageData.path_arrow}><a href="<{$arrPageData.current_url|cat:"&task=addItem"}>"><{$smarty.const.HEAD_LINK_ADD_ITEM}></a>
<!-- ++++++++++ Start BreadCrumb +++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/order_links.tpl' arrOrderLinks=$arrPageData.arrOrderLinks}>
<!-- ++++++++++ End BreadCrumb +++++++++++++++++++++++++++++++++++++++++++++ -->
    </div>
<{/if}>
    <div class="breadcrumb">
        <{$smarty.const.ADMIN_PATH}> <{$arrPageData.path_arrow}> <a href="<{$arrPageData.admin_url}>" title=""><{$smarty.const.CATALOG}></a>
<!-- ++++++++++ Start BreadCrumb +++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/breadcrumb.tpl' arrBreadCrumb=$arrPageData.arrBreadCrumb}>
<!-- ++++++++++ End BreadCrumb +++++++++++++++++++++++++++++++++++++++++++++ -->
    </div>
</div>

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
    <input type="hidden" name="created" value="<{$item.created}>" />
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center">Order</td>
            <td id="headb" align="left">Title</td>
            <td id="headb" align="center" nowrap>Created Date<br/>(yyyy-mm-dd)</td>
            <td id="headb" align="center" nowrap>Created Time<br/>(hh:mm:ss)</td>
            <td id="headb" align="center">Publish Page</td>
        </tr>
        <tr>
            <td id="body2" align="center">
                <input class="field_smal" name="order" type="text" id="order" value="<{$item.order}>" size="4" />
            </td>
            <td id="body2">
                <input class="field" name="title" id="title" size="75" type="text" value="<{$item.title}>" />
            </td>
            <td id="body2" align="center">
                <input class="field" name="createdDate" id="createdDate" size="8" type="text" value="<{$item.createdDate}>" />
                <a href="javascript:void(0);" onclick="clearInput('createdDate')" title="Очистить">
                    <img src="<{$arrPageData.system_images}>delete_pas.gif" onmouseover="this.src='<{$arrPageData.system_images}>delete_act.gif'" onmouseout="this.src='<{$arrPageData.system_images}>delete_pas.gif'" alt="Очистить" align="right" style="margin:0 3px;" />
                </a>
            </td>
            <td id="body2" align="center">
                <input class="field" name="createdTime" id="createdTime" size="5" type="text" value="<{$item.createdTime}>" />
            </td>
            <td id="body2" align="center">
                <select name="active">
                    <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                    <option value="0"<{if $item.active==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                </select>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
<{if !empty($categoryTree)}>
            <td id="headb" align="center">Category</td>
<{/if}>
            <td id="headb" align="center">Product Code</td>
            <td id="headb" align="center">Price</td>
        </tr>
        <tr>
<{if !empty($categoryTree)}>
            <td id="body2" align="center">
                <select name="cid"<{if !empty($item.cid) OR !empty($arrPageData.cid)}> onchange="hideApplyBut(this, this.form.submit_apply, <{if !empty($item.cid)}><{$item.cid}><{else}><{$arrPageData.cid}><{/if}>);"<{/if}>>
<{section name=i loop=$categoryTree}>
                    <option value="<{$categoryTree[i].id}>"<{if $item.cid==$categoryTree[i].id OR (empty($item.cid) && $arrPageData.cid==$categoryTree[i].id)}>  selected<{/if}>><{$categoryTree[i].margin}><{$categoryTree[i].title}> &nbsp; [items: <{if isset($arCidCntItems[$categoryTree[i].id])}><{$arCidCntItems[$categoryTree[i].id]}><{else}>0<{/if}>] &nbsp; <{if $categoryTree[i].active==0}>( неактивен ) &nbsp; <{/if}></option>
<{if !empty($categoryTree[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/tree_childrens.tpl' dependID=$item.cid arrChildrens=$categoryTree[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
                </select>
            </td>
<{elseif $arrPageData.cid OR $item.cid}>
    <input type="hidden" name="cid" value="<{if $item.cid}><{$item.cid}><{else}><{$arrPageData.cid}><{/if}>" />
<{/if}>
            <td id="body2" align="center">
                <input class="field" name="pcode" id="pcode" size="20" type="text" value="<{$item.pcode}>" />
            </td>
            <td id="body2" align="center">
                <input class="field" name="price" id="price" size="10" type="text" value="<{$item.price}>" />
            </td>
        </tr>
    </table>
    
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head">
                Short Description &nbsp; <a href="javascript:toggleEditor('description');">Включить/Отключить визуальный редактор</a>
            </td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'descriptionBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="descriptionBox">
            <td id="body1" colspan="2">
                <textarea id="description" name="descr" cols="87" rows="4" style="width: 100%; margin:5px 0;"><{$item.descr}></textarea>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head">
                Full Description &nbsp; <a href="javascript:toggleEditor('fulldescription');">Включить/Отключить визуальный редактор</a>
            </td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'fullDescriptionBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="fullDescriptionBox">
            <td id="body1" colspan="2">
                <textarea id="fulldescription" name="fulldescr" style="width: 100%; height: 400px"><{$item.fulldescr}></textarea>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head">Attach Page Image (width and height specified for large image)</td>
            <td id="head" align="center">Width</td>
            <td id="head" align="center">Height</td>
            <td id="head" align="center">Delete</td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'toogleImageBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="toogleImageBox">
            <td id="body2" width="85%">
                <input name="image" type="file"<{if !empty($item.image)}> onchange="if(this.value.length){ $('#image_delete').attr({checked:true, readonly:true}); this.form.image_w.value=''; this.form.image_h.value='';}"<{/if}> />
                <{if !empty($item.image)}>Файл: <a href="javascript:popUp('<{$arrPageData.files_url|cat:$item.image}>')"><{$item.image}></a><{/if}>
            </td>
            <td id="body2" align="center">
                <input class="field" name="image_w" id="image_w" type="text" value="<{if !empty($item.image)}><{$item.arImageData.w}><{else}><{$arrPageData.def_img_param.w}><{/if}>" size="2" />
            </td>
            <td id="body2" align="center">
                <input class="field" name="image_h" id="image_h" type="text" value="<{if !empty($item.image)}><{$item.arImageData.h}><{else}><{$arrPageData.def_img_param.h}><{/if}>" size="2" />
            </td>
            <td id="body2" align="center">
                <input id="image_delete" name="image_delete" type="checkbox" value="1"<{if empty($item.image)}> disabled<{/if}> onclick="if($(this).attr('readonly')){return false;}" />
            </td>
            <td id="body2" align="center">&nbsp;</td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head">Attach Page File</td>
            <td id="head" align="center">Delete</td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'toogleFileBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="toogleFileBox">
            <td id="body2" width="95%">
                <input name="filename" type="file"<{if !empty($item.filename)}> onchange="if(this.value.length){ $('#filename_delete').attr({checked:'true', readonly:'true'});};"<{/if}> />
                <{if !empty($item.filename)}>Файл: <a href="<{$arrPageData.files_url|cat:$item.filename}>" target="_blank"><{$item.filename}></a><{/if}>
            </td>
            <td id="body2" align="center">
                <input id="filename_delete" name="filename_delete" type="checkbox" value="1"<{if empty($item.filename)}> disabled<{/if}> onclick="if($(this).attr('readonly')){return false;}" />
            </td>
            <td id="body2" align="center">&nbsp;</td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list" id="metaBox">
        <tr>
            <td id="head" width="100px;">Meta Name</td>
            <td id="head">Meta Content</td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleByClass(this, 'metaBox', 'toogleLine');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr class="toogleLine">
            <td id="body2">Keywords</td>
            <td id="body2" colspan="2"><input type="text" class="field_big" name="meta_key" id="meta_key" value="<{$item.meta_key}>" /></td>
        </tr>
        <tr class="toogleLine">
            <td id="body1">Description</td>
            <td id="body1" colspan="2"><input type="text" class="field_big" name="meta_descr" id="meta_descr" value="<{$item.meta_descr}>" /></td>
        </tr>
        <tr class="toogleLine">
            <td id="body2">Robots</td>
            <td id="body2" colspan="2">
                <select name="meta_robots">
                    <option value=""> &nbsp; Not select &nbsp; </option>
<{section name=i loop=$arrPageData.robots}>
                    <option value="<{$arrPageData.robots[i]}>"<{if $item.meta_robots==$arrPageData.robots[i]}>  selected<{/if}>> &nbsp; <{$arrPageData.robots[i]}> &nbsp; </option>
<{/section}>
                </select>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list" id="seoBox">
        <tr>
            <td id="head" width="100px;">SEO Name</td>
            <td id="head">SEO Content</td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleByClass(this, 'seoBox', 'toogleLine');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr class="toogleLine">
            <td id="body2">SEO Title</td>
            <td id="body2" colspan="2"><input type="text" class="field_big" name="seo_title" id="seo_title" value="<{$item.seo_title}>" /></td>
        </tr>
        <tr class="toogleLine">
            <td id="body2">SEO Path</td>
            <td id="body2" colspan="2">
                <input type="text" class="field" name="seo_path" id="seo_path" size="105" value="<{$item.seo_path}>" />&nbsp;&nbsp;
                <input type="button" value="Генерировать" onclick="if(this.form.title.value.length==0){ alert('Вы не ввели названия страницы!'); this.form.title.focus(); return false; }else{ generateSeoPath(this.form.seo_path, this.form.title.value, '<{$arrPageData.module}>'); }" class="buttons" style="cursor:pointer;" />
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0"><tr><td id="line">&nbsp;</td></tr></table>

    <div align="center">
        <input class="buttons" name="submit" onclick="if(this.form.title.value.length==0) {alert('Вы не ввели названия страницы!'); return false;}" type="submit" value="Сохранить" />
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_apply" onclick="if(this.form.title.value.length==0) {alert('Вы не ввели названия страницы!'); return false;}" type="submit" value="Применить" />
<{if $arrPageData.task=='addItem'}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_add" onclick="if(this.form.title.value.length==0) {alert('Вы не ввели названия страницы!'); return false;}" type="submit" value="Сохранить и Добавить новый" />
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_clear" type="reset" onclick="if(window.confirm('Хотите очистить?')) {this.reset()}; return false" value="Очистить" />
<{/if}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_cancel" type="submit" onclick="if(window.confirm('Не хотите сохранять изменения?')) {window.location='<{$arrPageData.current_url|cat:$arrPageData.filter_url}>'}; return false;" value="Отмена" />
<{if $arrPageData.task=='editItem' && $item.id>0}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_delete" type="submit" onclick="if(window.confirm('Вы уверены? Страница удалится сразу со всех языков!')) {window.location='<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false" value="Удалить" />
<{/if}>
    </div>

</form>

<{* +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ *}>
<{else}>
<div style="height:7px;">&nbsp;</div>
<{if !empty($categoryTree)}>
<form action="" method="get" name="filterForm">
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
<div style="height:7px;">&nbsp;</div>
<{/if}>
<form method="post" action="<{$arrPageData.current_url|cat:"&task=reorderItems"}>" name="reorderItems">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center" width="12"><{$smarty.const.HEAD_ID}></td>
            <td id="headb" align="left"><{$smarty.const.HEAD_NAME}></td>
            <td id="headb" align="left" width="55"><{$smarty.const.HEAD_CODE}></td>
            <td id="headb" align="center" width="30"><{$smarty.const.HEAD_SORT}></td>
<{if !$arrPageData.cid}>
            <td id="headb" align="center" width="50"><{$smarty.const.HEAD_CATEGORY}></td>
<{/if}>
            <td id="headb" align="center" width="32"><{$smarty.const.HEAD_PRICE}></td>
            <td id="headb" align="center" width="95"><{$smarty.const.HEAD_DATE_ADDED}></td>
            <td id="headb" align="center" width="15"><{$smarty.const.HEAD_POPULAR}></td>
            <td id="headb" align="center" width="15"><{$smarty.const.HEAD_NEWEST}></td>
            <td id="headb" align="center" width="25"><{$smarty.const.HEAD_PUBLICATION}></td>
            <td id="headb" align="center" width="22"><{$smarty.const.HEAD_EDIT}></td>
            <td id="headb" align="center" width="35"><{$smarty.const.HEAD_DELETE}></td>
        </tr>
<{section name=i loop=$items}>
         <tr>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].id}></td>
            <td id="<{$items[i].idb}>"><{$items[i].title}></td>
            <td id="<{$items[i].idb}>"><{$items[i].pcode}></td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="hidden" name="arItems[<{$items[i].id}>]" value="1" />
                <input type="text" name="arOrder[<{$items[i].id}>]" id="arOrder_<{$items[i].id}>" class="field_smal" value="<{$items[i].order}>" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
            </td>
<{if !$arrPageData.cid}>
            <td id="<{$items[i].idb}>"><{$items[i].cat_title}></td>
<{/if}>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].price|number_format:2}></td>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].created|date_format:"%d.%m.%y %H:%M:%S"}></td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="checkbox" name="arPopular[<{$items[i].id}>]" id="arPopular_<{$items[i].id}>" class="field_smal" value="1"<{if $items[i].ispopular}> checked<{/if}> />
            </td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="checkbox" name="arNewest[<{$items[i].id}>]" id="arNewest_<{$items[i].id}>" class="field_smal" value="1"<{if $items[i].isnewest}> checked<{/if}> />
            </td>
            <td id="<{$items[i].idb}>" align="center">
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
            <td id="<{$items[i].idb}>" align="center" >
                <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=editItem&itemID="|cat:$items[i].id}>" title="Edit">
                    <img src="<{$arrPageData.system_images}>edit.gif" alt="Edit" />
                </a>
            </td>
            <td id="<{$items[i].idb}>" align="center">
                <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$items[i].id}>" onclick="return confirm('Вы уверены? Страница удалится сразу со всех языков!');" title="Delete!">
                   <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" title="Delete!" />
                </a>
            </td>
        </tr>
<{/section}>
<{if $items|@count>1}>
        <tr>
            <td id="body1" colspan="12" style="border:0;" align="center">
                <input name="submit_order" class="buttons" type="submit" value="<{$smarty.const.BUTTON_SAVE}>" />
            </td>
        </tr>
<{/if}>
        <tr>
            <td colspan="12" id="line"><{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}></td>
        </tr>

<{if $arrPageData.total_pages>1}>
        <tr>
            <td colspan="12" id = "line">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=1 showPrevNext=1}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </td>
        </tr>
<{/if}>

    </table>
</form>
<{/if}>
