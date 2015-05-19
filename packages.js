
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

