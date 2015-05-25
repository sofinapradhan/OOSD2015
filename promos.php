<?php
/* Written by dostap
 * Date: 2015/05/25
 */
$header_title = "Travel Experts - Promotions";
$header_style = ["global.css"];
$header_script = [
	"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js",		/* jQuery library */
	"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"];		/* Latest compiled JavaScript */
include "header.php";
?>
	<main>
		<article>
		<h1> Travel Experts Promotions - Don't Miss a GREAT Deal</h1>

			<section id="promo1">
				<h3>Book Your Next Vacation Now</h3>
				<img src="img/promo1.jpg" alt="promo1">
				<p>Summer is low season in the Caribbean. With low season, come low prices. <br />
				Take <b>15%</b> off your beach vacation until August 1st. 
				Check out our available <a href="packages.php">packages</a>!</p>
			</section>
			
			<section id="promo2">
				<h3>Destination Weddings</h3>
				<img src="img/promo2.jpg" alt="promo2">
				<p>No Deposit for 3 months prior to departure for wedding groups at most resorts.</p>
					<ul>
					<li>Free flight upgrade</li>
					<li>Free seat selection</li>
					<li>Future travel credit for 1 year anniversary</li>
					</ul>
				Check out our available <a href="packages.php">packages</a>!
			</section>	

			<section id="promo3">
				<h3>Group Travel</h3>
				<img src="img/promo3.jpg" alt="promo3">
				<p>Bring your friends and your family, your neighbours and your dog!<br />
				<ul>
					<li>Freebies for groups at select destinations,including Food+Drinks+Activities</li>
					<li>Dedicated group coordinator until departure</li>
					<li>Flexibility for guests to leave from different cities, on different days of the week</li>
					<li>Private check-in, transfers, excursions and activities can be arranged</li>
				</ul>

				Check out our available <a href="packages.php">packages</a>!
			</section>	

			<section id="promo4">
				<h3>Hotel Promotions</h3>
				<img src="img/promo4.jpg" alt="promo4">
				<p>Get exclusive offers and perks on your next vacation.
				Earn points, get upgrades - skip the line to get the most out of your trips!</p>
				<p> Book at:</p>
				<ul>
					<li>Marriott </li>
					<li>Hilton </li>
					<li>Hyatt </li>
					<li>And many, many other hotel chains!</li>
				</ul>
				<a href="contact.php">Contact our agents</a> and see what we can do for YOU!
			</section>	
		
		</article>
	</main>
	
<?php
include "footer.php";
?>