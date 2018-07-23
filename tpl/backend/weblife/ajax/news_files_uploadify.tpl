<script type="text/javascript">
    $(document).ready(function() {
        // LINK: http://www.uploadify.com/documentation/
        // правил строку 174 в файле /js/jquery/uploadify/jquery.uploadify.v2.1.4.js (в .min также), 
        // т.е. добавлял 4 аргумент в функцию cancelFileUpload(key,true,true,false);
        var scriptURL = '/interactive/ajax.php?zone=admin&action=ajaxNewsFilesUpload&<{$smarty.const.WLCMS_SESSION_NAME}>=<{$sessionID}>&PID=<{$arrPageData.pid}>&module=<{$arrPageData.pmodule}>&file_prefix=<{$arrPageData.userfileprefix}>';
        $('#userFile').uploadify({
            'queueID'        : 'fileQueue',
            'uploader'       : '/js/jquery/uploadify/uploadify.swf',
            'script'         : encodeURIComponent(scriptURL+'&uploadifyData=1&files_params=<{$arrPageData.files_params|serialize|base64_encode|urlencode}>'),
            'checkScript'    : encodeURIComponent(scriptURL+'&uploadifyCheck=1'),
            'expressInstall' : '/js/jquery/uploadify/images/expressInstall.swf',
            'cancelImg'      : '/js/jquery/uploadify/images/cancel.png',
            'buttonImg'      : '/js/jquery/uploadify/images/select_<{$lang}>.png',
            'rollover'       : true,
            'align'          : 'center',
            'width'          : 110,
            'height'         : 30,
            'multi'          : true,
            'queueSizeLimit' : '<{$arrPageData.user_can_upload}>',
            'folder'         : '<{$arrPageData.pmodule}>',
            'fileDataName'   : 'Filedata',
            'fileExt'        : '*.jpg;*.jpeg;*.gif;*.png',
            'fileDesc'       : 'Image Files (.jpg, .jpeg, .gif, .png)',
            'onCheck'        : function(event, data, key) {
                $('#userFile' + key).fadeTo('fast', 0.5, function(){ 
                    $('.percentage', this).addClass('itemExists').text(' - Exists');
                });
            },
            'onQueueFull'    : function (event, queueSizeLimit) {
                var msg;
                if(queueSizeLimit==0) msg = "The maximum files by user is <{$arrPageData.userfilesmax}>, so upload else impossible. Delete unused files and upload again another!";
                else msg = "The maximum size of the queue "+queueSizeLimit+" is full";
                $.jGrowl(msg, {
                    theme:  'error',
                    header: 'Queue is Full',
                    life:   4000,
                    sticky: false
                });
                return false;
            }, 
            'onClearQueue'   : function (event) {
                var msg = "The queue has been cleared.";
                $.jGrowl('<p></p>'+msg, {
                    theme: 	'warning',
                    header: 'Cleared Queue',
                    life:	4000,
                    sticky: false
                });
            },
            'onCancel'       : function (event, ID, fileObj, data) {
                var msg = "Cancelled uploading: "+fileObj.name;
                $.jGrowl('<p></p>'+msg, {
                    theme: 	'warning',
                    header: 'Cancelled Upload',
                    life:	4000,
                    sticky: false
                });
            },
            'onError'        : function (event, ID, fileObj, errorObj) {
                var msg;
                if (errorObj.type==="File Size")
                     msg = 'File: '+fileObj.name+'<br/>Error: '+errorObj.type+' Limit is '+Math.round(errorObj.info/1024)+'KB';
                else msg = 'Error type: '+errorObj.type+"<br/>Error Message: "+errorObj.info;
                $.jGrowl('<p></p>'+msg, {
                    theme: 	'error',
                    header: 'ERROR',
                    sticky: true
                });
                //$("#userFile" + ID).fadeOut(250, function() { $("#userFile" + ID).remove()});
                //return false;
            },
            'onComplete'     : function (event, ID, fileObj, response, data) {
                var size = Math.round(fileObj.size/1024);
                $.jGrowl('<p></p>'+fileObj.name+' - '+size+'KB', {
                    theme: 	'success',
                    header: 'Upload Complete',
                    life:	4000,
                    sticky: false
                });
            },
            'onAllComplete'  : function(event, data) {
                window.location.reload();
            }
        });       
    });
