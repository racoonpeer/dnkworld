<{* ++++++++++++++ Start Search Form Wrapper ++++++++++++++++++++++++++++++ -->
        <div class="beauty-input-search"><div>
            <form method="post" action="<{include file='core/href.tpl' arItem=$arrModules.search}>" name="searchForm">
                <input type="hidden" id="searchFormType" name="swhere" value="<{if !empty($arrPageData.swhere)}><{$arrPageData.swhere}><{else}>all<{/if}>" />
                <input type="text" id="searchFormText" name="stext" value="<{if !empty($arrPageData.stext)}><{$arrPageData.stext}><{else}><{$smarty.const.SITE_SEARCH}><{/if}>" onfocus="if(this.value=='<{$smarty.const.SITE_SEARCH}>') this.value='';" onblur="if(this.value=='') this.value='<{$smarty.const.SITE_SEARCH}>';" />
                <input type="submit" id="searchFormSubmit" name="ssubmit" value="<{$smarty.const.SITE_FOUND}>" style="display:none;" />
            </form>
        </div></div>
        <a class="beauty-btn search-btn-a" href="javascript:void(0);" onclick="if(document.searchForm.stext.value=='<{$smarty.const.SITE_SEARCH}>'){ document.searchForm.stext.value=''; document.searchForm.stext.focus(); }else{ document.searchForm.submit(); }"><span class="search-btn"><{$smarty.const.SITE_FOUND}></span></a>
        <div class="clear"></div>
<!-- ++++++++++++++ End Search Form Wrapper ++++++++++++++++++++++++++++++++ *}>
    <div class="page-body-content">
<{if !empty($arrPageData.messages) || !empty($arrPageData.errors)}>
        <div id="messages">
            <{if !empty($arrPageData.messages)}><div class="info"><{$arrPageData.messages|@implode:'<br/>'}></div><{/if}>
            <{if !empty($arrPageData.errors)}><div class="errors"><{$arrPageData.errors|@implode:'<br/>'}></div><{/if}>
        </div>
<{elseif !empty($items)}>
        <h2 class="search-found"><{$smarty.const.FOUND}>: <{$arrPageData.total_items}></h2>
        <div class="search">
            <table class="search-table" width="100%" cellspacing="0" cellpadding="0"><tbody>
<{section name=i loop=$items}>
                <tr class="item">
                    <td class="col1"><{$smarty.section.i.iteration}>.</td>
                    <td>
                        <a class="more" href="<{if isset($items[i].arCategory)}><{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}><{else}><{include file='core/href.tpl' arItem=$items[i]}><{/if}>" target="_blank"><{$items[i].title}></a><br/>
                        <{*p><{$items[i].descr|strip_tags|truncate:255:"...":true}></p*}>
                        <span class="pagetype"><{$items[i].name}></span> | <a class="more" href="<{if isset($items[i].arCategory)}><{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}><{else}><{include file='core/href.tpl' arItem=$items[i]}><{/if}>" target="_blank" title="<{$smarty.const.BUTTON_MORE}>"><{$smarty.const.BUTTON_MORE}></a>
                    </td>
                </tr>
<{/section}>
            </tbody></table>
        </div>
<{if $arrPageData.total_pages>1}>
        <div class="page-wrapper">
            <div class="cf50">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='core/pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=0 showFirstLast=0 showPrevNext=1 showAll=0}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </div><div class="clear"></div>
        </div>
<{/if}>

<{elseif !empty($arrPageData.stext)}>
        <h3 class="search-unfound"><{$smarty.const.NO_RESULTS}></h3>
<{/if}>

