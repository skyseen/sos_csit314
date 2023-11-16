<?php 
session_start();
// Include the controller class
include 'staffViewWorkSlotController.php';
// Create an instance of the controller
$controller = new staffViewWorkSlotController();
// Call the controller method to display the dashboard
$workSlotList = $controller->displayWorkSlotList();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bid WorkSlot</title>
	<link rel="stylesheet" type="text/css" href="css/staffBidWorkSlot.css">
</head>
<body>
	<?php if (isset($_POST['bidWorkslot'])) {
		include 'staffCreateBidController.php';
		$userID = $_SESSION['userID'];
		$workslotID = $_POST['workslotID'];
		$controller = new staffCreateBidController();
		$result = $controller->createBid($userID,$workslotID);
		$errorMessage = '';
		
		function displayPage(){
			echo '<script>window.location.href = "staffBidWorkSlot.php";</script>';
			exit();
		}
		
		if($result){
			displayPage();
		}else{
			$errorMessage = "Your maxShiftCount is zero or already bid for a workslot on the same date";
		}
}
	
?>
	<nav>
			<a href="staffDashboard.php">staffDashboard</a>
			
    </nav>
		
	<h2>Bid WorkSlot</h2>
	<?php if (!empty($errorMessage)): ?>
            <span style="color: red; font-size: 20px;"><?php echo $errorMessage; ?></span>
        <?php endif; ?>
	<!--user acc table!-->
	<table class="collapsible-table">
				<tr>		
                    <!--<th>workslotID</th>!-->
                    <th>role</th>
                    <th>date</th>
					<th>shift</th>
					<th>status</th>
					<th>slot</th>
					<th>slotTaken</th>
					<!--<th>Assign</th>!-->
					<th>Actions</th>
                </tr>
				<?php if (!empty($workSlotList)): // Check if $workSlotList is defined ?>
				<?php foreach ($workSlotList as $work): ?>
                <tr>
                    <!--<td><?php echo $work['workslotID']; ?></td>!-->
                    <td><?php echo $work['role']; ?></td>
                    <td><?php echo $work['date']; ?></td>
                    <td><?php echo $work['shift']; ?></td>
					<td><?php echo $work['status']; ?></td>
					<td><?php echo $work['slot']; ?></td>
					<td><?php echo $work['slotaken']; ?></td>
					<!--<td><?php echo $work['assigned_to']; ?></td>!-->							                
					<td>
						<form method="post" action="">
							<input type="hidden" name="workslotID" value="<?php echo $work['workslotID']; ?>">
							<button type="submit" name="bidWorkslot" value="bid"<?php echo ($work['status'] == 'unavailable') ? 'disabled' : 'class="active"'; ?>>
							Bid Workslot 
							</button> 
						</form>               
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No records found</td>
            </tr>
        <?php endif; ?>
    </table>


</body>
</html>