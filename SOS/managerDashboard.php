<?php
 session_start();
 // Include the controller class
include 'managerViewCurrentBidController.php';
// Create an instance of the controller
$controller = new managerViewCurrentBidController();
// Call the controller method to display the dashboard
$bidList = $controller->displayCurrentBidList();
include 'managerViewCompletedBidController.php';
// Create an instance of the controller
$controller = new managerViewCompletedBidController();
// Call the controller method to display the dashboard
$completedbidList = $controller->displayCompletedBidList();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cafe Manager</title>
	<link rel="stylesheet" type="text/css" href="css/managerDashboard.css">
</head>
<body>
<?php if (isset($_POST['approveBid'])) {
		include 'managerApprovedBidController.php';
		$bidID = $_POST['bidID'];
		$workslotID = $_POST['workslotID'];
		$controller = new managerApprovedBidController();
		$result = $controller->approveBid($workslotID,$bidID);
		$errorMessage = '';
		
		function displayPage(){
			echo '<script>window.location.href = "managerDashboard.php";</script>';
			exit();
		}
		
		if($result){
			displayPage();
		}else{
			$errorMessage = "The workslot is full/unavailable.";
		}
}

 if (isset($_POST['rejectBid'])) {
		include 'managerRejectBidController.php';
		$bidID = $_POST['bidID'];
		$userID = $_POST['userID'];
		$controller = new managerRejectBidController();
		$result = $controller->rejectBid($userID,$bidID);
		
		
		function displayPage($result){
		
			if ($result) {                              
                    
				echo '<script>window.location.href = "managerDashboard.php";</script>';
				exit();
                
			}else {
			   echo $errorMessage = "Error rejecting bid. Please try again.";
			}						
		
		}
		
		displayPage($result);
}

		function logOut(){
			
			//clear the session 
			unset($_SESSION['userName']);
			unset($_SESSION['userID']);
			unset($_SESSION['roleType']);
			session_destroy();
			//redirect to loginPage
			echo '<script>window.location.href = "loginPage.php";</script>';
			exit;
		}
		
		if(isset($_POST['logout'])){
			logOut();
		}

?>

	<h2>SOS Cafe</h2>
    <h3> <?php echo $_SESSION['userName'];?> </h3>
	<!--<h3> ID:<?php echo $_SESSION['userID'];?> </h3>!-->
	<h3> <?php echo $_SESSION['roleType'];?> </h3>
	
	<h3>Cafe Manager Dashboard</h3>
	
	<nav>
			<a href="managerViewUnfilledWorkSlot.php">ViewUnfilledWorkSlot</a>
			<a href="managerViewAvailableStaff.php">ViewAvailableStaff</a>
            <form method="post" action="">
			<input type="hidden" name="logout" value="true">
			<button type="submit" name="logOut">LogOut</button>
			</form>
    </nav>
	
	<h3>Current Staff's Bids</h3>
	<?php if (!empty($errorMessage)): ?>
            <span style="color: red; font-size: 20px;"><?php echo $errorMessage; ?></span>
        <?php endif; ?>
	<!--user acc table!-->
	<table class="collapsible-table">
				<tr>		
                    <!--<th>bidID</th>!-->
					<th>Name</th>
                    <th>role</th>
                    <th>date</th>
					<th>shift</th>
					<th>status</th>
					<th>Approve Actions</th>
					<th>Reject Actions</th>
                </tr>
				<?php if (!empty($bidList)): // Check if $workSlotList is defined ?>
				<?php foreach ($bidList as $bid): ?>
                <tr>
                    <!--<td><?php echo $bid['bidID']; ?></td>!-->
                    <td><?php echo $bid['userName']; ?></td>
                    <td><?php echo $bid['role']; ?></td>
                    <td><?php echo $bid['date']; ?></td>
					<td><?php echo $bid['shift']; ?></td>
					<td><?php echo $bid['status']; ?></td>							                
                    <td>
                       <form method="post" action="">
							<input type="hidden" name="bidID" value="<?php echo $bid['bidID']; ?>">
							<input type="hidden" name="workslotID" value="<?php echo $bid['workslotID']; ?>">
							<button type="submit" name="approveBid" value="approve">Approve Bid </button> 
						</form>                             
                    </td>
					<td>
						<form method="post" action="">
							<input type="hidden" name="bidID" value="<?php echo $bid['bidID']; ?>">
							<input type="hidden" name="userID" value="<?php echo $bid['userID']; ?>">
							<button type="submit" name="rejectBid" value="reject">Reject Bid </button> 
						</form>               
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No records found</td>
            </tr>
        <?php endif; ?>
    </table>

	<h3>Completed Staff's Bids</h3>
	<!--user acc table!-->
	<table class="collapsible-table">
				<tr>		
                    <!--<th>bidID</th>!-->
					<th>Name</th>
                    <th>role</th>
                    <th>date</th>
					<th>shift</th>
					<th>status</th>
					
                </tr>
				<?php if (!empty($completedbidList)): // Check if $workSlotList is defined ?>
				<?php foreach ($completedbidList as $bid): ?>
                <tr>
                    <!--<td><?php echo $bid['bidID']; ?></td>!-->
                    <td><?php echo $bid['userName']; ?></td>
                    <td><?php echo $bid['role']; ?></td>
                    <td><?php echo $bid['date']; ?></td>
					<td><?php echo $bid['shift']; ?></td>
					<td><?php echo $bid['status']; ?></td>							                
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No records found</td>
            </tr>
        <?php endif; ?>
    </table>


</body>
</html>