<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (sales@designburo.nl)                              //
//  http://www.designburo.nl                                                 //
//  Project: Xurl   v1.2                                                     //
//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
//  only subject to the terms and conditions set forth in the                //
//  Open Public License, v1.0 or later.                                      //
//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
//  ------------------------------------------------------------------------ //
define('_XURL_SUBMIT','Shorten');
define('_XURL_SANITIZE','Sanitize text');
define('_XURL_S_SUBMIT','Sanitize');
define('_XURL_WRONG_URL','The URL you have provided is not a valid url.');

// admin section
define('_AM_XURL_TAB1','About');
define('_AM_XURL_TAB1_HEAD','Welcome to Xurl');
define('_AM_XURL_TAB1_FOOT1','Xurl is part of the ');
define('_AM_XURL_TAB1_FOOT2','line of products');
define('_AM_XURL_TAB2','Settings');
define('_AM_XURL_TAB2_HEAD','<h2>Xurl Settings</h2><BR>Please make sure all the settings are correct.<BR>We need the 
MySQL settings for redirecting people who click on a link and are not registered users of your site. Without the MySQL information, XOOPS will always 
check to see if a user is registered.<BR>The SQL settings should be all fine, the other settings are most likely the ones you need to alter.');
define('_AM_XURL_TAB2_HEAD2','<b>Settings</b>');

define('_AM_XURL_UPAGE','Go to Xurl userpage (front site)');
//tab1
define('_AM_XURL_VERSION','Version');
define('_AM_XURL_DESC','Description');
define('_AM_XURL_AUTHOR','Author');
define('_AM_XURL_LCNSE','License');
define('_AM_XURL_STATUS','Status');
define('_AM_XURL_RELEASED','Released');

//tab2
define('_AM_XURL_SET_TABLEH1','Name');
define('_AM_XURL_SET_TABLEH2','Value');
define('_AM_XURL_SET_TABLEH3','Description');
define('_AM_XURL_SET_FOOTER','Last settings save: ');
define('_AM_XURL_SET_FOOTER_ERR','Unable to write the configuration file. Please make sure it has the correct write attributes set!');

define('_AM_XURL_YES','Yes');
define('_AM_XURL_NO','No');
define('_AM_XURL_SET_BASE','Basehref');
define('_AM_XURL_SET_BASE_D','The basename for redirecting urls, e.g. http://www.xoops.org/. Do not forget the ending slash.');
define('_AM_XURL_SET_ERR','Error url');
define('_AM_XURL_SET_ERR_D','If a shortened url is requested that does not exist, where should the person who clicked on the url go to?');
define('_AM_XURL_SET_RESTRICT','Restricted access?');
// Edited in v1.2
define('_AM_XURL_SET_RESTRICT_D','When set, only registered users from your website can click on a shortened URL and be referred, non registered user will be referred to the restriction URL.');
// end edited in v1.2
define('_AM_XURL_SET_RESTR_R','Restricted redirect URL');
define('_AM_XURL_SET_RESTR_R_D','If Restricted access is set, where do unregistered visitors go to? (e.g. if a user clicks on a shortened url, but registricted access is set to yes, to what websiteaddress should they be referred?) Be sure that this URL is allowed access to unregistered users (e.g. anonymous users).');

define('_AM_XURL_SET_SAVE','Save settings');


// Added version 1.1
define('_AM_XURL_TAB3','Manage');
define('_AM_XURL_TAB4','Help');
define('_XURL_INDEX_TEXT','<h1>Xurl</h1>Shortens long URLs for use in e.g. Twitter<BR />In this case it is using the 2lk.nl shorten service provider.<BR />Anyone registered to EasyTCPtransfer can use this!<BR /><BR />');
define('_XURL_INDEX2_TEXT','<h1>Xurl</h1>Shortens long URLs for use in e.g. Twitter<BR />We do not recommend using this feature for anonymous users.<BR /><BR />');
define('_AM_XURL_STAT_C1','Key');
define('_AM_XURL_STAT_C2','URL');
define('_AM_XURL_STAT_C3','User');
define('_AM_XURL_STAT_C4','Hits');
define('_AM_XURL_STAT_INTRO1','We have ');
define('_AM_XURL_STAT_INTRO2','shortened URLs in our database.');
define('_AM_XURL_STAT_INTRO3','Showing records ');
define('_AM_XURL_STAT_INTRO4','Click on a columnname to sort the column, click on the ascending and descending icons to make it so and click on a username to show only Xurls from that user.');
define('_AM_XURL_STAT_INTRO5','Showing Xurls filtered for user: ');
define('_AM_XURL_STAT_INTRO6','click here to show all records.');
define('_AM_XURL_STAT_NEXT','NEXT >>>');
define('_AM_XURL_STAT_PREV','<<< PREVIOUS');

// End added version 1.1

// Added in v1.2

define('_AM_XURL_SET_QR','Use QRCode in Xurl module?');
define('_AM_XURL_SET_QR_D','When set, QRCodes will be created for shortened URLs.');
define('_AM_XURL_SET_QR_PLUGIN','Use Xurl in plugins?');
define('_AM_XURL_SET_QR_PLUGIN_D','Yes, will allow other (modified) modules to shorten URLs. No will turn their usage of Xurl off.');
define('_AM_XURL_STAT_C5','Restricted');
define('_AM_XURL_STAT_C6','Group');
define('_AM_XURL_STAT_C7','Date added');
define('_AM_XURL_STAT_C8','Last click');
define('_AM_XURL_STAT_C9','#Spam');
define('_XURL_MAN_NODEL','You are not allowed to user this feature');
define('_XURL_MAN_NOOWN','You are not the owner of this URL');
define('_XURL_MAN_SQLERR','SQL error deleting this record');
define('_XURL_MAN_NOURL','Could not find this shortened URL');
define('_XURL_MAN_SUCCESS',' has been removed.');
define('_XURL_MAN_SHOW1','show');
define('_XURL_MAN_SHOW2','Shortened URL manager');
define('_XURL_MAN_CREA1','You have created');
define('_XURL_MAN_CREA2','short URLs');
define('_XURL_MAN_S_URL','Shortened URL');
define('_XURL_MAN_O_URL','Original URL');
define('_XURL_MAN_DATE','Created');
define('_XURL_MAN_LCLICK','Last visit');
define('_XURL_MAN_HITS','Hits');
define('_XURL_MAN_DEL','Delete');
define('_XURL_NEW_URL','New shortened url');
define('_XURL_STO_URL','Stored url');
define('_XURL_ORI_URL','Original url');
define('_XURL_WRONG_PASS','Wrong password.');
define('_XURL_SAN_TXT','Sanitized text');
define('_XURL_ORI_TXT','Original text');
define('_XURL_QRCODE','Your QRCode');
	   
	   
// End added in v1.2


?>