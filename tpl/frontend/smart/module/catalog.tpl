<!-- Items Start -->
<{* DISPLAY ITEM FIRST IF NOT EMPTY *}>
<{if !empty($item)}>
    <div class="page-body-content">
        <div class="date"><span><{$item.created|date_format:"%d.%m.%Y"}></span></div><div class="clear"></div>
        <h2><{$item.title}></h2>
        <img src="<{$item.image}>" alt="<{$item.title}>" />
        <{$item.fulldescr}>
        <div class="backurl-link">
            <a class="link-back" href="<{$arrPageData.backurl}>"><{$smarty.const.URL_BACK_TO_LIST}></a>
        </div>
    </div>

<{* DISPLAY ITEMS LIST IF NOT EMPTY *}>
<{elseif !empty($items)}>
    <div class="page-body-content">
        <div class="content-list">
            <table class="news2 news2-wide" width="100%" cellspacing="0" cellpadding="0"><tbody>
<{section name=i loop=$items}>
                <tr class="item">
                    <td>
                        <a href="<{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}>" title="<{$items[i].title}>">
                            <img alt="<{$items[i].title}>" src="<{$items[i].small_image}>" />
                        </a>
                    </td>
                    <td>
                        <div class="date"><span><{$items[i].created|date_format:"%d.%m.%Y"}></span></div><div class="clear"></div>
                        <a class="h" href="<{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}>"><h3 class="t"><{$items[i].title}></h3></a>
                        <{$items[i].descr}>
                        <a class="more" href="<{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}>"><{$smarty.const.BUTTON_MORE}></a>
                    </td>
                </tr>
<{/section}>
            </tbody></table>
<{if $arrPageData.total_pages>1}>
            <div class="page-wrapper">
                <div class="cf50">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='core/pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=0 showFirstLast=0 showPrevNext=1 showAll=1}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                </div><div class="clear"></div>
            </div>
<{/if}>
        </div>
    </div>

<{* DISPLAY CATEGORY INFO *}>
<{else}>
<{include file='core/static.tpl'}>
<{/if}>
<!-- Items end-->
