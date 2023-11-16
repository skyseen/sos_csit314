<?php 
session_start();
include 'managerViewAllWorkSlotInfoController.php';
// Create an instance of the controller
$controller = new managerViewAllWorkSlotInfoController();
// Call the controller method to display the dashboard
$Workslots = $controller->getAllWorkslotsInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>View all available staff</title>
		<link rel="stylesheet" type="text/css" href="css/managerViewAvailableStaff.css">
</head>
<body>
<?php if (isset($_POST['selectWorkslot'])) {
		include 'managerViewAvailableStaffController.php';
		$workslotID = $_POST['sWorkslot'];
		$resultMessage = '';
		
		$controller = new managerViewAvailableStaffController();
		$availableStaff = $controller->viewAvailableStaff($workslotID); // Implement this method in the User Entity
			
		if (empty($availableStaff)) {
            $resultMessage = "There is no available staff for it or workslot is unavailable.";
        }
		
	}
	
	if (isset($_POST['offerBid'])) {
		include 'managerOfferAvailableWorkSlotController.php';
		$workslotID = $_POST['workslotID'];
		$userID = $_POST['userID'];
		$controller = new managerOfferAvailableWorkSlotController();
		$result = $controller->offerAvailableWorkSlot($userID,$workslotID);
		
		
		function displayPage($result){
		
			if ($result) {                              
                    
				echo '<script>window.location.href = "managerViewAvailableStaff.php";</script>';
				exit();
                
			}else {
			   echo $errorMessage = "Error offer workslot. Please try again.";
			}						
		
		}
		
		displayPage($result);
}
	
	
	
?>
		
	<h2>View all available staff according to workslot</h2>
	<form method="post" action="">
		<label for="newWorkslot">Select Workslot:</label>
		<select name="sWorkslot" id="Workslot" required>
			<?php foreach ($Workslots as $workslot): ?>
				<option value="<?php echo $workslot['workslotID'];  ?>">
					<?php echo $workslot['role'] .' '. $workslot['date'] . ' ' . $workslot['shift'].' '. $workslot['status']; ?>
				</option>
			<?php endforeach; ?>
		</select><br>
		<button type="submit" name="selectWorkslot">Select</button>
		<a href="managerDashboard.php"><button type='button'>Back</button></a>  
	</form>

<?php if (!empty($availableStaff)): // Check if $availableStaff is defined ?>
	<table>
                <tr>
                    <!--<th>workslotID</th>!-->
					<th>available staff name</th>
                    <th>available role</th>
                    <th>available date</th>
					<th>available shift</th>				
					<th>available slot</th>	
					<th>action</th>	
                </tr>
	
	<?php foreach ($availableStaff as $work): ?>
                <tr>
                    <!--<td><?php echo $work['workslotID']; ?></td>!-->
					<td><?php echo $work['userName']; ?></td>
                    <td><?php echo $work['role']; ?></td>
                    <td><?php echo $work['date']; ?></td>
                    <td><?php echo $work['shift']; ?></td>
				    <td><?php echo $work['status']; ?></td>
					<td>
                       <form method="post" action="">
							<input type="hidden" name="userID" value="<?php echo $work['userID']; ?>">
							<input type="hidden" name="workslotID" value="<?php echo $work['workslotID']; ?>">
							<button type="submit" name="offerBid" value="offer">Offer</button> 
						</form>                             
                    </td>					
				</tr>
            <?php endforeach; ?>
			</table>
        <?php elseif (isset($resultMessage)): ?>
         <span style="color: red; font-size: 20px;"><?php echo $resultMessage; ?></span><!-- Display the result message from the controller -->
    <?php endif; ?>
 
</body>
</html>