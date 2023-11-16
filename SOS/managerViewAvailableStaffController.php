<?php
 include 'useraccount.php'; // Include the Entity
class managerViewAvailableStaffController {
  
	public function viewAvailableStaff($workslotID) {
		$user = new useraccount();


		// Retrieve user data (e.g., list of users)
		$availableStaff = $user->viewAvailableStaff($workslotID); // Implement this method in the User Entity
		return $availableStaff;
		
	}
	
}


?>