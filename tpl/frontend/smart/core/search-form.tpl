<!-- ++++++++++++++ Start Quick Search Form Wrapper ++++++++++++++++++++++++ -->
                                    <div class="bt-outer"><div class="bt-inner">
                                        <div class="rel"><div class="t-text"><span><{$arrModules.search.title}></span></div></div>
                                    </div></div>
                                    <div class="bc-outer"><div class="bc-inner search-block">
                                        <div class="item form">
                                            <div style="float:left;margin-right:5px;" class="input input-search input-182"><div>
                                                <form method="post" action="<{include file='core/href.tpl' arItem=$arrModules.search}>" name="qSearchForm">
                                                    <input type="hidden" id="qSearchFormType" name="swhere" value="<{if !empty($arrPageData.swhere)}><{$arrPageData.swhere}><{else}>all<{/if}>" />
                                                    <input type="text" id="qSearchFormText" name="stext" value="<{if !empty($arrPageData.stext)}><{$arrPageData.stext}><{else}><{$smarty.const.SITE_SEARCH}><{/if}>" onfocus="if(this.value=='<{$smarty.const.SITE_SEARCH}>') this.value='';liveSearch(this);" onblur="if(this.value=='') this.value=''; " />
                                                    <input type="submit" id="qSearchFormSubmit" name="ssubmit" value="<{$smarty.const.SITE_FOUND}>" style="display:none;" />
                                                </form>
                                            </div></div>
                                            <a style="float:left" class="input-btn" href="javascript:void(0);" onclick="if(document.qSearchForm.stext.value=='<{$smarty.const.SITE_SEARCH}>'){ document.qSearchForm.stext.value=''; document.qSearchForm.stext.focus(); }else{ document.qSearchForm.submit(); }"><span><{$smarty.const.SITE_FOUND}></span></a>
                                            <div class="search-example" ><{$smarty.const.LABEL_EXAMPLE}>: <a href="#" onclick="document.getElementById('qSearchFormText').value='<{$smarty.const.LABEL_SEARCH_EXAMPLE}>'; return false;"><{$smarty.const.LABEL_SEARCH_EXAMPLE}></a></div>
                                        </div>
                                    </div></div>
                                    <div class="bb-outer"><div class="bb-inner"></div></div>
<!-- ++++++++++++++ End Quick Search Form Wrapper ++++++++++++++++++++++++++ -->

<script type="text/javascript">
    function liveSearch(input) {
	$(input).bind('change', function() {
	    if($(this).val().length) {
		$.ajax({
		    url: '/interactive/ajax.php?zone=site&action=liveSearch',
		    type: 'POST',
		    data: {stext: utf8_encode($(this).val())},
		    dataType: 'json',
		    success: function(json) {
			if(json.output) {
			    $('div.search-example').html(json.output);
			    $('div.search-example ul > li > a').bind('click', function(){
				event.preventDefault();
				$(input).val($(this).text());
				$(this).parent().parent().remove();
			    });
			}
		    }
		});
	    }
	});
    }
    
     function utf8_encode(str){
	if (str == null){ 
	    return null;
	}
	var result = "";
	var o_code = "";
	var i_code = "";
	for (var I = 0; I < str.length; I++){ 
	    i_code = str.charCodeAt(I);
	    if (i_code == 184){
		o_code = 1105;
	    } else if (i_code == 168){
		o_code = 1025;
	    } else if (i_code > 191 && i_code < 256){ 
		o_code = i_code + 848; 
	    } else { 
		o_code = i_code; 
	    }
	    result += String.fromCharCode(o_code); 
	} 
	return result;
    }
</script>