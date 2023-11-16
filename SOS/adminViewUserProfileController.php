<?php
include 'userprofile.php'; // Include the Entity
class adminViewUserProfileController {
    public function displayUserProfileList() {
		$userProfile = new userprofile();

    // Retrieve user data (e.g., list of users)
    $userProfileList = $userProfile->getAllUserProfile(); // Implement this method in the User Entity
    return $userProfileList;
    
	}
}
?>