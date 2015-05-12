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
<p id='fh-custname' class='formHint'>Customer's First Name.</p>
<p id='fh-custaddy' class='formHint'>Customer's Last Name.</p>
<p id='fh-custcity' class='formHint'>Customer's Home City.</p>
<p id='fh-custprov' class='formHint'>Customer's Home Province.</p>
<p id='fh-custpost' class='formHint'>Customer's Postal Code.</p>
<p id='fh-destination' class='formHint'>Travel Destination.</p>
<p id='fh-paymethod' class='formHint'>Monetary Compensation Transaction Protocol.</p>
<form id='regForm' name='register' method='post' action='{$_SERVER['PHP_SELF']}' onReset='clearWarn();'>
<table>
<tr><td><label for='custpnom'>First Name:</label></td><td><input type='text' name='custpnom' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custpnom'></td></tr>
<tr><td><label for='custsnom'>Last Name:</label></td><td><input type='text' name='custsnom' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custsnom'></td></tr>
<tr><td><label for='custaddy'>Address:</label></td><td><input type='text' name='custaddy' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custaddy'></td></tr>
<tr><td><label for='custcity'>City:</label></td><td><input type='text' name='custcity' onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custcity'></td></tr>
<tr><td><label for='custprov'>Province:</label></td><td><select name='custprov' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>
	<option value=''>--- Select A Province ---</option>
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
<tr><td><label for='custpost'>Postal Code:</label></td><td><input type='text' name='custpost' 
	maxlength='7'
	onChange='this.value = this.value.toUpperCase();'
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custpost'></td></tr>
<tr><td><label for='custcountry'>Country:</label></td><td><input type='text' name='custcountry' 
	onFocus='showHint(this.name);' onBlur='hideHint(this.name);' /></td><td id='fb-custcountry'></td></tr>
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
<tr><td rowspan='5' valign='top'><label for='paymethod'>Method of Payment:</label></td>
	<td><input type='radio' name='paymethod' value='cash' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>Cash Money</input></td><td id='fb-paymethod' rowspan='6' valign='top'></td></tr>
<tr><td><input type='radio' name='paymethod' value='mastercard' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>MasterCard</input></td></tr>
<tr><td><input type='radio' name='paymethod' value='cheque' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>Cheque</input></td></tr>
<tr><td><input type='radio' name='paymethod' value='contract' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>Payment Plan</input></td></tr>
<tr><td><input type='radio' name='paymethod' value='bloodcontract' onFocus='showHint(this.name);' onBlur='hideHint(this.name);'>First-Born Child</input></td></tr>
<tr><td align='center'><input type='reset' name='rsbutton' value='Reset Form' onClick='return confirm(\"Are you sure you want to reset form?\");' /></td>
	<td align='center'><input type='submit' name='gobutton' value='Submit Registration' onClick='return checkForm();' /></td><td></td></tr>
</table>
</form>
</article>");
}
print("</main>");
require("footer.php");
?>
