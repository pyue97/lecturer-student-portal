<?php
	session_start();
	define('TITLE', 'View Student Record');
	require('header.html');
	include('config.php');
	include('checkAdmin.php');
?>

<div id="menu">
	<a href="index.php">HOME</a>
	<a class="active" href="adminpanel.php">ADMIN PANEL</a>
	<a href="logout.php">LOG OUT</a>
</div>

<div class="content">
	<h2>FUNCTIONS / VIEW STUDENT RECORD</h2>
	
	<?php
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		$data_result = mysqli_query($conn, 'SELECT * FROM users WHERE user_id > 1 ORDER BY user_id');
		
		echo '<table class="table">';
			echo '<thead class="thead-dark">';
				echo '<tr>';
					echo '<th scope="col">ID</th>';
					echo '<th scope="col">Student name</th>';
					echo '<th scope="col">Username</th>';
					echo '<th scope="col">Email</th>';
					echo '<th scope="col">Contact</th>';
				echo '</tr>';
			echo '</thead>';
			
			while ($row = mysqli_fetch_array($data_result)) {
				$id = $row['user_id'];
				$username = $row['user_name'];
				$name = $row['name'];
				$email = $row['email'];
				$number = $row['number'];
				
				echo '<tbody>';
				echo '<tr>';
				echo '<th scope="row">'.$id.'</th>';
				echo '<td>'.$name.'</td>';
				echo '<td>'.$username.'</td>';
				echo '<td>'.$email.'</td>';
				echo '<td>+60'.$number.'</td>';
			}		
			echo '</tbody>';
		echo '</table>';
	?>
</div>

<?php
	require('footer.html');
?>