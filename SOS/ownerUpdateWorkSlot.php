<?php 
session_start();
$workslotID = $_GET['workslotID'];
// Include the controller class
include 'ownerViewWorkSlotDetailController.php';
// Create an instance of the controller
$controller = new ownerViewWorkSlotDetailController();
// Call the controller method to display the dashboard
$workslotDetail = $controller->getWorkSlotDetail($workslotID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Update WorkSlot Detail</title>
	<link rel="stylesheet" type="text/css" href="css/ownerUpdateWorkSlot.css">
</head>
<body>
		
	<h2>Update WorkSlot</h2>
	<form action="" method="post">
		<?php if (isset($workslotDetail)): // Check if $userList is defined ?>
		<?php foreach ($workslotDetail as $work): ?>
	  <!--<label>workslotID:</label>
      <input type="text" name="workslotID" value="<?php echo $work['workslotID']; ?>" disabled><br>!-->
		
      <label>Role Type:</label>
        <select name = "role">
			 <option value="Cashier" <?php if ($work['role'] == 'Cashier') echo 'selected'; ?>>Cashier</option>
             <option value="Chef" <?php if ($work['role'] == 'Chef') echo 'selected'; ?>>Chef</option>
             <option value="Waiter" <?php if ($work['role'] == 'Waiter') echo 'selected'; ?>>Waiter</option>
		</select><br>
		
		<label>Date:</label>
        <input type="date" name="date" value="<?php echo $work['date']; ?>" required><br>
		
		<label>Shift:</label>
        <select name = "shift">
			  <option value="AM" <?php if ($work['shift'] == 'AM') echo 'selected'; ?>>AM</option>
              <option value="PM" <?php if ($work['shift'] == 'PM') echo 'selected'; ?>>PM</option>
		</select><br>
	  
        <label>Slot:</label>
        <input type="text" name="slot" value="<?php echo $work['slot']; ?>" required><br>
        <?php endforeach; ?>
        <button type="submit" name="submit">Update WorkSlot</button>
		<a href="ownerDashboard.php"><button type='button'>Back</button></a>  
		<?php endif; ?>
    </form>
	 <?php if (isset($_POST['submit'])) {
		 include 'ownerUpdateWorkSlotController.php';
		$role = $_POST['role'];
		$date = $_POST['date'];
		$shift = $_POST['shift'];
		$slot = $_POST['slot'];
		
		$controller = new ownerUpdateWorkSlotController();
		$result = $controller->updateWorkSlotDetail($workslotID,$role,$date,$shift,$slot);
		
		function displayPage($result){
		
		if ($result) {                              
                    
            header("Location: ownerDashboard.php");
            exit();
                
		}else {
           echo $errorMessage = "Error updating workslot detail. Please try again.";
        }						
		
		}
		
		displayPage($result);
	
	
		
}?>
</body>
</html>