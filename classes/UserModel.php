<?php

class UserModel
{
	public $dbObj = '';
	public function __construct(){
		global $dbObj;
		$this->dbObj = $dbObj;
		
	}

	####################################################
	//user register, logn & dashboard functions starts
	####################################################
	public function checkUserIsRegistered($user_data)
    {
		//print_r($user_data);exit;
		$user_arr = array();
        $user_query = "SELECT user_id, username, email, password FROM jb_users WHERE email = '".$user_data['email']."'";
		$user_result = $this->dbObj->query($user_query);		
	
		if ($user_result->num_rows >0){
			while($user = $user_result->fetch_assoc()) {
				$user_arr['user_id'] = $user['user_id'];
				$user_arr['username'] = $user['username'];
				$user_arr['email'] = $user['email'];
				$user_arr['password'] = $user['password'];
			}
		}
		return $user_arr;
    }
	
	//register customer
	public function registerUser($user_data)
    {
		// print_r($user_data);exit;
		$user_query = "INSERT INTO jb_users (username, email, password, raw_password, created_date) Values('".$user_data['username']."', '".$user_data['email']."','".$user_data['password']."','".$user_data['raw_password']."','".$user_data['created_date']."')";
		// echo $customer_query;exit;
        $user_result = $this->dbObj->query($user_query);		
		return true;
    }
	
	//verify login customer
	public function checkUserLogin($user_data)
    {
		$user_arr = array();
		$user_query = "SELECT user_id, username, email, password FROM jb_users WHERE email = '".$user_data['email']."'";
		//echo $user_query;exit;
        $user_result = $this->dbObj->query($user_query);		
		if ($user_result->num_rows >0){
			while($user = $user_result->fetch_assoc()) {
				$user_arr['user_id'] = $user['user_id'];
				$user_arr['username'] = $user['username'];
				$user_arr['email'] = $user['email'];
				$user_arr['password'] = $user['password'];
			}
		}
		return $user_arr;
    }
	
	//get user profile data by customer id
	public function getUserProfile($user_id)
    {
        $user_profile = array();
		$user_query = "SELECT user_id, username, email, password, created_date FROM jb_users WHERE user_id = '".$user_id."'";
		//echo $user_query;exit;
        $user_result = $this->dbObj->query($user_query);		
		if ($user_result->num_rows >0){
			while($user = $user_result->fetch_assoc()) {
				$user_profile['user_id'] = $user['user_id'];
				$user_profile['username'] = $user['username'];
				$user_profile['email'] = $user['email'];
				$user_profile['password'] = $user['password'];
				$user_profile['created_at'] = date("Y-m-d",strtotime($user['created_date']));
			}
		}
		return $user_profile;
    }
	
	//update user password by user_id
	public function updateUserPassword($hash_password, $raw_password, $user_id)
    {
        $current_date = date('Y-m-d H:i:s');
		$password_update_query = "UPDATE jb_users SET password = '".$hash_password."', raw_password = '".$raw_password."',  updated_date = '".$current_date."' WHERE user_id = '".$user_id."'";
		//echo $password_update_query;exit;
        $password_update_result = $this->dbObj->query($password_update_query);		
		return true;
    }
}	


?>