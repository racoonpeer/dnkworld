<{if !empty($subMenu)}>
<nav class="submenu row-fluid shadowbox">
    <ul>
<{if $arCategory.module=='blog' AND $arCategory.id!=$arrModules.blog.id}>
	<li>
	    <a href="<{include file='core/href_auto.tpl' arCategory=$arrModules.blog arItem='' params=''}>" title="Все посты" >Все посты</a>
	</li>
<{/if}>
<{section name=i loop=$subMenu}>
	<li class="<{if $subMenu[i].id==$arrPageData.catid}> active<{/if}>">
<{if $subMenu[i].id==$arrPageData.catid}>
	    <{$subMenu[i].title}>
<{else}>
	    <a href="<{include file='core/href.tpl' arItem=$subMenu[i]}>" title="<{$subMenu[i].title}>" <{if !empty($subMenu[i].redirecturl)}>target="_blank"<{/if}>><{$subMenu[i].title}></a>
<{/if}>
	</li>
<{/section}>
    </ul>
</nav>
<{/if}>
