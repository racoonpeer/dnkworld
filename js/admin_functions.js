
function popUp(url) {
    var arWindowInfo = new Array();
    arWindowInfo['w'] = 640;
    arWindowInfo['h'] = 480;
    arWindowInfo['l'] = 300;
    arWindowInfo['t'] = 200;
    popUpExact(url, arWindowInfo);
}

function popUpExact(url, arWindowInfo) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(url, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width="+arWindowInfo['w']+",height="+arWindowInfo['h']+",left="+arWindowInfo['l']+",top="+arWindowInfo['t']+"');");
}

function manageSelections(bt, sel1, sel2) {
    if(bt.checked){
        sel1.disabled = true;
        sel2.disabled = false;
    } else {
        sel1.disabled = false;
        sel2.disabled = true;
    }
}

function hideApplyBut(sel, but, parentID) {
    if(parentID != sel.value){
        but.style.display='none';
    } else if(parentID == sel.value){
        but.style.display='';
    }
}

function toggleBox(a, elementId) {
    if($('#'+elementId).css('display')=='none'){
        $('#'+elementId).css('display', '');
        $(a).removeClass( 'down' );
        $(a).addClass( 'up' );
    } else {
        $('#'+elementId).css('display', 'none');
        $(a).removeClass( 'up' );
        $(a).addClass( 'down' );
    }
}

function toggleByClass(a, elementId, classname) {
    if($('#'+elementId+' .'+classname).hasClass('hide')){
        $('#'+elementId+' .'+classname).removeClass('hide');
        $(a).removeClass( 'down' );
        $(a).addClass( 'up' );
    } else {
        $('#'+elementId+' .'+classname).addClass('hide');
        $(a).removeClass( 'up' );
        $(a).addClass( 'down' );
    }
}

function clearInput(elementId) {
    document.getElementById(elementId).value = '';
}

function generateSeoPath(obj, str, pref){
    $.getJSON(
        "/interactive/ajax.php",
        {zone: "admin", action: "generateSeoPath", path: str, prefix: pref},
        function(data, textStatus){
            if(textStatus=='success'){
                if(data.seo_path!='') obj.value = data.seo_path;
            }
        }
    );
}

function toggleFormState(form, page) {
    var arTargets;
    switch (page) {
	case 'main':
	    arTargets = '.description-data, .image-data, .seo-data';
	    $(document).find(arTargets).each(function(i, el){
		if(form.redirectid.value.length > 0 || form.redirecturl.value.length > 0 || form.redirectype.checked) {
		    $(el).hide();
		} else {
		    $(el).show();
		}
	    });
	    break;
    }
}