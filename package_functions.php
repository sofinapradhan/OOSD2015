<?php


/*
You will need to use the following tables to enhance the web pages you developed earlier:
1.	Packages
2.	Products
3.	Packages_products
4.	Agencies
5.	Agents
6.	Customers
7.	Bookings

Each package should display a description, start and end dates, and price.  



3.	When the package list is being generated, create an order button next to each package which will go to an order page that has a customer order form for that package.  Customers will enter their data and submit the order which will result in creation of a customer record and a booking record.  

*/

	// Move this to variables.php or db
	$imagetext = array(
		"",
		"Exchange the winter cold for the warm, sandy shores of the Caribbean - an excellent way to start off the New Year on a relaxed and cheerful note.",
		"In Hawaii, your vacation can be whatever you want it to be. From relaxed to adventurous, from beautiful beaches to breathtaking views.",
		"Travel to Asia and experience a rich tapestry of fascinating cultures, exotic landscapes, and age-old traditions.",
		"A European vacation is like no other. Experience a variety of cultures and famous sites as you see what this charming Old World continent has to offer."
	);
	
	// move to functions.php
	// Takes date() and formats it to our standard 
	function formatDate($date)
	{
		$rawDate = date_create($date);
		$myDate = date_format($rawDate, 'M d, Y');
		return ($myDate);
	}
	
	// 
	function selectPackages($packageID)
	{
		global $imagetext;
	
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
			
			// MySQL store date in PHP equivalent of: date("Y-m-d H:i:s"); 
			$myDateStart = formatDate($row["PkgStartDate"]);
			$myDateEnd = formatDate($row["PkgEndDate"]);
			$myPkgName = explode(' ',trim($row["PkgName"]));
					
			// Compare package date to current date; only show valid packages >= current date
			if (strtotime($row['PkgEndDate']) < time() )
			{
			
			print("
			
			<div class='package-main'>
				<table>
					<tr><td><img src='img/pack_" . $myPkgName[0] . ".jpg'></td></tr>
					<tr><td>
						<img id='img-pack-micro' src='img/pack_" . $myPkgName[0] . $i . ".jpg' >
						<img id='img-pack-micro' src='img/pack_" . $myPkgName[0] . $i . ".jpg' >
						<img id='img-pack-micro' src='img/pack_" . $myPkgName[0] . $i . ".jpg' >
						<img id='img-pack-micro' src='img/pack_" . $myPkgName[0] . $i . ".jpg' >
					</td></tr>
				</table>
			</div>
			<div class='package-main'>
				<table>
					<tr><td><h1>" . $row["PkgName"] . " $" . number_format($totalPrice, 0) . "</h1></td></tr>
					<tr><td><p align='left'>" . $imagetext[$i] . "</p></td></tr>
					<tr><td>
						<p class='pack-date-start'>Start Date: " . $myDateStart . "</p>
						<p id='pack-date-end'>End Date: " . $myDateEnd . "</p></td></tr>
					<tr><td><p>Package Includes:" . $row["PkgDesc"] . "</p></td></tr>		
				</table>
			</div>
			
			");	
			}

			// If package start date < current date, use CSS to make start date bold and red.
			if (strtotime($row['PkgStartDate']) < time() )
			{
				print("<script>setColorRed('pack-date-start');</script>");
			}
		} 
		
		mysqli_close($dbh);
	}


?>
