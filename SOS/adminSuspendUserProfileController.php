<?php
class adminSuspendUserProfileController {
    
	function suspendUserProfile($profileID) {
			$userProfile = new userprofile();

			// Retrieve user data (e.g., list of users)
			$result	= $userProfile->suspendUserProfile($profileID); // Implement this method in the User Entity
			
			return $result;
			
	}
		
}
