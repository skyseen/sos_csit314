<?php
include'workslot.php';  // Include the Entity
class ownerCreateWorkSlotController {
    public function createWorkSlot($role,$date,$shift,$slot) {
		$Workslot = new workslot();

    // Retrieve user data (e.g., list of users)
    $result = $Workslot->createWorkSlot($role,$date,$shift,$slot); // Implement this method in the Workslot Entity
	
	return $result;
	
	}
	
	
}

?>