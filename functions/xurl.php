<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (sales@designburo.nl)                              //
//  http://www.designburo.nl                                                 //
//  Project: Xurl v1.2                                                       //
//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
//  only subject to the terms and conditions set forth in the                //
//  Open Public License, v1.0 or later.                                      //
//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
//  ------------------------------------------------------------------------ //	
$rexProtocol = '(https?://)?';
$rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})';
$rexPort     = '(:[0-9]{1,5})?';
$rexPath     = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
$rexQuery    = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
$rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
$rexUrlLinker = "{\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))}";
$validTlds = array_fill_keys(explode(" ", ".aero .asia .biz .cat .com .coop .edu .gov .info .int .jobs .mil .mobi .museum .name .net .org .pro .tel .travel .ac .ad .ae .af .ag .ai .al .am .an .ao .aq .ar .as .at .au .aw .ax .az .ba .bb .bd .be .bf .bg .bh .bi .bj .bm .bn .bo .br .bs .bt .bv .bw .by .bz .ca .cc .cd .cf .cg .ch .ci .ck .cl .cm .cn .co .cr .cu .cv .cx .cy .cz .de .dj .dk .dm .do .dz .ec .ee .eg .er .es .et .eu .fi .fj .fk .fm .fo .fr .ga .gb .gd .ge .gf .gg .gh .gi .gl .gm .gn .gp .gq .gr .gs .gt .gu .gw .gy .hk .hm .hn .hr .ht .hu .id .ie .il .im .in .io .iq .ir .is .it .je .jm .jo .jp .ke .kg .kh .ki .km .kn .kp .kr .kw .ky .kz .la .lb .lc .li .lk .lr .ls .lt .lu .lv .ly .ma .mc .md .me .mg .mh .mk .ml .mm .mn .mo .mp .mq .mr .ms .mt .mu .mv .mw .mx .my .mz .na .nc .ne .nf .ng .ni .nl .no .np .nr .nu .nz .om .pa .pe .pf .pg .ph .pk .pl .pm .pn .pr .ps .pt .pw .py .qa .re .ro .rs .ru .rw .sa .sb .sc .sd .se .sg .sh .si .sj .sk .sl .sm .sn .so .sr .st .su .sv .sy .sz .tc .td .tf .tg .th .tj .tk .tl .tm .tn .to .tp .tr .tt .tv .tw .tz .ua .ug .uk .us .uy .uz .va .vc .ve .vg .vi .vn .vu .wf .ws .ye .yt .yu .za .zm .zw .xn--0zwm56d .xn--11b5bs3a9aj6g .xn--80akhbyknj4f .xn--9t4b11yi5a .xn--deba0ad .xn--g6w251d .xn--hgbk6aj7f53bba .xn--hlcj6aya9esc7a .xn--jxalpdlp .xn--kgbechtv .xn--zckzah .arpa"), true);


function xurl_checkXurl($db, $config, $u)
// v1.1 Check to see if an URL is not already a Xurl url
// returns 0 if it not a Xurl url else the KEY
{
	
$ul=parse_url($u);
$path=substr($ul['path'],1);
//$x_url=$config['config']['baseurl'].$path;
//    $path = mysql_real_escape_string($path, $db);	
      if($result = mysql_query("SELECT `url` FROM `".$config['db']['sql_table']."` WHERE `key` = '" . $path . "'", $db)) 
	  {
         if(mysql_num_rows($result) > 0)
		 {
            return $path;
         }
      }
	  return 0;
}

