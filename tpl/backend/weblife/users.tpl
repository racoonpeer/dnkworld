<div id="sectionTitle"><{$smarty.const.USERS_TITLE}></div>
<div id="messages" class="<{if !empty($arrPageData.errors)}>error<{elseif !empty($arrPageData.messages)}>info<{else}>hidden_block<{/if}>">
<{if !empty($arrPageData.errors)}>
    <{$arrPageData.errors|@implode:'<br/>'}>
<{elseif !empty($arrPageData.messages)}>
    <{$arrPageData.messages|@implode:'<br/>'}>
<{/if}>
</div>
<div id="mod_panel">
    <{$arrPageData.path_arrow}><a href="<{$arrPageData.current_url|cat:"&task=addItem"}>">Создать пользователя</a>
    <div>
        <{$smarty.const.ADMIN_PATH}> <{$arrPageData.path_arrow}> <a href="<{$arrPageData.admin_url}>" title=""><{$smarty.const.USERS_TITLE}></a>
        <{if $arrPageData.task=='addItem'}> <{$arrPageData.path_arrow}> Добавление нового пользователя
        <{elseif $arrPageData.task=='editItem'}> <{$arrPageData.path_arrow}> Редактирование текущего пользователя<{/if}>
    </div>
</div>

<{if $arrPageData.task=='addItem' || $arrPageData.task=='editItem'}>
<script type="text/javascript">
<!--
    function formCheck(form){
        var regExpEmail = new RegExp("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$");
        var regExpPhone = new RegExp("^([0-9 \-]{7,17})$");
        var errors      = 0;

        $.each($(form).find('.requirefield'), function(i, input) {
            if ( input.value.length==0 // type=='text', type=='select-one', type=='textarea'
             || (input.name=='email' && input.value.match(regExpEmail) == null) // type=='text', name=='email'
             || (input.name=='phone' && input.value.match(regExpPhone) == null) // type=='text', name=='phone'
                ){
                    if(!errors) $(this).focus();
                    $(this).addClass('required');
                    errors++;
            } else $(this).removeClass('required');
        });

        if(!errors){
            form.submit();
            return true;
        } else alert("Заполните все обязательные поля!");
        return false;
    }
    function applyPassword(form){
        if(confirm('Вы скопировали пароль и Вы действительно хотите изменить его?')){
            if(form.autogenpass.value.length==0){
                alert('Сначала необходимо сгенерировать новый пароль и скопировать его в буфер обмена!');
            } else {
                form.pass.value = form.confpass.value = form.autogenpass.value;
<{if $arrPageData.task=='editItem'}>
                form.submit_apply.click();
<{/if}>
                return true;
            }
        } return false;
    }
    function generatePassword(form){
        $.getJSON(
            "/interactive/ajax.php",
            {zone: "admin", action: "generatePassword", length:12},
            function(data){
                if(data.code) {
                    form.autogenpass.value = data.code;
                } else alert("Произошла ошибка при генерации Пароля!");
            }
        );
    }
//-->
</script>
<form method="post" action="<{$arrPageData.current_url|cat:"&task="|cat:$arrPageData.task}><{if $arrPageData.itemID>0}><{''|cat:"&itemID="|cat:$arrPageData.itemID}><{/if}>" name="<{$arrPageData.task}>Form" onsubmit="return formCheck(this);" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list" align="center">
        <tr>
            <td id="head" colspan="2">
                <{if $arrPageData.task=='addItem'}>Добавление нового пользователя
                <{elseif $arrPageData.task=='editItem'}>Редактирование текущего пользователя<{/if}>
            </td>
        </tr>
        <tr>
            <td id="body2" width="250" align="center" valign="top">
                <div style="margin:10px 5px;border:1px solid #999999;background-color:#E5E5E5;width:<{if !empty($item.image)}><{$item.arImageData.w}><{else}><{$arrPageData.def_img_param.w}><{/if}>px;height:<{if !empty($item.image)}><{$item.arImageData.h}><{else}><{$arrPageData.def_img_param.h}><{/if}>px;">
                    <{if !empty($item.image)}><img src="<{$arrPageData.files_url|cat:$item.image}>" border="0" alt="" /><{/if}>
                </div>
            </td>
            <td id="body2">
                <table border="0" cellspacing="1" cellpadding="0" class="list" style="margin-left:10px;">
                    <tr>
                        <td align="right">Доступ: <span class="required">*</span> </td>
                        <td>
                            <select name="type" class="field requirefield" style="width:132px; height:19px;"<{if $item.id==1 OR $objUserInfo->type != 'Administrator'}> disabled="disabled"<{/if}>>
