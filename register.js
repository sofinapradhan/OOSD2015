/* Written by lpeters
 * Date: 2015/05/12
 * Usage: Included by register.php.
 */
	
function checkForm()
{
	console.log("Beginning validation...");
	var targForm = document.getElementById("regForm");
	var errorFlag = false;
	clearWarn();
	if (targForm.custfirstname.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custfirstname").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: First Name requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custfirstname").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custlastname.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custlastname").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Last Name requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custlastname").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custaddress.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custaddress").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Address requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custaddress").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custcity.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custcity").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: City requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custcity").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custprov.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custprov").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Province requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custprov").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custcountry.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custcountry").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Country requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custcountry").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	//var re = new RegExp(/^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i);
	if (targForm.custpostal.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custpostal").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Postal Code requires a value.'>";
	}
	//else if (!re.test(targForm.custpost.value))
	else if (!new RegExp(/^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i).test(targForm.custpostal.value))
	{
		errorFlag = true;
		document.getElementById("fb-custpostal").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Postal Code must be valid.'>";
	}
	else
	{
		document.getElementById("fb-custpostal").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custhomephone.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custhomephone").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Home Phone requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custhomephone").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custbusphone.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custbusphone").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Work Phone requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custbusphone").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.custemail.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custemail").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: E-mail Address requires a value.'>";
	}
	else
	{
		document.getElementById("fb-custemail").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.destination.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-destination").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Destination requires a value.'>";
	}
	else
	{
		document.getElementById("fb-destination").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.ccname.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-ccname").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Credit Card Provider requires a value.'>";
	}
	else
	{
		document.getElementById("fb-ccname").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.ccnumber.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-ccnumber").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Credit Card Number requires a value.'>";
	}
	else
	{
		document.getElementById("fb-ccnumber").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	if (targForm.ccexpiry.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-ccexpiry").innerHTML = "<img src='img/icon_fail.png' style='height:1em' title='Error: Credit Card Expiry requires a value.'>";
	}
	else
	{
		document.getElementById("fb-ccexpiry").innerHTML = "<img src='img/icon_pass.png' style='height:1em'>";
	}
	console.log("errorFlag=" + errorFlag);
	return (errorFlag === false && confirm("Are you sure you want to submit registration?"));
}
function clearWarn()
{
	console.log("Clearing warnings...");
	document.getElementById("fb-custfirstname").innerHTML = "";
	document.getElementById("fb-custlastname").innerHTML = "";
	document.getElementById("fb-custaddress").innerHTML = "";
	document.getElementById("fb-custcity").innerHTML = "";
	document.getElementById("fb-custprov").innerHTML = "";
	document.getElementById("fb-custcountry").innerHTML = "";
	document.getElementById("fb-custpostal").innerHTML = "";
	document.getElementById("fb-custhomephone").innerHTML = "";
	document.getElementById("fb-custbusphone").innerHTML = "";
	document.getElementById("fb-custemail").innerHTML = "";
	document.getElementById("fb-destination").innerHTML = "";
	document.getElementById("fb-ccname").innerHTML = "";
	document.getElementById("fb-ccnumber").innerHTML = "";
	document.getElementById("fb-ccexpiry").innerHTML = "";
}
function showHint(fieldName)
{
	console.log("showHint(" + fieldName + ")");
	//document.getElementById("fb-" + fieldName).innerHTML = formHintList[fieldName];
	document.getElementById("fh-" + fieldName).style.visibility = "visible";
}
function hideHint(fieldName)
{
	console.log("hideHint(" + fieldName + ")");
	document.getElementById("fh-" + fieldName).style.visibility = "hidden";
}
