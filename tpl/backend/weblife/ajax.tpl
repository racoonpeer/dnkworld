<!DOCTYPE html">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<{$arrLangs.$lang.charset}>" />
        <title><{$arrPageData.headTitle}></title>
        <link href="<{$arrPageData.css_dir}>admin.css" rel="stylesheet" type="text/css" />
<{if $objSettingsInfo->logo}>
    <link rel="icon" href="<{$objSettingsInfo->logo}>" type="image/x-icon" />
    <link rel="shortcut icon" href="<{$objSettingsInfo->logo}>" type="image/x-icon" />
<{/if}>
        <script src="/js/jquery/jquery-<{$smarty.const.WLCMS_JQUERY_VERSION}>.min.js" type="text/javascript"></script>
        <script src="/js/jquery/jquery.easing.1.3.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/bootstrap/bootstrap.js"></script>
	<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<{if !empty($arrPageData.headCss)}>
        <{$arrPageData.headCss|implode:"\n        "}>
<{/if}>
<{if !empty($arrPageData.headScripts)}>
        <{$arrPageData.headScripts|implode:"\n        "}>
<{/if}>
        <script src="/js/admin_functions.js" type="text/javascript"></script>
        <script src="/js/admin_extra.js" type="text/javascript"></script>
    </head>
    <body class="highslide_ajax">
	<div class="container-fluid">
	    <br />
<!-- ++++++++++ Start Page Content +++++++++++++++++++++++++++++++++++++++++ -->
	    <{include file='ajax/'|cat:$arrPageData.module|cat:'.tpl'}>
<!-- ++++++++++ End Page Content +++++++++++++++++++++++++++++++++++++++++++ -->
	</div>
    </body>
</html>