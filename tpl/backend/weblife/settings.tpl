<div class="hero-unit">
    <h3><{$smarty.const.TITLE_SETTINGS}></h3>
</div>
    
<{if !empty($arrPageData.errors) OR !empty($arrPageData.messages)}>
<div class="row-fluid">
    <div class="alert <{if !empty($arrPageData.errors)}>alert-error<{elseif !empty($arrPageData.messages)}>alert-success<{/if}>">
	<button type="button" class="close" data-dismiss="alert">X</button>
    <{if !empty($arrPageData.errors)}>
	<{$arrPageData.errors|@implode:'<br/>'}>
    <{elseif !empty($arrPageData.messages)}>
	<{$arrPageData.messages|@implode:'<br/>'}>
    <{/if}>
    </div>
</div>
<{/if}>

<form method="post" action="<{$arrPageData.current_url}><{if $arrPageData.itemID OR $item.id}>&itemID=<{if $arrPageData.itemID}><{$arrPageData.itemID}><{else}><{$item.id}><{/if}><{/if}>" name="settingsForm" onSubmit="return formCheck(this);">
    <div class="row-fluid">
	<div class="span6">
	    <fieldset class="form-horizontal">
		<legend><{$smarty.const.SETTINGS_OWNER}></legend>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_FIRST_NAME}>:</label>
		    <div class="controls">
			<input name="ownerFirstName" type="text" value="<{$item.ownerFirstName}>" class="span9" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_LAST_NAME}>:</label>
		    <div class="controls">
			<input name="ownerLastName" type="text" value="<{$item.ownerLastName}>" class="span9" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_EMAIL}>:</label>
		    <div class="controls">
			<input name="ownerEmail" type="text" value="<{$item.ownerEmail}>" class="span9" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_PHONE}>:</label>
		    <div class="controls">
			<input name="ownerPhone" type="text" value="<{$item.ownerPhone}>" class="span9" />
		    </div>
		</div>
	    </fieldset>
	</div>
	<div class="span6">
	    <fieldset class="form-horizontal">
		<legend><{$smarty.const.SETTINGS_WEBSITE}></legend>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_WEBSITE_NAME}>:</label>
		    <div class="controls">
			<input name="websiteName" type="text" value="<{$item.websiteName}>" class="span9" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_WEBSITE_URL}>:</label>
		    <div class="controls">
			<input name="websiteUrl" type="text" value="<{$item.websiteUrl}>" class="span9" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_WEBSITE_SLOGAN}>:</label>
		    <div class="controls">
			<input name="websiteSlogan" type="text" value="<{$item.websiteSlogan}>" class="span9" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label"><{$smarty.const.SETTINGS_WEBSITE_LOGO}>:</label>
		    <div class="controls">
			<input name="logo" type="text" value="<{$item.logo}>" class="span9" />
    <{if !empty($item.logo)}>
			<span class="help-inline">
			    <img align="top" src="<{$item.logo}>" width="16" alt=""/>
			</span>
    <{/if}>
		    </div>
		</div>
	    </fieldset>
	</div>
    </div>
    <div class="row-fluid">
	<fieldset>
	    <legend><{$smarty.const.LABEL_COMMON_SYSTEM_SETTINGS}></legend>
	    <div class="controls controls-row">
		<label><{$smarty.const.SETTINGS_SITE_EMAIL}>:</label>
		<input name="siteEmail" type="text" value="<{$item.siteEmail}>" class="span6" />
	    </div> 
	    <div class="controls controls-row">
		<label><{$smarty.const.SETTINGS_NOTIFY_EMAIL}>:</label>
		<input name="notifyEmail" type="text" value="<{$item.notifyEmail}>" class="span6" />
	    </div> 
	    <div class="controls controls-row">
		<label><{$smarty.const.SETTINGS_ADDRESS}>:</label>
		<textarea name="ownerAddress" rows="4" class="span6"><{$item.ownerAddress}></textarea>
	    </div> 
	    <div class="controls controls-row">
		<label><{$smarty.const.SETTINGS_COPYRIGHT}>:</label>
		<textarea name="copyright" rows="4" class="span6"><{$item.copyright}></textarea>
	    </div> 
	</fieldset>
    </div>
<{*
    <div class="row-fluid">
	<fieldset>
	    <legend><{$smarty.const.LABEL_EXTRA_SYSTEM_SETTINGS}></legend>
	</fieldset>
    </div>

    <div class="row-fluid">
	<div class="span4">
	    <label>Extra field 1:</label>
	    <textarea name="extra1" rows="4" class="span12"><{$item.extra1}></textarea>
	</div>
	<div class="span4">
	    <label>Extra field 2:</label>
	    <textarea name="extra2" rows="4" class="span12"><{$item.extra2}></textarea>
	</div>
	<div class="span4">
	    <label>Extra field 3:</label>
	    <textarea name="extra3" rows="4" class="span12"><{$item.extra3}></textarea>
	</div>
    </div>
*}>
    <div class="row-fluid">
	<div class="form-actions">
	    <button name='submit' class='btn btn-primary btn-large' type='submit' onclick="return formCheck(this.form);"><{$smarty.const.BUTTON_SAVE}></button>
	</div>
    </div>
</form>

<div class="row-fluid">
    <fieldset>
	<legend><{$smarty.const.LABEL_EXTRA_SYSTEM_SETTINGS}></legend>
	<div class="controls controls-row" style="text-align: center;">
	    <div class="btn-group">
<{if !$smarty.const.TPL_BACKEND_FORSE_COMPILE || !$smarty.const.TPL_FRONTEND_FORSE_COMPILE}>
		<button class="btn btn-large" name="clearTemplatesButton" onclick="if(window.confirm('<{$smarty.const.LABEL_QUESTION_TO_DO}>?')) {window.location='<{$arrPageData.current_url|cat:"&task=clearTemplates"}>'}; return false;"><{$smarty.const.LABEL_CLEAR_TEMPLATES}></button>
<{/if}>
<{if $smarty.const.TPL_BACKEND_CACHING || $smarty.const.TPL_FRONTEND_CACHING}>
		<button class="btn btn-large" name="clearCacheButton" onclick="if(window.confirm('<{$smarty.const.LABEL_QUESTION_TO_DO}>?')) {window.location='<{$arrPageData.current_url|cat:"&task=clearCache"}>'}; return false;"><{$smarty.const.LABEL_CLEAR_CASHING}></button>
<{/if}>
		<button class="btn btn-large" name="repairDBTButton" onclick="if(window.confirm('<{$smarty.const.LABEL_QUESTION_TO_DO}>?')) {window.location='<{$arrPageData.current_url|cat:"&task=repairDBTables"}>'}; return false;"><{$smarty.const.LABEL_REPAIR_DB_TABLES}></button>
		<button class="btn btn-large" name="optimizeDBTButton" onclick="if(window.confirm('<{$smarty.const.LABEL_QUESTION_TO_DO}>?')) {window.location='<{$arrPageData.current_url|cat:"&task=optimizeDBTables"}>'}; return false;"><{$smarty.const.LABEL_OPTIMIZE_DB_TABLES}></button>
	    </div>    
	</div>
    </fieldset>
</div>
<script type="text/javascript">
    function formCheck(form){
    }
</script>