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
				
				<!-- Get the packages from the database to populate the selection table -->
				<?php
				include "db.php";
				?>

				<!-- Execute query  -->
				<?php
				// write query - $sql: selecting from Packages tables
				$sql = "SELECT PkgName FROM Packages"; 
				//execute query 
				$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con)); 
		
				// Associative array
				while ($row=mysqli_fetch_assoc($result)){
	
				foreach ($row as $index=>$col) //$index is the indexof each $row element
	 				 {
	 			     print("<option value=".$row[$index].">".$col."</option>");
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

				<label for="vacationType">What is your vacation budget?</label>
				<input style="width:60%; margin-left: 20%;" type="range"  name="budget" min="1" max="3" onchange="top.location.href = 'packages.php?budget='+ (this.value)" list="budgetTypes">
				<datalist id="budgetTypes">
				<option value="low">save</option>
				<option value="medium">best value</option>
				<option value="high">splurge</option>
				</datalist>
				</input>
						
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
				    <li data-target="#myCarousel" data-slide-to="4"></li>    
  				</ol>

  
				<div class="carousel-inner" role="listbox">
					<div class="item active">
					    <img src="img/Italy.jpg" alt="Italy">
					       <div class="carousel-caption">
      					 		<h3>Italy Awaits!</h3>
					        	<p><span style="font-size: 2.5em"> Limited Time Offer</span></p>
					        	<p><a class="carButton" href="contact.php" role="carButton">Contact Us for Details</a></p>
					      </div> <!--close carousel-caption class div-->
					</div><!--close item class div-->

					<div class="item">
					    <img src="img/cabin.jpg" alt="Cabin in the Rockies">
					    	<div class="carousel-caption">
      							<h3>Your Weekend Getaway</h3>
					     	   <p><span style="font-size: 2.5em">4th Night FREE</span></p>
					     	   <p><a class="carButton" href="contact.php" role="carButton">Contact Us for Details</a></p>
					     	</div><!--close carousel-caption class div-->
					</div><!--close item class div-->

					<div class="item">
					    <img src="img/japan.jpg" alt="Japan">
					     	<div class="carousel-caption">
      					 		<h3>Culinary Adventure in Japan</h3>
					     	   <p><span style="font-size: 2.5em">Coming SOON</span></p>
					     	   <p><a class="carButton" href="contact.php" role="carButton">Contact Us for Details</a></p>
					     	</div><!--close carousel-caption class div-->
					</div><!--close item class div-->

					<div class="item">
						<img src="img/train.jpg" alt="Rail tour">
					    	<div class="carousel-caption">
      							<h3>Canadian Railway Tour</h3>
					        	<p><span style="font-size: 2.5em">Save 15% by booking TODAY</span></p>
					        	<p><a class="carButton" href="contact.php" role="carButton">Contact Us for Details</a></p>
								</div><!--close carousel-caption class div-->
					</div><!--close item class div-->

					<div class="item">
						<img src="img/kenya.jpg" alt="Kenya">
					    	<div class="carousel-caption">
      							<h3>Kenya and Tanzania Safari</h3>
					        	<p><span style="font-size: 2.5em">The Ultimate Safari Tour</span></p>
					        	<p><a class="carButton" href="contact.php" role="carButton">Contact Us for Details</a></p>
								</div><!--close carousel-caption class div-->
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