<{section name=i loop=$arrUserTypes}>
                                <option value="<{$arrUserTypes[i].name}>"<{if $item.type==$arrUserTypes[i].name || ($arrPageData.task=='addItem' && $arrUserTypes[i].name=='Registered')}>  selected<{/if}>> &nbsp; <{$arrUserTypes[i].title}> </option>
<{/section}>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Активен: <span class="required">*</span> </td>
                        <td>
                            <select name="active" class="field requirefield" style="width:132px; height:19px;"<{if $item.id==1 OR $objUserInfo->type != 'Administrator'}> disabled="disabled"<{/if}>>
                                <option value="1"> <{$smarty.const.OPTION_YES}> </option>
                                <option value="0"<{if $item.active==0}> selected<{/if}>> <{$smarty.const.OPTION_NO}> </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Логин: <span class="required">*</span> </td>
                        <td>
                            <input class="field requirefield" name="login" type="text" value="<{$item.login}>"<{if $item.id==1 OR $objUserInfo->type != 'Administrator'}> readonly<{/if}> />
                            <input name="old_login" type="hidden" value="<{$item.login}>" />
                        </td>
                    </tr>
<{if $arrPageData.task=='addItem'}>
                    <tr>
                        <td align="right"><b>Пароль: </b><span class="required">*</span> </td>
                        <td><input class="field requirefield" name="pass"  type="password" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right" nowrap><b>Повторите пароль: </b><span class="required">*</span> </td>
                        <td><input class="field requirefield" name="confpass" type="password" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">&nbsp;</td>
                    </tr>
<{elseif $arrPageData.task=='editItem'}>
                    <tr<{if $objUserInfo->type == 'Administrator'}> style="visibility:hidden;"<{/if}>>
                        <td align="right">Старый пароль: <{if $objUserInfo->type != 'Administrator'}><span class="required">*</span><{/if}></td>
                        <td><input class="field<{if $objUserInfo->type != 'Administrator'}> requirefield<{/if}>" name="old_pass"  type="password" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right">Новый пароль:</td>
                        <td><input class="field" name="pass"  type="password" value="" /></td>
                    </tr>

                    <tr>
                        <td align="right" nowrap>Повторите новый пароль:</td>
                        <td><input class="field" name="confpass" type="password" value="" /></td>
                    </tr>
<{/if}>
                    <tr>
                        <td align="right" valign="middle"><u>Авто генерация пароля</u>:&nbsp; </td>
                        <td>
                            <input class="field" name="autogenpass" id="autogenpass"  type="text" value="" readonly />
                            &nbsp;
                            <input id='passGenerate' name='passGenerate' class='buttons' type='button' value='Генерировать' onclick="generatePassword(this.form);" style="cursor:pointer; margin-top:0;" />
                            &nbsp;
                            <input id='passApply' name='passApply' class='buttons' type='button' value='Применить' onclick="applyPassword(this.form);" style="cursor:pointer; margin-top:0;" />
                            <br/><small>Перед применением измененного пароля, сначала скопируйте его!!!</small>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right">Фамилия: <span class="required">*</span> </td>
                        <td><input class="field requirefield" name="surname" type="text" value="<{$item.surname}>" /></td>
                    </tr>
                    <tr>
                        <td align="right">Имя: <span class="required">*</span> </td>
                        <td><input class="field requirefield" name="firstname" type="text" value="<{$item.firstname}>" /></td>
                    </tr>
                    <tr>
                        <td align="right">Отчество: </td>
                        <td><input class="field" name="middlename" type="text" value="<{$item.middlename}>" /></td>
                    </tr>
                    <tr>
                        <td align="right">Телефон: </td>
                        <td><input class="field" name="phone" type="text" value="<{$item.phone}>" /></td>
                    </tr>
                    <tr>
                        <td align="right">E-mail: <span class="required">*</span> </td>
                        <td>
                            <input class="field requirefield" name="email" type="text" value="<{$item.email}>" />
                            <input name="old_email" type="hidden" value="<{$item.email}>" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right" nowrap>Адрес: </td>
                        <td>&nbsp;<input class="field" name="address" type="text" value="<{$item.address}>" /></td>
                    </tr>
                    <tr>
                        <td align="right" nowrap>Краткое описание: </td>
                        <td>&nbsp;<textarea name="descr" id="descr" cols="50" rows="5" class="field"><{$item.descr}></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th colspan="2">&nbsp;Файлы:</th>
                    </tr>
                    <tr>
                        <td align="right" nowrap>Управление файлами: &nbsp;</td>
                        <td align="left">                         
