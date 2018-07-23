<{include file='menu/sub.tpl'}>

<{if $arCategory.module=='blog' AND !empty($items)}>
<{if !empty($arrPageData.filterSelect)}> 
<div class="filter-menu row-fluid shadowbox">
    <h3>Выбранные теги:</h3>
    <ul>
<{section name=i loop=$arrPageData.filterSelect}>
    <li>
	<a href="<{$HTMLHelper->prepareFilterUrl($arrPageData.clear_url, $arFilters, 0, $arrPageData.filterSelect[i].id)}>">
	    <i class="icon-remove"></i> <{$arrPageData.filterSelect[i].title}>
	</a>
    </li>
<{/section}>
    </ul>
</div>
<{/if}>
<{if !empty($arrPageData.filters)}>
<div class="filter-menu row-fluid shadowbox">
    <h3>Теги:</h3>
    <ul>
<{section name=i loop=$arrPageData.filters}>
    <li>
	<a href="<{$HTMLHelper->prepareFilterUrl($arrPageData.clear_url, $arFilters, $arrPageData.filters[i].id, 0)}>">
	    <i class="icon-plus"></i> <{$arrPageData.filters[i].title}><{if $arrPageData.filters[i].count > 0}> <span class="muted">(+<{$arrPageData.filters[i].count}>)</span><{/if}>
	</a>
    </li>
<{/section}>
    </ul>
</div>
<{/if}>
<{/if}>