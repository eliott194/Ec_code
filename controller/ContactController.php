<?php

require_once( 'model/user.php' );

/*******************************************************
* ----- FUNCTION TO SEND A MAIL TO THE SUPPORT TEAM -----
********************************************************/

function contact() {

    require('view/auth/contactView.php');

	if (isset($_POST['send'])) {
		Email($_POST['subject'], $_POST['message']);
	}
}

function Email($sujet, $message) {

$to = "312.lisleeliott.clb@gmail.com";

mail($to, $sujet, $message);

}


?>