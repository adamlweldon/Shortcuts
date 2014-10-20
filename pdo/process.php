<?php 

// errors on
error_reporting(-1);
ini_set('display_errors', 'On');

// errors off
// error_reporting(0);
// @ini_set('display_errors', 0);

include('connection.php');
include('functions.php'); 

if (isset($_POST['sign_up'])) {
	// validate post
	$errors = validate($_POST);
	if (isset($errors) && !empty($errors)) { 
		foreach ($errors as $key => $error) {
			$alerts = array('id'=>$key, 'message' => $error, 'action'=>'error');
			echo json_encode($alerts);
			exit;
		}
		// exit;
	}
	else{
		include('class/classUser.php');
		$newuser = new User();
		$newuser->first_name=strip_tags($_POST['first_name']);
		$newuser->last_name=strip_tags($_POST['last_name']);
		$newuser->email=strip_tags($_POST['email']);
		$newuser->telephone=strip_tags($_POST['tele']);
		$newuser->password=password_hash($_POST['pw'], PASSWORD_DEFAULT);
		$newuser->insertUser();
		$success = 'You have successfully signed up';
		$successalerts = array('message' => $success, 'action'=>'success');
		echo json_encode($successalerts);
		exit;
	}
}


if (isset($_POST['login_log_in'])) {
	$login_errors = loginvalidate($_POST);
	if (isset($login_errors) && !empty($login_errors)) { 
		foreach ($login_errors as $key => $login_error) {
			$login_alerts = array('id'=>$key, 'message' => $login_error, 'action'=>'login_error');
			echo json_encode($login_alerts);
			exit;
		}
		// exit;
	}
	else{
		$loginattempt = loginAttempt($_POST);
	}
}


if (isset($_POST['signout'])) {
	session_destroy();
	header('Location: index.php');
}






?>