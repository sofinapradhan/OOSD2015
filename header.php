<?php
/* Written by lpeters
 * Style by spradhan
 * Date: 2015/05/12
 * Usage: Include at head of page.
 *     Set variables prior to include:
 *     $header_title is a string containing page title. (Optional)
 *     $header_style is an array of stylesheets to be included. (Optional)
 *     $header_script is an array of scripts to be included. (Optional)
 */
	if (!isset($header_title)) { $header_title = ucfirst(basename($_SERVER['PHP_SELF'], '.php')); }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<title><?= $header_title ?></title>
<link href='global.css' rel='stylesheet' type='text/css' />
<link href='menu.css' rel='stylesheet' type='text/css' />
<?php
if (isset($header_style))
{
	foreach($header_style as $stylesheet)
	{
		print("<link href='$stylesheet' rel='stylesheet' type='text/css' />");
	}
}
if (isset($header_script))
{
	foreach($header_script as $script)
	{
		print("<script src='$script'></script>");
	}
}
?>
</head>
<body>
<header>
	<div id='companylogo'> </div>   <!-- this is for logo -->
	<div id='header1'>
		<table width='1010' height='10'>
			<tr>
			<td align='right' width='60%'><img src='img/map.jpg' height='30' width='30'>Map & direction</td>
			<td align='right' width='15%'><img src='img/meeting.jpg' height='30' width='30'>Meetings</td>
			<td align='center'><img src='img/photog.jpg' width='30' height='30'>Photo Gallery</td>
			</tr>
		</table>
	</div>
	<div id='header2'>
		<div style='text-align:top;font-size:180%;width:100%;border:0px solid;'>Welcome to Travel Experts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size='5%'>Toll free Reservations (866) 555 7897</font></div>
	</div>
	<div id='header3'>
		<table>
			<tr>
			<td width='5%' align='center'><a href='index.php'>Home</a></td>
			<td width='9%' align='center'><a href='packages.php'>Packages</a></td>
			<td width='10%' align='center'><a href='register.php'>Register</a></td>
			<td width='10%' align='center'><a href='vacation.php'>Vacation</a></td>
			<td width='10%' align='center'><a href='contact.php'>Contact</a></td>
			<td width='10%' align='center'><a href='about.php'>About</a></td>
			</tr>
		</table>
		<hr>
	</div>
</header>
