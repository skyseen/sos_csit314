<?php
include'userprofile.php';  // Include the Entity
class adminViewUserProfileDetailController {
    public function getUserProfile($profileID) {
		$userProfile = new userprofile();

    // Retrieve user data (e.g., list of users)
    $userProfile = $userProfile->getUserProfile($profileID); // Implement this method in the User Entity
    return $userProfile;
   
	}
}
?>