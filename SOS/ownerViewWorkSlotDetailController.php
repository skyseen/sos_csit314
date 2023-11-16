<?php
include'workslot.php';  // Include the Entity
class ownerViewWorkSlotDetailController {
    public function getWorkSlotDetail($workslotID) {
		$Workslot = new workslot();

    // Retrieve user data (e.g., list of users)
    $WorkSlotDetail = $Workslot->getWorkSlotDetail($workslotID); // Implement this method in the User Entity
    return $WorkSlotDetail;
   
	}
}