<?php
 include 'bid.php'; // Include the Entity
class staffUpdateBidController {
  
	public function updateBidDetail($userID,$workslotID,$bidID) {
		$Bid = new bid();


		// Retrieve user data (e.g., list of users)
		$result	= $Bid->updateBidDetail($userID,$workslotID,$bidID); // Implement this method in the User Entity
		return $result;
		
	}
	
}


?>