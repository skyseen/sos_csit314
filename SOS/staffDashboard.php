<?php
 session_start();
 $userID = $_SESSION['userID'];
 // Include the controller class
include 'staffViewCurrentBidController.php';
// Create an instance of the controller
$controller = new staffViewCurrentBidController();
// Call the controller method to display the dashboard
$bidList = $controller->displayMyBidList($userID);
include 'staffViewPreviousBidController.php';
// Create an instance of the controller
$controller = new staffViewPreviousBidController();
// Call the controller method to display the dashboard
$previousbidList = $controller->displayMyPreviousBidList($userID);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cafe Staff</title>
	<link rel="stylesheet" type="text/css" href="css/staffDashboard.css">
</head>
<body>

	<h2>SOS Cafe</h2>
    <h3> <?php echo $_SESSION['userName'];?> </h3>
	<!--<h3> ID:<?php echo $_SESSION['userID'];?> </h3>!-->
	<h3> <?php echo $_SESSION['roleType'];?> </h3>
	
	<h3>Cafe Staff Dashboard</h3>
	
	<nav>
			<a href="staffBidWorkSlot.php">Workslot Bid</a>
			<a href="staffUpdateMaxShiftCount.php">UpdateMaxNumberOfWorkSlot</a>
            <form method="post" action="">
			<input type="hidden" name="logout" value="true">
			<button type="submit" name="logOut">LogOut</button>
			</form>
    </nav>
	
	<h3>My Bids</h3>
	<!--user acc table!-->
	<table class="collapsible-table">
				<tr>		
                    <!--<th>bidID</th>!-->
					<th>Name</th>
                    <th>role</th>
                    <th>date</th>
					<th>shift</th>
					<th>status</th>
					<th>Update Actions</th>
					<th>Suspend Actions</th>
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
                       <a href="staffUpdateBid.php?bidID=<?php echo $bid['bidID']; ?>"><button type="submit" name="update" >Update</button></a>                
                    </td>
					<td>
						<form method="post" action="">
							<input type="hidden" name="bidID" value="<?php echo $bid['bidID']; ?>">
							<button type="submit" name="suspendBid" value="Suspend">Suspend Workslot </button> 
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

	<h3>My Previous/Completed Bids</h3>
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
				<?php if (!empty($previousbidList)): // Check if $workSlotList is defined ?>
				<?php foreach ($previousbidList as $bid): ?>
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
<?php if (isset($_POST['suspendBid'])) {
		include 'staffSuspendBidController.php';
		$bidID = $_POST['bidID'];
		$controller = new staffSuspendBidController();
		$result = $controller->suspendBid($userID,$bidID);
		
		
		function displayPage($result){
		
			if ($result) {                              
                    
				echo '<script>window.location.href = "staffDashboard.php";</script>';
				exit();
                
			}else {
			   echo $errorMessage = "Error suspending workslot. Please try again.";
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


</body>
</html>