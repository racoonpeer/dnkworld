 tinyMCE.init({
    // General options
    mode        : "exact",
    elements    : "textintro,categorytext,categorydescr,description,fulldescription,ajaxfilemanager",
    theme       : "advanced",
    skin    	: "o2k7",
    plugins 	: "imagemanager,filemanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

    // Theme options
    theme_advanced_buttons1 : "newdocument,|,cut,copy,paste,pastetext,pasteword,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "undo,redo,|,restoredraft,cleanup,|,search,replace,|,outdent,indent,blockquote,|,forecolor,backcolor,|,link,unlink,anchor,image,insertfile,media,insertdate,inserttime,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,template",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,nonbreaking,emotions,iespell,advhr,pagebreak,|,print,|,ltr,rtl,|,visualchars,code,preview,fullscreen,help",
    theme_advanced_toolbar_location 	: "top",
    theme_advanced_toolbar_align 	: "left",
    theme_advanced_statusbar_location 	: "bottom",
    theme_advanced_resizing 		: false,

    //force_br_newlines : true,

    relative_urls : false,
    //convert_urls : false,

    // http://tinymce.moxiecode.com/wiki.php/Configuration:valid_elements
//    valid_elements: "",
//    extended_valid_elements: "",
//    invalid_elements: "",

    // Example content CSS (should be your site CSS)
    content_css : "/js/tiny_mce_ext/css/content.css",

    // default interface language
    language    : "ru",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url  : "/js/tiny_mce_ext/lists/template_list.js",
    external_link_list_url      : "/js/tiny_mce_ext/lists/link_list.js",
    external_image_list_url     : "/js/tiny_mce_ext/lists/image_list.js",
    media_external_list_url     : "/js/tiny_mce_ext/lists/media_list.js",

    // Style formats
    style_formats : [
        {title : 'Bold text', inline : 'b'},
        {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
        {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
        {title : 'Example 1', inline : 'span', classes : 'example1'},
        {title : 'Example 2', inline : 'span', classes : 'example2'},
        {title : 'Table styles'},
        {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ],

    // Replace values for the template plugin
    template_replace_values : {
        username : "Some User",
        staffid : "991234",
        count : "1"
    }
});

function toggleEditor(id) {
    if (!tinyMCE.get(id))
         tinyMCE.execCommand('mceAddControl', false, id);
    else tinyMCE.execCommand('mceRemoveControl', false, id);
}
