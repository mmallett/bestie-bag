<?php

	/*
		REQUIRES
			php >= 5.4
			pear
			pear mail

		INSTALL - on Ubuntu 14.04
			sudo apt-get install pear
			sudo pear install -a mail
	*/

	require_once "Mail.php";

	$name = $_POST['name'];
	$email = $_POST['email'];
	$bestie = $_POST['bestie'];

	$from = 'noreply.bestiebag@gmail.com';
	$to = 'phpmailtest@mailinator.com';
	$subject = "[NOREPLY] New contact " . $name . " from landing page";
	$body = "Name: " . $name . "\nEmail: " . $email . "\nFavorite Bestie: " . $bestie;

	$headers = array(
	'From' => $from,
	'To' => $to,
	'Subject' => $subject
	);

	$smtp = Mail::factory('smtp', array(
	    'host' => 'ssl://smtp.gmail.com',
	    'port' => '465',
	    'auth' => true,
	    'username' => 'noreply.bestiebag@gmail.com',
	    'password' => 'BigJava3E'
	));

	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
		echo('There was a problem handling your request, please try again');
		http_response_code(500);		
	} else {
		echo('Thanks for signing up!');
	}

?>