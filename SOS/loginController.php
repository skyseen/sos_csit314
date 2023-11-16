<?php
include'useraccount.php';  // Include the Entity
class LoginController {
	private $user;
    public function processLogin($uEmail,$uPassword) {
			
        $this->user = new useraccount();
		$result = $this->user->verifyPassword($uEmail,$uPassword);
		
		return $result;
	}
	
}
           


?>