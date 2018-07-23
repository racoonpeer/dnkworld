<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic"><{$arCategory.title}></h1>
</hgroup>    
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
	    <{include file='core/social.tpl'}>    
	</div>
    </div>
    <div class="span3">
	<{include file="core/column-right.tpl"}>
    </div>
</div>