<?php
	
	/* Course: CPRG 210
	   Author: MPoffenroth
	   Usage: 
	   Function: Functions used on Travel Packages page
	   Date: 2015/05/25
	*/ 
	
	// Move this to variables.php or db
	$packageText = array(
		"Travel Experts" => "Welcome to Travel Experts",
		"Caribbean" => "Start off the New Year on a relaxed and cheerful note on the warm, sandy shores of the Caribbean.",
		"Polynesian" => "In Hawaii, your vacation can be whatever you want it to be, from relaxed to adventurous.",
		"Asian" => "Travel to Asia and experience a rich tapestry of fascinating cultures, exotic landscapes, and age-old traditions.",
		"European" => "Experience a variety of cultures and famous sites as you see what this charming Old World continent has to offer."
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
			
			// Check packageName 1-4 Caribbean Polynesia Asia Europe
			if (!empty($_GET['packageName']))
			{
				$sql .= " AND PackageId = " . $_GET['packageName'] ;
			}
			
			// Check date start and end  
			if ( (!empty($_GET['dateStart'])) && (!empty($_GET['dateEnd'])) )
			{
				$sql .= " AND PkgStartDate > '" . $_GET['dateStart'] . "' AND PkgStartDate < '" . $_GET['dateEnd'] . "'"; 
			}
			
			// Check type Cruise Inclusive Eco Rail	
			if (!empty($_GET['type']))
			{
				$sql .= " AND PkgDesc LIKE '%" . $_GET['type'] . "%'";
			}
			
			// Check budget *1000	
			if (!empty($_GET['budget']))
			{
				$sql .= " AND (PkgBasePrice + PkgAgencyCommission) < " . $_GET['budget'] ;
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
							<dd><div id='pack-date-end'>Returning: " . $myDateEnd . "</div><br/></dd>
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
							<dt><dd><div class='pack-date-start" . $row["PackageId"] . "'>This Vacation Package is currently unavailable</div></dd></dt>
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
								<h2>" . $row["PkgName"] . " $" . number_format($totalPrice, 0) . "</h2>
								<dl><dd><div class='pack-date-start" . $row["PackageId"] . "'>Departure: " . $myDateStart . "</div></dd>
								<dd><div class='pack-date-end'>Returning: " . $myDateEnd . "</div><br/></dd></dl>
								<div>" . $packageText[$myPkgName] . "</div>
								<div>Package Includes: " . $row["PkgDesc"] . "</div>
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
