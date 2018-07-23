<!-- Items Start -->
<{* DISPLAY ITEM FIRST IF NOT EMPTY *}>
<{if !empty($item)}>
<div class="row-fluid">
    <div class="span9">
	<div class="story shadowbox">
	    <hgroup>
		<h1 class="title"><{$item.title}></h1>
		<div>
		    <div class="floatleft muted">
			<{$item.created|date_format: "%d.%m.%Y"}>
		    </div>
<{if !empty($item.comments)}>
		    <div class="floatright muted">
			<i class="icon-comment"></i> <{$item.comments|@count}>
		    </div>
<{/if}>
		    <div class="clearfix"></div>
		</div>
	    </hgroup>
	    <article>
		<{$item.fulldescr}>
	    </article>
	    <{include file='core/social.tpl'}>
	    <div class="summary">
		<a class="backlink" href="<{$arrPageData.backurl}>"><i class="icon-arrow-left"></i> <{$smarty.const.URL_BACK_TO_LIST}></a>
	    </div>
	    <div class="comments">
<{if !empty($item.comments)}>
		<fieldset><legend><{$smarty.const.COMMENTS}></legend>
<{section name=i loop=$item.comments}>
		<div class="well">
		    <p class="muted"><strong><{$item.comments[i].author}></strong> - <{$item.comments[i].created|date_format:"%d.%m.%Y"}></p>
		    <p><{$item.comments[i].descr}></p>
		</div>
<{/section}>
<{/if}>
		<div class="comment-form">
		    <fieldset><legend>Оставить комментарий:</legend>
<{if !empty($arrPageData.messages) OR !empty($arrPageData.errors)}>
		    <div class="alert <{if !empty($arrPageData.messages)}>alert-success<{elseif !empty($arrPageData.errors)}>alert-error<{/if}>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
<{if !empty($arrPageData.errors)}>
			<{$arrPageData.errors|@implode:'<br/>'}>
<{elseif !empty($arrPageData.messages)}>
			<{$arrPageData.messages|@implode:'<br/>'}>
<{/if}>
		    </div>
<{/if}>
		    </fieldset>
		    <form action="" method="POST">
			<div class="controls controls-row">
			    <label>Имя:</label>
			    <input type="text" name="firstname" value="<{if isset($item.firstname)}><{$item.firstname}><{/if}>" placeholder="Имя" class="input-xlarge" style="width: 300px;"/>
			</div>
			<div class="controls controls-row">
			    <label>E-mail:</label>
			    <input type="text" name="email" value="<{if isset($item.email)}><{$item.email}><{/if}>" placeholder="E-mail" class="input-xlarge" style="width: 300px;"/>
			</div>
			<div class="controls controls-row">
			    <label>Комментарий:</label>
			    <textarea name="message" class="input-xlarge" rows="5" style="width: 300px;"><{if isset($item.message)}><{$item.message}><{/if}></textarea>
			</div>
			<div class="controls controls-row">
			    <label><{$smarty.const.FEEDBACK_CODE}>:</label>
			    <img border="0" align="left" src="/interactive/captcha.php?zone=site&sid=<{$Captcha->GetGeneratedSID()}>" class="conf-code-image" alt="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>" title="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>, <{$smarty.const.FEEDBACK_CODE_CASE}>" />
			    <input type="hidden" name="captcha[sid]" value="<{$Captcha->GetSID()}>" id="captcha_sid" />
			    <input type="text" name="captcha[code]" value="" maxlength="<{$Captcha->GetCodeLength()}>" class="inputbox conf-code requirefield" id="captcha_code" title="<{$smarty.const.FEEDBACK_CODE_CASE}>" style="width: 130px; margin-left: 20px;"/>
			</div>
			<div class="controls controls-row">
			    <button type="submit" class="btn btn-primary">Комментировать</button>
			</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
    <div class="span3">
	<{include file='core/column-right.tpl'}>
    </div>
</div>

<{* DISPLAY ITEMS LIST IF NOT EMPTY *}>
<{elseif !empty($items)}>
<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic"><{$arCategory.title}></h1>
</hgroup>
<div class="row-fluid">
    <div class="span9 blog-list">
<{section name=i loop=$items}>
	<div class="row-fluid blog-item shadowbox">
	    <div class="date">
		<span><{$items[i].created|date_format:"%d.%m"}></span>
		<span><{$items[i].created|date_format:"%Y"}></span>
	    </div>
	    <h2 class="title"><{$items[i].title}></h2>
	    <div class="descr">
		<{$items[i].descr}>
	    </div>
	    <div class="summary">
		<div class="floatleft">
		    <a class="readmore" href="<{include file='core/href_auto.tpl' arCategory=$items[i].arCategory arItem=$items[i] params=''}>"><i class="icon-share-alt"></i> <{$smarty.const.BUTTON_MORE}></a>
		</div>
<{if $items[i].comments > 0}>
		<div class="floatright muted">
		    <i class="icon-comment"></i> <{$items[i].comments}>
		</div>
<{/if}>
		<div class="clearfix"></div>
	    </div>
	</div>
<{/section}>
<{if $arrPageData.total_pages>1}>
	<div class="row-fluid">
	    <{include file='core/pager_filter.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=0 showFirstLast=0 showPrevNext=0 showAll=0}>
	</div>
<{/if}>
    </div>
    <div class="span3">
	<{include file='core/column-right.tpl'}>
    </div>
</div>

<{* DISPLAY CATEGORY INFO *}>
<{else}>
    <{include file='core/static.tpl'}>
<{/if}>
<!-- Items end-->
