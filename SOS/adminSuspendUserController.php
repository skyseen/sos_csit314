<?php
  
class adminSuspendUserController {
    
	public function suspendUser($userID) {
		$user = new useraccount();

		// Retrieve user data (e.g., list of users)
		$result	= $user->suspendUser($userID); // Implement this method in the User Entity
		
		 return $result;
		
	}
	
	
}
