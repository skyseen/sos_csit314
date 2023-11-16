<?php
class bid {
    private $bidID;
    private $userID;
	private $workslotID;
	private $status;
	
    public function __construct() {
        // Initialization if needed
    }

	// Database interaction methods	
	public function getAllMyCurrentBid($userID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT b.bidID,ua.userName ,
						ws.role ,
						ws.date,
						ws.shift,
						b.status
					FROM
						bid b
					JOIN useraccount ua ON b.userID = ua.userID
					JOIN workslot ws ON b.workslotID = ws.workslotID
					WHERE
						b.userID = $userID AND b.status = 'pending'; ";
			
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$bidList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$bidList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $bidList;
	}
	
	public function createBid($userID,$workslotID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// Check if maxshiftcount > 0
		$maxShiftCountQuery = "SELECT maxShiftCount FROM useraccount WHERE userID = '$userID'";
		$maxShiftCountResult = mysqli_query($con, $maxShiftCountQuery);

		if (!$maxShiftCountResult) {
			mysqli_close($con);
		}

		$maxShiftCount = mysqli_fetch_assoc($maxShiftCountResult)['maxShiftCount'];

		// Check if the staff has not bid for the same date
		$checkBidQuery = "SELECT COUNT(*) AS bidCount FROM bid b
						  JOIN workslot w ON b.workslotID = w.workslotID
						  WHERE b.userID = '$userID' AND w.date = (SELECT date FROM workslot WHERE workslotID = '$workslotID')";
		$checkBidResult = mysqli_query($con, $checkBidQuery);

		if (!$checkBidResult) {
			mysqli_close($con);
		}

		$bidCount = mysqli_fetch_assoc($checkBidResult)['bidCount'];
		
		// Check eligibility conditions
		if ($maxShiftCount > 0 && $bidCount == 0 ) {
			
			$sql = "INSERT INTO bid (userID, workslotID, status)
            VALUES ('$userID', '$workslotID', 'pending')";
			
			$resultInsert = mysqli_query($con, $sql);
			
			if ($resultInsert) {
            // Successfully inserted, now update maxShiftCount
            $newMaxShiftCount = $maxShiftCount - 1;
            $sqlUpdate = "UPDATE useraccount SET maxShiftCount = '$newMaxShiftCount' WHERE userID = '$userID'";
            $resultUpdate = mysqli_query($con, $sqlUpdate);

            if (!$resultUpdate) {
                mysqli_close($con);
                die("Error updating maxShiftCount: " . mysqli_error($con));
            }
			
		} else {
				mysqli_close($con);
				die("Error inserting bid: " . mysqli_error($con));
			}

			// Close the database connection
			mysqli_close($con);

			return true; // Successfully inserted bid and updated maxShiftCount
		} else {
			mysqli_close($con);
			return false; // Staff member is not eligible to bid
		}
}
	public function updateBidDetail($userID,$workslotID,$bidID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
			// Check if the staff has not bid for the same date except for the current Bid(due to it make change to AM/PM shift)
			$checkBidQuery = "SELECT COUNT(*) AS bidCount FROM bid b
					  JOIN workslot w ON b.workslotID = w.workslotID
					  WHERE b.userID = '$userID' 
					  AND w.date = (SELECT date FROM workslot WHERE workslotID = '$workslotID')
					  AND b.bidID != '$bidID'";
			$checkBidResult = mysqli_query($con, $checkBidQuery);

		if (!$checkBidResult) {
			mysqli_close($con);
		}

		$bidCount = mysqli_fetch_assoc($checkBidResult)['bidCount'];
		
		// Check eligibility conditions
		if ($bidCount == 0 ) {
			
			$sql = "UPDATE bid SET workslotID ='$workslotID' WHERE bidID = '$bidID'";
			
			$resultInsert = mysqli_query($con, $sql);
			
			if (!$resultInsert) {
				mysqli_close($con);
            
        }
		
           // Close the database connection
        mysqli_close($con);

        return true; // Successfully updated bid 
    } else {
        mysqli_close($con);
        return false; // Staff member is not eligible to update bid
    }
}

