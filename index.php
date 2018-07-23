<?php 
 /*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
define('WEBlife', 1);  //Set flag that this is a parent file
define('WLCMS_ZONE', 'FRONTEND'); //Set flag that this is a site area

//Include Core File
require('kernel.php');


# ##############################################################################
// /////////////////// OPERATIONS BEFORE DISPLAY \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 $Cookie->process();
// \\\\\\\\\\\\\\\\\ END OPERATIONS BEFORE DISPLAY /////////////////////////////
# ##############################################################################


# ##############################################################################
// ///////////////////////// SMARTY DISPLAY \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->display(getTemplateFileName($ajax, $catid), $cacheID);
// \\\\\\\\\\\\\\\\\\\\\\\ END SMARTY DISPLAY //////////////////////////////////
# ##############################################################################
