<{* REQUIRE VARS: $arrBreadCrumb=array()*}>

<ul class="breadcrumb">
<{if !empty($arrBreadCrumb)}>
<{section name=i loop=$arrBreadCrumb}>
    <li>
<{if $smarty.section.i.last}>
	<span class="bc_path last"><{$arrBreadCrumb[i].title}></span>
<{else}>
	<a href="<{$arrPageData.admin_url|cat:'&cid='|cat:$arrBreadCrumb[i].id|cat:$arrPageData.filter_url}>" class="bc_path"><{$arrBreadCrumb[i].title}></a> <span class="divider">/</span>
<{/if}>
    </li>
<{/section}>
<{else}>
    <li>
	<a href="<{$arrPageData.admin_url}>" title=""><{$smarty.const.ADMIN_MAIN_ROOT}></a> <span class="divider">/</span>
    </li>
<{/if}>
</ul>
