<?php
  // Include the Entity
class staffSuspendBidController {
    
	public function suspendBid($userID,$bidID) {
		$Bid = new bid();

		// Retrieve user data (e.g., list of users)
		$result	= $Bid-> suspendBid($userID,$bidID); // Implement this method in the Workslot Entity
				
		return $result;
	}
	
	
	
}
