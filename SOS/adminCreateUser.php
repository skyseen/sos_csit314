<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create User</title>
	<link rel="stylesheet" type="text/css" href="css/adminCreateUser.css">
	<script>
		function enableMaxShiftCount() {
			var roleType = document.getElementById("roleType").value;
			var maxShiftCount = document.getElementById("maxShiftCount");
			
			if (roleType === "Cafe Staff") {
				maxShiftCount.removeAttribute("disabled");
			} else {
				maxShiftCount.setAttribute("disabled", "disabled");
			}
		}
	</script>
</head>
<body>
		
	<h2>Create User</h2>
	<form action="" method="post">	
		<label>User Name:</label>
        <input type="text" name="userName"><br>
		
		<label>PassWord:</label>
        <input type="password" name="passWord"><br>
        
        <label>Date of birth:</label>
        <input type="date" name="DOB"><br>
        
        <label>User Email:</label>
        <input type="text"  name="userEmail"><br>
		
		<label>Max Shift count:</label>
        <input type="text" name="maxShiftCount" id="maxShiftCount" disabled><br>
		
        <label>Role Type:</label>
        <select name = "roleType" id="roleType" onchange="enableMaxShiftCount()">
			<option value="System Admin">System Admin</option>
			<option value="Cafe Manager">Cafe Manager</option>
			<option value="Cafe Owner">Cafe Owner</option>
			<option value="Cafe Staff">Cafe Staff</option>
		</select><br>
		     
        <button type="submit" name="submit">Create User </button>
		<a href="systemAdminDashboard.php"><button type='button'>Back</button></a>  
    </form>
	
	<?php if (isset($_POST['submit'])) {
		include 'adminCreateUserController.php';
		$roleType = $_POST['roleType'];
		$userName = $_POST['userName'];
		$passWord = $_POST['passWord'];
		$DOB = $_POST['DOB'];
		$userEmail = $_POST['userEmail'];
		$maxShiftCount = isset($_POST['maxShiftCount']) ? $_POST['maxShiftCount'] : null;
		
		$controller = new adminCreateUserController();
		$result = $controller->createUser($userName,$passWord,$DOB,$userEmail,$maxShiftCount,$roleType);
		
		
		function displayPage($result){
		
			if ($result) {                              
						
				header("Location: systemAdminDashboard.php");
				exit();
					
			}else {
			   echo $errorMessage = "Error creating user. Please try again.";
			}						
		
		}
		
		displayPage($result);
}
	
?>
	  
</body>
</html>