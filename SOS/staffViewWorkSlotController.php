<?php
include 'workslot.php'; // Include the Entity
class staffViewWorkSlotController {
    public function displayWorkSlotList() {
		$Workslot = new workslot();

    // Retrieve user data (e.g., list of users)
    $workSlotList = $Workslot->getAllWorkSlot(); // Implement this method in the User Entity
    return $workSlotList;
   
	}
}
?>