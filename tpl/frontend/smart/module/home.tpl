<div class="row-fluid">
    <{include file='core/homeslider.tpl'}>
</div>
<div class="row-fluid">
    <div class="span9">
	<div class="story shadowbox">
	    <br />
	    <article>
<{if !empty($arCategory.text)}>
	    <{$arCategory.text}>
<{else}>
		<br />
		<br />
		<br />
		<center><{$smarty.const.NO_CONTENT}></center>
<{/if}>
	    </article>
	</div>
    </div>
    <div class="span3">
<{section name=i loop=$arrItems.arCategories}>
        <div class="album-headline shadowbox">
            <h4 class="title-serif">
                <{$arrItems.arCategories[i].title}>
            </h4>
            <a class="image" href="<{include file='core/href.tpl' arItem=$arrItems.arCategories[i]}>" title="<{$arrItems.arCategories[i].title}>">
                <img src="<{$arrItems.arCategories[i].image}>" alt="<{$arrItems.arCategories[i].title}>" align="top" />
            </a>
        </div>
        <div>
            <img src="/images/site/smart/slides/shadow_min.png" alt="" align="top" style="display: block;"/>
        </div>
<{/section}>    
    </div>
</div>