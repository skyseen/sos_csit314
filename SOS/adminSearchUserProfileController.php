<?php
include'userprofile.php';

class adminSearchUserProfileController {
	public function searchUserProfile($profileSearch) {
	$userProfile = new userprofile();
		
	$userProfileList = $userProfile->searchUserProfile($profileSearch); // Implement this method in the UserProfile Entity
	
	return $userProfileList;
			
		
	}
}