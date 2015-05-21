<?php
	$header_title = "Travel Booking";
	$header_style = ["packages.css"];
	$header_script = ["packages.js"];
	require("header.php");
	require("db.php");
	
	print ("<main>");

	$packageID = 1;
	include("package_functions.php");
?>
	
	<div class='package-mini'>
		<table>
			<tr><td>
			<?php selectPackagesMini(); ?>
			</td></tr>
		</table>
	</div>


	<?php
		if($_GET){
			if(isset($_GET['packageID'])){
			selectPackages($_GET['packageID']);
			}
		}
	?>	
	

<?php
	print("</main>");
	include("footer.php");

?>
