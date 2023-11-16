<?php
include'useraccount.php';  // Include the Entity
class adminViewUserDetailController {
    public function getUserDetail($userID) {
		$user = new useraccount();

    // Retrieve user data (e.g., list of users)
    $userDetail = $user->getUserDetail($userID); // Implement this method in the User Entity
    return $userDetail;
   
	}
}