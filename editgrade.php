<?php
	session_start();
	define('TITLE', 'Edit Grade');
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
	<h2>FUNCTIONS / EDIT GRADE</h2>
	
	<?php
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		$data_result = mysqli_query($conn, 'SELECT * FROM grades ORDER BY subject_name');
		
		echo '<table class="table">';
			echo '<thead class="thead-dark">';
				echo '<tr>';
					echo '<th scope="col">Subject Name</th>';
					echo '<th scope="col">Student Name</th>';
					echo '<th scope="col">Score</th>';
					echo '<th scope="col"></th>';
				echo '</tr>';
			echo '</thead>';
			
			while ($row = mysqli_fetch_array($data_result)) {
				$stdName = $row['student_name'];
				$subName = $row['subject_name'];
				$score = $row['score'];
				$id = $row['id'];
				
				echo '<tbody>';
				echo '<tr>';
				echo '<th scope="row">'.$subName.'</th>';
				echo '<td>'.$stdName.'</td>';
				echo '<td>'.$score.'</td>';
				echo "<td><a href='delete.php?del=$row[id]'><i class='far fa-trash-alt'></i></a></td>";
			}		
			echo '</tbody>';
		echo '</table>';
		
		mysqli_close($conn);
	?>
</div>

<?php
	require('footer.html');
?>