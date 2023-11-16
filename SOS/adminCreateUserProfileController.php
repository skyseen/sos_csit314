<?php
include'userprofile.php';  // Include the Entity
class adminCreateUserProfileController {
    public function createUserProfile($roleType,$description,$accessRight) {
		$userProfile = new userprofile();

    // Retrieve user data (e.g., list of users)
    $result = $userProfile->createUserProfile($roleType,$description,$accessRight); // Implement this method in the User Entity
	
	return $result;
	
	}
	
   
}

?>