<?php

class LoginController{

	public function __construct(){
		
	}

	//register user
    public function checkUserRegistered($user_register){
        global $dbObj, $userObj;

		//print_r($user_register);exit;
		$user_data = array();
		$msg = "";
		$current_date = date('Y-m-d H:i:s');
		$error = 0;
		
        //collect form variables
        $user_data['username'] = $this->sanitizePost($user_register['username']);
        $user_data['email'] = $this->sanitizePost($user_register['email']);
        $user_data['password'] = $this->sanitizePost($user_register['passwd']);
		
        //validate password & confirm password
		if(empty($user_data['username'])) {
			$msg .= 'Username is mandatory!<br />';
			$error = 1;
		}

		//validate email address
		if (!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
			$msg .= 'Invalid Email address!<br />';
			$error = 1;
		}
		
		//validate password & confirm password
		if(empty($user_data['password'])) {
			$msg .= 'Please enter a password!<br />';
			$error = 1;
		}
		//if any error then return for show error messages
		if($error){
			$_SESSION['error_msg'] = $msg;
			//header("Location: sign-up.php?msg=error");
		}
		//echo 1;exit;
		//set variables for add in table
		
		$user_data['raw_password'] = $user_data['password'];
		$user_data['password'] = password_hash($user_data['password'], PASSWORD_DEFAULT);
		$user_data['created_date'] = $current_date;
		
		//verify user already exist
		$data_result = $userObj->checkUserIsRegistered($user_data);
		//print_r($data_result);exit;
		//check user found in table
		if(is_array($data_result) && count($data_result)>0){
			$_SESSION['error_msg'] = 'You are already registered, please login!';
			header("Location: sign-up.php?msg=exist");			
		}else{
			//finally save all data inputs in table
			$addCustomer = $userObj->registerUser($user_data);
			$_SESSION['error_msg'] = "You have been successfully registered, please login!";
			header("Location: sign-up.php?msg=registered");
		}
    }

    //Verify login credentials and after success login - redirect to its dashboard.
    public function verifyUserLogin($user_register){
        global $dbObj, $userObj;
		
		$user_data = array();
		$msg = "";
		$error = 0;
		// print_r($user_register);exit;
        //collect form variables
        $user_data['email'] = $this->sanitizePost($user_register['email']);
        $user_data['password'] = $this->sanitizePost($user_register['passwd']);
		
		
		//validate email address
		if (!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
			$msg .= 'Invalid email address!<br />';
			$error = 1;
		}
		
		//validate password & confirm password
		if(empty($user_data['password'])) {
			$msg .= 'Please enter a password!<br />';
			$error = 1;
		}
		//if any error then return for show error messages
		if($error){
			$_SESSION['error_msg'] = $msg;
			//header("Location: sign-up.php?msg=error");
		}
		
		//verify user login
		$data_result = $userObj->checkUserLogin($user_data);
		// print_r($user_data);
		// print_r($user_register);exit;
		//check user found in table
		if(is_array($data_result) && count($data_result)>0){
			if(!password_verify($user_data['password'], $data_result['password'])){
				$msg = 'Invalid password, pleaese try again!';
				$_SESSION['error_msg'] = $msg;
				header("Location: sign-in.php?msg=pswdmismch");
				exit;
			}else{
				$_SESSION['jb_user_id'] = $data_result['user_id'];
				$_SESSION['jb_username'] = $data_result['username'];
				$msg = "You are successfully login & redirecting to dashboard...";
				$_SESSION['error_msg'] = $msg;
				header("Location: user.php");
				exit;				
			}			
		}else{
			$msg = 'There is no account exist in our system, please register for an account';
			$_SESSION['error_msg'] = $msg;
			header("Location: sign-in.php?msg=norecord");
			exit;
		}
		
		
		$msg = 'Invalid Username or Password';
		$_SESSION['error_msg'] = $msg;
		header("Location: sign-in.php?msg=invalid");
		exit;
    }

    //update customer password
	public function updateUserPasssword($user_password)
	{
		if(!isset($_SESSION['jb_user_id'])) {
			$msg = 'Your session is expired & redirecting to login page...';
			header("Location: sign-in.php");
			exit;exit;
		}else{
			global $dbObj, $userObj;
			$update_password = array();
			$msg = "";
			$current_date = date('Y-m-d H:i:s');
			$error = 0;
			//collect form variables
			$update_password['current_passw'] = $this->sanitizePost($user_password['current_passw']);
			$update_password['new_passw'] = $this->sanitizePost($user_password['new_passw']);
			
			$user_profile = $userObj->getUserProfile($_SESSION['jb_user_id']);
			//validate password & confirm password
			if(empty($update_password['current_passw'])) {
				$msg['message'] = 'Curent password can not be empty!';
				$error = 1;
			}
			
			//check current password with stored
			if(!password_verify($update_password['current_passw'], $user_profile['password'])){
				$msg = 'Incorrect old password!<br />';
				$error = 1;
			}else if(empty($update_password['new_passw'])) {
				$msg .= 'Please enter new password!<br />';
				$error = 1;
			}else {
				$msg = 'Password required!';
				$error = 1;
			}
			
			//if any error then return for show error messages
			if($error){
				$_SESSION['error_msg'] = $msg;
				//header("Location: lost-password.php?msg=passerr");
				//exit;
			}
			
			//update password in table
			$hash_password = password_hash($update_password['new_passw'], PASSWORD_DEFAULT);
			$user_profile = $userObj->updateUserPassword($hash_password, $update_password['new_passw'], $_SESSION['jb_user_id']);
			$msg = 'Password has been changed successfully. please login again!';
			unset($_SESSION['jb_user_id']);
			unset($_SESSION['jb_username']);
			session_unset();
			session_destroy();
			header("Location: sign-in.php?msg=login");
			exit;
		}		
	}

    //sanitize form post variable
	function sanitizePost($data) {
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
		 return $data;
	}
}


?>