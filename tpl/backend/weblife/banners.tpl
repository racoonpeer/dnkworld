<div id="sectionTitle"><{$smarty.const.BANNERS_TITLE}></div>
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
        <{$smarty.const.ADMIN_PATH}> <{$arrPageData.path_arrow}> <a href="<{$arrPageData.admin_url}>" title=""><{$smarty.const.BANNERS_PATH_TITLE}></a>
<!-- ++++++++++ Start BreadCrumb +++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/breadcrumb.tpl' arrBreadCrumb=$arrPageData.arrBreadCrumb}>
<!-- ++++++++++ End BreadCrumb +++++++++++++++++++++++++++++++++++++++++++++ -->
    </div>
</div>

<{* +++++++++++++++++ SHOW ADD OR EDIT ITEM FORM ++++++++++++++++++++++ *}>
<{if $arrPageData.task=='addItem' || $arrPageData.task=='editItem'}>
<form method="post" action="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task="|cat:$arrPageData.task}><{if $arrPageData.itemID>0}><{''|cat:"&itemID="|cat:$arrPageData.itemID}><{/if}>" name="<{$arrPageData.task}>Form" onsubmit="return formCheck(this);" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center"><{$smarty.const.HEAD_SORT}></td>
            <td id="headb" align="left"><{$smarty.const.HEAD_NAME}></td>
            <td id="headb" align="center" nowrap><{$smarty.const.HEAD_CREATED_DATE}></td>
            <td id="headb" align="center" nowrap><{$smarty.const.HEAD_CREATED_TIME}></td>
            <td id="headb" align="center"><{$smarty.const.HEAD_PUBLICATION}></td>
        </tr>
        <tr>
            <td id="body2" align="center">
                <font style="color:red">*</font>
                <input class="field_smal" name="order" type="text" id="order" value="<{$item.order}>" size="4" />
            </td>
            <td id="body2">
                <font style="color:red">*</font><input class="field" name="title" id="title" size="75" type="text" value="<{$item.title}>" />
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
            <td id="head" colspan="2">FOR THIS PAGE If you want, you can select internal link  for redirect</td>
            <td id="head">Switch</td>
            <td id="head">OR External link  for redirect</td>
        </tr>
        <tr>
            <td id="body2" align="right">&nbsp;</td>
            <td id="body2" width="491">
                <select name="redirectid" style="width:491px; overflow:hidden;"<{if !empty($item.redirecturl)}> disabled<{/if}>>
                    <option value="">&nbsp;&nbsp;&nbsp;- - Выберите ссылку перенаправления - -&nbsp; </option>
<{section name=i loop=$categoryTree}>
                    <option value="<{$categoryTree[i].id}>"<{if $item.redirectid==$categoryTree[i].id}>  selected<{/if}><{if $categoryTree[i].id==$item.id}> disabled<{/if}>><{$categoryTree[i].margin}><{$categoryTree[i].title}> &nbsp; ( <{if $categoryTree[i].active==0}>неактивный, <{/if}><{$categoryTree[i].menutitle|lower}> ) &nbsp; </option>
