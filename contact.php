<?php
/* Written by Sofina Pradhan
 * Date: 2015/05/12
 * Usage: show the contact information for all Agencies, as well as all agents under each agencies.
 */
require("header.php");
include("db.php");
?>
<script>
	function changeMousePointer(i)
	{
		document.getElementById("leftcol"+ i).style.cursor = "pointer";
	}

	function mouseClick(AgencyId)
	{
		var newwin;
		newwin = window.open("contactdetail.php",'','width=500, height=550, menubar=no');
		newwin.moveTo(200,300);
	}
</script>

<style>
	.imgfeildset
	{
		position:absolute;
		top:0%;
		height:90%;
		width:39%;
		overflow:scroll;
		border:1px solid black;
		visibility:visible;
		padding:20px;
	}

	.emailfeildset
	{
		position:absolute;
		left:43.5%;
		top:0%;
		width:44%;
		border:1px solid black;
		visibility:visible;
		padding:10px;
	}
</style>

<main id='wrapper'>
	<div class="imgfeildset">
		<h3><center>Agencies Contact Information:</center></h3>
		<?php
		$query = "select * from Agencies";
		$result = mysqli_query($con, $query) or die (" SQL query error");
		$i=0;
		while ($row = mysqli_fetch_assoc($result))
		{
			echo " <table>";
			echo "<tr><td width=200 >";
			echo "<p id='leftcol$i' onmouseover='changeMousePointer($i)' onClick='mouseClick($row[AgencyId])'>";
			echo "Address: ".$row["AgncyAddress"]."<br />";
			echo $row["AgncyCity"].","."\n";
			echo $row["AgncyProv"]."<br />";
			echo $row["AgncyPostal"].","."\n";
			echo $row["AgncyCountry"]."<br />";
			echo "Phone No: ".$row["AgncyPhone"]."<br />";
			echo "Fax No: ".$row["AgncyFax"]."<br />";
			echo "</p>";
			echo "</td></tr>";
			$outimage = "<iframe width='369' height='150' frameborder='1' scrolling='no' marginheight='0' marginwidth='0' src='";
			$outimage .= $row["Map"];
			$outimage .= "'></iframe>";
			echo "<tr><td >";
			print("$outimage <br />");
			echo "<hr>";
			echo "</td></tr>";
			echo "<tr height=8></tr>";
			$i = $i + 1;
			echo "</table>";
		}
		mysqli_close($con);
		?>
	</div>
	<div class="emailfeildset">
		Emailform
	</div>
</main>
<?php
require ("footer.php");
?>
