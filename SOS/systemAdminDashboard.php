<?php
 session_start();
// Include the controller class
include 'adminViewUserController.php';
// Create an instance of the controller
$controller = new adminViewUserController();
// Call the controller method to display the dashboard
$userList = $controller->displayUserList();
// Include the controller class
include 'adminViewUserProfileController.php';
// Create an instance of the controller
$controller = new adminViewUserProfileController();
// Call the controller method to display the dashboard
$userProfileList = $controller->displayUserProfileList();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>System Adminstator</title>
	<link rel="stylesheet" type="text/css" href="css/adminDashboard.css">
</head>
<body>

	<h2>SOS Cafe</h2>
    <h3><?php echo $_SESSION['userName'];?> </h3>
	<!--<h3> ID:<?php echo $_SESSION['userID'];?> </h3>!-->
	<h3><?php echo $_SESSION['roleType'];?> </h3>
	
	<h3>System Administrator Dashboard</h3>
	
	<nav>
			<a href="adminCreateUser.php">Account Creation</a>
			<a href="adminCreateUserProfile.php">Profile Creation</a>
			<a href="adminSearch.php">Search</a>
           <form method="post" action="">
			<input type="hidden" name="logout" value="true">
			<button type="submit" name="logOut">LogOut</button>
			</form>

    </nav>
	
	<h3>User List</h3>
	<!--user acc table!-->
	<table class="collapsible-table">
				<tr>		
                    <!--<th>userID</th>!-->
                    <th>userName</th>
                    <th>DOB</th>
					<th>userEmail</th>
					<th>maxShiftCount</th>
					<th>profileID</th>
					<th>Update Actions</th>
					<th>Suspend Actions</th>
                </tr>
				<?php if (isset($userList)): // Check if $userList is defined ?>
				<?php foreach ($userList as $user): ?>
                <tr>
                    <!--<td><?php echo $user['userID']; ?></td>!-->
                    <td><?php echo $user['userName']; ?></td>
                    <td><?php echo $user['DOB']; ?></td>
                    <td><?php echo $user['userEmail']; ?></td>
					<td><?php 
					if ($user['maxShiftCount'] == null) {
                                echo "null";
                            } else {
                                echo $user['maxShiftCount'];
                            }
					?>
					</td>
                    <td><?php echo $user['profileID']; ?></td>		
                    <td>
                       <a href="adminUpdateUser.php?userID=<?php echo $user['userID']; ?>"><button type="submit" name="updateUser" >Update User </button></a>                
                    </td>
					<td>
						<form method="post" action="">
							<input type="hidden" name="userID" value="<?php echo $user['userID']; ?>">
							<button type="submit" name="suspendUser" value="Suspend">Suspend User </button> 
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
	
	<h3>User profile List</h3>
	<table>
				<tr>		
                    <!--<th>profileID</th>!-->
                    <th>roleType</th>
                    <th>description</th>
					<th>accessRight</th>					
					<th>Update Actions</th>
					<th>Suspend Actions</th>
                </tr>
				<?php if (isset($userProfileList)): // Check if $userList is defined ?>
				<?php foreach ($userProfileList as $user): ?>
                <tr>
                    <!--<td><?php echo $user['profileID']; ?></td>!-->
                    <td><?php echo $user['roleType']; ?></td>
                    <td><?php echo $user['description']; ?></td>
                    <td><?php echo $user['accessRight']; ?></td>					
					 <td>
                       <a href="adminUpdateUserProfile.php?profileID=<?php echo $user['profileID']; ?>"><button type="submit" name="updateUserProfile" >Update User Profile </button></a>                
                    </td>
					<td>
						<form method="post" action="">
							<input type="hidden" name="profileID" value="<?php echo $user['profileID']; ?>">
							<button type="submit" name="suspendUserProfile" value="Suspend">Suspend User Profile </button> 
						</form>                   
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No records found</td>
            </tr>
        <?php endif; ?>
    </table>
	
	
	<?php if (isset($_POST['suspendUser'])) {
		include 'adminSuspendUserController.php';
		$userID = $_POST['userID'];
		$controller = new adminSuspendUserController();
		$result = $controller->suspendUser($userID);
		
		
		function displayPage($result){
		
			if ($result) {                              
                    
				echo '<script>window.location.href = "systemAdminDashboard.php";</script>';
				exit();
                
			}else {
			   echo $errorMessage = "Error suspending user. Please try again.";
			}						
		
		}
		
		displayPage($result);
}

		if (isset($_POST['suspendUserProfile'])) {
		include 'adminSuspendUserProfileController.php';
		$profileID = $_POST['profileID'];
		$controller = new adminSuspendUserProfileController();
		$result = $controller->suspendUserProfile($profileID);
		
		
		function displayPage($result){
		
			if ($result) {                              
                    
				echo '<script>window.location.href = "systemAdminDashboard.php";</script>';
				exit();
                
			}else {
			   echo $errorMessage = "Error suspending user profile. Please try again.";
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