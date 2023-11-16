<?php
include 'useraccount.php'; // Include the Entity
class adminViewUserController {
    public function displayUserList() {
		$user = new useraccount();

    // Retrieve user data (e.g., list of users)
    $userList = $user->getAllUsers(); // Implement this method in the User Entity
    return $userList;
   
	}
}
?>
		