	public function suspendBid($userID,$bidID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "DELETE FROM bid
            WHERE bidID = $bidID";
					
		$result = mysqli_query($con, $sql);
		
		 if (!$result) {
        // Error in deletion
        mysqli_close($con);
		return false;
        
		}
		
		$maxShiftCountQuery = "SELECT maxShiftCount FROM useraccount WHERE userID = '$userID'";
		$maxShiftCountResult = mysqli_query($con, $maxShiftCountQuery);

		if (!$maxShiftCountResult) {
			mysqli_close($con);
			return false;
		}
		
		$maxShiftCount = mysqli_fetch_assoc($maxShiftCountResult)['maxShiftCount'];
		// Update maxShiftCount
        $newMaxShiftCount = $maxShiftCount + 1;
        $sqlUpdate = "UPDATE useraccount SET maxShiftCount = '$newMaxShiftCount' WHERE userID = '$userID'";
        $resultUpdate = mysqli_query($con, $sqlUpdate);
		
		 // Check the update result
		if (!$resultUpdate) {
			// Error in updating maxShiftCount
			mysqli_close($con);
			return false;
		}
	
		// Close the database connection
		mysqli_close($con);

		return true;
	}
	
	public function getAllMyPreviousBid($userID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT b.bidID, ua.userName, ws.role, ws.date, ws.shift, b.status
        FROM bid b
        JOIN useraccount ua ON b.userID = ua.userID
        JOIN workslot ws ON b.workslotID = ws.workslotID
        WHERE b.userID = $userID AND b.status IN ('approved', 'rejected')";
			
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$bidList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$bidList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $bidList;
	}
	
	public function getAllCurrentBid() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT b.bidID,ua.userName ,
						ws.role ,
						ws.date,
						ws.shift,
						b.status,b.workslotID,b.userID
					FROM
						bid b
					JOIN useraccount ua ON b.userID = ua.userID
					JOIN workslot ws ON b.workslotID = ws.workslotID
					WHERE
						 b.status = 'pending'; ";
			
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$bidList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$bidList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $bidList;
	}
	
	public function getAllCompletedBid() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT b.bidID,ua.userName ,
						ws.role ,
						ws.date,
						ws.shift,
						b.status
					FROM
						bid b
					JOIN useraccount ua ON b.userID = ua.userID
					JOIN workslot ws ON b.workslotID = ws.workslotID
					WHERE
						 b.status IN ('approved', 'rejected'); ";
			
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$bidList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$bidList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $bidList;
	}
	
	public function approveBid($workslotID,$bidID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

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
        // Update bid status to approved
        $updateBidStatusQuery = "UPDATE bid SET status = 'approved' WHERE bidID = '$bidID'";
        $updateBidStatusResult = mysqli_query($con, $updateBidStatusQuery);

        if ($updateBidStatusResult) {
           
            // Close the database connection
            mysqli_close($con);
            return true; // Successfully updated bid
        } else {
            mysqli_close($con);
            return false; // Error in updating bid status
        }
    } else {
        mysqli_close($con);
        return false; // Workslot is unavailable
    }
}

	public function rejectBid($userID,$bidID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE bid SET status = 'rejected' WHERE bidID = '$bidID'";
					
		$result = mysqli_query($con, $sql);
		
		 if (!$result) {
        // Error in deletion
        mysqli_close($con);
		return false;
        
		}
		
		$maxShiftCountQuery = "SELECT maxShiftCount FROM useraccount WHERE userID = '$userID'";
		$maxShiftCountResult = mysqli_query($con, $maxShiftCountQuery);

		if (!$maxShiftCountResult) {
			mysqli_close($con);
			return false;
		}
		
		$maxShiftCount = mysqli_fetch_assoc($maxShiftCountResult)['maxShiftCount'];
		// Update maxShiftCount
        $newMaxShiftCount = $maxShiftCount + 1;
        $sqlUpdate = "UPDATE useraccount SET maxShiftCount = '$newMaxShiftCount' WHERE userID = '$userID'";
        $resultUpdate = mysqli_query($con, $sqlUpdate);
		
		 // Check the update result
		if (!$resultUpdate) {
			// Error in updating maxShiftCount
			mysqli_close($con);
			return false;
		}
	
		// Close the database connection
		mysqli_close($con);

		return true;
	}
	
}

?>
