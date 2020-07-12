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
include '../../../include/cp_header.php';
// if the site has no language defined, turn to English default
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
include "../language/".$xoopsConfig['language']."/main.php"; } else { include "../language/english/main.php"; }
require('../functions/ini.php');
include(XOOPS_ROOT_PATH.'/mainfile.php');
	global $xoopsDB;
	global $xoopsConfig;

ini_set("display_errors", "1");
unset($config);

$save_error = false;

if(isset($_POST['submit']))
{
unset ($config);
	$config['config']['baseurl'] = $_POST['base'];
	$config['config']['error_url'] = $_POST['error_url'];
	$config['config']['restrict'] = $_POST['restrict'];
	$config['config']['restrict_url'] = $_POST['restrict_url'];
// added in v1.2
	$config['config']['qr'] = $_POST['qr'];
	$config['config']['qr_plugin'] = $_POST['qr_plugin'];
	$config['config']['qr_path'] = XOOPS_ROOT_PATH.'/uploads/Xurl/';
// end added in v1.2	
	$config['config']['saved'] = date("F j, Y, g:i a");

	if (!write_ini_file($config, XOOPS_VAR_PATH.'/configs/Xurl_config.ini', TRUE)) $save_error = true;

} // End saving settings

$config = parse_ini_file(XOOPS_VAR_PATH.'/configs/Xurl_config.ini', true);

	$config['db']['sql_host'] = XOOPS_DB_HOST;
	$config['db']['sql_user'] = XOOPS_DB_USER;
	$config['db']['sql_pass'] = XOOPS_DB_PASS;
	$config['db']['sql_db'] = XOOPS_DB_NAME;
	$config['db']['sql_table'] = XOOPS_DB_PREFIX."_xurl";

xoops_cp_header();


$module_handler =& xoops_gethandler('module');
$versioninfo =& $module_handler->get($xoopsModule->getVar('mid'));

$version=$versioninfo->getInfo('version');
$description=$versioninfo->getInfo('description');
$author=$versioninfo->getInfo('author');
$license=$versioninfo->getInfo('license');
$licensefile=$versioninfo->getInfo('help');
$status=$versioninfo->getInfo('status');
$released=$versioninfo->getInfo('releasedate');

$Xurl_baseurl = $config['config']['baseurl'];
$Xurl_error_url = $config['config']['error_url'];
$Xurl_restrict = $config['config']['restrict'];
$Xurl_restrict_url = $config['config']['restrict_url'];
// added in v1.2
$Xurl_qr = $config['config']['qr'];
$Xurl_qr_plugin = $config['config']['qr_plugin'];
$Xurl_qr_path = $config['config']['qr_path'];
// end added in v1.2

echo '<link type="text/css" href="../class/jquery/jquery-ui-1.7.1.custom.css" rel="stylesheet" />';
echo '<script type="text/javascript" src="../class/jquery/jquery-1.3.2.min.js"></script>';
echo '<script type="text/javascript" src="../class/jquery/ui.core.js"></script>';
echo '<script type="text/javascript" src="../class/jquery/ui.tabs.js"></script>';

echo '<script type="text/javascript">';
echo '$(document).ready(function(){';
echo '$("#tabs").tabs();';
echo '});';
echo '</script>';

