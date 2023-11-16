<?php

class managerOfferAvailableWorkSlotController {
  
	public function offerAvailableWorkSlot($userID,$workslotID) {
		$Workslot = new workslot();


    $result = $Workslot->offerAvailableWorkSlot($userID,$workslotID); // Implement this method in the Workslot Entity
	
	return $result;
	
	}
}

?>