<{* REQUIRE VARS: $arrBreadCrumb=array()*}><{*include file='core/breadcrumb.tpl' arrBreadCrumb=$arrPageData.arrBreadCrumb*}>
<!-- ++++++++++++++ Start BREADCRUMB Wrapper +++++++++++++++++++++++++++++++ -->
<{section name=i loop=$arrBreadCrumb}>
<{if !$smarty.section.i.last}>
                                  <a href="<{include file='core/href.tpl' arItem=$arrBreadCrumb[i]}>" class="path<{if $smarty.section.i.first}> first<{elseif $smarty.section.i.last}> last<{/if}>" title="<{$arrBreadCrumb[i].title}>"><{$arrBreadCrumb[i].title}></a>
<{else}>
                                  <span><{$arrBreadCrumb[i].title}></span>
<{/if}>
<{/section}>
<!-- ++++++++++++++ End BREADCRUMB Wrapper +++++++++++++++++++++++++++++++++ -->
