<p class="navbar-text pull-right">
    <{$smarty.const.ADMIN_HELLO}>, <{if !empty($objUserInfo->firstname)}><{$objUserInfo->firstname|ucfirst}><{else}><{$objUserInfo->login|ucfirst}><{/if}>!
</p>