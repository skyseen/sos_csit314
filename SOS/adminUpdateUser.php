<?php 
session_start();
$userID = $_GET['userID'];
// Include the controller class
include 'adminViewUserDetailController.php';
// Create an instance of the controller
$controller = new adminViewUserDetailController();
// Call the controller method to display the dashboard
$userDetail = $controller->getUserDetail($userID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Update User Detail</title>
	<link rel="stylesheet" type="text/css" href="css/adminUpdateUser.css">
</head>
<body>
		
	<h2>Update User </h2>
	<form action="" method="post">
		<?php if (isset($userDetail)): // Check if $userList is defined ?>
		<?php foreach ($userDetail as $user): ?>
        <!--<label>User ID:</label>
        <input type="text" name="userID" value="<?php echo $user['userID']; ?>" disabled><br>!-->
        
        <label>User Name:</label>
        <input type="text" name="userName" value="<?php echo $user['userName'];?>"><br>
        
        <label>Date of birth:</label>
        <input type="date" name="DOB" value="<?php echo $user['DOB']; ?>"><br>
        
        <label>User Email:</label>
        <input type="text"  name="userEmail" value="<?php echo $user['userEmail']; ?>"><br>
		
		<label>Max Shift count:</label>
        <input type="text"  name="maxShiftCount" value="<?php 
					if ($user['maxShiftCount'] == null) {
                                echo "null";
                            } else {
                                echo $user['maxShiftCount'];
                            }
							?>"><br>
        
        <label >User ProfileID:</label>
        <input type="text" name="profileID" value="<?php echo $user['profileID']; ?>" disabled><br>
        <?php endforeach; ?>
        <button type="submit" name="submit">Update User</button>
		<a href="systemAdminDashboard.php"><button type='button'>Back</button></a>  
		<?php endif; ?>
    </form>
	
	<?php 
	if (isset($_POST['submit'])) {
	include 'adminUpdateUserController.php';
	$userName = $_POST['userName'];
	$DOB = $_POST['DOB'];
	$userEmail = $_POST['userEmail'];
	$maxShiftCount = $_POST['maxShiftCount'];
	
	$controller = new adminUpdateUserController();
    $result = $controller->updateUserDetail($userID,$userName,$DOB,$userEmail,$maxShiftCount);
	
	function displayPage($result){
		
		if ($result) {                              
                    
            header("Location: systemAdminDashboard.php");
            exit();
                
		}else {
           echo $errorMessage = "Error updating user detail. Please try again.";
        }						
		
	}
	
	displayPage($result);
}
?>
	  
</body>
</html>