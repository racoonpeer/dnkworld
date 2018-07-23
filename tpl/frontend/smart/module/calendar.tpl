<div class="row-fluid calendarMenu" style="text-align: right;">
<{section name=i loop=$arrPageData.arYears}>
    <a class="<{if $arrPageData.arYears[i]==$arrPageData.year}>active<{/if}>" href="<{include file='core/href_auto.tpl' arCategory=$arCategory arItem=array() params='year='|cat:$arrPageData.arYears[i]}>"><{$arrPageData.arYears[i]}></a>
<{/section}>
</div>
<div class="row-fluid">
    <table class="calendarGrid">
        <thead>
            <tr>
                <th colspan="3" align="center"><{$arrPageData.year}></th>
            </tr>
        </thead>
        <tbody>
            <tr>
<{foreach name=i from=$arrPageData.calendar[$arrPageData.year] key=arKey item=arItem}>
                <td>
                    <{$Calendar->generate($arrPageData.year, $arKey, $arItem)}>
                </td>
<{if $smarty.foreach.i.iteration%3==0}>
            <tr>
            </tr>
<{/if}>
<{/foreach}>
            </tr>
        </tbody>
    </table>
</div>
            
<script type="text/javascript">
    $(function(){
        var arLinks = $('.calendarTable').find('a');
        $.each(arLinks, function(i, a){
            var td = $(a).closest('td');
            var title = $(a).attr('title');
            $(td).bind('mouseenter', function(e){
                $(this).append('<div class="caption">' + title + '</div>');
            });
            $(td).bind('mouseleave', function(e){
                if($(this).has('.caption')) {
                    $(this).find('.caption').remove();
                }
            });
        });
    });
</script>