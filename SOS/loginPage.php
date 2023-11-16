<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/loginPage.css">
</head>
<body>
    <h2>SOS</h2>
	
	<?php 
	if (isset($_POST['submit'])) {
	include'loginController.php';
	$uEmail = $_POST['uEmail'];
	$uPassword = $_POST['uPassword'];
	$errorMessage = '';
	
	$loginController = new LoginController();
	$result = $loginController->processLogin($uEmail,$uPassword);
	
	function displayPage(){
	
			$position = $_SESSION['roleType'];

			if ($position == "System Admin") {
				header("Location: systemAdminDashboard.php");
				exit();
			} elseif ($position == "Cafe Manager") {
				header("Location: managerDashboard.php");
				exit();
			}elseif ($position == "Cafe Owner") {
				header("Location: ownerDashboard.php");
				exit();      
			} elseif ($position == "Cafe Staff") {
				header("Location: staffDashboard.php");
				exit();
			}
	}	
	
	if ($result){
		displayPage();
	}else{
		$errorMessage = "Invalid email or password. Please try again.";
	}
}
?>

    <form action="" method="post">
        <h3>Login to Your Account</h3>
        <input type="text" placeholder="Enter your Email" name="uEmail" required="required"><br>
		<input type="password" placeholder="Enter your Password" name="uPassword" required="required"><br>
        <button type="submit" name="submit">Login</button>
        
        <?php if (!empty($errorMessage)): ?>
            <span style="color: red; font-size: 12px;"><?php echo $errorMessage; ?></span>
        <?php endif; ?>
    </form>
    
</body>
</html>