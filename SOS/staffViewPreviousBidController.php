<?php
 // Include the Entity
class staffViewPreviousBidController {
    public function displayMyPreviousBidList($userID) {
		$Bid = new bid();

    // Retrieve user data (e.g., list of users)
    $bidList = $Bid->getAllMyPreviousBid($userID); // Implement this method in the User Entity
    return $bidList;
   
	}
}
?>