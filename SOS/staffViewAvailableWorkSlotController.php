<?php
include'workslot.php';  // Include the Entity
class staffViewAvailableWorkSlotController {
    public function getAvailableWorkslots($userID) {
		$Workslot = new workslot();

    // Retrieve workslot data (e.g., list of workslot)
    $WorkSlotDetail = $Workslot->getAvailableWorkslots($userID); // Implement this method in the workslot Entity
    return $WorkSlotDetail;
   
	}
}