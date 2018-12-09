<?php
	define('TITLE', 'Log out');
	require('header.html');
	include('config.php');
	
	session_start();
	if (!isset($_SESSION['username'])) {
		echo '<script>location.href="login.php"</script>';
	}
?>

<div id="menu">
	<a href="index.php">HOME</a>
	<a href="login.php">LOG IN</a>
</div>

<div class="content">
	<?php
		unset($_SESSION);
		session_destroy();
	?>
	<p>Thank you, you have logged out successfully.</p>
</div>

<?php
	require('footer.html');
?>