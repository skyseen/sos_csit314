<?php
include'workslot.php';  // Include the Entity
class managerViewAllWorkSlotInfoController {
    public function getAllWorkslotsInfo() {
		$Workslot = new workslot();

    // Retrieve workslot data (e.g., list of workslot)
    $WorkSlotDetail = $Workslot->getAllWorkslotsInfo(); // Implement this method in the workslot Entity
    return $WorkSlotDetail;
   
	}
}