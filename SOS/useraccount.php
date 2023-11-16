<?php
class useraccount {
    private $userID;
    private $userName;
	private $date;
	private $email;
	private $maxShiftCount;
	private $profileID;
	
    public function __construct() {
        // Initialization if needed
    }

    
	// Database interaction methods

    public function verifyPassword($email,$password) {
        // Get the stored hashed password from the database
        $con = mysqli_connect("localhost", "root", "", "sos");

        $email = mysqli_real_escape_string($con, $email); // Assuming you have a property for userEmail

        // Query to fetch the user's hashed password
        $sql = "SELECT passWord FROM useraccount WHERE userEmail = '$email'";
        $result = mysqli_query($con, $sql);
		
		if (!$result) {
			die("Query execution error: " . mysqli_error($con));
		}

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['passWord'];

                // Use password_verify to check if the user-entered password matches the stored hashed password
                if (password_verify($password, $hashedPassword)) {
					 // Query to fetch the user
					$sql = "SELECT a.userID, a.userName, b.roleType FROM useraccount a JOIN userprofile b ON a.profileID = b.profileID WHERE a.userEmail = '$email'";
					$result = mysqli_query($con, $sql);

					if ($result) {
						if (mysqli_num_rows($result) == 1) {
							$row = mysqli_fetch_assoc($result);
							
							$_SESSION['userID'] = $row['userID'];
							$_SESSION['userName'] = $row['userName'];
							$_SESSION['roleType'] = $row['roleType'];
						}
					}
					
                    // Passwords match
                    return true;
                }
            }
        }

        // Close the database connection
        mysqli_close($con);

        return false; // Passwords don't match or user not found
    }
	
	public function getAllUsers() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT userID, userName, DOB, userEmail, maxShiftCount,profileID FROM useraccount";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$userList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $userList;
	}
	
	public function getUserDetail($userID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM useraccount WHERE userID = $userID";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$userDetail = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userDetail[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $userDetail;
	}
	
	public function updateUserDetail($userID,$userName,$DOB,$userEmail,$maxShiftCount) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Handle NULL value for maxShiftCount in the SQL query
		if ($maxShiftCount === "null") {
			$sql = "UPDATE useraccount SET userName = '$userName',
						DOB = '$DOB',
						userEmail = '$userEmail',
						maxShiftCount = NULL
					WHERE userID = $userID";
		} else {
			$sql = "UPDATE useraccount SET userName = '$userName',
						DOB = '$DOB',
						userEmail = '$userEmail',
						maxShiftCount = '$maxShiftCount'
					WHERE userID = $userID";
		}
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function suspendUser($userID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			

		$sql = "DELETE FROM useraccount WHERE userID = $userID";
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function createUser($userName,$passWord,$DOB,$userEmail,$maxShiftCount,$roleType) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			
		$sql = "select profileID from userprofile where roleType = '$roleType'";
		$result = mysqli_query($con, $sql);
		
		$hashedPassword = password_hash($passWord, PASSWORD_BCRYPT);
		
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $profileID = $row['profileID'];
				
			// Check if $maxShiftCount is provided, and set it accordingly
            if ($maxShiftCount === null || $maxShiftCount === '') {
                $maxShiftCountValue = 'NULL'; // Set as NULL in SQL
            } else {
                $maxShiftCountValue = "'" . mysqli_real_escape_string($con, $maxShiftCount) . "'";
            }
				
			$sql = "INSERT INTO useraccount (userName, passWord, DOB, userEmail, maxShiftCount,profileID)
					VALUES ('$userName', '$hashedPassword','$DOB', '$userEmail', $maxShiftCountValue, $profileID)";
					
			$result = mysqli_query($con, $sql);
			
		// Close the database connection
		mysqli_close($con);

		return $result;
			
			}
		}		
	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function searchUser($userSearch) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			

		$sql = "SELECT * FROM useraccount WHERE userID LIKE '%$userSearch%' OR userName LIKE '%$userSearch%' OR userEmail LIKE '%$userSearch%'";
					
		$result = mysqli_query($con, $sql);
		
		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}
		
		$userDetail = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userDetail[] = $row;
			}
		}
	
		// Close the database connection
		mysqli_close($con);

		return $userDetail;
	}
	
	public function updateMaxShiftCount($userID,$maxShiftCount) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Handle NULL value for maxShiftCount in the SQL query
		if ($maxShiftCount === "null") {
			$sql = "UPDATE useraccount SET 				
						maxShiftCount = NULL
					WHERE userID = $userID";
		} else {
			$sql = "UPDATE useraccount SET 					
						maxShiftCount = '$maxShiftCount'
					WHERE userID = $userID";
		}
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function viewAvailableStaff($workslotID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");
		$userDetail = [];
			
		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		 // Check the availability of slots in the workslot
		$checkSlotsQuery = "SELECT
								w.*,
								(SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') AS slotaken,
								CASE
									WHEN (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') >= w.slot THEN 'unavailable'
									ELSE 'available'
								END AS status
							FROM workslot w
							WHERE w.workslotID = '$workslotID'";
		
		$checkSlotsResult = mysqli_query($con, $checkSlotsQuery);

		if (!$checkSlotsResult) {
			mysqli_close($con);
			return false;
		}

		$workslotData = mysqli_fetch_assoc($checkSlotsResult);
		
		 // Check if the workslot is available
		if ($workslotData['status'] == 'available') {

		$sql = "SELECT
				u.*,
				w.role ,
				w.date ,
				w.shift ,w.workslotID,
				CASE
					WHEN (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') >= w.slot THEN 'unavailable'
					ELSE 'available'
				END AS status
			FROM
				useraccount u
			JOIN workslot w ON w.workslotID = '$workslotID'
			JOIN userprofile p ON u.profileID = p.profileID
			LEFT JOIN bid b ON u.userID = b.userID AND w.workslotID = b.workslotID
			WHERE
				p.roleType = 'Cafe Staff'
				AND u.maxShiftCount > 0
				AND NOT EXISTS (
					SELECT 1 FROM bid b
					JOIN workslot ws ON b.workslotID = ws.workslotID
					WHERE
						b.userID = u.userID
						AND ws.date = (SELECT date FROM workslot WHERE workslotID = '$workslotID')
						AND (b.status = 'approved' OR b.status = 'pending')
				)
			GROUP BY
				u.userID";
					
		$result = mysqli_query($con, $sql);
		
		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}
		

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$userDetail[] = $row;
			}
		}
	
		// Close the database connection
		mysqli_close($con);

		return $userDetail;
	}else {
        // No available slots, return an empty array
        mysqli_close($con);
        return $userDetail;
    }	
}

}

?>
