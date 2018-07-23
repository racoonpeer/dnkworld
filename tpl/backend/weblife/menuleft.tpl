
<div class="well sidebar-nav">
    <ul class="nav nav-list">
	<li <{if $arrPageData.module=='main'}>class="active"<{/if}>>
	    <a href="/admin.php?module=main"><{$smarty.const.MAIN_PAGE}></a>
	</li>
	<li <{if $arrPageData.module=='homeslider'}>class="active"<{/if}>>
	    <a href="/admin.php?module=homeslider"><{$smarty.const.HOMESLIDER}></a>
	</li>
	<li <{if $arrPageData.module=='gallery'}>class="active"<{/if}>>
	    <a href="/admin.php?module=gallery"><{$smarty.const.GALLERY}></a>
	</li>
	<li <{if $arrPageData.module=='blog'}>class="active"<{/if}>>
	    <a href="/admin.php?module=blog"><{$smarty.const.BLOGNEWS}></a>
	</li>
	<li <{if $arrPageData.module=='calendar'}>class="active"<{/if}>>
	    <a href="/admin.php?module=calendar">Календарь</a>
	</li>
	<!--<li>
	    <a href="/admin.php?module=staticblocks"><{$smarty.const.STATIC_BLOCKS}></a>
	</li>
	<li>
	    <a href="/admin.php?module=blognews"><{$smarty.const.BLOGNEWS}></a>
	</li>
	<li>
	    <a href="/admin.php?module=messages"><{$smarty.const.MEMBERS_MESSAGES}></a>
	</li>
	<li>
	    <a href="/admin.php?module=commentusers"><{$smarty.const.TOPLINK_COMMENTUSERS}></a>
	</li>
	<li>
	    <a href="/admin.php?module=comments"><{$smarty.const.COMMENTS}></a>
	</li>
	<li>
	    <a href="/admin.php?module=quotes"><{$smarty.const.QUOTES}></a>
	</li>
	<li>
	    <a href="/admin.php?module=polls"><{$smarty.const.POLLS}></a>
	</li>
	-->
    </ul>
</div>                   

