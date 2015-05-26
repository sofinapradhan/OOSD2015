<?php
	/* Course: CPRG 210
	   Author: Mark Poffenroth
	   Usage: Requires package_functions.php
	   Function: Travel Packages page
	   Date: 2015/05/25
	*/ 
	
	$header_title = "Travel Booking";
	$header_style = ["packages.css"];
	$header_script = ["packages.js"];
	require("header.php");
	require("db.php");
	
	print ("<main>");

	include("package_functions.php");
	
	// Check if package details button was clicked and show that package
	if(isset($_GET['packageID']))
	{
		selectPackages();
	}
?>
	
	<div class='package-mini'>
		<table>
			<?php selectPackagesMini(); ?>
		</table>
	</div>


<?php
	print("</main>");
	include("footer.php");

?>
