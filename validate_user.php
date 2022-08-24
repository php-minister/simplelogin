<?php

// Create connection for database
include_once('config.php');
include_once('classes/LoginController.php');
$loginController = new LoginController();

//load user model class to query database
include_once('classes/UserModel.php');
//generate object to access methods and fetch data
$userObj = new UserModel();

//print_r($_POST);exit;
if(isset($_POST['form_type']) && $_POST['form_type'] == 'register'){
	//print_r($_POST);exit;	
	$user_register['username'] = $_POST['username'];
	$user_register['email'] = $_POST['email'];
	$user_register['passwd'] = $_POST['passwd'];
	$loginController->checkUserRegistered($user_register);	
}
else if(isset($_POST['form_type']) && $_POST['form_type'] == 'login'){
	//print_r($_POST);exit;	
	$user_register['email'] = $_POST['email'];
	$user_register['passwd'] = $_POST['passwd'];
	$loginController->verifyUserLogin($user_register);	
}
else if(isset($_POST['form_type']) && $_POST['form_type'] == 'change_pass'){
	//print_r($_POST);exit;	
	$user_pass['current_passw'] = $_POST['current_passw'];
	$user_pass['new_passw'] = $_POST['new_passw'];
	$loginController->updateUserPasssword($user_pass);	
}



?>