<?php
/* Written by dostap
 * Date: 2015/05/18
 */
$header_title = "Welcome to Travel Experts";
$header_style = ["index.css"];
$header_script = [
	"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js",		/* jQuery library */
	"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"];		/* Latest compiled JavaScript */
include "header.php";
?>

	<div id="wrapper1">
	<section>
	<h3>Let's find YOUR perfect vacation!</h3>
	<img src="img/beach.jpg" /><br / >
			<form id="list" method="get" action="">

				<label for="location">Where would you like to go?</label>
				<select onchange="top.location.href = 'packages.php?packageName='+ this.options[ this.selectedIndex ].value" >

				<option value="" disabled selected>Choose by Package Name</option>
				
				<!-- connect to the database-->
				<?php
				include "db.php";
				?>

				<!-- Get the packages from the database to populate the selection table -->
				<?php
				// write query - $sql: selecting PkgName from Packages tables
				$sql = "SELECT PkgName FROM Packages"; 
				//execute query or die
				$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con)); 
		
				// Fetch result row as an associative array
				//mysqli_fetch_assoc will return NULL and break out of loop 
				//when there are no more rows
				while ($row=mysqli_fetch_assoc($result)){
	
				foreach ($row as $index=>$col) //Loop through the vacation packages in the array
	 				 { //print select options of packages to HTML
	 			     print("<option value=".$col.">".$col."</option>");
					 }

					}
				// Free result set
				mysqli_free_result($result);
				// close connection
				mysqli_close($con);
				?>

				</select><br />

				<label for="date">When would you like to travel?</label>

				<select onchange="top.location.href = 'packages.php?month='+ this.options[ this.selectedIndex ].value" >
				<option value="" disabled selected>Choose by Month</option>
				<option value="January">January</option>
				<option value="February">February</option>
				<option value="March">March</option>
				<option value="April">April</option>
				<option value="May">May</option>
				<option value="June">June</option>
				<option value="July">July</option>
				<option value="August">August</option>
				<option value="September">September</option>
				<option value="Ocotber">October</option>
				<option value="November">November</option>
				<option value="December">December</option>
				</select><br />

				<label for="vacationType">What type of vacation would you prefer?</label>
				<select onchange="top.location.href = 'packages.php?type='+ this.options[ this.selectedIndex ].value" >
				<option value="" disabled selected>Choose by Vacation Type</option>
				<option value="Cruise">Cruise</option>
				<option value="AllInclusive">All inclusive resort</option>
				<option value="EcoTour">Eco tour</option>
				<option value="RailTour">Rail tour</option>
				</select><br />

				<label for="budget">What is your vacation budget?</label>
				<p id="sliderText">start at $2800
				<input id="budget" style="display: inline; width:40%; margin-left:5%; margin-right:5%;" 
				type="range"  name="budget" min="0" max="3" onchange="top.location.href = 'packages.php?budget='+ (this.value)" 
				list="budgetTypes" value="0">
				<!--Linked the input element to a datalist with string values via list attribute -->
				<datalist id="budgetTypes">
				<option value="0" disabled selected></option>
				<option value="1">save</option>
				<option value="2">best value</option>
				<option value="3">splurge</option>
				</datalist>
				</input>$4800</p>
						
			</form>
	</section>
	</div>
		<!-- Wrapper for the carousel-->
		
		<div id="wrapper2">
		<aside>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
	
 		 		<!-- Indicators -->
  				<ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				    <li data-target="#myCarousel" data-slide-to="3"></li>   
  				</ol>

  
				<div class="carousel-inner" role="listbox">
					<div class="item active">
					    <img src="img/promo1.jpg" alt="promo1">
					       <div class="carousel-caption">
					        	<p><a class="carButton" href="promos.php#promo1" role="carButton">Contact Us for Details</a></p>
					       </div> <!--close carousel-caption class div-->
						<h3>Enjoy the Sand...On Us!</h3>
						<p>Limited Time Offer</p>
					</div><!--close item class div-->

					<div class="item">
					    <img src="img/promo2.jpg" alt="promo2">
					    	<div class="carousel-caption">
					     	   <p><a class="carButton" href="promos.php#promo2" role="carButton">Contact Us for Details</a></p>
					     	</div><!--close carousel-caption class div-->
					     	<h3>Your Destination Wedding</h3>
					     	<p>Bring Your Loved Ones</p>
					</div><!--close item class div-->

					<div class="item">
					    <img src="img/promo3.jpg" alt="promo3">
					     	<div class="carousel-caption">
					     	   <p><a class="carButton" href="promos.php#promo3" role="carButton">Contact Us for Details</a></p>
					     	</div><!--close carousel-caption class div-->
					     	<h3>Bring Your Friends</h3>
					     	<p>The More The Merrier</p>
					</div><!--close item class div-->

					<div class="item">
						<img src="img/promo4.jpg" alt="promo4">
					    	<div  class="carousel-caption">
					        	<p><a class="carButton" href="promos.php#promo4" role="carButton">Contact Us for Details</a></p>
					        </div><!--close carousel-caption class div-->	
					        <h3>Hotel Promotions</h3>
					     	<p>Become a VIP today</p>
							
					</div><!--close item class div-->

   				</div> <!-- div for carousel-inner -->

			 <!-- Left and right controls -->
		
			  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div><!-- div for myCarousel -->
		</aside> 		
		</div> <!--close wrapper2 div-->
<?php
include "footer.php";
?>
