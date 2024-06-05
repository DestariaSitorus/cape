<?php 

	session_start();

	require 'function.php';

	if(isset($_SESSION["login"])){
		header("Location: index.php");
		exit;
	}

	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$password = $_POST["password"];

		$query = "SELECT * FROM login WHERE username = '$username'";

		$result = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($result);

		if(mysqli_num_rows($result) === 1){
			if($row["password"] == $password){
				$_SESSION["login"] = true;

				if($row["role"] == "admin"){
					$_SESSION["admin"] = true;
					$_SESSION["username"] = $username;
					$_SESSION["role"] = "Admin";

					header("Location: index.php");
					exit;
				}
				else if($row["role"] == "petugas"){
					$_SESSION["petugas"] = true;
					$_SESSION["username"] = $username;
					$_SESSION["role"] = "Petugas";

					header("Location: index.php");
					exit;
				}
			} else {
				echo "
					<script>
						alert('Password Anda Salah!!!');
						document.location.href = 'login.php';
					</script>
				";
			}
		} else {
			echo "
					<script>
						alert('Username Salah!');
						document.location.href = 'login.php';
					</script>
				";
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
 <title>Login</title>
 <link rel="stylesheet" type="text/css" href="loginStyles.css">
</head>
<body>

	<div class="kotak_login">

		<p class="tulisan_login">Silahkan login</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<label>Username</label>
			<input type="text" class="form_login" name="username" placeholder="Username .." required autofocus>

			<label>Password</label>
			<input type="password" class="form_login" name="password" placeholder="Password .." required autofocus>
			
			<button type="submit" name="submit" class="tombol_login">Login</button>
			
			<br>
		

		</form>
	
	</div>

</body>
</html>