<{if $arrPageData.task=='editItem'}>
                            <a href="/admin.php?module=users_files_uploadify&ajax=1&pmodule=<{$arrPageData.module}>&pid=<{if $item.id}><{$item.id}><{else}>0<{/if}>&files_params=<{$arrPageData.files_params|serialize|base64_encode|urlencode}>" onclick="return hs.htmlExpand(this, { headingText:'Управление файлами пользователя', objectType:'iframe', preserveContent: false, width:900 } )">открыть менеджер</a>
<{else}>
                            <b>"Менеджер файлов"</b> доступен только после создания пользователя
<{/if}>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">&nbsp;Изображение:</th>
                    </tr>
                    <tr>
                        <td align="right" nowrap><{if $arrPageData.task=='addItem'}>Добавить<{else}>Изменить<{/if}> изображение: &nbsp;</td>
                        <td><input name="image" type="file"<{if !empty($item.image)}> onchange="if(this.value.length){ $('#image_delete').attr({checked:true, readonly:true}); this.form.image_w.value=''; this.form.image_h.value='';}"<{/if}> /></td>
                    </tr>
                    <tr>
                        <td align="right" nowrap>Параметры изображения: &nbsp;</td>
                        <td>
                            <label for="image_w">Ширина: <input class="field" name="image_w" id="image_w" type="text" value="<{if !empty($item.image)}><{$item.arImageData.w}><{else}><{$arrPageData.def_img_param.w}><{/if}>" size="2" /></label>
                            &nbsp;&nbsp;
                            <label for="image_h">Высота: <input class="field" name="image_h" id="image_h" type="text" value="<{if !empty($item.image)}><{$item.arImageData.h}><{else}><{$arrPageData.def_img_param.h}><{/if}>" size="2" /></label>
                            &nbsp;&nbsp;
                            <label for="image_delete">Удалить: <input id="image_delete" name="image_delete" type="checkbox" value="1"<{if empty($item.image)}> disabled<{/if}> onclick="if($(this).attr('readonly')){return false;}" /></label>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                 <div align="center">
                    <input class="buttons" name="submit" onclick="if(this.form.login.value.length==0) {alert('Вы не ввели логин пользователя!'); return false;}" type="submit" value="Сохранить" />
                    &nbsp;|&nbsp;
                    <input class="buttons" name="submit_apply" onclick="if(this.form.login.value.length==0) {alert('Вы не ввели логин пользователя!'); return false;}" type="submit" value="Применить" />
<{if $arrPageData.task=='addItem'}>
                    &nbsp;|&nbsp;
                    <input class="buttons" name="submit_add" onclick="if(this.form.login.value.length==0) {alert('Вы не ввели логин пользователя!'); return false;}" type="submit" value="Сохранить и Добавить новый" />
                    &nbsp;|&nbsp;
                    <input class="buttons" name="submit_clear" type="reset" onclick="if(window.confirm('Хотите очистить?')) {this.reset()}; return false" value="Очистить" />
<{/if}>
                    &nbsp;|&nbsp;
                    <input class="buttons" name="submit_cancel" type="submit" onclick="if(window.confirm('Не хотите сохранять изменения?')) {window.location='<{$arrPageData.current_url}>'}; return false;" value="Отмена" />
<{if $arrPageData.task=='editItem' && $item.id>1}>
                    &nbsp;|&nbsp;
                    <input class="buttons" name="submit_delete" type="submit" onclick="if(window.confirm('Вы уверены? Страница и вся информация, связанная с нею, удалится полностью!')) {window.location='<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false" value="Удалить" />
<{/if}>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" id="line"></td>
        </tr>
    </table>
</form>


