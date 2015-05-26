	/* Course: CPRG 210
	   Author: Mark Poffenroth
	   Usage:  
	   Function: Packages.php JS functions
	   Date: 2015/05/25
	*/ 

	// If package start date < current date, use CSS to make start date bold and red.
	function setColorRed(className)
	{
		var x = document.getElementsByClassName(className);
		for (var i = 0; i < x.length; i++) 
		{
			x[i].style.color = "red";
			x[i].style.fontWeight = "bold";
		}
	}
	
		
	// Used on packages.php to show expanded mini image 
	var myPkgName = []; 
	function showImageMini(myPkgIndex)
	{
		document.getElementById("img-pack-main").src="img/pack_" + myPkgIndex + ".jpg";
	}
