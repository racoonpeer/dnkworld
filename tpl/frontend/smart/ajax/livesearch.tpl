<ul style="display: block; position: absolute; top: 40px; background: #000; padding: 10px; margin: 0">
<{section name=i loop=$items}>
    <li style="display: block;">
	<a href="<{if isset($items[i].arCategory)}><{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}><{else}><{include file='core/href.tpl' arItem=$items[i]}><{/if}>"><{$items[i].title}></a>
    </li>
<{/section}>
</ul>