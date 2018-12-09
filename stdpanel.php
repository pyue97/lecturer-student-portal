<?php
	session_start();
	define('TITLE', 'Admin Panel');
	require('header.html');
	include('config.php');
	include('checkStudent.php');
?>

<div id="menu">
	<a href="index.php">HOME</a>
	<a class="active" href="stdpanel.php">STUDENT PANEL</a>
	<a href="logout.php">LOG OUT</a>
</div>

<div class="content">
	<h2>STUDENT GRADES</h2>
	
	<?php
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		$student_search = mysqli_query($conn, 'SELECT name FROM users WHERE user_name = "'.$_SESSION['username'].'"');
		if (mysqli_num_rows($student_search) > 0) {
			while ($row = mysqli_fetch_array($student_search)) {
				$stdName = $row['name'];
			}
		}
		$data_result = mysqli_query($conn, 'SELECT * FROM grades WHERE student_name = "'.$stdName.'" ORDER BY subject_name');
		
		function gradeCalc($score) {
			if ($score >= 90)
				return 'A+';
			else if ($score >= 80)
				return 'A';
			else if ($score >= 75)
				return 'A-';
			else if ($score >= 70)
				return 'B+';
			else if ($score >= 65)
				return 'B';
			else if ($score >= 60)
				return 'B-';
			else if ($score >= 55)
				return 'C+';
			else if ($score >= 50)
				return 'C';
			else if ($score >= 45)
				return 'C-';
			else if ($score >= 40)
				return 'D';
			else
				return 'F';
		}
	
		echo '<h6>Student name: '.$stdName.'</h6><br />';
		
		echo '<table align="center" class="table" style="width: 80%">';
			echo '<thead class="thead-dark">';
				echo '<tr>';
					echo '<th scope="col">Subject Name</th>';
					echo '<th class="text-center" scope="col">Score</th>';
					echo '<th class="text-center" scope="col">Grade</th>';
				echo '</tr>';
			echo '</thead>';
			
			while ($row = mysqli_fetch_array($data_result)) {
				$stdName = $row['student_name'];
				$subName = $row['subject_name'];
				$score = $row['score'];
				
				echo '<tbody>';
				echo '<tr>';
				echo '<th scope="row">'.$subName.'</th>';
				echo '<td class="text-center">'.$score.'</td>';
				echo '<td class="text-center">'.gradeCalc($score).'</td>';
			}		
			echo '</tbody>';
		echo '</table>';
		
		mysqli_close($conn);
	?>
</div>

<?php
	require('footer.html');
?>