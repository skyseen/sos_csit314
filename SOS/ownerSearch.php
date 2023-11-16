<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="css/ownerSearch.css">
</head>
<body>
	 <h2>Search</h2>
	 
	<form action="" method="post">
    <label>Search WorkSlot:</label><br>
    <input type="text" name="workSlotSearch"  placeholder="Search by ID, role, date">
	<button type="submit" name="submit" >Search</button><br>

	</form>
<a href="ownerDashboard.php"><button>Back</button></a>  

	<?php if (isset($_POST['submit'])) {
		include 'ownerSearchWorkSlotController.php';
		$workSlotSearch = $_POST['workSlotSearch'];
		$resultMessage = '';
		
		if (empty($workSlotSearch)) {
            // Handle the case when the search term is empty
            $resultMessage = "Please enter a search term for searching users.";
        }else{
			// Retrieve user data (e.g., list of users)
			$controller = new ownerSearchWorkSlotController();
			$workSlotDetail = $controller->searchWorkSlot($workSlotSearch); // Implement this method in the User Entity
			
			if (empty($workSlotDetail)) {
                $resultMessage = "No records found.";
            }
		}
	}
?>
	<?php if (!empty($workSlotDetail)): // Check if $workSlotDetail is defined ?>
	<table>
                <tr>
                    <!--<th>workslotID</th>!-->
                    <th>role</th>
                    <th>date</th>
					<th>shift</th>				
					<th>slot</th>				                      
                </tr>
	
	<?php foreach ($workSlotDetail as $work): ?>
                <tr>
                    <!--<td><?php echo $work['workslotID']; ?></td>!-->
                    <td><?php echo $work['role']; ?></td>
                    <td><?php echo $work['date']; ?></td>
                    <td><?php echo $work['shift']; ?></td>
				    <td><?php echo $work['slot']; ?></td>            
				</tr>
            <?php endforeach; ?>
			</table>
        <?php elseif (isset($resultMessage)): ?>
        <span style="color: red; font-size: 20px;"><?php echo $resultMessage; ?></span> <!-- Display the result message from the controller -->
    <?php endif; ?>
	
</body>
</html>
		 