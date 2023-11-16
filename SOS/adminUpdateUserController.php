<?php
 // Include the Entity
class adminUpdateUserController {
   
	public function updateUserDetail($userID,$userName,$DOB,$userEmail,$maxShiftCount) {
		$user = new useraccount();

		// Retrieve user data (e.g., list of users)
		$result	= $user->updateUserDetail($userID,$userName,$DOB,$userEmail,$maxShiftCount); // Implement this method in the User Entity
		
		return $result;
		
	}
}

?>