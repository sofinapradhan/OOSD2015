<?php

	// Move this to variables.php or db
	$packageText = array(
		"Travel Experts"  => "Welcome to Travel Experts",
		"Caribbean" => "Exchange the winter cold for the warm, sandy shores of the Caribbean - an excellent way to start off the New Year on a relaxed and cheerful note.",
		"Polynesian" => "In Hawaii, your vacation can be whatever you want it to be. From relaxed to adventurous, from beautiful beaches to breathtaking views.",
		"Asian" => "Travel to Asia and experience a rich tapestry of fascinating cultures, exotic landscapes, and age-old traditions.",
		"European" => "A European vacation is like no other. Experience a variety of cultures and famous sites as you see what this charming Old World continent has to offer."
	);
	
	$packageImage = array(
		"Asian" => "img/pack_asian.jpg", 
		"Caribbean" => "img/pack_caribbean.jpg", 
		"European" => "img/pack_european.jpg", 
		"Polynesian" => "img/pack_polynesian.jpg"
	);
	
	// move to functions.php
	// Takes date() and formats it to our standard 
	function formatDate($date)
	{
		$rawDate = date_create($date);
		$myDate = date_format($rawDate, 'M d, Y');
		return ($myDate);
	}
	
	// List all packages from search
	function selectPackagesMini()
	{
		// String to hold GET parameters for use on page reloads
		$strGET = $_SERVER['QUERY_STRING'];
		
		$dbh = @mysqli_connect("localhost","root","","travelexperts") or die("SQL Error: " . mysqli_connect_error()); 
			
		// Use $_GET parameters from index.php search form to display packages
		if ($_GET)
		{
			// Set initial SQL string
			$sql = "SELECT * FROM Packages WHERE PackageId > 0 ";
			
			// Check findRegion 1-4 Caribbean Polynesia Asia Europe
			if (!empty($_GET['findRegion']))
			{
				$sql .= " AND PackageId = " . $_GET['findRegion'] ;
			}
			
			// Check month 0-11 
			if (!empty($_GET['month']))
			{
				// Set date based on if month has passed this year or not
				if ($_GET["month"] < date("m") )
				{ 
					$year = date("Y") + 1;
				}
				else 
				{ 
					$year = date("Y");
				}
				// Set format of myDate to format used in MySQL
				$myDate = $year . "-" . $_GET['month'] . "-01 00:00:00";
				
				$sql .= " AND PkgStartDate < '" . $myDate ."'"; 
			}
			
			// Check Type Cruise Inclusive Eco Rail	
			if (!empty($_GET['Type']))
			{
				$sql .= " AND PkgDesc LIKE '%" . $_GET['Type'] . "%'";
			}
			
			// Check budget *1000	
			if (!empty($_GET['budget']))
			{
				$cost = $_GET['budget'] * 1000;
				$sql .= " AND (PkgBasePrice + PkgAgencyCommission) < " . $cost ;
			}
			
			$sql .= ";";
			//print ($sql);
		}
		
		// If no $_GET parameter then show all packages
		else 
		{
			$sql = "SELECT * FROM Packages";
		}
		
		$result = mysqli_query($dbh, $sql) or die("Error: " . mysqli_error($dbh)); 
		
		// Get result w assoc key
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			// Get first word in string
			$myPkgName = strtok($row["PkgName"], " ");
			
			// Get total packge price
			$totalPrice = $row["PkgBasePrice"] + $row["PkgAgencyCommission"];
			
			// MySQL store date in PHP equivalent of: date("Y-m-d H:i:s"); 
			$myDateStart = formatDate($row["PkgStartDate"]);
			$myDateEnd = formatDate($row["PkgEndDate"]);
			
			// Sanitize GEt string; removw packageID=[0-9]&
			$strGET = preg_replace("/packageID=[0-9]&/", "", $strGET, 1);
			
			// Compare package date to current date; only show valid packages >= current date
			if (strtotime($row['PkgEndDate']) >= time() )
			{
				print("
					<tr>
					<td><img id='img-pack-mini' src='img/pack_" . $myPkgName . "0.jpg'/></td>
					<td>
						<h2 align='left'>" . $row["PkgName"] . " $" . number_format($totalPrice, 0) . "</h2>
						<dl>
							<dd><div class='pack-date-start" . $row["PackageId"] . "'>Departure: " . $myDateStart . "</div></dd>
							<dd><div id='pack-date-end'>Returning: " . $myDateEnd . "</div><br/><br/></dd>
						</dl>
						<dl>
							<dd><a href='packages.php?packageID=" . $row["PackageId"] . "&" . $strGET . "'><button>Details</button></a><br/><br/></dd>
							<dd><a href='register.php?packageID=" . $row["PackageId"] . "'><button>Book Now</button></a><br/><br/></dd>
						</dl>
					<br/></td>
					</tr>
				");	
			}
			
			// Special format if package date < time()
			// Documentation says not to display outdated packages
			// We are just showing that we actually found package and flagged it as outdated, thus could instead not show it
			else
			{
				print("
					<tr>
					<td><img id='img-pack-mini' src='img/pack_" . $myPkgName . "0.jpg'/>
					<td>
						<h2 align='left'>" . $row["PkgName"] . " $" . number_format($totalPrice, 0) . "</h2>
						<dl>
							<dt><div class='pack-date-start" . $row["PackageId"] . "'>This Vacation Package is currently unavailable</div></dt>
							<dd><a href='index.php'><br/><button>Search Again</button></a><br/><br/></dd>
					<br/><br/></td>
					</tr>
				");
			}
			
			// If package start date < current date, use CSS to make start date bold and red
			if (strtotime($row['PkgStartDate']) < time() )
			{
				print("<script>setColorRed('pack-date-start" . $row["PackageId"] . "');</script>");
			}
		} 
		
		mysqli_close($dbh);
	}
	
	
	// Details of selected package 
	function selectPackages()
	{
		global $packageText;
		global $packageImage;
		
		$dbh = @mysqli_connect("localhost","root","","travelexperts") or die("SQL Error: " . mysqli_connect_error()); 
	
		if ($_GET['packageID'] == 0) 
		{
			$sql = "SELECT * FROM Packages";
		}
		else 
		{
			$sql = "SELECT * FROM Packages WHERE Packages.PackageId = " . $_GET['packageID'] . ";";
		}
		
		$result = mysqli_query($dbh, $sql) or die("Error: " . mysqli_error($dbh)); 
		
		// gets result w assoc key
		while($row = mysqli_fetch_assoc($result)) 
		{ 
			// Get first word in string
			$myPkgName = strtok($row["PkgName"], " ");
			
			// Get total packge price		
			$totalPrice = $row["PkgBasePrice"] + $row["PkgAgencyCommission"];
			
			// MySQL store date in PHP equivalent of: date("Y-m-d H:i:s"); 
			$myDateStart = formatDate($row["PkgStartDate"]);
			$myDateEnd = formatDate($row["PkgEndDate"]);
				
			// Compare package date to current date; only show valid packages >= current date
			if (strtotime($row['PkgEndDate']) >= time() )
			{
				print("
					<div class='package-main'>
						<table>
							<tr><td>
								<h1>" . $row["PkgName"] . " $" . number_format($totalPrice, 0) . "</h1>
								<p align='left'>" . $packageText[$myPkgName] . "</p>
								<p>
								<dl><dd><div class='pack-date-start" . $row["PackageId"] . "'>Departure: " . $myDateStart . "</div></dd>
								<dd><div class='pack-date-end'>Returning: " . $myDateEnd . "</div></dd></dl>
								</p>
								<p><div>Package Includes:" . $row["PkgDesc"] . "</div></p>
							</td></tr>
							<tr><td>
								<img id='img-pack-main' src='img/pack_" . $myPkgName . "0.jpg'></td></tr>
							<tr><td>
				");
							// Add image thumbnails and mouseover function
							for ($i=0; $i < count($packageText); $i++)
							{
								// Convert PHP variable value to JS for use in JS function
								print("<script> myPkgName[" . $i . "] = ");
								echo json_encode($myPkgName . $i); 
								print("</script>");
								print("	<img id='img-pack-micro' src='img/pack_" . $myPkgName . $i . ".jpg' onmouseover='showImageMini(myPkgName[" . $i . "])'>");    
							}
				print("
							</td></tr>
						</table>
					</div>
				");	
			}
			
			// If package start date < current date, use CSS to make start date bold and red
			if (strtotime($row['PkgStartDate']) < time() )
			{
				print("<script>setColorRed('pack-date-start" . $row["PackageId"] . "');</script>");
			}
		} 
		
		mysqli_close($dbh);
	}

?>
