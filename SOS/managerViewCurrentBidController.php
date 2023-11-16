<?php
include 'bid.php'; // Include the Entity
class managerViewCurrentBidController {
    public function displayCurrentBidList() {
		$Bid = new bid();

    // Retrieve user data (e.g., list of users)
    $bidList = $Bid->getAllCurrentBid(); // Implement this method in the User Entity
    return $bidList;
   
	}
}
?>