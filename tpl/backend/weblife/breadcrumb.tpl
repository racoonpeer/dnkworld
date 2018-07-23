<{* REQUIRE VARS: $arrBreadCrumb=array()*}>
<ul class="breadcrumb">
    <li>
	<a href="<{$arrPageData.admin_url}>" title=""><{$smarty.const.ADMIN_MAIN_ROOT}></a> <span class="divider">/</span>
    </li>
<{section name=i loop=$arrBreadCrumb}>
    <li>
	<a href="<{$arrPageData.admin_url|cat:'&pid='|cat:$arrBreadCrumb[i].id|cat:$arrPageData.filter_url}>"><{$arrBreadCrumb[i].title}></a> <{if !$smarty.section.i.last}><span class="divider">/</span><{/if}>
    </li>
<{/section}>
</ul>