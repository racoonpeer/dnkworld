<div id="sectionTitle"><{$smarty.const.CURRENCY}></div>
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
        <{$smarty.const.ADMIN_PATH}> <{$arrPageData.path_arrow}> <a href="<{$arrPageData.admin_url}>" title=""><{$smarty.const.CURRENCY}></a>
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
            <td id="headb" align="center"><{$smarty.const.SORT_BY}></td>
            <td id="headb" align="left"><{$smarty.const.HEAD_NAME}><br/>(Доллар)</td>
            <td id="headb" align="left"><{$smarty.const.HEAD_TITLE}><br/>(Американский доллар)</td>
            <td id="headb" align="center" nowrap>Created Date<br/>(yyyy-mm-dd)</td>
            <td id="headb" align="center" nowrap>Created Time<br/>(hh:mm:ss)</td>
            <td id="headb" align="center"><{$smarty.const.HEAD_PUBLICATION}></td>
        </tr>
        <tr>
            <td id="body2" align="center">
                <input class="field_smal requirefield" name="order" type="text" id="order" value="<{$item.order}>" size="4"<{if $arrPageData.task=='editItem' || !$objCurrency->count}> disabled<{/if}> style="padding-left:0px;text-align:center;" />
            </td>
            <td id="body2">
                <input class="field requirefield" name="name" id="title" size="35" type="text" value="<{$item.name}>" />
            </td>
            <td id="body2">
                <input class="field requirefield" name="title" id="title" size="35" type="text" value="<{$item.title}>" />
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
                <select name="active" onchange="if(this.value==0) setUnDefault();"<{if $arrPageData.task=='editItem' || !$objCurrency->count}> disabled<{/if}>>
                    <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                    <option value="0"<{if $item.active==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                </select>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center" width="100"><{$smarty.const.HEAD_CURRENCY_CODE}><br/>(USD)</td>
            <td id="headb" align="center" width="100"><{$smarty.const.HEAD_SIGN}><br/>($)</td>
            <td id="headb" align="center" width="100"><{$smarty.const.HEAD_NOMINAL}><br/>(1)</td>
            <td id="headb" align="center" width="162"><{$smarty.const.HEAD_RATE}>/<{$smarty.const.HEAD_COEFFICIENT}><br/>(1.0000)</td>
            <td id="headb" align="center" width="135"><{$smarty.const.HEAD_DEFAULT_4_CALC}></td>
            <td id="headb" align="center" width="135"><{$smarty.const.HEAD_DEFAULT_4_SHOW}></td>
        </tr>
        <tr>
            <td id="body2" align="center">
                <input class="field requirefield" name="code" id="code" size="5" type="text" value="<{$item.code}>" onchange="addTemplate(this, this.form);" />
            </td>
            <td id="body2" align="center">
                <input class="field requirefield" name="sign" id="sign" size="5" type="text" value="<{$item.sign}>" onchange="addTemplate(this, this.form);" />
            </td>
            <td id="body2" align="center">
                <input class="field requirefield" name="nominal" id="nominal" size="5" type="text" value="<{$item.nominal}>"<{if $arrPageData.task=='editItem' || !$objCurrency->count}> disabled<{/if}> />
            </td>
            <td id="body2" align="center">
                <input class="field requirefield" name="rate" id="rate" size="5" type="text" value="<{$item.rate}>" onchange="setDefault(this, this.form);"<{if $arrPageData.task=='editItem' || !$objCurrency->count}> disabled<{/if}> />
            </td>
            <td id="body2" align="center">
                <select name="def4calc" id="def4calc" onfocus="if(this.value==0 && !isDefined(1)){ alert('Нелзья изменять, валюта <{$smarty.const.HEAD_DEFAULT}> уже определена!'); return false; }"<{if $arrPageData.task=='editItem' || !$objCurrency->count}> disabled<{/if}>>
                    <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                    <option value="0"<{if !$item.def4calc}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                </select>
            </td>
            <td id="body2" align="center">
                <select name="def4show" id="def4show" onfocus="if(this.value==0 && !isDefined(2)){ alert('Нелзья изменять, валюта <{$smarty.const.HEAD_DEFAULT}> уже определена!'); return false; }"<{if $arrPageData.task=='editItem' || !$objCurrency->count}> disabled<{/if}>>
                    <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                    <option value="0"<{if !$item.def4show}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                </select>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr><td id="head">Данные для отображения:</td></tr>
    </table>
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center" width="35"><{$smarty.const.HEAD_DECIMALS}> (2)</td>
            <td id="headb" align="center" width="35"><{$smarty.const.HEAD_DECIMALS_POINT}> (,)</td>
            <td id="headb" align="center" width="250"><{$smarty.const.HEAD_THOUSAND_SEPARATOR}> (.)</td>
            <td id="headb" align="center" width="200"><{$smarty.const.HEAD_TEMPLATE}><br/>($1.100,00)</td>
            <td id="headb" align="center" width="100"><{$smarty.const.HEAD_EXAMPLE}></td>
        </tr>
        <tr>
            <td id="body2" align="center">
                <input class="field requirefield" name="decimals" id="decimals" size="5" type="text" value="<{$item.decimals}>" onchange="createTemplate(this.form);" style="padding-left:0px;text-align:center;" />
            </td>
            <td id="body2" align="center">
                <select name="dec_point" id="dec_point" onchange="createTemplate(this.form);">
<{foreach name=i from=$item.arDecPoints key=sValue item=sTitle}>
                    <option value="<{$sValue}>"<{if $item.dec_point==$sValue}>  selected<{/if}>> &nbsp; <{$sTitle}> &nbsp; </option>
<{/foreach}>
                </select>
            </td>
            <td id="body2" align="center" nowrap>
                <select name="thousands_separates" onchange="correctThousandsSeparator(this.form); createTemplate(this.form);">
<{foreach name=i from=$item.arSepVariants key=sValue item=sTitle}>
                    <option value="<{$sValue|escape}>"<{if $item.thousands_sep==$sValue || (isset($item.thousands_separates) && $item.thousands_separates==$sValue)}>  selected<{/if}>> &nbsp; <{$sTitle}> &nbsp; </option>
<{/foreach}>
                </select>&nbsp;
                <input class="field" name="thousands_sep" id="thousands_sep" size="5" type="text" value="<{$item.thousands_sep|escape}>" onchange="correctThousandsSeparator(this.form); createTemplate(this.form);"<{if in_array($item.thousands_sep, $item.arSepVariants|@array_keys) || (isset($item.thousands_separates) && $item.thousands_sep!='#')}> readonly<{/if}> />
                <input name="unbreakspace" id="unbreakspace" type="hidden" value="<{$item.unbreakspace}>" />
            </td>
            <td id="body2" align="center" nowrap>
                <select name="templates" id="templates" onchange="fillTemplateData(this, this.form);">
<{foreach name=i from=$item.arrTemplates key=sValue item=sTitle}>
                    <option value="<{$sValue}>"<{if $item.template==$sValue || (isset($item.templates) && $item.templates==$sValue)}>  selected<{/if}>> &nbsp; <{$sTitle}> &nbsp; </option>
<{/foreach}>
                </select>&nbsp;
                <input class="field requirefield" name="template" id="template" size="5" type="text" value="<{$item.template}>" onchange="createTemplate(this.form);"<{if in_array($item.template, $item.arrTemplates|@array_keys) || (isset($item.templates) && $item.templates!='#')}> readonly<{/if}> />
            </td>
            <td id="body2" align="center">
                <div id="tpl_example" style="font-weight:bold;"><{if !empty($item.tpl_example)}><{$item.tpl_example}><{/if}></div>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="1" cellpadding="0"><tr><td id="line">&nbsp;</td></tr></table>

    <div align="center">
        <input class="buttons" name="submit" type="submit" value="Сохранить" />
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_apply" type="submit" value="Применить" />
<{if $arrPageData.task=='addItem'}>
        &nbsp;|&nbsp;
        <input class="buttons" name="submit_add" type="submit" value="Сохранить и Добавить новый" />
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
    <br/>
</form>
<script type="text/javascript">
<!--
    var signTpl = "#";
    createTemplate(document.<{$arrPageData.task}>Form);

    function randomNumber(ln) {
        var num = parseInt(Math.random()*Math.pow(10, ln));
        while(!num || num.toString().length!=ln) num = randomNumber(ln);
        return num;
    }

    function setDefault(bt, form){
        var canDef = isDefined(1);
        $("select#def4calc [value='0']").attr("selected", "selected");
        if(canDef && parseFloat(bt.value)==1 && form.active.value==1){
            $("select#def4calc [value='1']").attr("selected", "selected");
        } else if(!canDef && parseFloat(bt.value)==1){
            bt.value = '';
        }
    }

    function setUnDefault(){
        $("select#def4calc [value='0']").attr("selected", "selected");
        $("select#def4show [value='0']").attr("selected", "selected");
    }

    function isDefined(type){
        return type==1 ? <{if !$objCurrency->def4calc}>1<{else}>0<{/if}> : <{if !$objCurrency->def4show}>1<{else}>0<{/if}>;
    }

    function formCheck(form){
        var errors      = 0;
        $.each($(form).find('.requirefield'), function(i, input) {
            if ( input.value.length==0 ){
                    if(!errors) $(this).focus();
                    $(this).addClass('required');
                    errors++;
            } else $(this).removeClass('required');
        });
        if(!errors) return true;
        else alert("<{$smarty.const.FEEDBACK_ALERT_ERROR}>");
        return false;
    }

    function createNumber(form){
        var decimals = parseInt(form.decimals.value);
        var number   = randomNumber(1)+form.thousands_sep.value+randomNumber(3);
        if(decimals) number += form.dec_point.value+randomNumber(decimals);
        return number;
    }

    function createTemplate(form){
        var number  = createNumber(form);
        
        var tpl = form.template.value;
        if($(form.template).attr('readonly') && !tpl.length)
            tpl = signTpl+' '+(form.sign.value.length ? form.sign.value : form.code.value);

        if(tpl.indexOf(signTpl)>=0) tpl = tpl.replace(signTpl, number);
        else tpl = number+tpl;
        
        $('#tpl_example').html(tpl);
    }

    function fillTemplateData(sel, form){
        var inp     = form.template;
        if(sel.value==signTpl) $(inp).removeAttr('readonly').addClass('focusField').focus();
        else {
            $(form.template).attr('readonly', 'readonly').removeClass('focusField');
            inp.value=sel.value;
        }
        if(!inp.value.length) inp.value=signTpl;
        createTemplate(form);
    }

    function correctThousandsSeparator(form){
        var strSel  = decodeURIComponent(form.thousands_separates.value);
        var strInp  = decodeURIComponent(form.thousands_sep.value);

        if(strSel==signTpl) $(form.thousands_sep).removeAttr('readonly').addClass('focusField').focus();
        else {
            $(form.thousands_sep).attr('readonly', 'readonly').removeClass('focusField');
            form.thousands_sep.value=form.thousands_separates.value;
        }

        if(strSel=='&nbsp;' || (strSel==signTpl && strInp.indexOf('&nbsp;')>=0)){
               form.thousands_sep.value='&nbsp;';
               form.unbreakspace.value=1;
        } else form.unbreakspace.value=0;
    }

    function checkTemplateInSelect(str){
        var bPresent = false;
        $('select#templates option').each(function(){
            if(decodeURIComponent(this.value)==str) bPresent = true;
        });
        return bPresent;
    }

    function addTemplateToSelect(tpl){
        if(!checkTemplateInSelect(tpl)) 
            $('select#templates').prepend( $('<option value="'+tpl+'">'+tpl.replace(signTpl, "1.234,50")+'</option>'));
    }

    function addTemplate(inp, form){
        if(inp.value.length){
            addTemplateToSelect(inp.value+signTpl);
            addTemplateToSelect(inp.value+' '+signTpl);
            addTemplateToSelect(signTpl+inp.value);
            addTemplateToSelect(signTpl+' '+inp.value);
            $('select#templates :first').attr('selected', 'selected');
            form.template.value = $('select#templates :selected').val();
            createTemplate(form);
        }
    }

    $(document).ready(function() {
        $('#createdDate').datepicker({dateFormat:'yy-mm-dd'});
        //$('#createdDate').datepicker('setDate', 'Now');   // http://www.linkexchanger.su/2009/103.html
    });
//-->
</script>

<{* +++++++++++++++++++++++++ SHOW ALL ITEMS ++++++++++++++++++++++++++ *}>
<{else}>
<div style="height:7px;">&nbsp;</div>
<form method="post" action="<{$arrPageData.current_url|cat:"&task=reorderItems"}>" name="reorderItems" onsubmit="return formCheck(this);">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
        <tr>
            <td id="headb" align="center" width="12"><{$smarty.const.HEAD_ID}></td>
            <td id="headb" align="left"><{$smarty.const.HEAD_NAME}></td>
            <td id="headb" align="center" width="35"><{$smarty.const.HEAD_CURRENCY_CODE}></td>
            <td id="headb" align="center" width="30"><{$smarty.const.HEAD_SORT}></td>
            <td id="headb" align="center" width="40"><{$smarty.const.HEAD_NOMINAL}></td>
            <td id="headb" align="center" width="60"><{$smarty.const.HEAD_RATE}> / <{$smarty.const.HEAD_COEFFICIENT}></td>
            <td id="headb" align="center" width="70"><{$smarty.const.HEAD_DEFAULT}></td>
            <td id="headb" align="center" width="25"><{$smarty.const.HEAD_PUBLICATION}></td>
            <td id="headb" align="center" width="57"><{$smarty.const.HEAD_CREATED}></td>
            <td id="headb" align="center" width="22"><{$smarty.const.HEAD_EDIT}></td>
            <td id="headb" align="center" width="35"><{$smarty.const.HEAD_DELETE}></td>
        </tr>
<{section name=i loop=$items}>
         <tr>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].id}></td>
            <td id="<{$items[i].idb}>"><{$items[i].name}></td>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].code}></td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="text" name="arItems[<{$items[i].id}>][order]" id="order_<{$items[i].id}>" class="field_smal" value="<{$items[i].order}>" style="width:27px;padding-left:0px;text-align:center;" maxlength="4" />
            </td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="text" name="arItems[<{$items[i].id}>][nominal]" id="nominal_<{$items[i].id}>" class="field" value="<{$items[i].nominal}>" style="width:30px;" />
            </td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="hidden" name="oldrate_<{$items[i].id}>" id="oldrate_<{$items[i].id}>" value="<{$items[i].rate}>" />
                <input type="text" name="arItems[<{$items[i].id}>][rate]" id="rate_<{$items[i].id}>" class="field rates" value="<{$items[i].rate}>" onchange="setDefCalc(this.form, this, <{$items[i].id}>);" style="width:50px;" />
            </td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="radio" name="def4calc" id="def4calc_<{$items[i].id}>" value="<{$items[i].id}>" onfocus="return checkActive(<{$items[i].id}>);"<{if $items[i].def4calc}> checked<{/if}> style="display:none;" />
                <input type="radio" name="def4show" id="def4show_<{$items[i].id}>" value="<{$items[i].id}>" onfocus="return checkActive(<{$items[i].id}>);"<{if $items[i].def4show}> checked<{/if}> />
            </td>
            <td id="<{$items[i].idb}>" align="center">
                <input type="checkbox" name="arItems[<{$items[i].id}>][active]" id="active_<{$items[i].id}>" class="activs" value="<{$items[i].active}>" onchange="setActive(this, <{$items[i].id}>);"<{if $items[i].active}> checked<{/if}> />
            </td>
            <td id="<{$items[i].idb}>" align="center"><{$items[i].created|date_format:"%d.%m.%y"}></td>
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
        <tr>
            <td id="body1" align="center">
                <input name="submit" class="buttons" type="submit" value="<{$smarty.const.BUTTON_SAVE}>" />
            </td>
        </tr>
        <tr>
            <td id="line"><{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}></td>
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
<script type="text/javascript">
<!--
    var bSubmit   = true;
    var oldActive = null;
    function setDefCalc(form, bt, val){
        var bGo    = true;
        var newVal = parseFloat($('#rate_'+val).val());
        $.each($(form).find('input.rates[type=text]'), function(i, input) {
            if( $(this).attr('id')!='rate_'+val && newVal==1 && parseFloat(input.value)==1){
                $('#rate_'+val).val($('#oldrate_'+val).val());
                alert('Только одна валюта может иметь значение равное 1');
                bGo = false;
            }
        });
        if(bGo && parseFloat(bt.value)==1){
            for(var i=0; i<form.def4calc.length; i++) {
                form.def4calc[i].checked = false;
                if(form.def4calc[i].value==val) form.def4calc[i].checked = true;
            } bGo = false;
        } bSubmit = bGo;
    }
    function checkActive(val){
        if(!$('#active_'+val).attr('checked')){
            alert('Данная валюта отключена, поэтому ее нельзя выбрать "По умолчанию"!');
            return false;
        } return true;
    }
    function setActive(bt, val){
        var bGo = true;
        if(!bt.checked && ($('#def4calc_'+val).attr('checked') || $('#def4show_'+val).attr('checked')) ){
            alert('Данная валюта выбрана "По умолчанию", поэтому ее нельзя отключить!');
            bt.checked = true;
            bGo = false;
        } bSubmit = bGo;
    }
    function formCheck(form){
        if(bSubmit) {
            var iCount  = 0;
            var sErrors = '';
            $.each($(form).find('input.rates[type=text]'), function(i, input) {
                if(parseFloat(input.value)==1) iCount++;
            });
            if(iCount>1)     sErrors += 'Только одна валюта может иметь курс равный 1';
            else if(!iCount) sErrors += 'Должна присутствовать хотя бы одна валюта с курсом 1';

            for(i=0, iCount = 0; i<form.def4calc.length; i++)
                if(form.def4calc[i].checked) iCount++;
            if(iCount!=1) sErrors += 'Нужно выбрать одну валютус курсом 1 по умолчанию для пересчетов';

            for(i=0, iCount = 0; i<form.def4show.length; i++)
                if(form.def4calc[i].checked) iCount++;
            if(iCount!=1) sErrors += 'Нужно выбрать одну валюту по умолчанию для отображения на сайте';

            var activs = $(form).find('input.activs[type=checkbox]');
            if(!activs.length) sErrors += 'Необходимо опубликовать хотябы одну валюту!';
            iCount = 0;
            $.each(activs, function(i, input) {
                var id = $(this).attr('id').replace("active_", '');
                if(!$(this).attr('checked') && ($('#def4calc_'+id).attr('checked') || $('#def4show_'+id).attr('checked')) ) iCount++;
            });
            if(iCount) sErrors += 'Нельзя неопубликованную валюту ставить "<{$smarty.const.HEAD_DEFAULT}>"!';

            if(bSubmit && sErrors=='') return true;
            else alert(sErrors);
        } else bSubmit = true;
        return false;
    }
