<?php

/* Written by Sofina Pradhan
 * Date: 2015/05/17
 * Usage: send email to sender and receiver
 */

    $fname = $_POST['fname'];   //getting data from contact.php page
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phoneno'];
	$comments = $_POST['comments'];
    $msgtosender = "";
	
	echo "Name: $fname \n $lname <br />";
	echo "Email: $email<br>\n";
	echo "Comments: $comments<br><br/>\n";
	echo "Dear $lname,<br /><br /> \n";
	$msgtosender = "Thank you for completing the contact form. 
	      We will respond to your message as soon as possible!<br/><br />\n 
		  Regards,<br />
		  Travel Experts <br /><br />
	      ***This email message is intended only for the addressee(s) and contains
			information that may be confidential and/or copyright. If you are not
			the intended recipient please notify the sender by reply email and
			immediately delete this email. Use, disclosure or reproduction of this
			email by anyone other than the intended recipient(s) is strictly
			prohibited. No representation is made that this email or any
			attachments are free of viruses. Virus scanning is
			recommended and is the responsibility of the recipient.
		  ***";
	echo $msgtosender;
	
    //send email to Travel Experts	
	$to = "johnsmith@travelexperts.com";
	$subject = "Email from web site";
	$body = "Name: $fname\nEmail: $email\nComments: $comments\n";
	//mail($to,$subject,$body);   //since mail server is not available or set up , I have disable this line

	// send an email back to the sender
	$body = $msgtosender;
	//mail($email,$subject,$body);  //since mail server is not available or set up , I have disable this line


?>
