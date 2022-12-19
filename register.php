<?php

	include 'classes/connect.php';
	include 'classes/signup.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {


		$signup=new Signup();
		$result=$signup->evaluate($_POST);



		if ($result != "") {



			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo $result;

		}
		else {
			header("Location: login.php");
			die;
		}

		

		
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
    <title>RegisterPage</title>
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
						<h2 class="log-title">Register</h2>
							
						<form method="post" action="register.php">

<!------------------------------Les renseignements à remplir pour s'inscrire---------------------->

							<div class="form-group">	
							  <input name="first_name" type="text" required="required"/>
							  <label class="control-label" for="input">First Name</label><i class="mtrl-select"></i>
							</div>



							<div class="form-group">	
							  <input  name="last_name" type="text" required="required"/>
							  <label class="control-label" for="input">Last Name</label><i class="mtrl-select"></i>
							</div>




							<div class="form-radio">
							  <div class="radio">
								<label>
								  <input type="radio" name="sexe" value="masculin" checked="checked"/><i class="check-box"></i>Male
								</label>
							  </div>
							  <div class="radio">
								<label>
								  <input type="radio" name="sexe" value="Feminin" /><i class="check-box"></i>Female
								</label>
							  </div>
							</div>




							<div class="form-group">	
							  <input name="email" type="text" required="required"/>
							  <label class="control-label" for="input">[email]</label><i class="mtrl-select"></i>
							</div>




							<div class="form-group">	
							  <input name="password" type="password" required="required"/>
							  <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
							</div>

							<div class="form-group">	
							  <input name="password2" type="password" required="required"/>
							  <label class="control-label" for="input">Retype password</label><i class="mtrl-select"></i>
							</div>









							<div class="form-group">	
							  <input name="school" type="text" required="required"/>
							  <label class="control-label" for="input">School's name</label><i class="mtrl-select"></i>
							</div>




							




							




							<a href="login.php" title="" class="already">Already have an account</a>


							<div class="submit-btns">
								<button class="mtr-btn" type="submit"><span>Register</span></button>
							</div>
						</form>




			</div>	
		</div>
	</div>
</div>
</div>
</body>

</html>