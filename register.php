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
	foreach($_POST as $field=>$value)
	{
		print("<p>$field=$value</p>");
	}
}
else
{
	print("<article>
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
<form id='regForm' name='register' method='post' action='{$_SERVER['PHP_SELF']}' onReset='clearWarn();'>
<table>
<tr><td><label for='custfirstname'>First Name:</label></td><td><input type='text' name='custfirstname' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custfirstname'></td></tr>
<tr><td><label for='custlastname'>Last Name:</label></td><td><input type='text' name='custlastname' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custlastname'></td></tr>
<tr><td><label for='custaddress'>Address:</label></td><td><input type='text' name='custaddress' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custaddress'></td></tr>
<tr><td><label for='custcity'>City:</label></td><td><input type='text' name='custcity' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custcity'></td></tr>
<tr><td><label for='custprov'>Province:</label></td><td><select name='custprov' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>
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
	</select></td><td id='fb-custprov'></td></tr>
<tr><td><label for='custcountry'>Country:</label></td><td><select name='custcountry' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>
	<option value=''>---- Select Country ----</option>
	<option value='CA'>Canada</option>
	<option value='US'>United States of America</option>
	</select></td><td id='fb-custcountry'></td></tr>
<tr><td><label for='custpostal'>Postal Code:</label></td><td><input type='text' name='custpostal' 
	maxlength='7'
	onChange='this.value = this.value.toUpperCase();'
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custpostal'></td></tr>
<tr><td><label for='custhomephone'>Home Phone:</label></td><td><input type='text' name='custhomephone' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custhomephone'></td></tr>
<tr><td><label for='custbusphone'>Bus. Phone:</label></td><td><input type='text' name='custbusphone' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custbusphone'></td></tr>
<tr><td><label for='custemail'>E-mail Address:</label></td><td><input type='text' name='custemail' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custemail'></td></tr>
<tr><td><label for='destination'>Destination:</label></td><td><select name='destination' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>
	<option value=''>---- Go To ----</option>
	<option value='cancun'>Cancun</option>
	<option value='hawaii'>Hawaii</option>
	<option value='leo'>Low Earth Orbit</option>
	</select></td><td id='fb-destination'></td></tr>
<tr><td rowspan='4' valign='top'><label for='ccname'>Method of Payment:</label></td>
	<td><input type='radio' name='ccname' value='AMEX' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_amex.png' alt='American Express' /></input></td><td id='fb-ccname' rowspan='4' valign='top'></td></tr>
<tr><td><input type='radio' name='ccname' value='Diners' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_dine.png' alt='Diners Club' /></input></td></tr>
<tr><td><input type='radio' name='ccname' value='MC' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_mast.png' alt='MasterCard' /></input></td></tr>
<tr><td><input type='radio' name='ccname' value='VISA' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'><img src='img/card_visa.png' alt='Visa' /></input></td></tr>
<tr><td><label for='ccnumber'>Card Number:</label></td><td><input type='text' name='ccnumber' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-ccnumber'></td></tr>
<tr><td><label for='ccexpiry'>Expiration:</label></td><td><input type='date' name='ccexpiry' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-ccexpiry'></td></tr>
<tr><td align='center'><input type='reset' name='rsbutton' value='Reset Form' onClick='return confirm(\"Are you sure you want to reset form?\");' /></td>
	<td align='center'><input type='submit' name='gobutton' value='Submit Registration' onClick='return checkForm();' /></td><td></td></tr>
</table>
</form>
</article>");
}
print("</main>");
require("footer.php");
?>
