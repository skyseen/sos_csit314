<?php
 // Include the Entity
class staffUpdateMaxShiftCountController {
   
	public function updateMaxShiftCount($userID,$maxShiftCount) {
		$user = new useraccount();

		// Retrieve user data (e.g., list of users)
		$result	= $user->updateMaxShiftCount($userID,$maxShiftCount); // Implement this method in the User Entity
		
		return $result;
		
	}
}

?>