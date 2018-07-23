<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<{$arrLangs.$lang.charset}>" />
        <title><{$arrPageData.headTitle}></title>
	<link href="<{$arrPageData.css_dir}>admin.css" rel="stylesheet" type="text/css" />
<{if $objSettingsInfo->logo}>
	<link rel="icon" href="<{$objSettingsInfo->logo}>" type="image/x-icon" />
	<link rel="shortcut icon" href="<{$objSettingsInfo->logo}>" type="image/x-icon" />
<{/if}>
        <script src="/js/jquery/jquery-<{$smarty.const.WLCMS_JQUERY_VERSION}>.min.js" type="text/javascript"></script>
        <script src="/js/jquery/easing/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="/js/bootstrap/bootstrap.js" type="text/javascript"></script>
<{if !empty($arrPageData.headCss)}>
        <{$arrPageData.headCss|implode:"\n        "}>
<{/if}>
<{if !empty($arrPageData.headScripts)}>
        <{$arrPageData.headScripts|implode:"\n        "}>

<{/if}>
        <script src="/js/tiny_mce/tiny_mce.js" type="text/javascript"></script>
        <script src="/js/tiny_mce/tiny_mce_config.js" type="text/javascript"></script>
        <script src="/js/admin_functions.js" type="text/javascript"></script>
        <script src="/js/admin_extra.js" type="text/javascript"></script>
    </head>
    <body>
	<{include file='ajax/modal.tpl'}>
	<!--top menu-->
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="navbar-inner">
		<div class="container-fluid">
<!-- ++++++++++ Start TOP Menu +++++++++++++++++++++++++++++++++++++++++++++ -->
			<{include file='menutop.tpl'}>
<!-- ++++++++++ End TOP Menu +++++++++++++++++++++++++++++++++++++++++++++++ -->
		</div>
	    </div>
	</div>
	<!--top menu-->
	
	<!--page body-->
	<div class="container-fluid">
	    <br><br><br>
	    <div class="row-fluid">
		<!--left sidebar-->
		<div class="span3">
<!-- ++++++++++ Start LEFT TOP Menu ++++++++++++++++++++++++++++++++++++++++ -->
		    <{include file='menuleft.tpl'}>
<!-- ++++++++++ End LEFT TOP Menu ++++++++++++++++++++++++++++++++++++++++++ -->
		</div>
		<!--left sidebar-->
		<!--right sidebar-->
		<div class="span9">
<!-- ++++++++++ Start Page Content +++++++++++++++++++++++++++++++++++++++++ -->
		    <{include file=$arrPageData.module|cat:'.tpl'}>
<!-- ++++++++++ End Page Content +++++++++++++++++++++++++++++++++++++++++++ -->		
		</div>
		<!--right sidebar-->
	    </div>
	    <!--page footer-->
	    <hr>
	    <footer>
		<p><img alt="" src="<{$arrPageData.images_dir}>weblife.gif" /><{$smarty.const.ADMIN_COPYRIGHT}><small><{$smarty.const.WLCMS_VERSION}></small></p>
	    </footer>
	    <!--page footer-->
	</div>
	<!--page body-->
    </body>
</html>