echo '<div id="tabs"><ul><li style="list-style-type:none;"><a href="#fragment-1"><span>'._AM_XURL_TAB1.'</span></a></li>';
echo '<li style="list-style-type:none;"><a href="#fragment-2"><span>'._AM_XURL_TAB2.'</span></a></li>';
echo '<li style="list-style-type:none;"><a href="#fragment-3"><span>'._AM_XURL_TAB3.'</span></a></li>';
echo '<li style="list-style-type:none;"><a href="#fragment-4"><span>'._AM_XURL_TAB4.'</span></a></li>';
echo '</ul><div id="fragment-1">';
//<!-- 1 TAB START -->
echo '<a href="'.XOOPS_URL.'/modules/Xurl/index.php"><img style="float:right; border:0;" alt="'._AM_XURL_UPAGE.'" src="../images/xurl.png"></a>';
echo '<h2>'._AM_XURL_TAB1_HEAD.'</h2><br />';
echo '<table style="border: solid 2px; width:auto; padding:7px;">';
echo '<tr><td style="width:100px;"><strong>'._AM_XURL_VERSION.'</strong></td><td>'.$version.'</td></tr>';
echo '<tr><td><strong>'._AM_XURL_DESC.'</strong></td><td>'.$description.'</td></tr>';
echo '<tr><td><strong>'._AM_XURL_AUTHOR.'</strong></td><td><a href="http://ett.designburo.nl" rel="external">'.$author.'</a></td></tr>';
echo '<tr><td><strong>'._AM_XURL_LCNSE.'</strong></td><td><a href="'.XOOPS_URL.'/modules/Xurl/'.$licensefile.'" rel="external">'.$license.'</a></td></tr>';
echo '<tr><td><strong>'._AM_XURL_STATUS.'</strong></td><td>'.$status.'</td></tr>';
echo '<tr><td><strong>'._AM_XURL_RELEASED.'</strong></td><td>'.$released.'</td></tr></table>';
echo '<div style="text-align:center;"><a href="http://ett.designburo.nl"><img style="border:0;" src="../images/logo.png" alt="Designburo.net"/></a><br />';
echo '<h4>'._AM_XURL_TAB1_FOOT1.'<em style="color:#ff0000;">TCP</em>transfer '._AM_XURL_TAB1_FOOT2.'</h4></div>';
//<!-- 1 TAB END -->
echo '</div><div id="fragment-2">';
//<!-- 2 TAB START -->
//<!-- settings form-->

echo '<a href="'.XOOPS_URL.'/modules/Xurl/index.php"><img style="float:right; border:0;" alt="'._AM_XURL_UPAGE.'" src="../images/xurl.png"></a>';
echo _AM_XURL_TAB2_HEAD.'<br />';
echo '<form name="xurl_settings" method="post" action="index.php">';
echo '<table style="border:solid 2px; width:auto;">';
echo '<tr><td colspan="3"><strong>'._AM_XURL_TAB2_HEAD2.'</strong><br /><br /></td></tr>';
echo '<tr style="background-color:#fff;"><td style="width:180px;">'._AM_XURL_SET_TABLEH1.'</td><td>'._AM_XURL_SET_TABLEH2.'</td>';
echo '<td>'._AM_XURL_SET_TABLEH3.'</td></tr>';

echo '<tr style="background-color:#bbcccc;"><td style="width:180px;">'._AM_XURL_SET_BASE.'</td><td><input name="base" id="base" type="text" size="30" value="'.$Xurl_baseurl.'" /></td>';
echo '<td><em>'._AM_XURL_SET_BASE_D.'</em></td></tr>';
echo '<tr style="background-color:#99cccc;"><td style="width:180px;">'._AM_XURL_SET_ERR.'</td><td><input name="error_url" id="error_url" type="text" size="30" value="'.$Xurl_error_url.'" /></td>';
echo '<td><em>'._AM_XURL_SET_ERR_D.'</em></td></tr>';

if ($Xurl_restrict=="yes") echo '<tr style="background-color:#bbcccc;"><td style="width:180px;">'._AM_XURL_SET_RESTRICT.'</td><td><select name="restrict" id="restrict"><option value="yes">'._AM_XURL_YES.'</option><option value="no">'._AM_XURL_NO.'</option></select></td>';
else echo '<tr style="background-color:#bbcccc;"><td style="width:180px;">'._AM_XURL_SET_RESTRICT.'</td><td><select name="restrict" id="restrict"><option value="no">'._AM_XURL_NO.'</option><option value="yes">'._AM_XURL_YES.'</option></select></td>';
echo '<td><em>'._AM_XURL_SET_RESTRICT_D.'</em></td></tr>';

echo '<tr style="background-color:#99cccc;"><td style="width:180px;">'._AM_XURL_SET_RESTR_R.'</td><td><input name="restrict_url" id="restrict_url" type="text" size="30" value="'.$Xurl_restrict_url.'" /></td>';
echo '<td><em>'._AM_XURL_SET_RESTR_R_D.'</em></td></tr>';

// Added in v1.2
if ($Xurl_qr=="yes") echo '<tr style="background-color:#bbcccc;"><td style="width:180px;">'._AM_XURL_SET_QR.'</td><td><select name="qr" id="qr"><option value="yes">'._AM_XURL_YES.'</option><option value="no">'._AM_XURL_NO.'</option></select></td>';
else echo '<tr style="background-color:#bbcccc;"><td style="width:180px;">'._AM_XURL_SET_QR.'</td><td><select name="qr" id="qr"><option value="no">'._AM_XURL_NO.'</option><option value="yes">'._AM_XURL_YES.'</option></select></td>';
echo '<td><em>'._AM_XURL_SET_QR_D.'</em></td></tr>';

