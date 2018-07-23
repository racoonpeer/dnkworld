
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<a class="brand" href="/admin.php"><{$objSettingsInfo->websiteName}></a>                
<div class="nav-collapse collapse">
    <!-- ++++++++++ Start User Info (Welcome) ++++++++++++++++++++++++++++++++++ -->
    <{include file='userinfo.tpl'}>
    <!-- ++++++++++ End User Info (Welcome) ++++++++++++++++++++++++++++++++++++ -->
    <ul class="nav">
	<{*<li><a href="/admin.php"><{$smarty.const.TOPLINK_HOME}></a></li>*}>
	<{*<li><a href="/admin.php?module=users"><{$smarty.const.TOPLINK_USERS}></a></li>
	<li><a href="/admin.php?module=banners"><{$smarty.const.TOPLINK_BANNERS}></a></li>
	<li><a href="/admin.php?module=currency"><{$smarty.const.TOPLINK_CURRENCY}></a></li>*}>
	<li><a href="/admin.php?module=settings"><{$smarty.const.TOPLINK_SETTINGS}></a></li>
	<li><a href="/admin.php?module=mysqldumper"><{$smarty.const.TOPLINK_MYSQLDUMPER}></a></li>
    </ul>
    <ul class="nav pull-right">
<!-- ++++++++++ Start LANG Menu ++++++++++++++++++++++++++++++++++++++++++++ -->
	<{include file='langs.tpl'}>
<!-- ++++++++++ End LANG Menu ++++++++++++++++++++++++++++++++++++++++++++++ -->
	<li class="divider-vertical"></li>
	<li><a href="/index.php" target="_blank"><{$smarty.const.TOPLINK_PREVIEW_SITE}></a></li>
	<li class="divider-vertical"></li>
	<li><a href="/admin.php?action=logout"><{$smarty.const.TOPLINK_LOGOUT}></a></li>
	<li class="divider-vertical"></li>
    </ul>
</div>
