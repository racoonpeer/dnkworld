<{if $item.step==1}>
<div class="m-title mt-oformlenia">
    <div class="mtc-l">Регистрация на сайте</div>
</div>
<div class="m-body mb-oformlenia">
    <!-- помещаем в контейнер для static отображения текста-->
    <table class="fix-position"><tr><td>
        <script type="text/javascript">
        <!--
            function formCheck(form){
                var arErrors = new Array();
                var regExpPhone = new RegExp("^([0-9 \-]{7,17})$");
                var regExpEmail = new RegExp("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$");
                // Required: captcha[code], address, city, phone, surname, firstname, confpass, pass, email //, login
                if($('#captcha_code').val() == "") {
                    arErrors.unshift('Введите пожалуйста Код подтверждения!');
                    $('#captcha_code').focus();
                }
                if(form.address.value == "") {
                    arErrors.unshift('Введите пожалуйста Ваш адресс!');
                    form.address.focus();
                }
                if(form.city.value == "") {
                    arErrors.unshift('Введите пожалуйста Ваш город!');
                    form.city.focus();
                }
                if(form.phone.value == "" || form.phone.value.match(regExpPhone) == null) {
                    arErrors.unshift('Введите пожалуйста Ваш телефон!');
                    form.phone.focus();
                }             
                if(form.surname.value == "") {
                    arErrors.unshift('Введите пожалуйста Вашу фамилию!');
                    form.surname.focus();
                }  
                if(form.firstname.value == "") {
                    arErrors.unshift('Введите пожалуйста Ваше Имя!');
                    form.firstname.focus();
                }
                if(form.pass.value == "" || form.confpass.value == "" || form.pass.value != form.confpass.value) {
                    arErrors.unshift('Введите пожалуйста Ваш Пароль и Подтвердите пароль!');
                    form.pass.focus();
                } 
                if (form.email.value.match(regExpEmail) == null){
                    if (form.email.value.search(";") != -1 || form.email.value.search(",") != -1 || form.email.value.search(" ") != -1  ) 
                         arErrors.unshift("Нельзя вводить более одного адреса email. Или вы ввели некорректный email адрес!");
                    else arErrors.unshift("Введите, пожалуйста, корректный Ваш электронный адрес!");
                    form.email.focus();
                }
                /*if(form.login.value == "" || form.login.value.match(/^([a-zA-Z0-9_\-]{3,32})$/) == null) {
                    arErrors.unshift('Введите пожалуйста Ваш Логин. Логин должен быть больше 3 символов латиницей [a-zA-Z0-9_-]!');
                    form.login.focus();
                }*/
                if ( arErrors.length > 0){
                    $('#messages').html('<ul><li>'+arErrors.join("</li><li>")+'</li></ul>')
                                  .removeAttr("class")
                                  .addClass("error");
                } else {
                    form.submit();
                    return true;
                };
                return false;
            }   
        //-->
        </script>
        <div id="messages" class="<{if !empty($arrPageData.errors)}>error<{elseif !empty($arrPageData.messages)}>info<{else}>hidden_block<{/if}>">
        <{if !empty($arrPageData.errors)}>
            <{$arrPageData.errors|@implode:'<br/>'}>
        <{elseif !empty($arrPageData.messages)}>
            <{$arrPageData.messages|@implode:'<br/>'}>
        <{/if}>
        </div>
        <form method="post" action="" name="<{$arCategory.module}>Form" onsubmit="return formCheck(this);">
            <table class="userdataform" align="center">
                <tbody>
                    <{*
                    <tr>
                        <td class="lbl">Логин:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.login}>" name="login" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    *}>
                    <tr>
                        <td class="lbl">Email:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.email}>" name="email" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Пароль:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="password" value="" name="pass" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Повторите&nbsp;пароль:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="password" value="" name="confpass" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Имя:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.firstname}>" name="firstname" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Отчество: </td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.middlename}>" name="middlename" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Фамилия:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.surname}>" name="surname" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Телефон:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.phone}>" name="phone" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Город:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.city}>" name="city" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Адрес:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-textarea">
                                <div class="wp2-textarea">
                                    <textarea name="address" cols="50" rows="7"><{$item.address}></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Дополнительная&nbsp;&nbsp;&nbsp;<br />информация:<font>&nbsp;</font></td>
                        <td class="frm">
                            <div class="wp1-textarea">
                                <div class="wp2-textarea">
                                    <textarea name="descr" cols="50" rows="7"><{$item.descr}></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Повторите цифры:<font>*</font></td>
                        <td class="frm frm-cap">
                            <img border="0" align="left" src="/interactive/captcha.php?zone=site&sid=<{$Captcha->GetGeneratedSID()}>" alt="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>" title="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>, <{$smarty.const.FEEDBACK_CODE_CASE}>" />
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="hidden" name="captcha[sid]" id="captcha_sid" value="<{$Captcha->GetSID()}>" />
                                    <input type="text" name="captcha[code]" id="captcha_code" value="<{*$Captcha->GetGeneratedCode()*}>" maxlength="<{$Captcha->GetCodeLength()}>" title="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>, <{$smarty.const.FEEDBACK_CODE_CASE}>" />
                                </div>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="subscribe">
                                <input id="subscribe" name="subscribe" type="checkbox" value="1"<{if isset($item.subscribe) OR empty($arrPageData.errors)}> checked<{/if}> />
                                <label for="subscribe">подписатся на рассылку</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="frm"><a href="javascript:void(0);" onclick="formCheck(document.<{$arCategory.module}>Form);" class="obtn"><span>Подтвердить</span></a></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="info">
                            <font class="star">*</font> - поля обязательные для заполнения
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </td></tr></table>
</div>
<{elseif $item.step==2}>
<{elseif $item.step==3}>
<{elseif $item.action=='confirm'}>
<{include file='core/register_confirm.tpl'}>
<{/if}>