if ($Xurl_qr_plugin=="yes") echo '<tr style="background-color:#99cccc;"><td style="width:180px;">'._AM_XURL_SET_QR_PLUGIN.'</td><td><select name="qr_plugin" id="qr_plugin"><option value="yes">'._AM_XURL_YES.'</option><option value="no">'._AM_XURL_NO.'</option></select></td>';
else echo '<tr style="background-color:#bbcccc;"><td style="width:180px;">'._AM_XURL_SET_QR_PLUGIN.'</td><td><select name="qr_plugin" id="qr_plugin"><option value="no">'._AM_XURL_NO.'</option><option value="yes">'._AM_XURL_YES.'</option></select></td>';
echo '<td><em>'._AM_XURL_SET_QR_PLUGIN_D.'</em></td></tr>';

// END Added in v1.2

echo '<tr><td colspan="2">';
if (!$save_error)
{
	if (strlen($config['config']['saved']) > 3) echo '<span style="color:#FF0000;">'._AM_XURL_SET_FOOTER.$config['config']['saved'].'</span></td>';
} else echo '<span style="color:#FF0000;">'._AM_XURL_SET_FOOTER_ERR.'</span></td>';
echo '<td style="text-align:right; padding: 10px;"><br /><input type="submit" name="submit" id="submit" value="'._AM_XURL_SET_SAVE.'" /></td></tr>';
echo '</table></form>';
//<!-- 2 TAB END -->
echo '</div>';

echo '<div id="fragment-4">';
//<!-- 4 TAB START -->

echo '<br /><iframe src="http://designburo.nl/ett2/modules/content/index.php?id=7" width="100%" height="500" frameborder="0" ></iframe>';
//<!-- 4 TAB END -->
echo '</div>';

echo '<div id="fragment-3">';
//<!-- 3 TAB START -->
if (!isset($_GET['usr'])) $usr="none"; else $usr=($_GET['usr']);
if (!isset($_GET['sort'])) $sort="DESC"; else $sort=($_GET['sort']);
if (!isset($_GET['key'])) $key="hits"; else $key=($_GET['key']);
if (!isset($_GET['start']))
{
	$start=0;
	$sta=0;
} else $start=$_GET['start'];
if ($start<0) $start=0;
$sta=$start;
if ($key=="last") $key="d_l_click";
if ($key=="date") $key="d_added";
if ($usr!="none") $where=" WHERE user='".$usr."'"; else $where=" ";
$selection = "SELECT * FROM ".$xoopsDB->prefix("xurl").$where." ORDER BY `".$key."` ".$sort;
$sql = $xoopsDB->queryF($selection);
$aantal = mysql_num_rows($sql);
if ($aantal<$start) $start=0;
echo '<a href="'.XOOPS_URL.'/modules/Xurl/index.php"><img style="float:right; border:0;" alt="'._AM_XURL_UPAGE.'" src="../images/xurl.png"></a>';
echo "<span style='color:#0000FF'>"._AM_XURL_STAT_INTRO1."<strong>".$aantal."</strong> "._AM_XURL_STAT_INTRO2."<br />";
echo _AM_XURL_STAT_INTRO3.($start+1)." - ".($start+20).".</span><br />";
echo "<em>"._AM_XURL_STAT_INTRO4."</em>";
if ($usr!="none")
{ 
	echo "<br />"._AM_XURL_STAT_INTRO5." <span style='color:#ff0000;'>".$usr."</span>, ";
	echo '<a href="'.$_SERVER['PHP_SELF'].'?usr=none&sort='.$sort.'&key='.$key.'&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_INTRO6.'">'._AM_XURL_STAT_INTRO6.'</a>';
}
echo '<br /><p style="text-align:center; padding:7px;"><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort=ASC&key='.$key.'&start='.($sta).'#fragment-3"><img border="0" src="../images/asc.png" alt=""></a>&nbsp;&nbsp;';
echo '<a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort=DESC&key='.$key.'&start='.($sta).'#fragment-3"><img border="0" src="../images/desc.png" alt=""></a></p>';
echo '<table border=1 style="bordercolorlight=#fff; align=left;bordercolordark=#black; bordercolor=#006666;">';
echo '<tr style="background-color:#fff;"><td><strong>#</strong></td><td';
if ($key=="key") echo ' style="background-color:#FFFF00;"';
echo '><strong><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key=key&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_C1.'">'._AM_XURL_STAT_C1.'</a></strong></td><td';
if ($key=="url") echo ' style="background-color:#FFFF00;"';
echo '><strong><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key=url&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_C2.'">'._AM_XURL_STAT_C2.'</a></strong></td><td';
if ($key=="user") echo ' style="background-color:#FFFF00;"';
echo '><strong><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key=user&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_C3.'">'._AM_XURL_STAT_C3.'</a></strong></td><td';
if ($key=="hits") echo ' style="background-color:#FFFF00;"';
echo '><strong><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key=hits&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_C4.'">'._AM_XURL_STAT_C4.'</a></strong></td>';
echo '<td>'._AM_XURL_STAT_C5.'</td><td>'._AM_XURL_STAT_C6.'</td><td';
if ($key=="date") echo ' style="background-color:#FFFF00;"';
echo '><strong><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key=date&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_C7.'">'._AM_XURL_STAT_C7.'</a></strong></td><td';
if ($key=="last") echo ' style="background-color:#FFFF00;"';
echo '><strong><a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key=last&start='.($sta).'#fragment-3" title="'._AM_XURL_STAT_C8.'">'._AM_XURL_STAT_C8.'</td><td>'._AM_XURL_STAT_C9.'</td></tr>';

