<?php 

function printer($data,$exit=false) {
	echo '<pre>'; print_r($data); echo '</pre>';
	if($exit){
		exit;
	}	
}

function validate($signup) {
	$errors = array();
	// first name validation
	if (!empty($signup['first_name'])) {
		$firstname = $signup['first_name'];
  		$pattern = "/^[a-zA-Z0-9\_]{2,20}/";
  		if (preg_match($pattern,$firstname)){ 
  			
  		}
  		else{ 
  			$errors['first-name'] = 'Your First Name can only contain _, 1-9, A-Z or a-z and has to be 2-20 characters long.';}
  		} 
  	else {
  		// first-name is key for json object
  		$errors['first-name'] = 'Please enter your First Name.';
  	}
  	// last name validation
  	if (!empty($signup['last_name'])) {
		$lastname = $signup['last_name'];
  		$pattern = "/^[a-zA-Z0-9\_]{2,20}/";
  		if (preg_match($pattern,$lastname)){ 
  			
  		}
  		else{ 
  			$errors['last-name'] = 'Your Last Name can only contain _, 1-9, A-Z or a-z and has to be 2-20 characters long.';
  		}
  	} 
  	else {
  		// last-name is key for json object
  		$errors['last-name'] = 'Please enter your Last Name.';
  	}
  	//email validation
  	if (!empty($signup['email'])) {
  		if (!filter_var($signup['email'], FILTER_VALIDATE_EMAIL)) {
  			$errors['email'] = 'Please enter a valid email.';
  		}
  		else{
  			$query = "SELECT email FROM users WHERE `email` = :email";
			$prepare = array(':email' => $signup['email']);
			$results=RECORD::query($query, $prepare)->fetch();
			// printer($results);
			// exit;
  			if (empty($results)) {
  				
  			}
  			else {
  				$errors['email'] = 'Email is already in use.';
  			}
  		}
  	}
  	else{
  		// email is key for json object
  		$errors['email'] = 'Please enter your Email address.';
  	}
  	// telephone number validation
  	if (!empty($signup['tele'])) {
  		$phone = $signup['tele'];
  		$pattern = "/^[0-9\_]{7,20}/";
  		if (preg_match($pattern,$phone)){ 
  			
  		}
  		else{ 
  			$errors['tele'] = 'Your Phone number can only be numbers.';
  		}
  	} 
  	else {
  		// tele is key for json object
  		$errors['tele'] = 'Please enter your Phone number.';
  	}
  	//password validation
  	if (!empty($signup['pw'])) {
  		if (!preg_match_all('$\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])$', $signup['pw'])){
  			$errors['pw'] = 'Please enter a Password that is at least 6 characters long and contains at least one lowercase, and number.';
  		}
  	}
  	else{
  		// pw is key for json object
  		$errors['pw'] = 'Please enter a password.';
  	}
  	//verify password validation
  	if (!empty($signup['verify_pw'])) {

  	}
  	else{
  		// verify-pw is key for json object
  		$errors['verify-pw'] = 'Please verify password.';
  	}
  	//confirm passwords match
  	if ($signup['pw']!=$signup['verify_pw']) {
  		$errors['verify-pw'] = 'Please verify passwords match.';
  	}
	if (isset($errors)) {
		return $errors;
	}
}

function loginvalidate($login) {
	$login_errors=array();
	if (!empty($login['login_email'])) {
  		if (!filter_var($login['login_email'], FILTER_VALIDATE_EMAIL)) {
  			$login_errors['login_email'] = 'Please enter a valid email.';
  		}
  		else{
  			$query = "SELECT email FROM users WHERE `email` = :email";
			$prepare = array(':email' => $login['login_email']);
			$results=RECORD::query($query, $prepare)->fetch();

  			if (empty($results)) {
  				$login_errors['login_email'] = 'Email address does not exist.';
  			}
  			else {
  				
  			}
  		}
  	}
  	else{
  		$login_errors['login_email'] = 'Please enter your Email address.';
  	}
  	if (!empty($login['login_pw'])) {
  		
  	}
  	else{
  		$login_errors['login_pw'] = 'Please enter a password.';
  	}
	if (isset($login_errors)) {
		return $login_errors;
	}	
}

function loginAttempt($attempt) {
	$query = "SELECT email, password FROM users WHERE `email` = :email";
	$prepare = array(':email' => $attempt['login_email']);
	$results=RECORD::query($query, $prepare)->fetch();
	$hash = $results->password;
	$verifylogin = array();
	$verify_alerts_success = array();
	if (password_verify($attempt['login_pw'], $hash)) {
		session_start();
		$verify_alerts_success = array('id'=>'success', 'message' => 'Logging you In', 'action'=>'verify_success');
		echo json_encode($verify_alerts_success);
		exit;
	} 
	else {
		$verifylogin['login_errors'] = 'Invalid password';
	}

	foreach ($verifylogin as $key => $verify) {
		$verify_alerts = array('id'=>$key, 'message' => $verify, 'action'=>'verify_error');
		echo json_encode($verify_alerts);
		exit;
	}
}

?>