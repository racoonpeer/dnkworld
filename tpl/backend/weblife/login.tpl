<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
<{if !empty($refresh.head)}>
        <{$refresh.head}>
<{/if}>
        <title><{$arrPageData.headTitle}></title>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251">
        <meta http-equiv="imagetoolbar" content="no">
	<link href="/css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<{$arrPageData.css_dir}>admin.css" />
        <link rel="shortcut icon" href="<{$arrPageData.images_dir}>weblife.ico" />
	<script src="/js/jquery/jquery-<{$smarty.const.WLCMS_JQUERY_VERSION}>.min.js" type="text/javascript"></script>
        <script src="/js/jquery/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="/js/bootstrap/bootstrap.js" type="text/javascript"></script>
<{if $bannedTime>0}>
        <script type="text/javascript">
            <!--
            var banTimerID = null;
            function updateBanTimer(){
                var banDate = new Date(<{$bannedTime}>*1000); // seconds*1000 in JavaScripts Milisecons Timestamp
                var nowDate = new Date();
                if( banDate >= nowDate && document.getElementById('banTimer') != null &&
                    nowDate.getFullYear() == banDate.getFullYear() &&
                    nowDate.getMonth()    == banDate.getMonth() &&
                    nowDate.getDate()     == banDate.getDate() ) {
                        var totalRemains = (banDate.getTime()-nowDate.getTime());
                        var RemainsSec=(parseInt(totalRemains/1000));
                        var RemainsFullDays=(parseInt(RemainsSec/(24*60*60)));
                        var secInLastDay=RemainsSec-RemainsFullDays*24*3600;
                        var RemainsFullHours=(parseInt(secInLastDay/3600));
                        //if (RemainsFullHours<10){RemainsFullHours="0"+RemainsFullHours};
                        var secInLastHour=secInLastDay-RemainsFullHours*3600;
                        var RemainsMinutes=(parseInt(secInLastHour/60));
                        //if (RemainsMinutes<10){RemainsMinutes="0"+RemainsMinutes};
                        var lastSec=secInLastHour-RemainsMinutes*60;
                        //if (lastSec<10){lastSec="0"+lastSec};
                        document.getElementById('banTimer').innerHTML = /*RemainsFullHours+" hours "+*/RemainsMinutes+' min '+lastSec+' sec';
                        document.loginForm.Submit2.disabled=true;
                } else if(banTimerID != null) {
                    clearInterval(banTimerID);
                    document.loginForm.Submit2.disabled=false;
                }

            }
            function checkForm(form){
                if(banTimerID != null){
                       form.submit();
                       return true;
                } else form.Submit2.disabled=true;
                return false;
            }
            banTimerID = setInterval("updateBanTimer()", 1000);
            //-->
        </script>
<{/if}>
    </head>
    <body style="background-color: #f5f5f5; padding: 40px 0;">
<{if !empty($refresh.head) or !empty($refresh.body)}>
    <{$refresh.body}>
<{else}>
	<div class="container">
	    <form class="form-signin" name="loginForm" action="" method="post" onsubmit="<{if $bannedTime>0}>return checkForm(this);<{/if}>">
	      <h4 class="form-signin-heading">Welcome to administration <a href="http://weblife.ua" style="text-decoration:none;">&reg;</a></h4>
<{if !empty($messages.top)}>
		<div class="alert alert-error">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <{$messages.top}>
		</div>
<{/if}>
		<input type="text" name="login" value="" class="input-block-level" placeholder="Login" />
		<input type="password" name="pass" class="input-block-level" placeholder="Password" />
		<{if $showCode}>
		<div>
			<img style="float: left; margin: 0px 7px 0px 0px" alt="code" src="/interactive/cv_img.php?zone=admin" border="0">
			<input class="field" type="text" id="fConfirmationCode" name="fConfirmationCode" value="" style="width:73px; margin-top:3px;" maxlength="<{$smarty.const.IVALIDATOR_MAX_LENTH}>" />
		    </td>
		</div>
		<{/if}>
		<button class="btn btn-large btn-primary" name="Submit2" type="submit">Enter</button>
<{if !empty($messages.bottom)}>
		<div class="alert alert-block">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <{$messages.bottom}>
		</div>
<{/if}>
	    </form>
	</div>
    <{*
        <form name="loginForm" action="" method="post" onsubmit="<{if $bannedTime>0}>return checkForm(this);<{/if}>">
            <table width="300" border="" cellspacing="1" cellpadding="0" class="list" style="border:1px solid #CCCCCC; margin:auto; margin-top:200px;" align="center">
                <tr>
                    <td id="head" style="font-size:11px">
                        
                        
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px; height:20px; padding-left:5px;">
                        
                    </td>
                </tr>
                <tr>
                    <td id="body1">
                        <table width="300" border="" cellspacing="1" cellpadding="0" align="center" style="margin:auto;" >
                            <tr>
                                <td style="height:5px;"></td>
                                <td style="height:5px;"></td>
                            </tr>

                            <tr>
                                <td id="body1" style="font-size:11px; height:20px; padding-left:5px;">Login:</td>
                                <td id="body1">
				    
				</td>
                            </tr>

                            <tr>
                                <td id="body1" style="font-size:11px; height:20px; padding-left:5px;">Password:</td>
                                <td id="body1"><input value="" type="password" class="field" style="width:100%;"></td>
                            </tr>
                            <{if $showCode}>
                            <tr>
                                <td id="body1" style="font-size:11px; height:20px; padding-left:5px;" nowrap><label for="fConfirmationCode">Confirmation code: </label></td>
                                <td id="body1">
                                    <img style="float: left; margin: 0px 7px 0px 0px" alt="code" src="/interactive/cv_img.php?zone=admin" border="0">
                                    <input class="field" type="text" id="fConfirmationCode" name="fConfirmationCode" value="" style="width:73px; margin-top:3px;" maxlength="<{$smarty.const.IVALIDATOR_MAX_LENTH}>" />
                                </td>
                            </tr>
                            <{/if}>
                            <tr>
                                <td style="height:5px;"></td>
                                <td style="height:5px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td style="height:5px;"></td></tr>
                <tr>
                    <td align="center" style="font-size:11px; height:20px; padding-left:10px;">
                        <input type="submit" name="Submit2" value="Enter" class="buttons">
                    </td>
                </tr>
                <tr><td style="height:5px;"></td></tr>
                <tr>
                    <td style="font-size:11px; height:5px; padding-left:10px; padding-right:5px;" align="center">
                        <{$messages.bottom}>
                    </td>
                </tr>
                <tr><td style="height:5px;"></td></tr>
            </table>
        </form>
	*}>
<{/if}>
    </body>
</html>