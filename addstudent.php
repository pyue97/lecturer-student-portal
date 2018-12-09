<?php
	session_start();
	define('TITLE', 'Add Student');
	require('header.html');
	include('config.php');
	include('checkAdmin.php');
	
	if (isset($_POST['submitted'])) {
		$student_name = $_POST['inputStdName'];
		
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		
		$insert_query = 'INSERT INTO users (name, user_type) VALUES ("'.$_POST['inputStdName'].'", "Student")';
		$check_query = 'SELECT * FROM users WHERE name = "'.$student_name.'"';
		$check_result = mysqli_query($conn, $check_query);
		
		if (mysqli_num_rows($check_result) < 1) {
			mysqli_query($conn, $insert_query);
			echo '<script type="text/javascript">alert("New student record created successfully");</script>';
		}
		else {
			echo '<script type="text/javascript">alert("Student record is already existed");</script>';
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
	<h2>FUNCTIONS / ADD STUDENT</h2>
	
	<form action="addstudent.php" method="post">
		<div class="form-group">
			<div class="col-sm-5">
				<p>Enter a student name:</p>
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-sm-5">
				<input type="text" class="form-control" name="inputStdName" placeholder="Name" required />
			</div>
			<div class="col-sm-4">
				<button type="submit" class="btn btn-primary"><i class="fas fa-plus" style="color:#FFFFFF"></i>&nbsp&nbsp&nbsp Add</button>
				<input type="hidden" name="submitted" value="true" />
			</div>
		</div>
	</form>
</div>

<?php
	require('footer.html');
?>