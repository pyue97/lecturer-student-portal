<?php
	session_start();
	define('TITLE', 'Add Grade');
	require('header.html');
	include('config.php');
	include('checkAdmin.php');
	
	if (isset($_POST['submitted'])) {
		$subExist = FALSE;
		$subject = $_POST['inputSubject'];
		$stdName = $_POST['inputStdName'];
		$score = $_POST['inputScore'];
		
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		$insert_query = 'INSERT INTO grades (subject_name, student_name, score) VALUES ("'.$subject.'", "'.$stdName.'", "'.$score.'")';
		$check_Exist = mysqli_query($conn, 'SELECT subject_name FROM grades WHERE student_name = "'.$stdName.'"');
		$check_Student = mysqli_query($conn, 'SELECT name FROM users WHERE name = "'.$stdName.'"');
		
		if (mysqli_num_rows($check_Student) < 1) {
			echo '<script type="text/javascript">alert("Error: Could not find student name in database");</script>';
		}
		else {
			if (mysqli_num_rows($check_Exist) > 0) {
				while ($row = mysqli_fetch_assoc($check_Exist)) {
					if ($subject == $row['subject_name']) {
						$subExist = TRUE;
					}
				}
				if ($subExist == TRUE) {
					echo '<script type="text/javascript">alert("Error: Record exists in database");</script>';
				}
				else {
					if ($score < 0 || $score > 100) {
						echo '<script type="text/javascript">alert("Error: Invalid score");</script>';
					}
					else {
						mysqli_query($conn, $insert_query);
						echo '<script type="text/javascript">alert("Record inserted successfully");</script>';
					}
				}
			}
			else {
				mysqli_query($conn, $insert_query);
				echo '<script type="text/javascript">alert("Record inserted successfully");</script>';
			}
		}
		mysqli_close($conn);
	}
?>

<div id="menu">
	<a href="index.php">HOME</a>
	<a class="active" href="adminpanel.php">ADMIN PANEL</a>
	<a href="logout.php">LOG OUT</a>
</div>

<div class="content">
	<h2>FUNCTIONS / ADD GRADE</h2>
	
	<form action="addgrade.php" method="post">
	
		<div class="form-group row">
				<div class="col-2">
					<label for="lblSubject" class="col-sm-2 col-form-label">Subject</label>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="inputSubject" placeholder="Subject name" required />
				</div>
		</div>
		
		<div class="form-group row">
				<div class="col-2">
					<label for="lblStdName" class="col-sm-2 col-form-label">Student</label>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="inputStdName" placeholder="Student Name" required />
				</div>
		</div>
		
		<div class="form-group row">
				<div class="col-2">
					<label for="lblScore" class="col-sm-2 col-form-label">Score</label>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="inputScore" placeholder="Score" required />
				</div>
		</div>
		
		<div class="form-group row">
			<div class="col-10">
			</div>
			<div class="col">
				<button type="submit" class="btn btn-primary">Submit</button>
				<input type="hidden" name="submitted" value="true" />
			</div>
		</div>
	</form>
</div>

<?php
	require('footer.html');
?>