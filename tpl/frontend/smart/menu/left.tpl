<{if !empty($leftMenu)}>
<div class="row-fluid">
<{section name=i loop=$leftMenu max=3}>
    <div class="span4">
	<div class="album-headline">
	    <a href="<{include file='core/href.tpl' arItem=$leftMenu[i]}>" title="<{$leftMenu[i].title}>">
		<img src="<{$leftMenu[i].image}>" alt="<{$leftMenu[i].title}>" align="top" />
	    </a>
	    <h4 class="title-serif">
		<{$leftMenu[i].title}>
	    </h4>
	</div>
    </div>
<{/section}>
</div>
<{/if}>