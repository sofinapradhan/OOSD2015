<?php

	function selectPackages($packageID)
	{
		$imagetext = array(
			"",
			"With hundreds of miniature islands surrounded by warm, crystalline seas, the Bahamas is both evocative and idyllic.",
			"Mexico is exuberant, colourful and dripping with natural wonders, yet accessorised by just enough chic to entice the most decadent of tastes.",
			"Barbados holidays have long been considered the ultimate escape by many with the coral sands, swaying palms and tempting waters only part of the appeal.",
			"Antigua, an utterly relaxed island, blessed with icing sugar beaches lapped by clear azure waters, picturesque coves, and an unpretentious charm."
		);
	
		$dbh = @mysqli_connect("localhost","root","","travelexperts") or die("SQL Error: " . mysqli_connect_error()); 
	
		if ($packageID == 0) 
		{
			$sql = "SELECT * FROM Packages";
		}
		else 
		{
			$sql = "SELECT * FROM Packages WHERE Packages.PackageId = $packageID";
		}
			
		$result = mysqli_query($dbh, $sql) or die("Error: " . mysqli_error($dbh)); 
		
		// gets result w assoc key
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			$i = $row["PackageId"];
			$totalPrice = $row["PkgBasePrice"] + $row["PkgAgencyCommission"];
			print("
				<table><tr>
					<td>
					<img src='images/package_" . $row["PkgName"] . ".jpg' height='360' width='480'>			
					
					</td>
						<td>
					<h1>" . $row["PkgName"] . " $" . number_format($totalPrice, 0) . "</h1>
					
					<p>" . $imagetext[$i] . "</p>
					<dl align='left'>
						<p>Start Date: " . $row["PkgStartDate"] . "</p>
						<p>End Date: " . $row["PkgEndDate"] . "</p>
					</dl>
					<p>Package Includes:" . $row["PkgDesc"] . "</p>
					</td>
				</tr></table>
				
				<table><tr>
					<td>
					<dl align='left'>
					<img src='images/package_" . $row["PkgName"] . ".jpg' height='120' width='120'>
					<img src='images/package_" . $row["PkgName"] . ".jpg' height='120' width='120'>
					<img src='images/package_" . $row["PkgName"] . ".jpg' height='120' width='120'>
					<img src='images/package_" . $row["PkgName"] . ".jpg' height='120' width='120'>
					</dl>
					</td>
				</tr></table>
				<hr>
			");	
		} 
		
		mysqli_close($dbh);
	}


?>
