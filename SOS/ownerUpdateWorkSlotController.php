<?php
  // Include the Entity
class ownerUpdateWorkSlotController {
  
	public function updateWorkSlotDetail($workslotID,$role,$date,$shift,$slot) {
		$Workslot = new workslot();

		// Retrieve user data (e.g., list of users)
		$result	= $Workslot->updateWorkSlotDetail($workslotID,$role,$date,$shift,$slot); // Implement this method in the User Entity
		
		return $result;
		
	}
	
}


?>