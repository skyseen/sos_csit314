<?php
  // Include the Entity
class managerApprovedBidController {
    
	public function approveBid($workslotID,$bidID) {
		$Bid = new bid();

		// Retrieve user data (e.g., list of users)
		$result	= $Bid-> approveBid($workslotID,$bidID); // Implement this method in the Workslot Entity
				
		return $result;
	}
	
	
	
}
