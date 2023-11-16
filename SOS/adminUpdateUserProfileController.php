<?php
  // Include the Entity
class adminUpdateUserProfileController {
  
	public function updateUserProfile($profileID,$description,$accessRight) {
		$userProfile = new userprofile();

		// Retrieve user data (e.g., list of users)
		$result	= $userProfile->updateUserProfile($profileID,$description,$accessRight); // Implement this method in the User Entity
		
		 return $result;
		
	}
	
	
}

?>