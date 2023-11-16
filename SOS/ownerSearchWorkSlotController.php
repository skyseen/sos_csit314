<?php
include'workslot.php';   // Include the Entity
class ownerSearchWorkSlotController {
    public function searchWorkSlot($workSlotSearch) {
		$Workslot = new workslot();
		
		// Retrieve Workslot data (e.g., list of Workslot)
		$workSlotDetail = $Workslot->searchWorkSlot($workSlotSearch); // Implement this method in the Workslot Entity
			
		return $workSlotDetail;
				
	}
			
}
?>