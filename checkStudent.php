<?php
	if (isset($_SESSION['username'])) {
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		$qry = 'SELECT * FROM users WHERE user_name = "'.$_SESSION['username'].'"';
		$name = mysqli_query($conn, $qry);
		if(mysqli_num_rows($name) > 0) {
			while($row = mysqli_fetch_assoc($name)) {
				$userType = $row["user_type"];
			}
			if ($userType != 'Student') {
				echo '<script>location.href="adminpanel.php"</script>';
			}
		}
		mysqli_close($conn);
	}
	else {
		echo '<script>location.href="login.php"</script>';
	}
?>