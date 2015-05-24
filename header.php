<?php
/* Written by lpeters
 * Style by dostapenko
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
<link href='img/favicon.ico' rel='shortcut icon' type='image/x-icon' />
<link href='global.css' rel='stylesheet' type='text/css' />
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' rel='stylesheet' type='text/css' /> <!-- Latest compiled and minified CSS -->
<?php
if (isset($header_style))
{
	foreach($header_style as $stylesheet)
	{
		print("<link href='$stylesheet' rel='stylesheet' type='text/css' />\n");
	}
}
if (isset($header_script))
{
	foreach($header_script as $script)
	{
		print("<script src='$script'></script>\n");
	}
}
?>
</head>
<body>
<header>
<div id="logoBar">
<img src="img/mainLogo.png">
</div>
<div id="socialBar">
<a href="http://www.facebook.com"><img src="img/facebook.png"></a>
<a href="http://www.twitter.com"><img src="img/twitter.png"></a>
</div>
</header>
<nav>
	<div id="navBar">
		<ul>
			<li><a href="index.php" class="button">Home</a></li>
			<li><a href="packages.php?packageID=0" class="button">Travel Packages</a></li>
			<li><a href="register.php" class="button">Register</a></li>
			<li><a href="about.php" class="button">About / FAQ</a></li>
			<li><a href="contact.php" class="button">Contact</a></li>
		</ul>
	</div>
</nav>
