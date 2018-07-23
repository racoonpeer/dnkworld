<!-- Галлерея начало -->
<{if !empty($item) OR !empty($items)}>

<{* DISPLAY ITEM FIRST IF NOT EMPTY *}>
<{if !empty($item)}>
<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic pull-right"><{$item.title}></h1>
</hgroup>
<{if !empty($item.arGalleries)}>
<div class="row-fluid">
    <ul class="album-nav">
<{section name=i loop=$item.arGalleries}>
	<li>
	    <a href="<{include file='core/href_auto.tpl' arCategory=$arCategory arItem=$item.arGalleries[i] params=''}>" title="<{$item.arGalleries[i].title}>"><{$item.arGalleries[i].title}></a>
	</li>
<{/section}>
    </ul>
    <div class="clearfix"></div>
</div>
<br />
<{/if}>

<{if !empty($item.images)}>
<div class="row-fluid">
    <div class="iGallery">
	<div class="screen">
	    <img src="<{$item.images[0].src}>" align="top" alt="<{$item.images[0].descr}>" />
	    <div class="descr">
		<p class="caption">
<{if !empty($item.images[0].descr)}>
		    <{$item.images[0].descr}>
<{/if}>
		</p>
	    </div>
	</div>
	<a class="control prev" href="javascript:void(0);" title="Предыдущая">&nbsp;</a>
	<a class="control next" href="javascript:void(0);" title="Следующая">&nbsp;</a>
	<div class="filmstrip">
	    <div>
		<ul>
<{section name=i loop=$item.images}>
		    <li>
			<a class="<{if $smarty.section.i.first}>active<{/if}>" href="javascript:void(0);" data-caption="<{$item.images[i].descr}>" data-index="<{$smarty.section.i.index}>" data-src="<{$item.images[i].src}>">
			    <img src="<{$item.images[i].pre}>" alt="<{$item.images[i].descr}>" align="top">
			</a>
		    </li>
<{/section}>
		</ul>
		<div class="clearfix"></div>
	    </div>
	</div>
    </div>
</div>
<div class="overlay-black"></div>
<div class="gallery-cover" style="background-image: url('<{$item.image}>')"></div>
<script type="text/javascript">    
    $(document).ready(function(){
	IGallery.init();
    });
</script>
<{/if}>

<{* DISPLAY ITEMS LIST IF NOT EMPTY *}>
<{elseif !empty($items)}>
    
<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic"><{$arCategory.title}></h1>
</hgroup>
<div class="row-fluid">
<{section name=i loop=$items}>
    <div class="span3">
	<div class="album-headline shadowbox">
	    <h4 class="title-serif" style="margin-top: 0;">
		<{$items[i].title}>
	    </h4>
	    <a class="image" href="<{include file='core/href_auto.tpl' arCategory=$arrModules.gallery arItem=$items[i] params=''}>" title="<{$items[i].title}>">
		<img src="<{$items[i].image}>" alt="<{$items[i].title}>" align="top" />
	    </a>
	</div>
    </div>
<{if $smarty.section.i.iteration%4==0}>
</div>
<div class="row-fluid">
<{/if}>
<{/section}>
</div>
<{if $arrPageData.total_pages>1}>
<div class="row-fluid">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<{include file='core/pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=0 showFirstLast=0 showPrevNext=0 showAll=0}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
</div>
<{/if}>
	
<{/if}>
<{* DISPLAY CATEGORY INFO *}>
<{else}>
<{include file='core/static.tpl'}>
<{/if}>
<!--Галлерея конец-->