//-->
</script>
<{/if}>

<div class="noticePanel">
    <span class="required">*</span> - Поля, обязательные для заполнения.<br/>
    &mdash; Должна присутствовать ТОЛЬКО одна валюта с курсом <u>1 - базовая</u>. Иммено в этой валюте будут сохраняются прайсы<br/>
    &mdash; Первая валюта будет добавлена валютой "<{$smarty.const.HEAD_DEFAULT}>" с курсом, номиналом и сортировкой равной 1<br/>
    &mdash; <{$smarty.const.HEAD_RATE}> в других валютах - это <{$smarty.const.HEAD_COEFFICIENT}> относительно основной валюты где <{$smarty.const.HEAD_RATE}> равен 1<br/>
    &mdash; Валюта выбранная "По умолчанию для отображения" будет грузится на сайте первой<br/>
    &mdash; Только после добавления второй валюты будет возможно изменять валюту "<{$smarty.const.HEAD_DEFAULT}>"<br/>
    &mdash; Номинал, курс и другие основные параметры валюты редактировать можно только в режиме вывода списка валют<br/>
<{if $arrPageData.task=='addItem' || $arrPageData.task=='editItem'}>
    &mdash; Если необходимо вывести число без "<{$smarty.const.HEAD_DECIMALS}>", выставтье его значение в 0<br/>
    &mdash; Используется только первый символ в строке "<{$smarty.const.HEAD_THOUSAND_SEPARATOR}>". Исключением является "Неразрывный пробел" - <{'&nbsp;'|escape}><br/>
    &mdash; В шаблоне символ '#' (объязателен) будет заменен на отформатированное по настройкам число при выводе (как в примере)<br/>
    &mdash; В шаблоне можно использовать различные символы и сущности<br/>
<{/if}>
</div>
