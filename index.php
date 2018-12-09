<?php
	session_start();
	define('TITLE', 'Home page');
	require('header.html');
	include('config.php');
?>

<div id="menu">
	<a class="active" href="index.php">HOME</a>
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
				if ($userType == "Admin") {
					echo '<a href="adminpanel.php">ADMIN PANEL</a>';
				}
				else {
					echo '<a href="stdpanel.php">STUDENT PANEL</a>';
				}
			}
			mysqli_close($conn);
		}
		
		if (isset($_SESSION['username'])) {
			echo '<a href="logout.php">LOG OUT</a>';
		}
		else {
			echo '<a href="login.php">LOG IN</a>';
		}
	?>
</div>

<div class="content">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="Images/library.jpeg" alt="First slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>Welcome</h5>
					<p>This is a lecturer-student portal</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="Images/reading.jpeg" alt="Second slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>Lecturer</h5>
					<p>Update students' grades</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="Images/corridor.jpeg" alt="Third slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>Student</h5>
					<p>Check available grades</p>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	
	<?php
		if (isset($_SESSION['username'])) {
			echo '<h1>Welcome, ' .$_SESSION['username']. '!</h1>';
		}
		else {
			echo '<h3>Welcome to INTI student grading portal</h3>';
			echo '<p class="intro">This is a lecturer-student portal educational experiences will be optimized. We believe in the power of technology to expand access to education to every student—regardless of geography, stage of life or disability.</p>';
			
			echo '<h3>Admin / Lecturer</h3>';
			echo '<p class="intro">This role has full access and is usually given to the teaching staff member responsible for the course. Admin/Lecturer can access the Admin Panel and add marks etc</p>';
			
			echo '<h3>Student</h3>';
			echo '<p class="intro">Students have guest access to the site to check academy grades, and must be registered only if admin allows. </p>';
		}
	?>
</div>

<?php
	require('footer.html');
?>