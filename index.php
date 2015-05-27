<?php
/* Written by dostap
 * Date: 2015/05/26
 */
$header_title = "Welcome to Travel Experts";
$header_style = ["index.css"];
$header_script = [
	"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js",		/* jQuery library */
	"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"];		/* Latest compiled JavaScript */
include "header.php";
?>
<div id="pageContainer">
	<div id="wrapper1">
	<section>
	<h3>Let's find YOUR perfect vacation!</h3>
		<img src="img/beach.jpg" /><br / >
			<form id="list" method="get" action="">

				<label for="location">Where would you like to go?</label>
				<select onchange="top.location.href = 'packages.php?packageId='+ this.options[ this.selectedIndex ].value" >

				<option value="" disabled selected>Choose by Package Name</option>
				
				<!-- connect to the database-->
				<?php
				include "db.php";
				?>

				<!-- Get the packages from the database to populate the selection table -->
				<?php
				// write query - $sql: selecting from Packages tables
				$sql = "SELECT PackageId,PkgName FROM Packages"; 
				//execute query or die
				$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con)); 
		
				// Fetch result row as an associative array
				//mysqli_fetch_assoc will return NULL and break out of loop 
				//when there are no more rows
				while ($row=mysqli_fetch_assoc($result)){ 

				print("<option value=".$row["PackageId"].">".$row["PkgName"]."</option>");

					}
				// Free result set
				mysqli_free_result($result);
				// close connection
				mysqli_close($con);
				?>

				</select><br />

				<label for="date">When would you like to travel?</label><br />
			
				<input id="dateStart" type="date" placeholder="Date Range: Start"></input>
				<input id="dateEnd" type="date" placeholder="Date Range: End"></input>
				<button type="button"
				onclick="top.location.href = 'packages.php?dateStart='+document.getElementById('dateStart').value+
				'&dateEnd='+document.getElementById('dateEnd').value">Go!</button><br />

				<label for="vacationType">What type of vacation would you prefer?</label><br />
				<select onchange="top.location.href = 'packages.php?type='+ this.options[ this.selectedIndex ].value" >
				<option value="" disabled selected>Choose by Vacation Type</option>
				<option value="Cruise">Cruise</option>
				<option value="Inclusive">All inclusive resort</option>
				<option value="Eco">Eco tour</option>
				<option value="Rail">Rail tour</option>
				</select><br />
				</form>

				<label for="budget">What is your maximum budget?</label>
				<p id="sliderText">$0
				<input id="budget" style="display: inline; width:40%; margin-left:5%; margin-right:5%;" type="range" 
				step="1000" name="budget" min="0" max="5000" list="steplist" value="3000" 
				onchange="document.getElementById('budgetValue').innerHTML = this.value;">
				
				</input>$5000</p>

				<button id="budgetValue" value="3000"
				onclick="top.location.href = 'packages.php?budget='+document.getElementById('budgetValue').innerHTML">3000</button>
	</section>
	</div>
		<!-- Wrapper for the carousel-->
		
	<div id="wrapper2">

			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			    <li data-target="#myCarousel" data-slide-to="3"></li>
			    <li data-target="#myCarousel" data-slide-to="4"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">


			    <div class="item active">
			      <img src="img/promo1.jpg" alt="Promotion1">
			      <div class="carousel-caption">
			        <h3>Enjoy the Sand...On Us!</h3>
		            <p>Limited Time Offer</p><br />
		            <a class="carButton" href="register.php" role="button">Sign up today</a>
			      </div>
			    </div>

			    <div class="item">
			      <img src="img/promo2.jpg" alt="Promotion2">
			      <div class="carousel-caption">
			        <h3>Your Destination Wedding</h3>
		            <p>Bring Your Loved Ones</p><br />
		            <a class="carButton" href="packages.php" role="button">Learn more</a>
			      </div>
			    </div>

			    <div class="item">
			      <img src="img/promo3.jpg" alt="Promotion3">
			      <div class="carousel-caption">
			        <h3>Bring Your Friends</h3>
		             <p>The More The Merrier</p><br />
		             <a class="carButton" href="register.php" role="button">Register With Us</a>
			      </div>
			    </div>

			    <div class="item">
			      <img src="img/promo4.jpg" alt="Promotion4">
			      <div class="carousel-caption">
			        <h3>Hotel Promotions</h3>
		             <p>Become a VIP today</p><br />
		             <a class="carButton" href="contact.php" role="button">Contact Us</a>
			      </div>
			    </div>


			  </div><!-- close carousel inner div -->

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			

		</div><!--wrapper2 div closed-->
	</div><!-- close the container-->
		
		
		<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
<?php
include "footer.php";
?>