function xurl_page()
{
 $pURL = 'http';
 if ($_SERVER["HTTPS"]) {$pURL .= "s";}
 $pURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80")
 {
  	$pURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } 
 else
 {
  $pURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pURL;
}

function xurl_sanitize($db, $config, $text,$u,$p,$type,$nohref=FALSE)
// Function to sanitize whole texts
// This can be very usefull to check forum posts or Blog post and sanitize them completely before posting
// Returns the sanitized text
{
    global $rexUrlLinker, $validTlds, $xurl_checkXurl;
    $result = "";
    $position = 0;
    while (preg_match($rexUrlLinker, $text, $match, PREG_OFFSET_CAPTURE, $position))
    {
        list($url, $urlPosition) = $match[0];
        $result .= htmlspecialchars(substr($text, $position, $urlPosition - $position));
        $domain = $match[2][0];
        $port   = $match[3][0];
        $path   = $match[4][0];
        $tld = strtolower(strrchr($domain, '.'));
        if (preg_match('{\.[0-9]{1,3}}', $tld) || isset($validTlds[$tld]))
        {
            $completeUrl = $match[1][0] ? $url : "http://$url";
			if(!$nohref) $result.= xurl('all-in-1',$db,$config,htmlspecialchars($completeUrl),$u,$p,$type);
			else $result .= xurl('all-in-1',$db,$config,htmlspecialchars($completeUrl),$u,$p,$type,true);
        }
        else
        {
            $result .= htmlspecialchars($url);
        }
        $position = $urlPosition + strlen($url);
    }
    $result .= htmlspecialchars(substr($text, $position));
    return $result;
}

function xurl($case, $db, $config, $var, $n, $p, $type, $nohref=FALSE, $nocheck=false)
/* Main function that does all the work.
/  $case is action
/  $db is database variable
/  $config is configuration varaibles
/  $var is used for various variables, useally the url
/  $n is username
/  $p is password
/  $type is how the password is provided (MD5 or plain)
*/
{
include_once(XOOPS_ROOT_PATH.'/modules/Xurl/class/qr/qr.php');
global $xurl_checkXurl;
switch ($case)
{
	
case "all-in-1":
// Do a Check and Store automatically if needed. Return the shortened URL
if (!$backkey=xurl_checkXurl($db, $config, $var))
{

   if(filter_var($var, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) == false) { exit;}	
	$key = 0;
    $u = mysql_real_escape_string($var, $db);	
      if($result = mysql_query("SELECT `key` FROM `".$config['db']['sql_table']."` WHERE `url` = '" . $u . "'", $db)) {
         if(mysql_num_rows($result) > 0) {
            $row = mysql_fetch_row($result);
            $key = $row[0];
         }
      }

    if ($key=="0")
	{
		if ($type=="plain")
			{
				$p = md5($p);
			}
//		echo "Xpass: ".$config['pass']." calcPass: ".$p."<BR>";
		$datum = date("d-m-Y, H:i \(\w W\)");
		if ($nocheck) $n="system";
		else 
		{
			if ($p != $config['pass']) return "errorP";
		}
		if (mysql_query("INSERT INTO `".$config['db']['sql_table']."` (`url`,`user`,`hits`,`restrict`, `group`, `d_added`, `d_l_click`, `spam_mark`) VALUES ('" . $u . "', '".$n."', '1', '0', '1,2', '".$datum."', '0', '0')", $db))
		{
        	$id = mysql_insert_id($db);
        	$key = base_convert($id, 10, 36);
        	mysql_query("UPDATE `".$config['db']['sql_table']."` SET `key` = '" . $key . "' WHERE `id` = '" . $id . "'");
			if ($config['config']['qr']=="yes")
			{
  				Xurl_QR($config['config']['qr_path'],$key,$config['config']['baseurl'].$key,"","5");	
			}				
      	} else { return 0;}	  
	} 
	if (!$nohref) 
	{
		$back='<a href="' . $config['config']['baseurl'] . $key . '" rel="external" title="">' . $config['config']['baseurl'] . $key . '</a>';
		$_GET['sleutel']=$key;
		if($config['config']['qr']=="yes")
		{
		  
		}
			return $back;
		
	}
	else 
	{
		$back = $config['config']['baseurl'] . $key;
		$_GET['sleutel']=$key;
		if($config['config']['qr_plugin']=="yes")
		{
		  
		}
		return $back;
	}
} else 
{
	$_GET['sleutel']=$var;
	$back = $var;
	if($config['config']['qr_plugin']=="yes")
	{
		
	}
	return $back;
}
case "refer":
// URL refer request
// Needs key variable
// refers user to the requested url and updates nr of hits for this url
    $k = mysql_real_escape_string($var, $db);
	$datum = date("d-m-Y, H:i \(\w W\)");
	if($result = mysql_query("SELECT `url` FROM `".$config['db']['sql_table']."` WHERE `key` = '" . $k . "'", $db))
	{
      if(mysql_num_rows($result) > 0)
	  {
         $row = mysql_fetch_row($result);
		 $result= mysql_query("SELECT `hits` FROM `".$config['db']['sql_table']."` WHERE `key` = '" . $k . "'", $db);
		 $hits = mysql_fetch_row($result);
		 $hit = ($hits[0]) +1;
		 mysql_query("UPDATE `".$config['db']['sql_table']."` SET `hits` = '".$hit."' WHERE `key` = '" . $k . "'"); 
		 mysql_query("UPDATE `".$config['db']['sql_table']."` SET `d_l_click` = '".$datum."' WHERE `key` = '" . $k . "'"); 
//		 echo "k=".$k." -- url=".$row[0];
		 header('HTTP/1.1 301 Moved Permanently');
         header('Location: ' . $row[0]);
         exit;
      }
    }
         header('Location: '. $config['config']['error_url']);
         exit;

case "check":
// Check if URL already exists.
// Needs: url 
// Returns 0 if not found, else returns key
if (!xurl_checkXurl($db, $config, $var))
{
	$key = 0;
    $u = mysql_real_escape_string($var, $db);	
      if($result = mysql_query("SELECT `key` FROM `".$config['db']['sql_table']."` WHERE `url` = '" . $u . "'", $db)) {
         if(mysql_num_rows($result) > 0) {
            $row = mysql_fetch_row($result);
            $key = $row[0];
         }
      }
	  return $key;
} else return xurl_checkXurl($db, $config, $var);

case "store":
// Store new URL in database
// Needs: url, username, password, type
// returns errorP is authentication problem, zero if problems storing the url and key is succesfull

	$u = mysql_real_escape_string($var, $db);	
	if ($type=="plain") {$p = md5($p);}
	if ($p !== $config['pass']) {
//		echo "Error in password";
		return "errorP";
	}
	$datum = date("d-m-Y, H:i \(\w W\)");
	if (mysql_query("INSERT INTO `".$config['db']['sql_table']."` (`url`,`user`,`hits`,`restrict`, `group`, `d_added`, `d_l_click`, `spam_mark`) VALUES ('" . $u . "', '".$n."', '1', '0', '1,2', '".$datum."', '0', '0')", $db))
	{
         $id = mysql_insert_id($db);
         $key = base_convert($id, 10, 36);
         mysql_query("UPDATE `".$config['db']['sql_table']."` SET `key` = '" . $key . "' WHERE `id` = '" . $id . "'");
		 
		if ($config['config']['qr']=="yes")
		{
		  Xurl_QR($config['config']['qr_path'],$key,$var,"","5");	
		}		 
		 
		 return $key;
      } else { return "errorSQL";}

case "echo":
// Show the (created) short link
// Needs: key
// Shows the new shortened url
	if (!$n) 
	{ 
		$back='<a href="' . $config['config']['baseurl'] . $var . '" rel="external" title="">' . $config['config']['baseurl'] . $var . '</a>';
		return $back;
	}
	else 
	{
		$back=$config['config']['baseurl'] . $var;
		return $back;
	}
	
} // end switch
} // end function
?>