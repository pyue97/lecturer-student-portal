<?php
	define('TITLE', 'Log in');
	require('header.html');
	include('config.php');
	session_start();
	
	if (isset($_SESSION['username'])) {
		echo '<script>location.href="index.php"</script>';
	}
?>

<div id="menu">
	<a href="index.php">HOME</a>
	<a class="active" href="">LOG IN</a>
</div>

<div class="content">
	<h2>LOG IN</h2>
	
	<form action="login.php" method="post">
		<div class="form-group">
			<div class="col-md-4 mb-3">
				<label for="lblUsername"><i class="fa fa-user" style="color:#8D9DB6"></i> Username</label>
				<input type="text" class="form-control" name="inputUsername" placeholder="Enter username" value="<?php if (isset($_POST['inputUsername'])) { echo htmlspecialchars($_POST['inputUsername']); } ?>" required />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-4 mb-3">
				<label for="lblPassword"><i class="fa fa-key" style="color:#8D9DB6"></i> Password</label>
				<input type="password" class="form-control" name="inputPassword" placeholder="Enter password" required />
			</div>
		</div>
		
		<div class="col-md-4 mb-3">
			<?php
				if (isset($_POST['submitted'])) {
					$username = $_POST['inputUsername'];
					$password = $_POST['inputPassword'];
					
					if($username!=''&& $password!='') {
						$conn = mysqli_connect('localhost','root','');
						mysqli_select_db($conn, 'HPY_205CDE');
						
						$query3 = 'SELECT * FROM users WHERE user_name="'.$username.'" and user_password="'.$password.'"';
						$result = mysqli_query($conn, $query3); 

						if(!$result)
							die("Query Failed: " .  mysqli_error($conn));
						else{
							if(mysqli_num_rows($result) > 0) {
								session_start();
								$_SESSION['username'] = $username;
								header('Location: index.php');
								exit();
				
								mysqli_close($conn);
							}
							else {
								echo '<p class="error">*Username or password is incorrect</p>';
							}
						}
					}
				}
			?>
		</div>
		
		<div class="col-md-4 mb-3">
			<button type="submit" class="btn btn-primary">Log in</button>
			<input type="hidden" name="submitted" value="true" />
			<p>Not an existing user? <a href="register.php">Register here</a></p>	
		</div>
		
	</form>
</div>


<?php
	require('footer.html');
?>