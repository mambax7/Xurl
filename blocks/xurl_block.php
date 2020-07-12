<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (sales@designburo.nl)                              //
//  http://www.designburo.nl                                                 //
//  Project: Xurl                                                            //
//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
//  only subject to the terms and conditions set forth in the                //
//  Open Public License, v1.0 or later.                                      //
//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
//  ------------------------------------------------------------------------ //	

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}


function blockList()
{
	global $xoopsDB;
	global $xoopsConfig;
	$block=array();

	$selection = "SELECT * FROM ".$xoopsDB->prefix("xurl");
	$sql = $xoopsDB->queryF($selection);
	$entries = mysql_num_rows($sql);
	$block['entries']=$entries;
	
	return $block;
	
}

function showQR()
{
    require_once(XOOPS_ROOT_PATH.'/modules/Xurl/functions/xurl.php');		
	global $xoopsDB;
	global $xoopsConfig;
	$block=array();
	$config = parse_ini_file(XOOPS_VAR_PATH.'/configs/Xurl_config.ini', true);
	$config['db']['sql_host'] = XOOPS_DB_HOST;
	$config['db']['sql_user'] = XOOPS_DB_USER;
	$config['db']['sql_pass'] = XOOPS_DB_PASS;
	$config['db']['sql_db'] = XOOPS_DB_NAME;
	$config['db']['sql_table'] = XOOPS_DB_PREFIX."_xurl";	
	$db = mysql_connect($config['db']['sql_host'], $config['db']['sql_user'], $config['db']['sql_pass']);
	$uri = xurl_page();
//  echo "<BR> url= ".$uri;
	$xrl=xurl('all-in-1',$db,$config,$uri,"","","plain",true,true);		
//	echo "url=".$xrl;
	$key = $_GET['sleutel'];
	$path=$config['config']['qr_path'].$key.".png";
	if (!file_exists($path)) Xurl_QR($config['config']['qr_path'],$key,$config['config']['baseurl'].$key,"","5");
//	echo "path=".$config['config']['qr_path']."qr_".$key.".png";
	$block['qr']="<img width=150 src=".XOOPS_URL."/uploads/Xurl/qr_".$key.".png>";
	$block['text']=" ";
	
	return $block;
}

function showTwit()
{
	$block=array();
	$block['text']=" ";
	return $block;
}

function showform()
{
	$block=array();
	$block['text2']=" ";
	return $block;	
}
?>