<{if !empty($categoryTree[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<{include file='tree_childrens.tpl' itemID=$item.id dependID=$item.redirectid arrChildrens=$categoryTree[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
                </select>
            </td>
            <td id="body2" align="center" valign="middle">
               &lt; <input id="redirectype" name="redirectype" type="checkbox" value="1" onclick="manageSelections(this, this.form.redirectid, this.form.redirecturl);"<{if !empty($item.redirecturl)}> checked<{/if}> /> &gt;
           </td>
           <td id="body2">
               <input id="redirecturl" name="redirecturl" type="text" value="<{$item.redirecturl}>" class="field" size="37"<{if empty($item.redirecturl)}> disabled<{/if}> />
           </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head" align="left"><{$smarty.const.HEAD_POSITION}></td>
            <td id="head" align="left"><{$smarty.const.HEAD_MODULE}></td>
            <td id="head" align="left"><{$smarty.const.HEAD_TARGET}></td>
        </tr>
        <tr>
            <td id="body2" align="left">
                <font style="color:red">*</font>
                <select name="position">
<{foreach name=i from=$arrPageData.arPositions key=iKey item=iItem}>
                    <option value="<{$iKey}>"<{if $item.position==$iKey OR (empty($item.position) && $arrPageData.posid==$iKey)}>  selected<{/if}>><{$iItem}></option>
<{/foreach}>
                </select>
            </td>
            <td id="body2" align="left">
                <font style="color:red">*</font>
                <select name="module" onchange="moduleManager(this.value);">
<{foreach name=i from=$arrPageData.arModules key=iKey item=iItem}>
                    <option value="<{$iKey}>"<{if $item.module==$iKey OR (empty($item.module) && $arrPageData.modname==$iKey)}>  selected<{/if}>> &nbsp; <{$iItem}> &nbsp; </option>
<{/foreach}>
                </select>
            </td>
            <td id="body2" align="left">
                <select name="target">
<{foreach name=i from=$arrPageData.arTargets key=iKey item=iItem}>
                    <option value="<{$iKey}>"<{if $item.target==$iKey}>  selected<{/if}>> &nbsp; <{$iItem}> &nbsp; </option>
<{/foreach}>
                </select>
            </td>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head">Изображение баннера</td>
            <td id="head" width="45" align="center">Width</td>
            <td id="head" width="45" align="center">Height</td>
            <td id="head" width="37" align="center">Delete</td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'toogleImageBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="toogleImageBox">
            <td id="body2">
<{if !empty($item.image)}> 
                <input name="upimage" type="hidden" value="<{$item.image}>" />
<{/if}>
                <input name="image" type="file"<{if !empty($item.image)}> onchange="if(this.value.length){ $('#image_delete').attr({checked:true, readonly:true}); this.form.image_w.value=''; this.form.image_h.value='';}"<{/if}> />
                <{if !empty($item.image)}>Файл: <a href="javascript:popUp('<{$arrPageData.files_url|cat:$item.image}>')"><{$item.image}></a><{/if}>
            </td>
            <td id="body2" align="center">
                <input class="field" name="image_w" id="image_w" type="text" value="<{if !empty($item.image)}><{$item.arImageData.w}><{/if}>" size="2" />
            </td>
            <td id="body2" align="center">
                <input class="field" name="image_h" id="image_h" type="text" value="<{if !empty($item.image)}><{$item.arImageData.h}><{/if}>" size="2" />
            </td>
            <td id="body2" align="center">
                <input id="image_delete" name="image_delete" type="checkbox" value="1"<{if empty($item.image)}> disabled<{/if}> onclick="if($(this).attr('readonly')){return false;}" />
            </td>
            <td id="body2" align="center">&nbsp;</td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head">
                Текст баннера &nbsp; <a href="javascript:toggleEditor('ajaxfilemanager');">Включить/Отключить визуальный редактор</a>
            </td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'toogleTextBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="toogleTextBox">
            <td id="body1" colspan="2">
                <textarea id="ajaxfilemanager" name="customcode" style="width: 100%; height: 400px"><{$item.customcode}></textarea>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="head" align="left" width="420"><{$smarty.const.HEAD_MORE_OPTIONS}>: </td>
            <td id="head" align="left" width="330"><{$smarty.const.HEAD_AVAILABLE_ON_PAGES}>: </td>
            <td id="head" width="21" align="center" valign="middle">
                <a class="expand_link up" title="Свернуть/Развернуть" onclick="toggleBox(this, 'toogleParamBox');" href="javascript:void(0);"></a>
            </td>
        </tr>
        <tr id="toogleParamBox">
            <td id="body2" valign="top"><fieldset style="border: 1px solid #CDCDCD; padding:5px 0;">
                <legend style="font-weight:bold; margin-left:10px; padding-bottom:1px;"><{$smarty.const.HEAD_SIGNIFICANCE}></legend>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
                    <tr>
                        <td id="body1" align="left" width="185"><b><{$smarty.const.HEAD_WEIGHT}> (<{$smarty.const.HEAD_PRIORITY|lower}>):</b></td>
                        <td id="body1" align="left">
                            <input id="weight" name="weight" type="text" value="<{if $item.weight>0}><{$item.weight}><{/if}>" class="field" size="5" />
                            &nbsp;| <b><{$smarty.const.LABEL_EXAMPLE}>: 700</b>
                        </td>
                    </tr>
                </table></fieldset><br/><fieldset style="border: 1px solid #CDCDCD; padding:5px 0;">
                <legend style="font-weight:bold; margin-left:10px; padding-bottom:1px;"><{$smarty.const.HEAD_HITS}></legend>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
                    <tr>
                        <td id="body1" align="left" width="185"><b><{$smarty.const.HEAD_COUNT_HITS}>:</b></td>
                        <td id="body1" align="left">
                            <select name="countviews" onchange="changeParams(this, 'views');">
                                <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                                <option value="0"<{if $item.countviews==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="body2" align="left"><b><{$smarty.const.HEAD_MAX_HITS}>:</b></td>
                        <td id="body2" align="left">
                            <input id="views" name="views" type="hidden" value="<{if $item.views>0}><{$item.views}><{else}>0<{/if}>" />
                            <input id="maxviews" name="maxviews" type="text" value="<{if $item.maxviews>0}><{$item.maxviews}><{/if}>" class="field" size="5"<{if empty($item.countviews)}> readonly<{/if}> />
                            &nbsp;| <b><{$item.views}></b> <label><{$smarty.const.LABEL_RESET}>: <input id="reset_maxviews" name="reset[views]" type="checkbox" value="1"<{if empty($item.views)}> disabled<{/if}> /></label>
                        </td>
                    </tr>
                </table></fieldset><br/><fieldset style="border: 1px solid #CDCDCD; padding:5px 0;">
                <legend style="font-weight:bold; margin-left:10px; padding-bottom:1px;"><{$smarty.const.HEAD_CLICKS}></legend>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
                    <tr>
                        <td id="body1" align="left" width="185"><b><{$smarty.const.HEAD_COUNT_CLICKS}>:</b></td>
                        <td id="body1" align="left">
                            <select name="countclicks" onchange="changeParams(this, 'clicks');">
                                <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                                <option value="0"<{if $item.countclicks==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="body2" align="left"><b><{$smarty.const.HEAD_MAX_CLICKS}>:</b></td>
                        <td id="body2" align="left">
                            <input id="clicks" name="clicks" type="hidden" value="<{if $item.clicks>0}><{$item.clicks}><{else}>0<{/if}>" />
                            <input name="maxclicks" type="text" id="maxclicks" value="<{if $item.maxclicks>0}><{$item.maxclicks}><{/if}>" class="field" size="5"<{if empty($item.countclicks)}> readonly<{/if}> />
                            &nbsp;| <b><{$item.clicks}></b> <label><{$smarty.const.LABEL_RESET}>: <input id="reset_maxclicks" name="reset[clicks]" type="checkbox" value="1"<{if empty($item.views)}> disabled<{/if}> /></label>
                        </td>
                    </tr>
                </table></fieldset>
            </td>
            <td colspan="2" id="body2" style="padding-top:5px;"><fieldset style="border: 1px solid #CDCDCD;">
                <legend style="font-weight:bold; margin-left:10px; padding-bottom:1px;">
                    <label class="lbl"><input type="radio" onclick="changeDisabledSelections(true);" value="all" name="page_selector" id="page_selector_all" checked /> Все </label>&nbsp; 
                    <label class="lbl"><input type="radio" onclick="enableSelections();" value="selected" name="page_selector" id="page_selector_selected"> Выберите из списка </label>&nbsp; 
                </legend>
                <select id="selections" class="inputbox" name="cids[]" multiple="multiple" style="border-top:1px solid #DCDEDF; width:100%; height:227px; overflow:hidden;">
<{section name=i loop=$categoryTree}>
                    <option value="<{$categoryTree[i].id}>"<{if in_array($categoryTree[i].id, $item.cids)}>  selected<{/if}>><{$categoryTree[i].margin}><{$categoryTree[i].title}> &nbsp; ( <{if $categoryTree[i].active==0}>неактивный, <{/if}><{$categoryTree[i].menutitle|lower}> ) &nbsp; </option>
<{if !empty($categoryTree[i].childrens)}>
<!-- ++++++++++ Start Tree Childrens +++++++++++++++++++++++++++++++++++++++ -->
<{include file='common/tree_childrens_depends.tpl' dependIDS=$item.cids arrChildrens=$categoryTree[i].childrens}>
<!-- ++++++++++ End Tree Childrens +++++++++++++++++++++++++++++++++++++++++ -->
<{/if}>
<{/section}>
                </select>
            </fieldset></td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0"><tr><td id="line">&nbsp;</td></tr></table>

    <div align="center">
        <input class="buttons" name="submit_save" onclick="return formCheck(this.form);" type="submit" value="Сохранить" />
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_apply" onclick="return formCheck(this.form);" type="submit" value="Применить" />
<{if $arrPageData.task=='addItem'}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_add" onclick="return formCheck(this.form);" type="submit" value="Сохранить и Добавить новый" />
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_clear" type="reset" onclick="if(window.confirm('Хотите очистить?')) { return true; } else { return false; }" value="Очистить" />
<{/if}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_cancel" type="submit" onclick="if(window.confirm('Не хотите сохранять изменения?')) {window.location='<{$arrPageData.current_url|cat:$arrPageData.filter_url}>'}; return false;" value="Отмена" />
<{if $arrPageData.task=='editItem' && $item.id>0}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_delete" type="submit" onclick="if(window.confirm('Вы уверены? Страница удалится сразу со всех языков!')) {window.location='<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false" value="Удалить" />
<{/if}>
    </div>
    <br/>
    <div class="noticePanel">
        <span class="required">*</span> - Поля, обязательные для заполнения.
        <div style="text-align:left;padding-top:10px;">
            <b>Ссылки для флеш:</b><br/>
            &nbsp; а) <u>Без фиксации клика:</u> [ <{Banners::makeItemLink($item)}> ]<br/>
            &nbsp; б) <u>С фиксацией клика:</u> &nbsp;[ <{Banners::makeAccountClickURL(0, $item.id, Banners::makeItemLink($item))}> ]
        </div>
    </div>
    <script type="text/javascript">
    <!--

<{if empty($item.cids)}>
        changeDisabledSelections(true);
<{else}>
        //Установить кнопку переключатель на выбраные
        var e = document.getElementById('page_selector_selected');
        e.checked = true;
<{/if}>

        moduleManager('<{$item.module}>');

        function formCheck(form){
            if(form.title.value.length==0) {
                alert('Вы не ввели названия блока!');
                form.title.focus();
                return false;
            } else if(form.position.value.length==0) {
                form.position.focus();
                alert('Вы не выбрали позицию блока');
                return false;
            } else if(form.module.value.length==0) {
                form.module.focus();
                alert('Вы не выбрали модуль блока');
                return false;
            } else if(form.order.value.length==0) {
                form.order.focus();
                alert('Вы не ввели порядковый номер блока!');
                return false;
            }
            form.submit();
            return true;
        }
        function changeDisabledSelections(bSelect) {
            var e = document.getElementById('selections');
            var i = 0;
            var n = e.options.length;
            e.disabled = true;
            for (i = 0; i < n; i++) {
                e.options[i].disabled = true;
                e.options[i].selected = bSelect;
            }
        }
        function enableSelections() {
            var e = document.getElementById('selections');
            var i = 0;
            var n = e.options.length;
            e.disabled = false;
            for (i = 0; i < n; i++) {
                e.options[i].disabled = false;
            }
        }
        function changeParams(select, id){
            if(select.value==1){
                $('#'+'max'+id).removeAttr('readonly').focus();
                if($('#'+id).val()>0) $('#'+'reset_max'+id).removeAttr('disabled').attr('checked', 'checked');
            } else {
                $('#'+'max'+id).val('');
                $('#'+'max'+id).attr('readonly', 'readonly');
                $('#'+'reset_max'+id).removeAttr('checked');
            }
        }
        function moduleManager(module){
            switch(module){
                case 'image':
                    itemsShowHide(new Array('toogleImageBox'));
                    break;
                case 'text':
                    itemsShowHide(new Array('toogleTextBox'));
                    break;
                case 'image_text':
                    itemsShowHide(new Array('toogleImageBox', 'toogleTextBox'));
                    break;
                default:
                    itemsShowHide(new Array());
                    break;
            }
        }
        function itemsShowHide(arrDisplay) {
            var bts = new Array('toogleImageBox', 'toogleTextBox', 'toogleParamBox');
            if(bts.length > 0){
                for(var i=0; i<bts.length; i++){
                    var display = 'none';
                    if(arrDisplay instanceof Array && arrDisplay.length > 0){
                        for(var j=0; j<arrDisplay.length && display=='none'; j++){
                            if(bts[i]==arrDisplay[j]) display = '';
                        }
                    } document.getElementById(bts[i]).style.display = display;
                }
            }
        }
        $(document).ready(function() {
            $('#createdDate').datepicker({dateFormat:'yy-mm-dd'});
            //$('#createdDate').datepicker('setDate', 'Now');   // http://www.linkexchanger.su/2009/103.html
        });
    //-->
    </script>

</form>

<{* +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ *}>
<{else}>
<div style="height:7px;">&nbsp;</div>
<form action="" method="get" name="filterForm">
    <div class="filter_box">
        Фильтр: &nbsp;
        <input type="hidden" name="module" value="<{$arrPageData.module}>" />
        <select name="posid" onchange="this.form.submit()">
<{foreach name=i from=$arrPageData.arPositions key=iKey item=iItem}>
            <option value="<{$iKey}>"<{if $arrPageData.posid==$iKey}>  selected<{/if}>><{$iItem}></option>
<{/foreach}>
        </select>
        &nbsp;&nbsp;&nbsp;
        <select name="modname" onchange="this.form.submit()">
<{foreach name=i from=$arrPageData.arModules key=iKey item=iItem}>
            <option value="<{$iKey}>"<{if $arrPageData.modname==$iKey}>  selected<{/if}>> &nbsp; <{$iItem}> &nbsp; </option>
<{/foreach}>
        </select>
    </div>
</form>
<div style="height:7px;">&nbsp;</div>
<form method="post" action="<{$arrPageData.current_url|cat:"&task=reorderItems"}>" name="reorderItems">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center" width="12"><{$smarty.const.HEAD_ID}></td>
            <td id="headb" align="left"><{$smarty.const.HEAD_NAME}></td>
            <td id="headb" align="left" width="50"><{$smarty.const.HEAD_CATEGORY}></td>
            <td id="headb" align="center" width="40"><{$smarty.const.HEAD_POSITION}></td>
            <td id="headb" align="center" width="40"><{$smarty.const.HEAD_MODULE}></td>
            <td id="headb" align="center" width="30"><{$smarty.const.HEAD_HITS}></td>
            <td id="headb" align="center" width="30"><{$smarty.const.HEAD_CLICKS}></td>
            <td id="headb" align="center" width="30"><{$smarty.const.HEAD_SORT}></td>
            <td id="headb" align="center" width="95"><{$smarty.const.HEAD_DATE_ADDED}></td>
            <td id="headb" align="center" width="25"><{$smarty.const.HEAD_PUBLICATION}></td>
            <td id="headb" align="center" width="22"><{$smarty.const.HEAD_EDIT}></td>
            <td id="headb" align="center" width="35"><{$smarty.const.HEAD_DELETE}></td>
        </tr>
<{section name=i loop=$items}>
         <tr>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].id}></td>
            <td id="<{$items[i].idb}>"><{$items[i].title}></td>
            <td id="<{$items[i].idb}>"><{$items[i].cids}></td>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].ptitle}></td>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].mtitle}></td>
            <td id="<{$items[i].idb}>" align="center"><{if $items[i].countviews}><{$items[i].views}><{else}>-<{/if}></td>
            <td id="<{$items[i].idb}>" align="center"><{if $items[i].countclicks}><{$items[i].clicks}><{else}>-<{/if}></td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="hidden" name="arItems[<{$items[i].id}>]" value="1" />
                <input type="text" name="arOrder[<{$items[i].id}>]" id="arOrder_<{$items[i].id}>" class="field_smal" value="<{$items[i].order}>" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
            </td>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].created|date_format:"%d.%m.%y %H:%M:%S"}></td>
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
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
<{if $items|@count>1}>
        <tr>
            <td id="body1" style="border:0;" align="center">
                <input name="submit_order" class="buttons" type="submit" value="<{$smarty.const.BUTTON_SAVE}>" />
            </td>
        </tr>
<{/if}>
        <tr>
            <td id="line"><{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}></td>
        </tr>

<{if $arrPageData.total_pages>1}>
        <tr>
            <td id = "line">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=1 showPrevNext=1}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </td>
        </tr>
<{/if}>
    </table>

</form>
<{/if}>