<{elseif $arrPageData.task=='viewItem'}>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="list" align="center">
    <tr><td id="head" colspan="2">Просмотр пользователя</td></tr>
    <tr>
        <td id="body2" width="250" align="center" valign="top">
            <b>Изображение: </b>
            <div style="margin:10px 5px;border:1px solid #999999;background-color:#E5E5E5;width:<{if !empty($item.image)}><{$item.arImageData.w}><{else}><{$arrPageData.def_img_param.w}><{/if}>px;height:<{if !empty($item.image)}><{$item.arImageData.h}><{else}><{$arrPageData.def_img_param.h}><{/if}>px;">
                <{if !empty($item.image)}><img src="<{$arrPageData.files_url|cat:$item.image}>" border="0" alt="" /><{/if}>
            </div>
        </td>
        <td id="body2">
            <table border="0" cellspacing="1" cellpadding="0" class="list" style="margin-left:10px;">
                <tr><td align="right">Доступ: </td><td>&nbsp;<{$item.typename}></td></tr>
                <tr><td align="right">Активен: </td><td>&nbsp;<{if $item.active}><span style="color:green;"><{$smarty.const.OPTION_YES}></span><{else}><span style="color:red;"><{$smarty.const.OPTION_NO}></span><{/if}></td></tr>
                <tr><td align="right"><b>Логин: </b> </td><td>&nbsp;<{$item.login}></td></tr>
                <tr><td align="right"><b>Пароль: </b> </td><td>&nbsp;<{if !empty($item.pass)}>Установлен<{else}>Не установлен<{/if}></td></tr>
                <tr><td align="right">Фамилия: </td><td>&nbsp;<{$item.surname}></td></tr>
                <tr><td align="right">Имя: </td><td>&nbsp;<{$item.firstname}></td></tr>
                <tr><td align="right">Отчество: </td><td>&nbsp;<{$item.middlename}></td></tr>
                <tr><td align="right">Телефон: </td><td>&nbsp;<{$item.phone}></td></tr>
                <tr><td align="right">E-mail: </td><td>&nbsp;<{$item.email}> &nbsp;(<i>E-mail подтвержден: <strong><{if $item.type!='Anonimous'}><span style="color:green;"><{$smarty.const.OPTION_YES}></span><{else}><span style="color:red;"><{$smarty.const.OPTION_NO}></span><{/if}></strong></i>)</td></tr>
                <tr><td align="right" nowrap>Адрес: </td><td>&nbsp;<{$item.address}></td></tr>
                <tr><td align="right" nowrap>Краткое описание: </td><td>&nbsp;<{$item.descr}></td></tr>
                <tr>
                    <th align="right" valign="top">Файлы: </th>
                    <td>
<{foreach name=i from=$item.arrFiles key=iKey item=iItem}>
                        &nbsp;<a href="<{$arrPageData.files_url|cat:$iItem.filename}>" onclick="return parent.hs.expand (this, { })" class="highslide"><{$iItem.filename}></a><{if !$smarty.foreach.i.last}>, <br/><{/if}>
<{foreachelse}>
                        &nbsp;нет файлов
<{/foreach}>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
             <div align="center">
<{if $item.isnew && $item.type=='Registered'}>
                <input class="buttons" name="button_activate" type="button" onclick="if(window.confirm('Вы действительно хотите активировать данного пользователя? Пользователю станут доступны ресурсы сайта!')) {window.location='<{$arrPageData.current_url|cat:"&task=activateItem&status=1&itemID="|cat:$item.id}>'}; return false" value="Активировать" />
                &nbsp;|&nbsp;
<{elseif !$item.isnew}>
                <input class="buttons" name="button_edit" type="button" onclick="window.location='<{$arrPageData.current_url|cat:"&task=editItem&itemID="|cat:$item.id}>';" value="Редактировать" />
                &nbsp;|&nbsp;
<{/if}>
                <input class="buttons" name="button_cancel" type="button" onclick="if(window.confirm('Закрыть детальный просмотр?')) {window.location='<{$arrPageData.current_url}>'}; return false;" value="Закрыть просмотр" />
<{if $item.id>1}>
                &nbsp;|&nbsp;
                <input class="buttons" name="button_delete" type="button" onclick="if(window.confirm('Вы уверены? Страница и вся информация, связанная с нею, удалится полностью!')) {window.location='<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$item.id}>'}; return false" value="Удалить" />
<{/if}>
            </div>
        </td>
    </tr>
    <tr><td colspan="2" id="line"></td></tr>
</table>
<{/if}>



<div>&nbsp;</div>
<{if !empty($arrNewItems)}>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
    <tr><th id="body1" colspan="7" style="color:red;"> &diams; Список пользователей для активации:</th></tr>
    <tr>
        <td id="head" align="center">Id</td>
        <td id="head">Логин</td>
        <td id="head">ФИО</td>
        <td id="head">Контакты</td>
        <td id="head" width="30">Подтвержден</td>
        <td id="head" align="center" width="32">Просмотр</td>
    </tr>
