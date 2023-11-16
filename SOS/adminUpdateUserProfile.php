<?php 
session_start();
$profileID = $_GET['profileID'];
// Include the controller class
include 'adminViewUserProfileDetailController.php';
// Create an instance of the controller
$controller = new adminViewUserProfileDetailController();
// Call the controller method to display the dashboard
$userProfile = $controller->getUserProfile($profileID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Update User Profile</title>
	<link rel="stylesheet" type="text/css" href="css/adminUpdateUserProfile.css">
</head>
<body>
		
	<h2>Update User Profile</h2>
	<form action="" method="post">
		<?php if (isset($userProfile)): // Check if $userList is defined ?>
		<?php foreach ($userProfile as $user): ?>
        <!--<label>Profile ID:</label>
        <input type="text" name="profileID" value="<?php echo $user['profileID']; ?>" disabled><br>!-->
        
        <label>Role Type:</label>
        <input type="text" name="roleType" value="<?php echo $user['roleType'];?>"  disabled><br>
        
        <label>Description:</label>
        <textarea  name="description"><?php echo $user['description']; ?></textarea><br>
		
        <label>Access Right:</label>
        <textarea  name="accessRight"><?php echo $user['accessRight']; ?></textarea><br>
		     
        <?php endforeach; ?>
        <button type="submit" name="submit">Update User Profile</button>
		<a href="systemAdminDashboard.php"><button type='button'>Back</button></a>  
		<?php endif; ?>
    </form>
	
		<?php 
		if (isset($_POST['submit'])) {
		include 'adminUpdateUserProfileController.php';
		$description = $_POST['description'];
		$accessRight = $_POST['accessRight'];
		
		$controller = new adminUpdateUserProfileController();
		$result = $controller->updateUserProfile($profileID,$description,$accessRight);
		
		function displayPage($result){
			
			if ($result) {                              
						
				header("Location: systemAdminDashboard.php");
				exit();
					
			}else {
			   echo $errorMessage = "Error updating user profile.  Please try again.";
			}						
			
		}
		
		displayPage($result);
	}
?>
	  
</body>
</html>