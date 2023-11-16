<?php
class workslot {
    private $workslotID;
    private $role;
	private $date1;
	private $shift;
	private $slot;
	
    public function __construct() {
        // Initialization if needed
    }

   
	// Database interaction methods	
	public function getAllWorkSlot() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT
				w.*,
				(SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') AS slotaken,
				CASE
					WHEN (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') >= w.slot THEN 'unavailable'
					ELSE 'available'
				END AS status,
				GROUP_CONCAT(u.userName) AS assigned_to
			FROM workslot w
			LEFT JOIN bid b ON w.workslotID = b.workslotID AND b.status = 'approved'
			LEFT JOIN useraccount u ON b.userID = u.userID
			GROUP BY w.workslotID;";
			
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$workSlotList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$workSlotList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $workSlotList;
	}
	
	public function createWorkSlot($role,$date,$shift,$slot) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		
		$sql = "INSERT INTO workslot (role, date, shift, slot)
            VALUES ('$role', '$date', '$shift', $slot)";
		
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function getWorkSlotDetail($workslotID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM workslot WHERE workslotID = $workslotID";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$workSlotDetail = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$workSlotDetail[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $workSlotDetail;
	}
	
	public function updateWorkSlotDetail($workslotID,$role,$date,$shift,$slot) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE workslot SET role = '$role',
                date = '$date',
                shift = '$shift',
				slot = '$slot'
            WHERE workslotID = $workslotID";
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function suspendWorkSlot($workslotID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			

		$sql = "DELETE FROM workslot WHERE workslotID = $workslotID";
					
		$result = mysqli_query($con, $sql);

	
		// Close the database connection
		mysqli_close($con);

		return $result;
	}
	
	public function searchWorkSlot($workSlotSearch) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			

		$sql = "SELECT * FROM workslot WHERE workslotID LIKE '%$workSlotSearch%' OR role LIKE '%$workSlotSearch%' OR date LIKE '%$workSlotSearch%'";
					
		$result = mysqli_query($con, $sql);
		
		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}
		
		$workSlotDetail = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$workSlotDetail[] = $row;
			}
		}
	
		// Close the database connection
		mysqli_close($con);

		return $workSlotDetail;
	}
	
	public function getAvailableWorkslots($userID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		//get all the available workslot and exclude those staff already bided
		$sql = "SELECT
				w.*,
				(SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') AS slotaken,
				CASE
				WHEN (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') >= w.slot THEN 'unavailable'
				ELSE 'available'
				END AS status,
				GROUP_CONCAT(u.userName) AS assigned_to
			FROM workslot w
			LEFT JOIN bid b ON w.workslotID = b.workslotID AND b.status = 'approved'
			LEFT JOIN useraccount u ON b.userID = u.userID
			WHERE NOT EXISTS (SELECT 1 FROM bid b2 WHERE b2.workslotID = w.workslotID AND b2.userID = '$userID')
				AND (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') < w.slot
			GROUP BY w.workslotID;";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$workSlotDetail = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$workSlotDetail[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $workSlotDetail;
	}
	
	public function getAllUnfilledWorkSlot() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT
            w.*,
            (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') AS slotaken,
            CASE
                WHEN (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') >= w.slot THEN 'unavailable'
                ELSE 'available'
            END AS status,
            GROUP_CONCAT(u.userName) AS assigned_to
        FROM workslot w
        LEFT JOIN bid b ON w.workslotID = b.workslotID AND b.status = 'approved'
        LEFT JOIN useraccount u ON b.userID = u.userID
        WHERE 
            (SELECT COUNT(*) FROM bid b2 WHERE b2.workslotID = w.workslotID AND b2.status = 'approved') < w.slot
        GROUP BY w.workslotID;";

			
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$workSlotList = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$workSlotList[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $workSlotList;
	}
	
	public function getAllWorkslotsInfo() {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		//get all the workslot 
		$sql = $sql = "SELECT
						w.*,
						(SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') AS slotaken,
						CASE
						WHEN (SELECT COUNT(*) FROM bid b WHERE b.workslotID = w.workslotID AND b.status = 'approved') >= w.slot THEN 'unavailable'
						ELSE 'available'
						END AS status,
						GROUP_CONCAT(u.userName) AS assigned_to
					FROM workslot w
					LEFT JOIN bid b ON w.workslotID = b.workslotID AND b.status = 'approved'
					LEFT JOIN useraccount u ON b.userID = u.userID
					GROUP BY w.workslotID;";
		$result = mysqli_query($con, $sql);

		if (!$result) {
			mysqli_close($con); // Close the connection in case of an error
			die("Query execution error: " . mysqli_error($con));
		}

		$workSlotDetail = [];

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$workSlotDetail[] = $row;
			}
		}

		// Close the database connection
		mysqli_close($con);

		return $workSlotDetail;
	}
	
	public function offerAvailableWorkSlot($userID,$workslotID) {
		// Initialize the connection outside the function
		$con = mysqli_connect("localhost", "root", "", "sos");

		// Check the connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "INSERT INTO bid (userID, workslotID, status)
            VALUES ('$userID', '$workslotID', 'approved')";
					
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
        $newMaxShiftCount = $maxShiftCount - 1;
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
