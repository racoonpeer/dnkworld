<{if $arrLangs|@count>1}>
    <li class="dropdown">
	<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
	    <img src="/images/<{$lang}>.gif" alt="<{$arrLangs.$lang.title}>" /> <{$smarty.const.SITE_LANGUAGE}>:
	    <b class="caret"></b>
	</a>
	<ul class="dropdown-menu">
<{foreach from=$arrLangs key=lnKey item=arLnItem}>
	    <li class="dropdown">
		<a class="dropdown-toggle" href="<{$arLangsUrls.$lnKey}>" title="<{$arLnItem.title}>"<{if $lnKey==$lang}> id="activeLang"<{/if}>>
		    <img src="<{$arrPageData.images_dir}><{$arLnItem.image}>" alt="<{$arLnItem.title}>" /> <{$arLnItem.title}>
		</a>
	    </li>
<{/foreach}>
	</ul>
    </li>
<{/if}>

