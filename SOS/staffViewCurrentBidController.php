<?php
include 'bid.php'; // Include the Entity
class staffViewCurrentBidController {
    public function displayMyBidList($userID) {
		$Bid = new bid();

    // Retrieve user data (e.g., list of users)
    $bidList = $Bid->getAllMyCurrentBid($userID); // Implement this method in the User Entity
    return $bidList;
   
	}
}
?>