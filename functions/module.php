<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (sales@designburo.nl)                              //
//  http://www.designburo.nl                                                 //
//  Project: Xurl  v1.2                                                      //
//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
//  only subject to the terms and conditions set forth in the                //
//  Open Public License, v1.0 or later.                                      //
//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
//  ------------------------------------------------------------------------ //	


function xoops_module_update_xurl(&$module) 
{
	global $xoopsDB;
	include (XOOPS_ROOT_PATH.'/modules/Xurl/functions/ini.php');	
	require('../../mainfile.php');
	// cleaning up version 1.0, 1.0a and 1.0b
	if (!file_exists(XOOPS_VAR_PATH."/configs/Xurl_config.ini"))
	{
		if (file_exists(XOOPS_ROOT_PATH.'/modules/Xurl/functions/config.ini'))
		{
			chmod (XOOPS_VAR_PATH.'/configs', 666);
			copy(XOOPS_ROOT_PATH.'/modules/Xurl/functions/config.ini',XOOPS_VAR_PATH.'/configs/Xurl_config.ini');
			unlink(XOOPS_ROOT_PATH.'/modules/Xurl/functions/config.ini');
		}
	}
	if (!file_exists(XOOPS_ROOT_PATH."/uploads/Xurl")) 
	{
		if(!mkdir(XOOPS_ROOT_PATH."/uploads/Xurl")) echo "Error creating dir"; else chmod(XOOPS_ROOT_PATH."/uploads/Xurl", 0777); 
	}
			
	$config = parse_ini_file(XOOPS_VAR_PATH.'/configs/Xurl_config.ini', true);
	unset($config['db']['sql_host']);
	unset($config['db']['sql_user']);
	unset($config['db']['sql_pass']);
	unset($config['db']['sql_db']);
	unset($config['db']['sql_table']);
	write_ini_file($config, XOOPS_VAR_PATH."/configs/Xurl_config.ini", TRUE);
	unset($config);
	// END cleaning up version 1.0, 1.0a and 1.0b and 1.1
	// Add tables for version 1.2

	if (!$db = mysql_connect(XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS)) 
	{
		$module->setErrors("Could not connect to database");
		return false;
	}
	if (!mysql_select_db(XOOPS_DB_NAME, $db)) echo "could not select database";
	echo $db;

	if (!$fields = mysql_list_fields(XOOPS_DB_NAME, XOOPS_DB_PREFIX."_xurl")) echo "error mysql_fields";
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++)
	{
    	$field_array[] = mysql_field_name($fields, $i);
	}
	if (!in_array("restrict", $field_array))
	{
    	if (!mysql_query("ALTER TABLE `".XOOPS_DB_PREFIX."_xurl` ADD `restrict` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';",$db))
		{
			$module->setErrors("Could not add field (restrict) in Xurl");	
			return false;
		}
	}
	if (!in_array("group", $field_array))
	{
	   	if (!mysql_query("ALTER TABLE `".XOOPS_DB_PREFIX."_xurl` ADD `group` VARCHAR(50) NOT NULL DEFAULT '1,2';",$db))
		{
			$module->setErrors("Could not add field (group) in Xurl");	
			return false;
		}
	}
	if (!in_array("d_added", $field_array))
	{
	   	if (!mysql_query("ALTER TABLE `".XOOPS_DB_PREFIX."_xurl` ADD `d_added` VARCHAR(50) NOT NULL DEFAULT '0';",$db))
		{
		$module->setErrors("Could not add field (d_added) in Xurl");	
		return false;
	}	
	}
	if (!in_array("d_l_click", $field_array))
	{
    	if (!mysql_query("ALTER TABLE `".XOOPS_DB_PREFIX."_xurl` ADD `d_l_click` VARCHAR(50) NOT NULL DEFAULT '0';",$db))
		{
			$module->setErrors("Could not add field (d_l_click) in Xurl");	
			return false;
		}	
	}
	if (!in_array("spam_mark", $field_array))
	{
    	if (!mysql_query("ALTER TABLE `".XOOPS_DB_PREFIX."_xurl` ADD `spam_mark` MEDIUMINT(8) DEFAULT '0';",$db))
		{
			$module->setErrors("Could not add field (spam_mark) in Xurl");	
			return false;
		}	
	}

// END adding tables
	return true;
}

function xoops_module_install_xurl(&$module)
{
	global $xoopsDB;
	require('../../mainfile.php');
	include (XOOPS_ROOT_PATH.'/modules/Xurl/functions/ini.php');
	$config=array();
	$config['config']['baseurl'] = XOOPS_URL;
	$config['config']['error_url'] = XOOPS_URL;
	$config['config']['restrict'] = "no";
	$config['config']['restrict_url'] = XOOPS_URL;
// added in v1.2
	$config['config']['qr'] = "yes";
	$config['config']['qr_plugin'] = "yes";
	$config['config']['qr_path'] = XOOPS_ROOT_PATH.'/uploads/Xurl/';
// end added in v1.2
	$config['config']['saved'] = "";
	mkdir (XOOPS_VAR_PATH."/uploads/Xurl", 0777);
	chmod (XOOPS_VAR_PATH.'/configs', 666);
//	if (file_exist(XOOPS_VAR_PATH."/config/Xurl_config.ini")) chmod (XOOPS_VAR_PATH.'/config/Xurl_config.ini', 666);
	if (!file_exists(XOOPS_ROOT_PATH."/uploads/Xurl")) 
	{
		if(!mkdir(XOOPS_ROOT_PATH."/uploads/Xurl")) echo "Error creating dir"; else chmod(XOOPS_ROOT_PATH."/uploads/Xurl", 0777); 
	}
	if (write_ini_file($config, XOOPS_VAR_PATH."/configs/Xurl_config.ini", TRUE))
	{
		 return true;
	}
	else 
	{ 
		$module->setErrors("Could not create config file in XOOPS_DATA");	
		return false;
	}
	return true;
}

?>