<?php
class userprofile {
    private $profileID;
	private $roleType;
	private $description;
	private $accessRight;
	
    public function __construct() {
        // Initialization if needed
    }

    
	// Database interaction methods	
	public function getAllUserProfile() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM userprofile";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$userprofileList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userprofileList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $userprofileList;
	}
	
	public function getUserProfile($profileID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM userprofile WHERE profileID = $profileID";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$userProfile = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userProfile[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $userProfile;
	}
	
	public function updateUserProfile($profileID,$description,$accessRight) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$description = mysqli_real_escape_string($con, $description);
		$accessRight = mysqli_real_escape_string($con, $accessRight);


		$sql = "UPDATE userprofile SET description = '$description',
                accessRight = '$accessRight'              
            WHERE profileID = $profileID";
					
		$result = mysqli_query($con, $sql);
		


	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function suspendUserProfile($profileID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "DELETE FROM userprofile 
            WHERE profileID = $profileID";
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function createUserProfile($roleType,$description,$accessRight) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$roleType = mysqli_real_escape_string($con, $roleType);
		$description = mysqli_real_escape_string($con, $description);
		$accessRight = mysqli_real_escape_string($con, $accessRight);

		$sql = "INSERT INTO userProfile (roleType, description, accessRight)
            VALUES ('$roleType', '$description', '$accessRight')";
		
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function searchUserProfile($profileSearch) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			

		$sql = "SELECT * FROM userprofile WHERE profileID LIKE '%$profileSearch%' OR roleType LIKE '%$profileSearch%' OR description LIKE '%$profileSearch%'";
					
		$result = mysqli_query($con, $sql);
		
		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}
		
		$userProfile = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userProfile[] = $row;
			}
		}
	
		// Close the database connection
		mysqli_close($con);

		return $userProfile;
	}
}



?>