$i=0;

//$start=0;

if ($start != 0){
while (($rij = $xoopsDB->fetchArray($sql)) && ($i!=($start-1)))
{
	$i++;
}
}
$i=0;
$result = $xoopsDB->query("select groupid, name from ".$xoopsDB->prefix("groups").";");
while ($myRow = $xoopsDB->fetchArray($result))
{
	$cat[$myRow['groupid']]=$myRow['name'];
}
	
while (($rij = $xoopsDB->fetchArray($sql)) && ($i!=20))
{
	echo "<tr><td><strong>".($i+$start+1)."</strong></td><td>".$rij['key']."</td><td>".$rij['url']."</td><td>";
	echo '<a href="'.$_SERVER['PHP_SELF'].'?usr=';
	echo $rij['user'];
	echo '&sort='.$sort.'&key='.$key.'&start='.($sta).'#fragment-3">';
	echo $rij['user']."</a></td><td>".$rij['hits']."</td>";
	if ($rij['restrict']) echo "<td>"._AM_XURL_YES."</td>"; else echo "<td>"._AM_XURL_NO."</td>";
	$cat_nr = explode(",",$rij['group']);
	$grp = "";
	foreach (array_keys($cat_nr) as $d)
	{
		$d=$d+1;
		$grp.=" ".$cat[$d]." ";
	}
	echo "<td>".$grp."</td>";
	echo "<td>".$rij['d_added']."</td><td>".$rij['d_l_click']."</td><td>".$rij['spam_mark']."</td></tr>";
	$i++;
}
echo "</table><br />";
$vorige='';
$volgende='';
if ($start>0) 
{	
	$vorige='<a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key='.$key.'&start='.($start-20).'#fragment-3" title=" '._AM_XURL_STAT_PREV.'"> '._AM_XURL_STAT_PREV.'</a>';
	$sta=($start-20);
}
if (($start+20)<$aantal)
{
	$volgende='<a href="'.$_SERVER['PHP_SELF'].'?usr='.$usr.'&sort='.$sort.'&key='.$key.'&start='.($start+20).'#fragment-3" title=" '._AM_XURL_STAT_NEXT.'"> '._AM_XURL_STAT_NEXT.'</a>';
	$sta=($start+20);
}
if (($volgende!='') && ($vorige!='')) echo "<table><tr><td style='text-align:left;'>".$vorige."</td><td style='text-align:right;'>".$volgende."</td></tr><table>";
if (($volgende!='') && ($vorige=='')) echo "<table><tr><td style='text-align:right;'>".$volgende."</td></tr><table>";
if (($volgende=='') && ($vorige!='')) echo "<table><tr><td  style='text-align:left;'>".$vorige."</td></tr><table>";
echo "<br />";
//<!-- 3 TAB END -->
echo '</div>';

echo '</div>';

xoops_cp_footer();
?>
