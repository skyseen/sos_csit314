<?php 
session_start();
$bidID = $_GET['bidID'];
$userID = $_SESSION['userID'];
include 'staffViewAvailableWorkSlotController.php';
// Create an instance of the controller
$controller = new staffViewAvailableWorkSlotController();
// Call the controller method to display the dashboard
$availableWorkslots = $controller->getAvailableWorkslots($userID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Update Bid</title>
	<link rel="stylesheet" type="text/css" href="css/staffUpdateBid.css">
</head>
<body>
<?php if (isset($_POST['updateBid'])) {
		 include 'staffUpdateBidController.php';
		$workslotID = $_POST['newWorkslot'];
		
		$controller = new staffUpdateBidController();
		$result = $controller->updateBidDetail($userID,$workslotID,$bidID);
		$errorMessage = '';
		
		function displayPage(){
			echo '<script>window.location.href = "staffDashboard.php";</script>';
			exit();
		}
		
		if($result){
			displayPage();
		}else{
			$errorMessage = "You already bid for a workslot on the same date";
		}
}
	
		
?>
		
	<h2>Update Bid</h2>
<form method="post" action="">
    <label for="newWorkslot">Select New Workslot(Available):</label>
    <select name="newWorkslot" id="newWorkslot" required>
        <?php foreach ($availableWorkslots as $workslot): ?>
            <option value="<?php echo $workslot['workslotID'];  ?>">
                <?php echo $workslot['role'] .' '. $workslot['date'] . ' ' . $workslot['shift'].' '. $workslot['status']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>
	<?php if (!empty($errorMessage)): ?>
            <span style="color: red; font-size: 20px;"><?php echo $errorMessage; ?></span>
        <?php endif; ?>
    <button type="submit" name="updateBid">Update Bid</button>
	<a href="staffDashboard.php"><button type='button'>Back</button></a>  
</form>
 
</body>
</html>