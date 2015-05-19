<?php

/* Written by Sofina Pradhan
 * Date: 2015/05/17
 * Usage: show the contact information for all Agencies, as well as all agents under each agencies.
 */
 
   include("db.php");        
   $agentid =$_GET['id'];    //getting agentid from contact page to show the list of agents for the particular Agency
   $query = "select * from Agencies where Agencyid = $agentid ";
   $result = mysqli_query($con, $query) or die (" SQL query error");
   while ($row = mysqli_fetch_assoc($result))
   {
        $mainaddress = "";
		$mainaddress  = "<p><h4>Address: $row[AgncyAddress]<br />";
		$mainaddress .= "$row[AgncyCity] \n";
		$mainaddress .= "$row[AgncyProv] <br />";
		$mainaddress .= "$row[AgncyPostal] \n";
		$mainaddress .= "$row[AgncyCountry] <br />";
		$mainaddress .= "Phone No: .$row[AgncyPhone] <br />";
		$mainaddress .= "Fax No: .$row[AgncyFax] <br /></h></p>";
		print($mainaddress);
   }
?>   
	
<!DOCTYPE html>


<html>
	<head>
		<title>Agents Information</title>
		<link href="contact.css" type="text/css" rel="stylesheet">   
	</head>
	<body bgcolor=#FACFAA> 
			
					<?php           // show the list of agents filter by Agencyid
					    $sql = "select AgtFirstName,AgtMiddleInitial,AgtLastName,AgtBusPhone,AgtEmail,AgtPosition from agents where Agencyid = $agentid order by AgtFirstName";
						$result = mysqli_query($con, $sql) or die("SQL Error");
                           
					?>
					
					<table border="1" cellpadding="5" cellspacing="0">
					   <thead>
	                     <tr>
						    <th class="tableheader">First Name</th>
							<th class="tableheader">Middle Name</th>
							<th class="tableheader">Last Name</th>
							<th class="tableheader">Business Phone Number</th>
							<th class="tableheader">Email Address</th>
							<th class="tableheader">Position</th>
						 </tr>
					   </thead>	 
	   
						<tbody>
						    <?php   while($row = mysqli_fetch_assoc($result))  { ?>
						    <tr>
							    <td><?php echo $row["AgtFirstName"]; ?></td>
							    <td><?php echo $row["AgtMiddleInitial"]; ?></td>
							    <td><?php echo $row["AgtLastName"]; ?></td>
							    <td><?php echo $row["AgtBusPhone"]; ?></td>
							    <td><?php echo $row["AgtEmail"]; ?></td>
							    <td><?php echo $row["AgtPosition"]; ?></td>
						    </tr>
							<?php } ?>  
							<?php  mysqli_close($con); ?>
			            </tbody>
			        </table>
	</body>
	
</html> 