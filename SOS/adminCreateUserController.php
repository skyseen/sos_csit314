<?php
include'useraccount.php';  // Include the Entity
class adminCreateUserController {
    public function createUser($userName,$passWord,$DOB,$userEmail,$maxShiftCount,$roleType) {
		$user = new useraccount();

    // Retrieve user data (e.g., list of users)
    $result = $user->createUser($userName,$passWord,$DOB,$userEmail,$maxShiftCount,$roleType); // Implement this method in the User Entity
	
	return $result;

}

	
}

?>