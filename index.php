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
ini_set("display_errors", "1");
error_reporting (E_ALL);

unset($config);


if(!isset($_POST['uname'], $_POST['pass']))			// Calling the script from outside XOOPS?
{ 
	require('../../mainfile.php');
	if (!isset($_GET['k'])){						// Requesting a stored URL translation (can be outside person)
		require(XOOPS_ROOT_PATH.'/header.php');
		include('class/twit/Twitter.class.php');
		include('class/qr/qr.php');
}
} 
$config = parse_ini_file(XOOPS_VAR_PATH.'/configs/Xurl_config.ini', true);
$config['db']['sql_host'] = XOOPS_DB_HOST;
$config['db']['sql_user'] = XOOPS_DB_USER;
$config['db']['sql_pass'] = XOOPS_DB_PASS;
$config['db']['sql_db'] = XOOPS_DB_NAME;
$config['db']['sql_table'] = XOOPS_DB_PREFIX."_xurl";

$defaulttxt ='';
$message ='';
$origtxt ='';
if (!isset($_GET['k'])){							// Using XOOPS to get details (user must be logged in)
	if ($xoopsUser)
	{
		$config['user'] = $xoopsUser->getVar('uname'); 
		$config['pass'] = $xoopsUser->getVar('pass'); 
	}
} else {											// Requesting a stored URL translation (can be outside person)
													// No XOOPS function can be used
	if(!isset($_POST['uname'], $_POST['pass']))
	{ 
		$config['user'] = $_POST['uname']; 
		$config['pass'] = $_POST['pass']; 
	}
}

$db = mysql_connect($config['db']['sql_host'], $config['db']['sql_user'], $config['db']['sql_pass']);
mysql_select_db($config['db']['sql_db'], $db);
//include('class/qr/qr.php');
require('functions/xurl.php');

// Start of index.php

if(isset($_GET['k'])) 
{  
	if ($config['config']['restrict']=="yes") 
	{
		if ($xoopsUser=='')
		{
//			header('HTTP/1.1 301 Moved Permanently');
        	header('Location: ' . $config['config']['restrict_url']);
        	exit;	
		}
	}
	xurl('refer',$db,$config,($_GET['k']));																				// Refer..
} 
if(isset($_GET['delete']))
{
	if (!$xoopsUser)
	{
		$message = _XURL_MAN_NODEL;
	}
	else
	{
     $result = mysql_query("SELECT `user` FROM `".$config['db']['sql_table']."` WHERE `key` = '" . $_GET['delete'] . "'", $db);
     if (mysql_num_rows($result) > 0)
	 	{
            $row = mysql_fetch_row($result);
            if ($config['user'] != $row[0])
			{ 
				$message=_XURL_MAN_NOOWN;
			}
			else
			{
				$result = mysql_query("DELETE FROM `".$config['db']['sql_table']."` WHERE `key`='".$_GET['delete']."';",$db);
				if(!$result)
				{
					$message=_XURL_MAN_SQLERR;
				}
				else
				{
					$message=$config['config']['baseurl'].$_GET['delete']._XURL_MAN_SUCCESS;
				}
			}
      	} else $message=_XURL_MAN_NOURL;		
		
	}
}
?>

<?php
echo '<img style="float:right;" src="'.XOOPS_URL.'/modules/Xurl/images/xurl.png">';
?>

