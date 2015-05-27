<?php
/* Written by lpeters
 * Date: 2015/05/12
 * Usage: User Interface.
 */
$header_title = "Travel Booking";
$header_style = ["register.css"];
$header_script = ["register.js"];
require("header.php");
require("db.php");
print ("<main>");
if (isset($_POST['gobutton']))
{
	$customerid = NULL;
	foreach($_POST as $field=>$value)
	{
		print("$field=$value<br />");
	}
	if (isset($_POST['custfirstname'],$_POST['custlastname'],$_POST['custaddress'],$_POST['custcity'],$_POST['custprov'],$_POST['custcountry'],$_POST['custpostal'],$_POST['custhomephone'],$_POST['custbusphone'],$_POST['custemail']))
	{
		print("All customer information present, uploading to database.<br />");
		$custfirstname = preg_replace('/[^a-zA-Z]/', '', $_POST['custfirstname']);
		$custlastname = preg_replace('/[^a-zA-Z]/', '', $_POST['custlastname']);
		$custaddress = preg_replace('/[^a-zA-Z0-9 #,.-]/', '', $_POST['custaddress']);
		$custcity = preg_replace('/[^a-zA-Z ]/', '', $_POST['custcity']);
		$custprov = preg_replace('/[^a-zA-Z]/', '', $_POST['custprov']);
		$custcountry = preg_replace('/[^a-zA-Z]/', '', $_POST['custcountry']);
		$custpostal = preg_replace('/[^a-zA-Z0-9 ]/', '', $_POST['custpostal']);
		$custhomephone = preg_replace('/[^0-9]/', '', $_POST['custhomephone']);
		$custbusphone = preg_replace('/[^0-9]/', '', $_POST['custbusphone']);
		$custemail = preg_replace('/[^a-zA-Z0-9 @._-]/', '', $_POST['custemail']);
		/* This is only temporary, replace it with prepared statements and proper input sanitation. */
		$sql = "INSERT INTO `customers` (`CustomerId`, `CustFirstName`, `CustLastName`, `CustAddress`, `CustCity`, `CustProv`, `CustCountry`, `CustPostal`, `CustHomePhone`, `CustBusPhone`, `CustEmail`, `AgentId`) VALUES (NULL, '$custfirstname', '$custlastname', '$custaddress', '$custcity', '$custprov', '$custcountry', '$custpostal', '$custhomephone', '$custbusphone', '$custemail', NULL);";
		print("<b>Query:</b> $sql<br />");
		$result = mysqli_query($con, $sql) or die('Query Failed: ' . mysqli_error($con));
		print("<b>Result:</b> $result<br />");
		$customerid = mysqli_insert_id($con);
		print "Successfully added new customer #$customerid.<br />";
		//mysqli_free_result($result);
	}
	if ($customerid != NULL && isset($_POST['destination'],$_POST['travelercount'],$_POST['triptype']))
	{
		print("All booking information present, uploading to database.<br />");
		$packageid = preg_replace('/[^0-9]/', '', $_POST['destination']);
		$travelercount = preg_replace('/[^0-9]/', '', $_POST['travelercount']);
		$triptypeid = preg_replace('/[^A-Z]/', '', $_POST['triptype']);
		$sql = "INSERT INTO `bookings` (`BookingId`, `BookingDate`, `BookingNo`, `TravelerCount`, `CustomerId`, `TripTypeId`, `PackageId`) VALUES (NULL, CURDATE(), UPPER(LEFT(UUID(), 8)), '$travelercount', $customerid, '$triptypeid', '$packageid');";
		print("<b>Query:</b> $sql<br />");
		$result = mysqli_query($con, $sql) or die('Query Failed: ' . mysqli_error($con));
		print("<b>Result:</b> $result<br />");
		$bookingid = mysqli_insert_id($con);
		print "Successfully added new booking #$bookingid.<br />";
		//mysqli_free_result($result);
	}
	if ($customerid != NULL && isset($_POST['ccname'],$_POST['ccnumber'],$_POST['ccexpiry']))
	{
		print("All payment information present, uploading to database.<br />");
		$ccname = preg_replace('/[^a-zA-Z]/', '', $_POST['ccname']);
		$ccnumber = preg_replace('/[^0-9]/', '', $_POST['ccnumber']);
		$ccexpiry = preg_replace('/[^0-9-]/', '', $_POST['ccexpiry']) . "-00";
		$sql = "INSERT INTO `creditcards` (`CreditCardId`, `CCName`, `CCNumber`, `CCExpiry`, `CustomerId`) VALUES (NULL, '$ccname', '$ccnumber', '$ccexpiry', $customerid);";
		print("<b>Query:</b> $sql<br />");
		$result = mysqli_query($con, $sql) or die('Query Failed: ' . mysqli_error($con));
		print("<b>Result:</b> $result<br />");
		$creditcardid = mysqli_insert_id($con);
		print "Successfully added new card #$creditcardid.<br />";
		//mysqli_free_result($result);
	}
	mysqli_close($con);
}
else
{
	$packList = Array('------ Go To ------');
	$costList = Array('N/A');
	$typeList = Array('TripType');
	// Populate $packList and $costList from DB.
	$sql = 'SELECT `PackageId`, `PkgName`, (`PkgBasePrice`+`PkgAgencyCommission`) AS `PkgPrice` FROM `packages`;';
	$result = mysqli_query($con, $sql) or die('Query Failed: ' . mysqli_error($con));
	while($row = mysqli_fetch_array($result)) {
		$packList[$row['PackageId']] = $row['PkgName'];
		$costList[$row['PackageId']] = "\$" . substr($row['PkgPrice'],0,-2);
	}
	mysqli_free_result($result);
	// Populate $typeList from DB.
	$sql = 'SELECT `TripTypeId`, `TTName` FROM `triptypes`;';
	$result = mysqli_query($con, $sql) or die('Query Failed: ' . mysqli_error($con));
	while($row = mysqli_fetch_array($result)) {
		$typeList[$row['TripTypeId']] = $row['TTName'];
	}
	mysqli_free_result($result);
	mysqli_close($con);
	print("<script>
	costList = ['" . implode("','", $costList) . "'];
	function viewCost(key)
	{
		document.getElementById('formCost').innerHTML = costList[key];
	}
	</script>");
/*
<p id='fh-custfirstname' class='formHint'>Customer's First Name.</p>
<p id='fh-custlastname' class='formHint'>Customer's Last Name.</p>
<p id='fh-custaddress' class='formHint'>Customer's Home Address.</p>
<p id='fh-custcity' class='formHint'>Customer's Home City.</p>
<p id='fh-custprov' class='formHint'>Customer's Home Province.</p>
<p id='fh-custcountry' class='formHint'>Customer's Home Country.</p>
<p id='fh-custpostal' class='formHint'>Customer's Postal Code.</p>
<p id='fh-custhomephone' class='formHint'>Customer's Home Phone Number.</p>
<p id='fh-custbusphone' class='formHint'>Customer's Work Phone Number.</p>
<p id='fh-custemail' class='formHint'>Customer's E-mail Address.</p>
<p id='fh-destination' class='formHint'>Travel Destination.</p>
<p id='fh-ccname' class='formHint'>Credit Card Provider.</p>
<p id='fh-ccnumber' class='formHint'>Credit Card Number.</p>
<p id='fh-ccexpiry' class='formHint'>Credit Card Expiration.</p>
*/
print("<article>
<form id='regForm' name='register' method='post' action='{$_SERVER['PHP_SELF']}' onReset='clearWarn();'>
<table>
<tr><th colspan=2'>Customer Information</th><th class='formicon'></th><th class='formicon'></th><th colspan=2'>Customer Information</th><th class='formicon'></th><th class='formicon'></th></tr>
<tr><td><label for='custfirstname'>First Name:</label></td>
	<td><input type='text' name='custfirstname' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custfirstname'><img class='formicon' src='img/icon_info.png' title='Customers First Name'></td>
	<td id='fb-custfirstname'></td>
	<td><label for='custlastname'>Last Name:</label></td>
	<td><input type='text' name='custlastname' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custlastname'><img class='formicon' src='img/icon_info.png' title='Customers Last Name'></td>
	<td id='fb-custlastname'></td></tr>
<tr><td><label for='custaddress'>Address:</label></td>
	<td><input type='text' name='custaddress' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custaddress'><img class='formicon' src='img/icon_info.png' title='Customers Address'></td>
	<td id='fb-custaddress'></td></tr>
<tr><td><label for='custcity'>City:</label></td>
	<td><input type='text' name='custcity' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custcity'><img class='formicon' src='img/icon_info.png' title='Customers Home City'></td>
	<td id='fb-custcity'></td></tr>
<tr><td><label for='custprov'>Province:</label></td>
	<td><select name='custprov' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>
	<option value=''>---- Select Province ----</option>
	<option value='AB'>Alberta</option>
	<option value='BC'>British Columbia</option>
	<option value='MB'>Manitoba</option>
	<option value='NB'>New Brunswick</option>
	<option value='NL'>Newfoundland and Labrador</option>
	<option value='NS'>Nova Scotia</option>
	<option value='NT'>Northwest Territories</option>
	<option value='NU'>Nunavut</option>
	<option value='ON'>Ontario</option>
	<option value='PE'>Prince Edward Island</option>
	<option value='QC'>Quebec</option>
	<option value='SK'>Saskatchewan</option>
	<option value='YT'>Yukon</option>
	</select></td>
	<td id='fi-custprov'><img class='formicon' src='img/icon_info.png' title='Customers Home Province'></td>
	<td id='fb-custprov'></td></tr>
<tr><td><label for='custcountry'>Country:</label></td>
	<td><select name='custcountry' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>
	<option value=''>---- Select Country ----</option>
	<option value='CA'>Canada</option>
	<option value='US'>United States of America</option>
	</select></td>
	<td id='fi-custcountry'><img class='formicon' src='img/icon_info.png' title='Customers Home Country'></td>
	<td id='fb-custcountry'></td></tr>
<tr><td><label for='custpostal'>Postal Code:</label></td>
	<td><input type='text' name='custpostal' 
	maxlength='7'
	onChange='this.value = this.value.toUpperCase();'
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custpostal'><img class='formicon' src='img/icon_info.png' title='Customers Postal Code'></td>
	<td id='fb-custpostal'></td></tr>
<tr><td><label for='custhomephone'>Home Phone:</label></td>
	<td><input type='text' name='custhomephone' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custhomephone'><img class='formicon' src='img/icon_info.png' title='Customers Home Phone'></td>
	<td id='fb-custhomephone'></td></tr>
<tr><td><label for='custbusphone'>Work Phone:</label></td>
	<td><input type='text' name='custbusphone' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custbusphone'><img class='formicon' src='img/icon_info.png' title='Customers Work Phone'></td>
	<td id='fb-custbusphone'></td></tr>
<tr><td><label for='custemail'>E-mail Address:</label></td>
	<td><input type='text' name='custemail' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-custemail'><img class='formicon' src='img/icon_info.png' title='Customers E-mail Address'></td>
	<td id='fb-custemail'></td></tr>
<tr><th colspan=2'>Package Information</th><th></th><th></th></tr>
<tr><td><label for='destination'>Destination:</label></td>
	<td><select name='destination' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' onChange='viewCost(this.value);'>");
	foreach ($packList as $key=>$val)
	{
		print("<option value='$key'" . (isset($_GET['packageID']) && $_GET['packageID'] == $key ? " selected" : NULL) . ">$val</option>");
	}
print ("</select></td>
	<td id='fi-destination'><img class='formicon' src='img/icon_info.png' title='Travel Destination'></td>
	<td id='fb-destination'></td></tr>
<tr><td><label for='travelercount'>Group Size:</label></td>
	<td><input type='text' name='travelercount' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-travelercount'><img class='formicon' src='img/icon_info.png' title='Number of Travelers'></td>
	<td id='fb-travelercount'></td></tr>
<tr><td><label for='triptype'>Trip Type:</label></td>
	<td><select name='triptype' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>");
	foreach ($typeList as $key=>$val)
	{
		print("<option value='$key'>$val</option>");
	}
print ("</select></td>
	<td id='fi-triptype'><img class='formicon' src='img/icon_info.png' title='Type of Trip'></td>
	<td id='fb-triptype'></td></tr>
<tr><td>Price:</td>
	<td><span id='formCost'>" . $costList[(isset($_GET['packageID']) ? preg_replace('/[^0-9]/','',$_GET['packageID']) : 0)] . "</span></td>
	<td></td><td></td></tr>
<tr><th colspan=2'>Payment Information</th><th></th><th></th></tr>
<tr><td><label for='ccname'>Method of Payment:</label></td>
	<td>
	<input type='radio' name='ccname' value='AMEX' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_amex.png' alt='American Express' /></input>
	&nbsp;
	<input type='radio' name='ccname' value='Diners' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_dine.png' alt='Diners Club' /></input>
	&nbsp;
	<input type='radio' name='ccname' value='MC' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_mast.png' alt='MasterCard' /></input>
	&nbsp;
	<input type='radio' name='ccname' value='VISA' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_visa.png' alt='Visa' /></input>
	</td>
	<td id='fi-ccname'><img class='formicon' src='img/icon_info.png' title='Credit Card Provider'></td>
	<td id='fb-ccname'></td>
	</tr>
<tr><td><label for='ccnumber'>Card Number:</label></td>
	<td><input type='text' name='ccnumber' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-ccnumber'><img class='formicon' src='img/icon_info.png' title='Credit Card Number'></td>
	<td id='fb-ccnumber'></td></tr>
<tr><td><label for='ccexpiry'>Expiration:</label></td>
	<td><input type='month' name='ccexpiry' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td>
	<td id='fi-ccexpiry'><img class='formicon' src='img/icon_info.png' title='Credit Card Expiration'></td>
	<td id='fb-ccexpiry'></td></tr>
<tr><td></td><td align='center'><input type='reset' name='rsbutton' value='Reset Form' onClick='return confirm(\"Are you sure you want to reset form?\");' /></td><td></td><td></td>
	<td></td><td align='center'><input type='submit' name='gobutton' value='Submit Form' onClick='return checkForm();' /></td><td></td><td></td></tr>
</table>
</form>
</article>");
}
print("</main>");
require("footer.php");
?>
