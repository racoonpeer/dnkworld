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
	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover admin-list tinytable">
	    <thead>
		<tr>
		    <th class="center"><{$smarty.const.HEAD_ID}></th>
		    <th><{$smarty.const.HEAD_NAME}></th>
		    <th><{$smarty.const.HEAD_DESCRIPTION}></th>
		    <th><{$smarty.const.HEAD_DATE_ADDED}></th>
		    <th class="center"><{$smarty.const.HEAD_PUBLICATION}></th>
		    <th class="center"><{$smarty.const.HEAD_DELETE}></th>
		</tr>
	    </thead>
	    <tbody>
<{section name=i loop=$items}>
		<tr>
		    <td class="center"><{$items[i].id}></td>
		    <td><{$items[i].author}></td>
		    <td><{$items[i].descr}></td>
		    <td><{$items[i].created|date_format:"%d.%m.%y %H:%M:%S"}></td>
		    <td class="center">
<{if $items[i].active==1}>
			<a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=publishItem&status=0&itemID="|cat:$items[i].id}>" title="Publication">
			    <img src="<{$arrPageData.system_images}>check.gif" alt="Publication" title="Publication" />
			</a>
<{else}>
			<a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=publishItem&status=1&itemID="|cat:$items[i].id}>" title="No Publication">
			    <img src="<{$arrPageData.system_images}>un_check.gif" alt="No Publication" title="No Publication" />
			</a>
<{/if}>
		    </td>
		    <td class="center">
			<a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$items[i].id}>" onclick="return confirm('¬ы уверены что хотите удалить запись?');" title="Delete!">
			   <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" title="Delete!" />
			</a>
		    </td>
		</tr>
<{/section}>
	    </tbody>
	</table>
    </div>
<{if $arrPageData.total_pages>1}>
    <div class="controls controls-row">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=0 showPrevNext=0 subClass='centered'}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    </div>
<{/if}>
</div>