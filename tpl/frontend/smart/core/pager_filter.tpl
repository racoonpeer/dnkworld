<{* REQUIRE VARS: arrPager=array(), page=int, showTitle=[0|1], showFirstLast=[0|1], showPrevNext=[0|1], showAll=[0|1] *}>
<{* arrPager = array_keys(all, first, last, prev, next, count, pages, baseurl, sep) *}>
<div class="pagination pagination-centered">
    <ul>
    
<{if $showTitle}>
	<li><{$smarty.const.SITE_PAGES}>:</li>
<{/if}>
<{if $showFirstLast}>
	<li>
	    <a href="<{$arrPager.baseurl}><{$UrlWL->getSuffix()}>" class="pager p-first"><{$smarty.const.SITE_PAGER_FIRST}></a>
	</li>
<{/if}>
<{if $showPrevNext && $page>1}>
	<li>
	    <a href="<{$arrPager.baseurl}><{if $arrPager.prev>1}><{'/'|cat:$arrPager.prev}><{/if}><{$UrlWL->getSuffix()}>" class="pager prev"><{$smarty.const.SITE_PAGER_PREV}></a>
	</li>
<{/if}>
<{* START SHOW PAGES *}>
<{section name=i loop=$arrPager.pages}>
<{if $arrPager.sep == $arrPager.pages[i]}>
	<li class="disabled">
	    <a href="javascript:void(0);"><{$arrPager.pages[i]}></a>
	</li>
<{else}>
	<li class="<{if $page==$arrPager.pages[i]}>disabled<{/if}>">
<{if $arrPager.pages[i] > 1}>
	    <a href="<{$HTMLHelper->prepareFilterUrl($arrPager.baseurl|cat:'/'|cat:$arrPager.pages[i]|cat:$UrlWL->getSuffix(), $arFilters, 0, 0)}>" ><{$arrPager.pages[i]}></a>
<{else}>
	    <a href="<{$HTMLHelper->prepareFilterUrl($arrPager.baseurl|cat:$UrlWL->getSuffix(), $arFilters, 0, 0)}>" ><{$arrPager.pages[i]}></a>
<{/if}>
	</li>
<{/if}>
<{/section}>
<{* END SHOW PAGES *}>
<{if $showPrevNext && $page<$arrPager.count}>
	<li>
	    <a href="<{$arrPager.baseurl|cat:'/'|cat:$arrPager.next}><{$UrlWL->getSuffix()}>" class="pager next"><{$smarty.const.SITE_PAGER_NEXT}></a>
	</li>
<{/if}>
<{if $showFirstLast}>
	<li>
	    <a href="<{$arrPager.baseurl|cat:'/'|cat:$arrPager.last}><{$UrlWL->getSuffix()}>" class="pager last"><{$smarty.const.SITE_PAGER_LAST}></a>
	</li>
<{/if}>
<{if $showAll}>
	<li>
	    <a href="<{$arrPager.baseurl|cat:$UrlWL->getSuffix()|cat:'?pages='|cat:$arrPager.all}>" class="pager all"><{$smarty.const.SITE_PAGER_ALL}></a>
	</li>
<{/if}>
    </ul>
</div>

