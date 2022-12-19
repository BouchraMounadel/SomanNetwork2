<?php
session_start();
	include 'classes/connect.php';
	include 'classes/signin.php';

	

	$email = "";
	$password = "";


	


	if ($_SERVER['REQUEST_METHOD']=='POST') {


		$signin=new Signin();
		$result=$signin->evaluate($_POST);



		if ($result != "") {



			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo $result;

		}
		else {
			header("Location: profil.php");
			die;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];

		

		
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="" />
    <meta name="keywords" content="" />
	
    <link rel="icon" href="images/CAPTURE.png" type="image/png" sizes="16x16"> 
    <title>LoginPage</title>
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

    
	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

</head>

<body>


	<div class="theme-layout">
	<div class="container-fluid pdng0">
		<div class="row merged">




			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="land-featurearea">
					<div class="land-meta">
						<h1>SomanNetwork</h1>
						<p>
							Soyez plus connectés à votre école.
						</p>
						<div class="friend-logo">
							<span><img src="images/wink.png" alt=""></span>
						</div>
					</div>	
				</div>
			</div>





			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-reg-bg">


					<div class="log-reg-area sign">
						<h2 class="log-title">Login</h2>
							
						<form method="post">


							<div class="form-group">	
							  <input name="email" type="text" id="input" required="required"/>
							  <label class="control-label" value="email" for="input">Email</label><i class="mtrl-select"></i>
							</div>


							<div class="form-group">	
							  <input name="password" value="password" type="password" required="required"/>
							  <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
							</div>

							<div class="checkbox">
							  <label>
								<input type="checkbox" checked="checked"/><i class="check-box"></i>Always Remember Me.
							  </label>
							</div>
							<a href="#" title="" class="forgot-pwd">Forgot Password?</a>

							<div class="submit-btns">

								<button class="mtr-btn "  type="submit" ><span>Login</span></button>

								 <a href="register.php"> <button  class="mtr-btn " type="button"><span >Register</span></button></a>
							</div>
						</form>
					</div>
	



</body>
</html>