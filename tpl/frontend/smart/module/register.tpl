<{if $item.step==1}>
<div class="m-title mt-oformlenia">
    <div class="mtc-l">����������� �� �����</div>
</div>
<div class="m-body mb-oformlenia">
    <!-- �������� � ��������� ��� static ����������� ������-->
    <table class="fix-position"><tr><td>
        <script type="text/javascript">
        <!--
            function formCheck(form){
                var arErrors = new Array();
                var regExpPhone = new RegExp("^([0-9 \-]{7,17})$");
                var regExpEmail = new RegExp("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$");
                // Required: captcha[code], address, city, phone, surname, firstname, confpass, pass, email //, login
                if($('#captcha_code').val() == "") {
                    arErrors.unshift('������� ���������� ��� �������������!');
                    $('#captcha_code').focus();
                }
                if(form.address.value == "") {
                    arErrors.unshift('������� ���������� ��� ������!');
                    form.address.focus();
                }
                if(form.city.value == "") {
                    arErrors.unshift('������� ���������� ��� �����!');
                    form.city.focus();
                }
                if(form.phone.value == "" || form.phone.value.match(regExpPhone) == null) {
                    arErrors.unshift('������� ���������� ��� �������!');
                    form.phone.focus();
                }             
                if(form.surname.value == "") {
                    arErrors.unshift('������� ���������� ���� �������!');
                    form.surname.focus();
                }  
                if(form.firstname.value == "") {
                    arErrors.unshift('������� ���������� ���� ���!');
                    form.firstname.focus();
                }
                if(form.pass.value == "" || form.confpass.value == "" || form.pass.value != form.confpass.value) {
                    arErrors.unshift('������� ���������� ��� ������ � ����������� ������!');
                    form.pass.focus();
                } 
                if (form.email.value.match(regExpEmail) == null){
                    if (form.email.value.search(";") != -1 || form.email.value.search(",") != -1 || form.email.value.search(" ") != -1  ) 
                         arErrors.unshift("������ ������� ����� ������ ������ email. ��� �� ����� ������������ email �����!");
                    else arErrors.unshift("�������, ����������, ���������� ��� ����������� �����!");
                    form.email.focus();
                }
                /*if(form.login.value == "" || form.login.value.match(/^([a-zA-Z0-9_\-]{3,32})$/) == null) {
                    arErrors.unshift('������� ���������� ��� �����. ����� ������ ���� ������ 3 �������� ��������� [a-zA-Z0-9_-]!');
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
                        <td class="lbl">�����:<font>*</font></td>
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
                        <td class="lbl">������:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="password" value="" name="pass" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">���������&nbsp;������:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="password" value="" name="confpass" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">���:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.firstname}>" name="firstname" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">��������: </td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.middlename}>" name="middlename" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">�������:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.surname}>" name="surname" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">�������:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.phone}>" name="phone" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">�����:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-input">
                                <div class="wp2-input">
                                    <input type="text" value="<{$item.city}>" name="city" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">�����:<font>*</font></td>
                        <td class="frm">
                            <div class="wp1-textarea">
                                <div class="wp2-textarea">
                                    <textarea name="address" cols="50" rows="7"><{$item.address}></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">��������������&nbsp;&nbsp;&nbsp;<br />����������:<font>&nbsp;</font></td>
                        <td class="frm">
                            <div class="wp1-textarea">
                                <div class="wp2-textarea">
                                    <textarea name="descr" cols="50" rows="7"><{$item.descr}></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">��������� �����:<font>*</font></td>
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
                                <label for="subscribe">���������� �� ��������</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="frm"><a href="javascript:void(0);" onclick="formCheck(document.<{$arCategory.module}>Form);" class="obtn"><span>�����������</span></a></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="info">
                            <font class="star">*</font> - ���� ������������ ��� ����������
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



