<{* REQUIRE VARS: $arItems=array(), $marginLevel=int <{include file='menu/main.tpl' arItems=$mainMenu marginLevel=0}>  *}>
<ul class="nav" role="navigation">
<{if $arCategory.module!='home'}>
    <li class="">
	<a href="<{include file='core/href.tpl' arItem=$arrModules.home}>" title="<{$arrModules.home.title}>"><{$arrModules.home.title}></a>
    </li>
<{/if}>
<{section name=i loop=$arItems}>
<{if $arItems[i].id>1}>
    <li class="<{if $arItems[i].opened}>active<{/if}>">
	<a href="<{include file='core/href.tpl' arItem=$arItems[i]}>" title="<{$arItems[i].title}>"><{$arItems[i].title}></a>
    </li>
<{/if}>
<{/section}>
</ul>
