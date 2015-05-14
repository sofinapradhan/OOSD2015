<?php
	$header_title = "Travel Booking";
	$header_style = ["packages.css"];
	$header_script = ["packages.js"];
	require("header.php");
	require("db.php");
	
	print ("<main>");
?>
	
		<?php
		include("package_functions.php");
		selectPackages(0);
		?>

<?php
	print("</main>");
	include("footer.php");

?>
