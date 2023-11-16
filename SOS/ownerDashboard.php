<?php
 session_start();
 // Include the controller class
include 'ownerViewWorkSlotController.php';
// Create an instance of the controller
$controller = new ownerViewWorkSlotController();
// Call the controller method to display the dashboard
$workSlotList = $controller->displayWorkSlotList();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cafe Owner</title>
	<link rel="stylesheet" type="text/css" href="css/ownerDashboard.css">
</head>
<body>

	<h2>SOS Cafe</h2>
    <h3> <?php echo $_SESSION['userName'];?> </h3>
	<!--<h3> ID:<?php echo $_SESSION['userID'];?> </h3>!-->
	<h3> <?php echo $_SESSION['roleType'];?> </h3>
	
	<h3>Cafe Owner Dashboard</h3>
	
	<nav>
			<a href="ownerCreateWorkSlot.php">Workslot Creation</a>
			<a href="ownerSearch.php">Search</a>
            <form method="post" action="">
			<input type="hidden" name="logout" value="true">
			<button type="submit" name="logOut">LogOut</button>
			</form>
    </nav>
	
	<h3>Workslot</h3>
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
					<th>Assign</th>
					<th>Update Actions</th>
					<th>Suspend Actions</th>
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
					<td><?php echo $work['assigned_to']; ?></td>								                
                    <td>
                       <a href="ownerUpdateWorkSlot.php?workslotID=<?php echo $work['workslotID']; ?>"><button type="submit" name="update" >Update</button></a>                
                    </td>
					<td>
						<form method="post" action="">
							<input type="hidden" name="workslotID" value="<?php echo $work['workslotID']; ?>">
							<button type="submit" name="suspendWorkslot" value="Suspend">Suspend Workslot </button> 
						</form>               
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No records found</td>
            </tr>
        <?php endif; ?>
    </table>

<?php if (isset($_POST['suspendWorkslot'])) {
		include 'ownerSuspendWorkSlotController.php';
		$workslotID = $_POST['workslotID'];
		$controller = new ownerSuspendWorkSlotController();
		$result = $controller->suspendWorkSlot($workslotID);
		
		
		function displayPage($result){
		
			if ($result) {                              
                    
				echo '<script>window.location.href = "ownerDashboard.php";</script>';
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