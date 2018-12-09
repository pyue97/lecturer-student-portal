<?php
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn, 'HPY_205CDE');
		
	if( isset($_GET['del']) ) {
		$id = $_GET['del'];
		if(mysqli_query($conn, 'DELETE FROM grades WHERE id = "'.$id.'"')) {
			echo '<script type="text/javascript">alert("Record has been deleted");</script>';
			echo "<meta http-equiv='refresh' content='0;url=editgrade.php'>";
		}
		else {
			echo '<script type="text/javascript">alert("Failed");</script>';
		}
	}
	mysqli_close($conn);
?>