</script>
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
<div class="row-fluid">
    <div class="span6" id="upload_box">
	<fieldset><legend><{$smarty.const.FILES_UPLOAD_MULTIPLE_SELECT_FILES}>:</legend>
	    <div id="upload_links_box">
		<div id="userFile"><{$smarty.const.FILES_UPLOAD_ERROR_JAVASCRIPT}></div>
		<div id="fileQueue"></div>
		<a class="btn" href="javascript:<{*ajaxFormValidate('#userFile');*}>$('#userFile').uploadifyUpload();"><{$smarty.const.FILES_UPLOADIFY_DOWNLOAD}></a>&nbsp;&nbsp;
		<a class="btn" href="javascript:$('#userFile').uploadifyClearQueue();"><{$smarty.const.FILES_UPLOADIFY_CLEAR}></a>
	    </div>
	</fieldset>
    </div>
    <div class="span6">
	<fieldset>
	    <legend><{$smarty.const.FILES_UPLOADIFY_ADDED}>:</legend>
	</fieldset>
	<div class="controls controls-row">
	    <table width="100%" cellspacing="5" cellpadding="0" border="0" class="table table-bordered table-hover admin-list tinytable">
		<thead>
		    <tr>
			<th class="center"><{$smarty.const.HEAD_ID}></th>
			<th><{$smarty.const.HEAD_NAME}></th>
			<th class="center"><{$smarty.const.HEAD_PUBLICATION}></th>
			<th class="center"><{$smarty.const.HEAD_DELETE}></th>
		    </tr>
		</thead>
		<tbody>
<{section name=i loop=$items}>
		    <tr>
			<td class="center">
			    <{$items[i].id}>
			</td>
			<td>
			    <a href="<{$arrPageData.files_url|cat:$items[i].filename}>" onclick="return parent.hs.expand (this, { })" class="highslide">
				<{$items[i].filename}>
			    </a>
			</td>
			<td class="center">
<{if $items[i].active==1}>
			    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=publishItem&status=0&itemID="|cat:$items[i].id}>" title="Publication">
				<img src="<{$arrPageData.system_images}>check.gif" alt="Publication" title="Publication" />
			    </a>
<{else}>
			    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=publishItem&status=1&itemID="|cat:$items[i].id}>" title="No Publication">
				<img src="<{$arrPageData.system_images}>un_check.gif" alt="No Publication" title="No Publication" />
			    </a>
<{/if}>
			</td>
			<td class="center">
			    <a href="<{$arrPageData.current_url|cat:$arrPageData.filter_url|cat:"&task=deleteItem&itemID="|cat:$items[i].id}>" onclick="return confirm('Вы уверены что хотите удалить файл?');" title="Delete!">
			       <img src="<{$arrPageData.system_images}>delete.gif" alt="Delete!" title="Delete!" />
			    </a>
			</td>
		    </tr>
<{/section}>
		</tbody>
	    </table>
	</div>
<{if $arrPageData.total_pages>1}>
	<div class="controls controls-row">
<!-- ++++++++++ Start PAGER ++++++++++++++++++++++++++++++++++++++++++++++++ -->
	    <{include file='pager.tpl' arrPager=$arrPageData.pager page=$arrPageData.page showTitle=1 showFirstLast=0 showPrevNext=0 subClass='centered'}>
<!-- ++++++++++ End PAGER ++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</div>
<{/if}>	
	<div class="form-actions">
	    <a class="btn btn-info" href="javascript:void(0)" onclick="window.location.reload();" title="<{$smarty.const.BUTTON_RELOAD}>"><{$smarty.const.BUTTON_RELOAD}></a>&nbsp;&nbsp;
	    <a class="btn btn-warning" href="javascript:void(0)" onclick="parent.window.hs.close();" title="<{$smarty.const.BUTTON_EXIT}>"><{$smarty.const.BUTTON_EXIT}></a>
	</div>
    </div>
</div>