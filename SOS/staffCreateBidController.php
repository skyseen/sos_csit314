<?php
include'bid.php';  // Include the Entity
class staffCreateBidController {
    public function createBid($userID,$workslotID) {
		$Bid = new bid();

    // Retrieve user data (e.g., list of users)
    $result = $Bid->createBid($userID,$workslotID); // Implement this method in the Workslot Entity
	
	return $result;
	
	}
	
	
}

?>