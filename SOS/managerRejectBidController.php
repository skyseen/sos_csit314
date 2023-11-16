<?php
  // Include the Entity
class managerRejectBidController {
    
	public function rejectBid($userID,$bidID) {
		$Bid = new bid();

		// Retrieve user data (e.g., list of users)
		$result	= $Bid-> rejectBid($userID,$bidID); // Implement this method in the Workslot Entity
				
		return $result;
	}
	
	
	
}
