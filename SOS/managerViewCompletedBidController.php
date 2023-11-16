<?php
 
class managerViewCompletedBidController {
    public function displayCompletedBidList() {
		$Bid = new bid();

    // Retrieve user data (e.g., list of users)
    $bidList = $Bid->getAllCompletedBid(); // Implement this method in the User Entity
    return $bidList;
   
	}
}
?>