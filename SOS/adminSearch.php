<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="css/adminSearch.css">
</head>
<body>
	 <h2>Search</h2>
	 
	<form action="" method="post">
    <label>Search User:</label><br>
    <input type="text" name="userSearch"  placeholder="Search by ID, name, userEmail" >
	<button type="submit" name="searchUser" >Search User</button><br>
	</form>
	
	<form action="" method="post">
    <label>Search UserProfile:</label><br>
    <input type="text" name="profileSearch"  placeholder="Search by ID, roleType, description" >
    <button type="submit" name="searchUserProfile" >Search User Profile</button><br>
	</form>
<a href="systemAdminDashboard.php"><button>Back</button></a>  


<?php if (isset($_POST['searchUser'])) {
		include 'adminSearchUserController.php';
		$userSearch = $_POST['userSearch'];
		$resultMessage = '';
		
		if (empty($userSearch)) {
            // Handle the case when the search term is empty
            $resultMessage = "Please enter a search term for searching users.";
        }else{
			// Retrieve user data (e.g., list of users)
			$controller = new adminSearchUserController();
			$userDetail = $controller->searchUser($userSearch); // Implement this method in the User Entity
			
			if (empty($userDetail)) {
                $resultMessage = "No records found.";
            }
		}
	}
	
	if (isset($_POST['searchUserProfile'])) {
		include 'adminSearchUserProfileController.php';
		$profileSearch = $_POST['profileSearch'];
		$resultMessage1 = '';
		
		if (empty($profileSearch)) {
            // Handle the case when the search term is empty
            $resultMessage1 = "Please enter a search term for searching users profile.";
        }else{
			// Retrieve user data (e.g., list of users)
			$controller = new adminSearchUserProfileController();
			$userProfileList = $controller->searchUserProfile($profileSearch); // Implement this method in the User Entity
			
			if (empty($userProfileList)) {
                $resultMessage1 = "No records found.";
            }
		}
	}
?>

	<?php if (!empty($userDetail)): // Check if $userList is defined ?>
	<table>
                <tr>
                    <!--<th>userID</th>!-->
                    <th>userName</th>
                    <th>DOB</th>
					<th>userEmail</th>
					<th>maxShiftCount</th>
					<th>profileID</th>		                                
                </tr>
	
	<?php foreach ($userDetail as $user): ?>
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
				</tr>
            <?php endforeach; ?>
			</table>
        <?php elseif (isset($resultMessage)): ?>
        <span style="color: red; font-size: 20px;"><?php echo $resultMessage; ?></span> <!-- Display the result message from the controller -->
    <?php endif; ?>
	
	<?php if (!empty($userProfileList)): // Check if $userList is defined ?>
	<table>
                <tr>		
                    <!--<th>profileID</th>!-->
                    <th>roleType</th>
                    <th>description</th>
					<th>accessRight</th>					
                </tr>
	
	
    <?php foreach ($userProfileList as $user): ?>
                <tr>
                    <!--<td><?php echo $user['profileID']; ?></td>!-->
                    <td><?php echo $user['roleType']; ?></td>
                    <td><?php echo $user['description']; ?></td>
                    <td><?php echo $user['accessRight']; ?></td>	
                  
				</tr>
            <?php endforeach; ?>
			</table>
        <?php elseif (isset($resultMessage1)): ?>
        <span style="color: red; font-size: 20px;"><?php echo $resultMessage1; ?></span> <!-- Display the result message from the controller -->
    <?php endif; ?>
	
	
</body>
</html>
		 