/* 
         Optional: Temporarily hide the "tabber" class so it does not "flash"
         on the page as plain HTML. After tabber runs, the class is changed
         to "tabberlive" and it will appear.
document.write('<style type="text/css">.tabber{display:none;}<\/style>');

var tabberOptions = {
         Optional: instead of letting tabber run during the onload event,
         we'll start it up manually. This can be useful because the onload
         even runs after all the images have finished loading, and we can
         run tabber at the bottom of our page to start it up faster. See the
         bottom of this page for more info. Note: this variable must be set
         BEFORE you include tabber.js.
  'manualStartup':true,

        Optional: code to run after each tabber object has initialized
  'onLoad': function(argsObj) { //Display an alert only after tab2 
    if (argsObj.tabber.id == 'tab2') {
      alert('Finished loading tab2!');
    }
  },

         Optional: code to run when the user clicks a tab. If this
         function returns boolean false then the tab will not be changed
         (the click is canceled). If you do not return a value or return
         something that is not boolean false,
  'onClick': function(argsObj) {
    var t = argsObj.tabber; // Tabber object 
    var id = t.id; // ID of the main tabber DIV 
    var i = argsObj.index; // Which tab was clicked (0 is the first tab) 
    var e = argsObj.event; // Event object 
    if (id == 'tab2') {
      return confirm('Swtich to '+t.tabs[i].headingText+'?\nEvent type: '+e.type);
    }
  },

        Optional: set an ID for each tab navigation link 
  'addLinkId': true
};*/

document.write('<style type="text/css">.tabber{display:none;}<\/style>');

var tabberOptions = {
  'onClick': function(argsObj) {
      updateTabContent(argsObj, this.tabs[argsObj.index].div);
  }
};

function updateTabContent(argsObj, tab){
    var prdID   = parseInt(argsObj.tabber.id.replace('productID_', ''));
    var sTabID  = '#'+argsObj.tabber.id+' ';
    var options = getAuctionsOptions();
    
    switch(argsObj.index){
        case 0: //Product info update
            $('.tabbertabtext', tab).html(options.loader); // Display a loading message
            $.getJSON(
                "/interactive/ajax.php",
                {zone: "site", action: "ajaxGetProduct", productID:prdID},
                function(data){
                    if(data.result) options.html = data.arProduct.fulldescr;
                    $('.tabbertabtext', tab).html(options.html);
                }
            ).error(function() {
                $('.tabbertabtext', tab).html(options.error);
            }); 
            break;

        case 1: // Auctions Info update
            $.each(options.tables, function(ind, table) {
                // Remove all items
                $('.tabbertabtext .product-'+table+' .item', tab).remove();
                // Display a loading message
                $('<tr/>', { 'class': 'item', html: '<td colspan="3">'+options.loader+'</td></tr>' }).appendTo(sTabID+'.tabbertabtext .product-'+table+' table'); 
            });
            $.getJSON(
                "/interactive/ajax.php",
                {zone: "site", action: "ajaxGetAuctions", productID:prdID, ordered:''},
                function(data){
                    $.each(data.arrAuctions, function(key, items) {
                        var lines = [];
                        $.each(items, function(ind, item) {
                            lines.push(fillTemplate(item, 2));
                        });
                        if(lines.length){
                            $('.tabbertabtext .product-'+key+' .item', tab).remove();
                            $(lines.join('')).appendTo(sTabID+'.tabbertabtext .product-'+key+' table');
                        } else $('.tabbertabtext .product-'+key+' .item td', tab).html(options.html);
                    });

                    $.each(options.tables, function(ind, table) {
                        // Display a loading empty message
                        if(!data.arrAuctions.hasOwnProperty(table)) $('.tabbertabtext .product-'+table+' .item td', tab).html(options.html);
                    });

                }
            ).error(function() {
                $.each(options.tables, function(ind, table) {
                    // Display a loading message
                    $('.tabbertabtext .product-'+table+' .item td', tab).html(options.error);
                });
            });       
            break;
        default:break;
    }
}