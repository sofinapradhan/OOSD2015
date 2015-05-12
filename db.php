<?php
/* Written by lpeters
 * Date: 2015/05/12
 * Usage: Include at start of page.
 */
$con = mysqli_connect("localhost","travelexperts","GetPasswordFromTeam","TravelExperts");
if (!$con) { die('Could not connect: ' . mysqli_connect_error()); }
?>
