<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create Workslot</title>
	<link rel="stylesheet" type="text/css" href="css/ownerCreateWorkSlot.css">
</head>
<body>
		
	<h2>Create Workslot</h2>
	<form action="" method="post">	
		<label>Role Type:</label>
        <select name = "role">
			<option value="Cashier">Cashier</option>
			<option value="Chef">Chef</option>
			<option value="Waiter">Waiter</option>
		</select><br>
		
		<label>Date:</label>
        <input type="date" name="date" required><br>
		
		<label>Shift:</label>
        <select name = "shift">
			<option value="AM">AM</option>
			<option value="PM">PM</option>
		</select><br>
	  
        <label>Slot:</label>
        <input type="text"  name="slot" required><br>
		     
        <button type="submit" name="submit">Create Workslot</button>
		<a href="ownerDashboard.php"><button type='button'>Back</button></a>  
    </form>
<?php
	if (isset($_POST['submit'])) {
	include 'ownerCreateWorkSlotController.php';
	$role = $_POST['role'];
	$date = $_POST['date'];
	$shift = $_POST['shift'];
	$slot = $_POST['slot'];
	
	$controller = new ownerCreateWorkSlotController();
    $result = $controller->createWorkSlot($role,$date,$shift,$slot);
	
	function displayPage($result){
		
		if ($result) {                              
                    
            header("Location: ownerDashboard.php");
            exit();
                
		}else {
           echo $errorMessage = "Error creating workslot. Please try again.";
        }						
		
	}
	displayPage($result);	
}
?>
</body>
</html>