<?php
	$header_title = "Travel Booking";
	$header_style = ["packages.css"];
	$header_script = ["packages.js"];
	require("header.php");
	require("db.php");
	
	print ("<main>");

	include("package_functions.php");
?>
	
	<div class='package-mini'>
		<table>
			<?php selectPackagesMini(); ?>
		</table>
	</div>

	<?php
		// Check if package details button was clicked and show that package
		if(isset($_POST['packageID']))
		{
			selectPackages($_POST['packageID']);
		}
	?>	

	

<?php
	print("</main>");
	include("footer.php");

?>
