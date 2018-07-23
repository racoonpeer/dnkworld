<nav class="bottommenu">
    <ul>
<{*section name=i loop=$arItems}>
	<li class="nav-header">
	    <strong><{$arItems[i].title}></strong>
<{if !empty($arItems[i].subcategories)}>
	    <ul>
<{section name=j loop=$arItems[i].subcategories}>
		<li<{if $arItems[i].subcategories[j].opened}> class="active"<{/if}>>
		    <a href="<{include file='core/href.tpl' arItem=$arItems[i].subcategories[j]}>"><{$arItems[i].subcategories[j].title}></a>
		</li>
<{/section}>
	    </ul>
<{/if}>
	</li>
<{/section*}>
    </ul>
    <div class="clearfix"></div>
</nav>
