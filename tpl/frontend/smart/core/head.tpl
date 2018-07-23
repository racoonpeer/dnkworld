<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<{$arrLangs.$lang.charset}>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<{$arCategory.meta_key}>" />
    <meta name="description" content="<{$arCategory.meta_descr}>" />
<{if $arCategory.meta_robots}>
    <meta name="robots" content="<{$arCategory.meta_robots}>" />
<{/if}>
    <title><{$HTMLHelper->prepareHeadTitle($arCategory)}></title>
<{if $objSettingsInfo->logo}>
    <link rel="icon" href="<{$objSettingsInfo->logo}>" type="image/x-icon" />
    <link rel="shortcut icon" href="<{$objSettingsInfo->logo}>" type="image/x-icon" />
<{/if}>
<{if !empty($arrPageData.headCss)}>
    <{$arrPageData.headCss|implode:"\n    "}>
<{/if}>
    <link rel="stylesheet" type="text/css" href="<{$arrPageData.css_dir}>style.css" />
    <script type="text/javascript" src="/js/jquery/jquery-<{$smarty.const.WLCMS_JQUERY_VERSION}>.min.js"></script>
    <script type="text/javascript" src="/js/jquery/easing/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.js"></script>
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<{if !empty($arrPageData.headScripts)}>
    <{$arrPageData.headScripts|implode:"\n    "}>
<{/if}>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?84"></script>
    <script type="text/javascript">
	VK.init({apiId: 3213592, onlyWidgets: true});
    </script>
    <script type="text/javascript" src="/js/scripts.js"></script>
</head>