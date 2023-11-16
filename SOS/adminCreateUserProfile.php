<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create User Profile</title>
	<link rel="stylesheet" type="text/css" href="css/adminCreateUserProfile.css">
</head>
<body>
		
	<h2>Create User Profile</h2>
	<form action="" method="post">		          
        <label>Role Type:</label>
        <select name = "roleType">
			<option value="System Admin">System Admin</option>
			<option value="Cafe Manager">Cafe Manager</option>
			<option value="Cafe Owner">Cafe Owner</option>
			<option value="Cafe Staff">Cafe Staff</option>
		</select><br>
        <label>Description:</label>
        <textarea  name="description"></textarea><br>
		
        <label>Access Right:</label>
        <textarea  name="accessRight"></textarea><br>
		     
        <button type="submit" name="submit">Create User Profile</button>
		<a href="systemAdminDashboard.php"><button type='button'>Back</button></a>  
    </form>
	
	<?php if (isset($_POST['submit'])) {
		include 'adminCreateUserProfileController.php';
		$roleType = $_POST['roleType'];
		$description = $_POST['description'];
		$accessRight = $_POST['accessRight'];
			
		$controller = new adminCreateUserProfileController();
		$result = $controller->createUserProfile($roleType,$description,$accessRight);
		
		
		function displayPage($result){
		
			if ($result) {                              
						
				header("Location: systemAdminDashboard.php");
				exit();
					
			}else {
			   echo $errorMessage = "Error  creating user profile. Please try again.";
			}						
		
		}
		
		displayPage($result);
}
	
?>
	  
</body>
</html>