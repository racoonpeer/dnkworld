<!-- ++++++++++++++ Start UserInfo Block +++++++++++++++++++++++++++++++++++ --><{*include file='core/userinfo.tpl'*}>
<{if $objUserInfo->logined}>
                                <span class="uwelcome"><{$smarty.const.USER_HELLO}>, <a href="<{include file='core/href.tpl' arItem=$arrModules.users}>" title="<{$smarty.const.USER_PROFILE}>"><{$objUserInfo->firstname}></a></span>
                                <a class="last" href="<{include file='core/href_auto.tpl' arCategory=$arrModules.authorize arItem=array() params='action=logout'}>" title="<{$smarty.const.USER_LOGOUT_TITLE}>"><{$smarty.const.USER_EXIT}></a>
<{else}>
                                <a href="<{include file='core/href.tpl' arItem=$arrModules.register}>" class="first" title="<{$smarty.const.USER_REGISTER_TITLE}>"><{$arrModules.register.title}></a>
                                <a href="<{include file='core/href_auto.tpl' arCategory=$arrModules.authorize arItem=array() params=''}>" class="last" title="<{$smarty.const.USER_LOGIN_TITLE}>"><{$arrModules.authorize.title}></a>
<{/if}>
<!-- ++++++++++++++ End UserInfo Block +++++++++++++++++++++++++++++++++++++ -->