<?php
if(!$xoopsUser)
{
	echo _XURL_INDEX2_TEXT;
}
else
{
	echo _XURL_INDEX_TEXT;



//if(isset($_POST['qr']))
//{
#   d= data         URL encoded data.
#   e= ECC level    L or M or Q or H   (default M)
#   s= module size  (dafault PNG:4 JPEG:8)
#   v= version      1-40 or Auto select if you do not set.
#   t= image type   J:jpeg image , other: PNG image

/*
	Xurl_QR($_POST['qr']."? Brought to you by Xurl! Visit us at http://2lk.nl/y","","5");
	echo '<h4>Here you go! Your QR CODE for the following link: '.$_POST['qr'].'</h4><br />';
	echo ' <img src="'.XOOPS_URL.'/uploads/qr.png">';
	*/
//}
//if(isset($_POST['Tsubmit'], $_POST['Tname'], $_POST['Tpass'], $_POST['comment']))
if(isset($_POST['Tsubmit'], $_POST['Tname']))
{

	$defaulttxt=xurl_sanitize($db,$config,$_POST['comment'],$config['user'],$config['pass'],'md5',true);

    $origtxt=$_POST['comment'];

	$tweet = new Twitter($_POST['Tname'], $_POST['Tpass']);	
	$Ttext = $defaulttxt." -- Send using Xurl(http://2lk.nl/l)";

	$success = $tweet->update($Ttext);
	if ($success) echo "Tweet successful!";
	else echo $tweet->error;
	echo "<br /><hr /><br />";
}

if(isset($_POST['submits'], $_POST['txt']))
{
	if(isset($_POST['uname'], $_POST['pass'])) // External Call, check uname and pass towards XOOPS database
	{
      $defaulttxt=xurl_sanitize($db,$config,$_POST['txt'],$_POST['uname'],$_POST['pass'],'plain');
	  $origtxt=$_POST['txt'];
	} else {
		$defaulttxt=xurl_sanitize($db,$config,$_POST['txt'],$config['user'],$config['pass'],'md5');	// within XOOPS
		$origtxt=$_POST['txt'];
	}
}

if(isset($_POST['submit'], $_POST['url']))
{
//	if (substr(strtolower($_POST['url']),7 !== 'http://')) $_POST['url'] = 'http://'.$_POST['url'];
   if(filter_var($_POST['url'], FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false)
   {
	  $key = xurl('check',$db,$config,$_POST['url']); 															// check if url already in db
	  echo '<p style="text-align:left;"><table style="width:70%;"><tr><td colspan=2 style="width:300px;"></td></tr>';
      if ($key=="0")

	  {
	   	$key=xurl('store',$db,$config,$url,$config['user'],$config['pass'],'md5');  
	   	if ($key=="errorP") { echo _XURL_WRONG_PASS; } else
	   	{
			echo "<tr><td>"._XURL_NEW_URL.":</td><td>"; echo xurl('echo',$db,$config,$key)."</td></tr>";
			echo "<tr><td>"._XURL_ORI_URL.": ".$_POST['url']."</td></tr>";
			if ($config['config']['qr']=="yes") echo "<tr><td colspan=2><p style='text-align:center;'><h3>"._XURL_QRCODE.":</h3></p></td></tr><tr><td colspan=2  style=\"background-image:url(".XOOPS_URL."/uploads/Xurl/qr_".$key.".png); background-position:top; background-repeat:no-repeat; width:300px;\"><img src=".XOOPS_URL."/images/blank.gif height=300 width=300></td></tr>";			
			echo "</table></p>";
		}
		
	  } else
	  {
	  		echo "<tr><td>"._XURL_STO_URL.":</td><td style='text-align:left;'>"; echo xurl('echo',$db,$config,$key)."</td></tr>";
			echo "<tr><td>"._XURL_ORI_URL.":</td><td>".$_POST['url']."</td></tr>";
			if ($config['config']['qr']=="yes")
			{ 
				if (file_exists($config['config']['qr_path']."qr_".$key.".png")) echo "<tr><td style='text-align:center;' colspan=2><p align=center><h3>Your QRCode:</h3></p></td></tr><tr><td colspan=2 style=\"background-image:url(".XOOPS_URL."/uploads/Xurl/qr_".$key.".png); background-position:top; background-repeat:no-repeat; width:300px;\"><img src=".XOOPS_URL."/images/blank.gif height=300 width=300></td></tr>";	
			}
			echo "</table></p>";
	  	}
   	} else echo "< span style='color: #ff0000; font-weight: bold;'>"._XURL_WRONG_URL."</span>";
	  
}
else {
?>
<p style="text-align:right;">
	<form method="post" action="index.php">
		<label><?php echo _XURL_ORI_URL; ?>:</label>
		<input type="text" size="50" name="url" id="url" />
		<br />
		<input type="submit" name="submit" id="submit" value=<?php echo _XURL_SUBMIT; ?> />
	</form>
	<br />
	<form method="post" action="index.php">
		<label><?php echo _XURL_SANITIZE; ?>:</label>
		<textarea cols="30" rows="5" name="txt" id="txt" /></textarea>
		<br />
		<input type="submit" name="submits" id="submit" value=<?php echo _XURL_S_SUBMIT; ?> />
	</form>
</p>
<?php
if ($message != '')
{
	echo "<p>".$message."</p>";
}
if ($defaulttxt != '') {
echo '<table><tr><td>'._XURL_SAN_TXT.':</td></tr><tr><td style="text-align:left; width:200px; background-color: #eee;">'.stripslashes($defaulttxt).'</td></tr></table><br />';
echo '<table><tr><td>'._XURL_ORI_TXT.':</td></tr><tr><td style="text-align:left; width:200px; background-color: #ccc;">'.stripslashes($origtxt).'</td></tr></table>';
}
// User created URLs

$where=" WHERE user='".$config['user']."'";
$selection = "SELECT * FROM ".$xoopsDB->prefix("xurl").$where;
$sql = $xoopsDB->queryF($selection);
$aantal = mysql_num_rows($sql);
if ($aantal>0)
{
	
?>
<script type="text/javascript"> 
function toggle(showHideDiv, switchTextDiv) {
	var ele = document.getElementById(showHideDiv);
	var text = document.getElementById(switchTextDiv);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "show";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide";
	}
} 
</script>

<br /><br />
<p style="text-align:right;">
	<a id="header" href="javascript:toggle('url_manager','header');"><?php echo _XURL_MAN_SHOW1."</a> "._XURL_MAN_SHOW2."";?>
</p>
<div id="url_manager" style="display: none; width:auto;">
	<h4><?php echo _XURL_MAN_SHOW2;?></h4>
	<?php
		echo "<p style='color:#0000ff;'>"._XURL_MAN_CREA1." <strong>".$aantal."</strong> "._XURL_MAN_CREA2."</p>";
		echo '<table style="font-size:7px; clear:right; max-width:500px; border: solid; border-width:thin;"><tr style="font-size:xx-small;">';
		echo "<td><strong>"._XURL_MAN_S_URL."</strong></td><td><strong>"._XURL_MAN_DATE."</strong></td><td><strong>"._XURL_MAN_HITS."</strong></td><td><strong>"._XURL_MAN_DEL."</strong></td></tr>";
		$bcol="#ccc";
		$bcol2="#eee";
		$evenrow=false;

		while ($rij = $xoopsDB->fetchArray($sql))
			{
			echo "<tr style='background-color:".$bcol."'><td style='color:#ff0000;'>".$config['config']['baseurl'].$rij['key']."</td><td>".$rij['d_added']."</td><td>".$rij['hits']."</td><td style='background-color:#ddd; text-align:center; vertical-align:middle;' rowspan=2><a href=".$_SERVER['PHP_SELF']."?delete=".$rij['key']."><img src=".XOOPS_URL."/modules/Xurl/images/del.png border=0 alt=''></a></td></tr>";
			echo "<tr style='background-color:".$bcol2."'><td colspan=3 style='font-size:x-small'><strong>"._XURL_MAN_O_URL.": </strong>".$rij['url']."<br /><strong>"._XURL_MAN_LCLICK.": </strong>".$rij['d_l_click']."</td></tr><tr><td colspan=4>&nbsp;</td></tr>";
			}
		echo "</table>";
	?>
</div>
<?php	
}

}
}
require(XOOPS_ROOT_PATH.'/footer.php');
?>
