<?php
	$conn = mysqli_connect('localhost','root','');
	mysqli_query($conn, 'CREATE DATABASE HPY_205CDE');
	mysqli_select_db($conn, 'HPY_205CDE');
	
	$query = 'CREATE TABLE users(
		        user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				user_name VARCHAR(20),
				user_password VARCHAR(20),
		        name VARCHAR(100) NOT NULL,
		        email TEXT,
		        number INT(10),
				user_type VARCHAR(10) NOT NULL)';
	$query4 = 'CREATE TABLE grades(
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		        subject_name VARCHAR(50) NOT NULL,
				student_name VARCHAR(100) NOT NULL,
				score INT(3) NOT NULL)';
			
	$query2 = 'SELECT user_id FROM users WHERE user_id = 1';
	$query3 = 'INSERT INTO users (user_name, user_password, name, user_type) VALUES ("admin", "admin", "Admin", "Admin")';
	
	mysqli_query($conn, $query);
	mysqli_query($conn, $query4);
	$checkAdmin = mysqli_query($conn, $query2);
	
	if(mysqli_num_rows($checkAdmin) == 0) {
		mysqli_query($conn, $query3);
	}
	mysqli_close($conn);
?>