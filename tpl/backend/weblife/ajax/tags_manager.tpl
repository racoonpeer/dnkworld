<{if !empty($arrPageData.errors) OR !empty($arrPageData.messages)}>
<div class="row-fluid">
    <div class="alert <{if !empty($arrPageData.errors)}>alert-error<{elseif !empty($arrPageData.messages)}>alert-success<{/if}>">
	<button type="button" class="close" data-dismiss="alert">X</button>
<{if !empty($arrPageData.errors)}>
	<{$arrPageData.errors|@implode:'<br/>'}>
<{elseif !empty($arrPageData.messages)}>
	<{$arrPageData.messages|@implode:'<br/>'}>
<{/if}>
    </div>
</div>
<{/if}>
<div class="row-fluid">
    <div class="controls controls-row">
	<form action="<{$arrPageData.current_url|cat:"&task=updateItems"}>" name="updateItems" method="POST" onsubmit="return formCheck(this);">
	    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover admin-list tinytable">
		<thead>
		    <tr>
			<th class="center"><{$smarty.const.HEAD_ID}></th>
			<th><{$smarty.const.HEAD_NAME}></th>
			<th class="center"><{$smarty.const.HEAD_DELETE}></th>
		    </tr>
		</thead>
		<tbody>
<{foreach name=i from=$items key=arKey item=arItem}>
		    <tr>
			<td class="center">
			    <input type="hidden" name="arItems[<{$arKey}>][id]" value="<{$arKey}>" />
<{if $arItem.id}>
			    <{$arItem.id}>
<{else}>
			    +
<{/if}>
			</td>
			<td>
			    <input type="text" name="arItems[<{$arKey}>][title]" id="item_<{$arKey}>" class="field<{if $arItem.id || !empty($arItem.title)}> requirefield<{/if}>" value="<{$arItem.title}>" />
			</td>
			<td class="center">
<{if $arItem.id}>
			    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$arItem.id}>" onclick="return confirm('Вы уверены что хотите удалить запись?');" title="Delete!">
			       <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" title="Delete!" />
			    </a>
<{else}>
			    +
<{/if}>
			</td>
		    </tr>
<{/foreach}>
		</tbody>
		<tfoot>
		    <tr>
			<td colspan="3">
			    <input class="btn btn-primary" name="submit" type="submit" value="Сохранить" />
			</td>
		    </tr>
		</tfoot>
	    </table>
	</form>
    </div>
<{if $arrPageData.total_pages>1}>
    <div class="controls controls-row">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=0 showPrevNext=0 subClass='centered'}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    </div>
<{/if}>
</div>

<script type="text/javascript">
    <!--
    function formCheck(form){
        var errors = 0;
        $.each($(form).find('.requirefield'), function(i, input) {
            if ( input.value.length==0 ){   // type=='text', type=='select-one', type=='textarea'
                    if(!errors) $(this).focus();
                    $(this).addClass('error');
                    errors++;
            } else $(this).removeClass('error');
        });
        if(!errors) {
	    return true;
	} else {
	    alert("<!--{$smarty.const.FEEDBACK_ALERT_ERROR}-->");
	    return false;
	}
    }
    //-->
</script>