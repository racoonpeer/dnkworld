<!DOCTYPE html>
<html lang="<{$lang}>" xmlns:fb="http://ogp.me/ns/fb#">
<{*head*}>
<{include file='core/head.tpl'}>
<{*/head*}>
<body onload="MAINFRAME.init();">
    <{include file='core/fbconnect.tpl'}>
    <div class="canvas"></div>
<{*header*}>
    <{include file='core/header.tpl'}>
<{*/header*}>
<{*container*}>
    <div class="container">
<{if !empty($arCategory.module)}>
	<{include file='module/'|cat:$arCategory.module|cat:'.tpl'}>
<{else}>
	<{include file='core/static.tpl'}>
<{/if}>
    </div>
<{*/container*}>
<{*footer*}>
    <{include file='core/footer.tpl'}>
    <{include file='core/footer-extra.tpl'}>
<{*/footer*}>
</body>
</html>