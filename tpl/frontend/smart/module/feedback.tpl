<hgroup class="row-fluid heading-title">
    <h1 class="title-serif italic"><{$arCategory.title}></h1>
</hgroup>
<div class="row-fluid">
    <div class="span9">
	<div class="story shadowbox">
<{if !empty($arCategory.text)}>
	    <br/>
	    <article>
    <{$arCategory.text}>
	    </article>
	    <{include file='core/social.tpl'}>
<{/if}>
	    <fieldset><legend><{$smarty.const.FEEDBACK}></legend></fieldset>
<{if !empty($arrPageData.errors) OR !empty($arrPageData.messages)}>
	    <div class="alert alert-<{if !empty($arrPageData.errors)}>error<{elseif !empty($arrPageData.messages)}>success<{/if}>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
<{if !empty($arrPageData.errors)}>
		    <{$arrPageData.errors|@implode:'<br/>'}>
<{elseif !empty($arrPageData.messages)}>
		    <{$arrPageData.messages|@implode:'<br/>'}>
<{/if}>
	    </div>
<{/if}>
	    <form class="form-horizontal" action="" method="POST" onsubmit="return formCheck(this);">
		<div class="control-group">
		    <label class="control-label"><mark>* </mark><{$smarty.const.FEEDBACK_FIRST_NAME}>:</label>
		    <div class="controls">
			<input type="text" name="firstname" value="<{if isset($item.firstname)}><{$item.firstname}><{/if}>" class="span8 requirefield" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><mark>* </mark><{$smarty.const.FEEDBACK_EMAIL}>:</label>
		    <div class="controls">
			<input type="text" name="email" value="<{if isset($item.email)}><{$item.email}><{/if}>" class="span8 requirefield" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><mark>* </mark><{$smarty.const.FEEDBACK_STRING_TEXT}>:</label>
		    <div class="controls">
			<textarea name="text" rows="5" class="span8 requirefield"><{if isset($item.text)}><{$item.text}><{/if}></textarea>
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><mark>* </mark><{$smarty.const.FEEDBACK_CODE}>:</label>
		    <div class="controls">
			<img border="0" align="left" src="/interactive/captcha.php?zone=site&sid=<{$Captcha->GetGeneratedSID()}>" alt="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>" title="<{$smarty.const.FEEDBACK_CONFIRMATION_CODE}>, <{$smarty.const.FEEDBACK_CODE_CASE}>" />
			<input type="hidden" name="captcha[sid]" value="<{$Captcha->GetSID()}>" />
			<input type="text" name="captcha[code]" value="" maxlength="<{$Captcha->GetCodeLength()}>" class="span3 requirefield" title="<{$smarty.const.FEEDBACK_CODE_CASE}>" style="margin-left: 14px; width: 150px;"/>
		    </div>
		</div>
		<div class="form-actions">
		    <button class="btn" type="submit"><{$smarty.const.FEEDBACK_STRING_SEND}></button>
		</div>
	    </form>
	</div>
    </div>
    <div class="span3">
	<{include file="core/column-right.tpl"}>
    </div>
</div>
<script type="text/javascript">
    function formCheck(form){
	var regExpEmail = new RegExp("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$");
	var regExpPhone = new RegExp("^([0-9 \-]{7,17})$");
	var errors      = 0;
	$.each($(form).find('.requirefield'), function(i, input) {
	    if (input.value.length==0 || (input.name=='email' && input.value.match(regExpEmail) == null)){
		$(input).focus();
		$(input).parent().parent().addClass('error');
		errors++;
	    } else {
		$(input).parent().parent().removeClass('error');
	    }
	});
	if(errors==0) {
	    return true;
	} else {
	    alert("<{$smarty.const.FEEDBACK_ALERT_ERROR}>");
	    return false;
	}
    }
</script>