<?php
	define('TITLE', 'Register');
	require('header.html');
	include('config.php');
	session_start();
	
	if (isset($_SESSION['username'])) {
		echo '<script>location.href="index.php"</script>';
	}
	
	if (isset($_POST['submitted'])) {
		$name = $_POST['inputStdName'];
		$username = $_POST['inputUsername'];
		$pwrd = $_POST['inputPassword'];
		$conpwrd = $_POST['inputConfirmPassword'];
		$email = $_POST['inputEmail'];
		$contact = $_POST['inputNumber'];
		
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn, 'HPY_205CDE');
		$checkName_query = mysqli_query($conn, 'SELECT name FROM users WHERE name = "'.$name.'"');
		$checkUsername_query = mysqli_query($conn, 'SELECT user_name FROM users WHERE user_name = "'.$username.'"');
		$checkRegister_query = mysqli_query($conn, 'SELECT user_name, user_password, email, number FROM users WHERE user_name = "'.$username.'"');
		$update_query = 'UPDATE users SET user_name = "'.$username.'", user_password = "'.$pwrd.'", email = "'.$email.'", number = "'.$contact.'" WHERE name = "'.$name.'"';
		
		if (mysqli_num_rows($checkName_query) < 1) {
			echo '<script type="text/javascript">alert("Student name is incorrect or does not exist");</script>';
		}
		else {
			if (mysqli_num_rows($checkRegister_query) > 0) {
				echo '<script type="text/javascript">alert("Error: Account already been registered");</script>';
			}
			else {
				if (mysqli_num_rows($checkUsername_query) > 0) {
					echo '<script type="text/javascript">alert("Error: Username has been used");</script>';
				}
				else {
					if (strlen($username) < 8) {
						echo '<script type="text/javascript">alert("Error: Username must be more than 8 characters");</script>';
					}
					else {
						if (strlen($pwrd) < 8) {
							echo '<script type="text/javascript">alert("Error: Password must be more than 8 characters");</script>';
						}
						else {
							if ($pwrd != $conpwrd) {
								echo '<script type="text/javascript">alert("Error: Password and confirm password do not match");</script>';
							}
							else {
								if (!is_numeric($contact)) {
									echo '<script type="text/javascript">alert("Error: Contact number must be numeric");</script>';
								}
								else {
									if (strlen($contact) < 10 OR strlen($contact) > 11) {
										echo '<script type="text/javascript">alert("Error: Contact number must be 10 or 11 numbers");</script>';
									}
									else {
										if (mysqli_query($conn, $update_query)) {
											echo '<script type="text/javascript">alert("Account registered successfully, you may proceed to log in now");</script>';
											echo '<script>location.href="login.php"</script>';
										}
									}
								}
							}
						}
					}
				}
			}
		}
		mysqli_close($conn);
	}
?>

<div id="menu">
	<a href="index.php">HOME</a>
	<a href="login.php">LOG IN</a>
</div>

<div class="content">
	<h2>REGISTRATION</h2>
	<form action="register.php" method="post">
	
	<div class="form-group row">
			<div class="col-2">
				<label for="lblName" class="col-sm-2 col-form-label">Name</label>
			</div>
			<div class="col">
				<input type="text" class="form-control" name="inputStdName" placeholder="Student name" value="<?php if (isset($_POST['inputStdName'])) { echo htmlspecialchars($_POST['inputStdName']); } ?>" required />
			</div>
	</div>
	
	<div class="form-group row">
			<div class="col-2">
				<label for="lblUsername" class="col-sm-2 col-form-label">Username</label>
			</div>
			<div class="col">
				<input type="text" class="form-control" name="inputUsername" placeholder="Username" value="<?php if (isset($_POST['inputUsername'])) { echo htmlspecialchars($_POST['inputUsername']); } ?>" required />
			</div>
	</div>
	
	<div class="form-group row">
			<div class="col-2">
				<label for="lblPassword" class="col-sm-2 col-form-label">Password</label>
			</div>
			<div class="col">
				<input type="password" class="form-control" name="inputPassword" placeholder="Password" required />
			</div>
	</div>
	
	<div class="form-group row">
			<div class="col-2">
				<label for="lblConfirmPassword" class="col-sm-2 col-form-label">Confirm password</label>
			</div>
			<div class="col">
				<input type="password" class="form-control" name="inputConfirmPassword" placeholder="Confirm Password" required />
			</div>
	</div>
	
	<div class="form-group row">
			<div class="col-2">
				<label for="lblEmail" class="col-sm-2 col-form-label">Email</label>
			</div>
			<div class="col">
				<input type="email" class="form-control" name="inputEmail" placeholder="Email" value="<?php if (isset($_POST['inputEmail'])) { echo htmlspecialchars($_POST['inputEmail']); } ?>" required />
			</div>
	</div>
	
	<div class="form-group row">
			<div class="col-2">
				<label for="lblNumber" class="col-sm-2 col-form-label">Contact Number</label>
			</div>
			<div class="col">
				<input type="text" class="form-control" name="inputNumber" placeholder="Contact Number" value="<?php if (isset($_POST['inputNumber'])) { echo htmlspecialchars($_POST['inputNumber']); } ?>" required />
			</div>
	</div>
		
		<div class="form-group row">
			<div class="col-10">
			</div>
			<div class="col">
				<button type="submit" class="btn btn-primary">Register</button>
				<input type="hidden" name="submitted" value="true" />
			</div>
		</div>
	</form>
</div>

<?php
	require('footer.html');
?>