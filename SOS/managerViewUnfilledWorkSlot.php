<?php 
session_start();
// Include the controller class
include 'managerViewUnfilledWorkSlotController.php';
// Create an instance of the controller
$controller = new managerViewUnfilledWorkSlotController();
// Call the controller method to display the dashboard
$workSlotList = $controller->displayUnfilledWorkSlotList();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bid WorkSlot</title>
	<link rel="stylesheet" type="text/css" href="css/managerViewUnfilledWorkSlot.css">
</head>
<body>
	<nav>
			<a href="managerDashboard.php">managerDashboard</a>
			
    </nav>
		
	<h2>Unfilled/Available WorkSlot</h2>
	<table class="collapsible-table">
				<tr>		
                    <!--<th>workslotID</th>!-->
                    <th>role</th>
                    <th>date</th>
					<th>shift</th>
					<th>status</th>
					<th>slot</th>
					<th>slotTaken</th>
					<!--<th>Assign</th>!-->
                </tr>
				<?php if (!empty($workSlotList)): // Check if $workSlotList is defined ?>
				<?php foreach ($workSlotList as $work): ?>
                <tr>
                    <!--<td><?php echo $work['workslotID']; ?></td>!-->
                    <td><?php echo $work['role']; ?></td>
                    <td><?php echo $work['date']; ?></td>
                    <td><?php echo $work['shift']; ?></td>
					<td><?php echo $work['status']; ?></td>
					<td><?php echo $work['slot']; ?></td>
					<td><?php echo $work['slotaken']; ?></td>
					<!--<td><?php echo $work['assigned_to']; ?></td>!-->							                
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No records found</td>
            </tr>
        <?php endif; ?>
    </table>



</body>
</html>