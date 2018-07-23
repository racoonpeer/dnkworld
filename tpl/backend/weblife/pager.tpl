<{* array_keys(title, first, last, prev, next, count, pages, baseurl, sep) *}>
<{* REQUIRE VARS: arrPager=array(), showTitle=[0|1], showFirstLast=[0|1], showPrevNext=[0|1], subClass='' *}>
<div class="pagination pagination-<{$subClass}>">
    <ul>
<{if $showTitle}>
	<li class="disabled">
	    <span><{$smarty.const.SITE_PAGES}>:<{/if}></span>
	</li>
<{if $showFirstLast}>
	<li>
	    <a href="<{$arrPager.baseurl}>" class="pager first"><{$smarty.const.SITE_PAGER_FIRST}></a>
	</li>
<{/if}>
<{if $showPrevNext}>
	<li>
	    <a href="<{$arrPager.baseurl}><{if $arrPager.prev>1}><{'&page='|cat:$arrPager.prev}><{/if}>" class="pager prev"><{$smarty.const.SITE_PAGER_PREV}></a>
	</li>
<{/if}>

<{section name=i loop=$arrPager.pages}>
<{if $arrPager.sep == $arrPager.pages[i]}>
	<li class="disabled">
	    <span class="pager sep"><{$arrPager.pages[i]}></span>
	</li>
<{else}>
	<li class="<{if $page==$arrPager.pages[i]}> disabled<{/if}>">
	    <a href="<{if $page==$arrPager.pages[i]}>javascript:void(0)<{else}><{$arrPager.baseurl}><{if $arrPager.pages[i]>1}><{'&page='|cat:$arrPager.pages[i]}><{/if}><{/if}>"><{$arrPager.pages[i]}></a>
	</li>
<{/if}>
<{/section}>

<{if $showPrevNext}>
	<li>
	    <a href="<{$arrPager.baseurl|cat:'&page='|cat:$arrPager.next}>" class="pager next"><{$smarty.const.SITE_PAGER_NEXT}></a>
	</li>
<{/if}>
<{if $showFirstLast}>
	<li>
	    <a href="<{$arrPager.baseurl|cat:'&page='|cat:$arrPager.last}>" class="pager last"><{$smarty.const.SITE_PAGER_LAST}></a>
	</li>
<{/if}>
    </ul>
</div>
