/* Written by lpeters
 * Date: 2015/05/12
 * Usage: Included by register.php.
 */
formHintList = [
	{key: "custname", value: "Customer's First Name."},
	{key: "custaddy", value: "Customer's Last Name."},
	{key: "custcity", value: "Customer's Home City."},
	{key: "custprov", value: "Customer's Home Province."},
	{key: "custpost", value: "Customer's Postal Code."},
	{key: "destination", value: "Travel Destination."},
	{key: "paymethod", value: "Monetary Compensation Transaction Protocol."}];
	
function checkForm()
{
	console.log("Beginning validation...");
	var targForm = document.getElementById("regForm");
	var errorFlag = false;
	clearWarn();
	if (targForm.custpnom.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custpnom").innerHTML = "Error: Full Name requires a value.";
	}
	if (targForm.custaddy.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custaddy").innerHTML = "Error: Address requires a value.";
	}
	if (targForm.custcity.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custcity").innerHTML = "Error: City requires a value.";
	}
	if (targForm.custprov.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custprov").innerHTML = "Error: Province requires a value.";
	}
	//var re = new RegExp(/^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i);
	if (targForm.custpost.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-custpost").innerHTML = "Error: Postal Code requires a value.";
	}
	//else if (!re.test(targForm.custpost.value))
	else if (!new RegExp(/^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i).test(targForm.custpost.value))
	{
		errorFlag = true;
		document.getElementById("fb-custpost").innerHTML = "Error: Postal Code must be valid.";
	}
	if (targForm.destination.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-destination").innerHTML = "Error: Destination requires a value.";
	}
	if (targForm.paymethod.value == "")
	{
		errorFlag = true;
		document.getElementById("fb-paymethod").innerHTML = "Error: Payment Method requires a value.";
	}
	console.log("errorFlag=" + errorFlag);
	return (errorFlag === false && confirm("Are you sure you want to submit registration?"));
}
function clearWarn()
{
	document.getElementById("fb-custpnom").innerHTML = "";
	document.getElementById("fb-custaddy").innerHTML = "";
	document.getElementById("fb-custcity").innerHTML = "";
	document.getElementById("fb-custprov").innerHTML = "";
	document.getElementById("fb-custpost").innerHTML = "";
	document.getElementById("fb-destination").innerHTML = "";
	document.getElementById("fb-paymethod").innerHTML = "";
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