<{section name=i loop=$arrNewItems}>
    <tr>
        <td id="<{$arrNewItems[i].idb}>" align="center"><{$arrNewItems[i].id}></td>
        <td id="<{$arrNewItems[i].idb}>"><{$arrNewItems[i].login}></td>
        <td id="<{$arrNewItems[i].idb}>"><{$arrNewItems[i].surname}> <{$arrNewItems[i].firstname}> <{$arrNewItems[i].middlename}></td>
        <td id="<{$arrNewItems[i].idb}>"><{$arrNewItems[i].email}> &nbsp; <{$arrNewItems[i].phone}> &nbsp; <{$arrNewItems[i].city}></td>
        <td id="<{$arrNewItems[i].idb}>" align="center"><strong><{if $arrNewItems[i].type=='Registered'}><span style="color:green;"><{$smarty.const.OPTION_YES}></span><{else}><span style="color:red;"><{$smarty.const.OPTION_NO}></span><{/if}></strong></td>
        <td id="<{$arrNewItems[i].idb}>" align='center'>
            <a href="<{$arrPageData.current_url|cat:"&task=viewItem&itemID="|cat:$arrNewItems[i].id}>" title="Просмотр для активации">
                <img src="<{$arrPageData.system_images}>edit.gif" alt="Просмотр для активации" />
            </a>
        </td>
    </tr>
<{/section}>
    <tr>
        <td colspan="7" id="line"><{$smarty.const.SITE_COUNT_RECORDS}><{$arrNewItems|@count}></td>
    </tr>
</table>
<div>&nbsp;</div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
    <tr><th id="body1" style="color:black;"> &diams; Общий список пользователей:</th></tr>
</table>                
<{/if}>


<table width="100%" border="0" cellspacing="1" cellpadding="0" class="list">
    <tr>
        <td id="head" align="center">Id</td>
        <td id="head">Логин</td>
        <td id="head">ФИО</td>
        <td id="head" align="center">E-mail</td>
        <td id="head" align="center">Телефон</td>
        <td id="head" align="center">Доступ</td>
        <td id="head" align="center">Активен</td>
        <td id="head" align="center">Ред.</td>
        <td id="head" align="center">Удалить</td>
    </tr>
<{section name=i loop=$items}>
    <tr>
        <td id="<{$items[i].idb}>" align="center"><{$items[i].id}></td>
        <td id="<{$items[i].idb}>"><{$items[i].login}></td>
        <td id="<{$items[i].idb}>">
            <a href="<{$arrPageData.current_url|cat:"&task=viewItem&itemID="|cat:$items[i].id}>" title="Просмотр">
                <{$items[i].surname}> <{$items[i].firstname}> <{$items[i].middlename}>
            </a>
        </td>
        <td id="<{$items[i].idb}>"><{$items[i].email}></td>
        <td id="<{$items[i].idb}>"><{$items[i].phone}></td>
        <td id="<{$items[i].idb}>"><{$items[i].typename}></td>
        <td id="<{$items[i].idb}>" align='center'>
<{if $items[i].id==1}>Denied
<{elseif $items[i].active==1}>
            <a href="<{$arrPageData.current_url|cat:"&task=publishItem&status=0&itemID="|cat:$items[i].id}>" title="Enable">
                <img src="<{$arrPageData.system_images}>check.gif" alt="Enable" />
            </a>
<{else}>
            <a href="<{$arrPageData.current_url|cat:"&task=publishItem&status=1&itemID="|cat:$items[i].id}>" title="No Enable">
                <img src="<{$arrPageData.system_images}>un_check.gif" alt="No Enable" />
            </a>
<{/if}>
        </td>
        <td id="<{$items[i].idb}>" align='center'>
<{if $items[i].id==1 && $objUserInfo->type != 'Administrator'}>
            Denied
<{else}>
            <a href="<{$arrPageData.current_url|cat:"&task=editItem&itemID="|cat:$items[i].id}>" title="Edit">
                <img src="<{$arrPageData.system_images}>edit.gif" alt="Edit" />
            </a>
<{/if}>
        </td>
        <td id="<{$items[i].idb}>" align='center'>
<{if $items[i].id==1 OR $objUserInfo->type != 'Administrator'}>
            Denied
<{else}>
        <a href="<{$arrPageData.current_url|cat:"&task=deleteItem&itemID="|cat:$items[i].id}>" onclick="return confirm('Вы уверены? Страница и вся информация, связанная с нею, удалится полностью!')" title="Delete">
            <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" />
        </a>
<{/if}>
        </td>
    </tr>
<{/section}>
    <tr>
        <td colspan="10" id="line"><{$smarty.const.SITE_COUNT_RECORDS}><{$arrPageData.total_items}></td>
    </tr>

<{if $arrPageData.total_pages>1}>
    <tr>
        <td colspan="10" id = "line">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=0 showPrevNext=0}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        </td>
    </tr>
<{/if}>

</table>
