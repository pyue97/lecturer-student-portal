<?php
	session_start();
	define('TITLE', 'Admin Panel');
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
	<h2>FUNCTIONS</h2>
	<ul style="list-style-type:none">
		<li><a href="addstudent.php"><i class="fas fa-plus-circle" style="color:#8D9DB6"></i>&nbsp&nbsp&nbsp Add student</a></li><br />
		<li><a href="viewstudent.php"><i class="far fa-address-card" style="color:#8D9DB6"></i></i>&nbsp&nbsp&nbsp View student record</a></li><br />
		<li><a href="addgrade.php"><i class="fa fa-award" style="color:#8D9DB6"></i>&nbsp&nbsp&nbsp Add grade</a></li><br />
		<li><a href="editgrade.php"><i class="fas fa-user-edit" style="color:#8D9DB6"></i>&nbsp&nbsp&nbsp Edit grade</a></li><br />
	</ul>
</div>

<?php
	require('footer.html');
?>