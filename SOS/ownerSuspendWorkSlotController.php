<?php
  // Include the Entity
class ownerSuspendWorkSlotController {
    
	public function suspendWorkSlot($workslotID) {
		$Workslot = new workslot();

		// Retrieve user data (e.g., list of users)
		$result	= $Workslot-> suspendWorkSlot($workslotID); // Implement this method in the Workslot Entity
				
		return $result;
	}
	
	
	
}
