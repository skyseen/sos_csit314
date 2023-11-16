<?php
include'useraccount.php';  // Include the Entity

class adminSearchUserController {
    public function searchUser($userSearch) {
		$user = new useraccount();
		
		// Retrieve user data (e.g., list of users)
		$userDetail = $user->searchUser($userSearch); // Implement this method in the User Entity
			
		return $userDetail;
			
	}
	
}
?>
