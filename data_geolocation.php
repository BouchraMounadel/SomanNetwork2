<?php 

	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);
	$USER = $user_data;

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$profile = new Profile();
	$profile_data=$profile->get_profile($_GET['id']);

	if (is_array($profile_data)) {

		$user_data=$profile_data[0];
	}
}


	//posting starts here
if ($_SERVER['REQUEST_METHOD'] == "POST") {


		$post=new Post();

		$IdUser=$_SESSION['SomanNetwork_IdUser'];

		$result=$post->create_post($_POST,$IdUser,$_FILES);
		
		if ($result=="") {
			header("Location:index.php");
			die;
		}
		else {


			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo $result;
			
		}

	}




 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Acceuil</title>
    <link rel="icon" href="images/Capture.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</head>
<body onload="getLocation();">
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	
	
	<?php include 'header.php'; ?>


	<!--------------------------------------- topbar is up--------------------- -->
















		
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">




<!--------------------------------------- sidebar is down ------------------------------------->

							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget">
										<h4 class="widget-title">Shortcuts</h4>
										<ul class="naves">
											<li>
												<i class="ti-clipboard"></i>
												<a href="index.php" title="">News feed</a>
											</li>
											<li>
												<i class="ti-bell"></i>
												<a href="notifications.php" title="">Notifications</a>
											</li>
											<li>
												<i class="ti-files"></i>
												<a href="profil.php" title="">My profil</a>
											</li>
											<li>
												<i class="ti-power-off"></i>
												<a href="logout.php" title="">Logout</a>
											</li>
											<li>
												<i class="ti-user"></i>
												<a href="404.html" title="">friends</a>
											</li>
											<li>
												<i class="ti-image"></i>
												<a href="404.html" title="">images</a>
											</li>
											<li>
												<i class="ti-video-camera"></i>
												<a href="404.html" title="">videos</a>
											</li>
											<li>
												<i class="ti-comments-smiley"></i>
												<a href="404.html" title="">Messages</a>
											</li>
											
											<li>
												<i class="ti-share"></i>
												<a href="404.html" title="">People Nearby</a>
											</li>
											
										</ul>
									</div>






									





									
								</aside>
							</div>
							<!------------------------------------- sidebar is up ---------------------------------->





							<div class="col-lg-6">





								<div class="central-meta item">
										<div class="new-postbox">
											<figure>

							<?php 
								$image=" " ;

								if ( file_exists($USER['profile_image']) ) {


									$image=$image_class->get_thumb_profile($USER['profile_image']) ;

								}

								elseif ($USER['sexe'] == "masculin") {

									$image="images/user_male.jpg";
									


								} else {

									$image="images/user_female.jpg";
									
								}
								




							?>


							<img src="<?php echo $image?>" alt="">
						</figure>
											


												<form class="myForm" method="post" enctype="multipart/form-data" autocomplete="off">

													<h5 style="text-align: center;" >To share your current position click "Publish": </h5> <br> <br>
													<textarea name="post" rows="2" placeholder="write something"></textarea>
													<input type="hidden" name="latitude">
													<input type="hidden" name="longitude">
													<div class="attachments">
														<ul>
															
															
															<li>
																<button type="submit" style="text-align: center; float:right; size: 120 px; ">Publish</button>
															</li>
														</ul>
													</div>
												</form>

												<script type="text/javascript">
													
													function getLocation() {
														if (navigator.geolocation) {
															 navigator.geolocation.getCurrentPosition(showPosition,showError);
														}
													}
													function showPosition(position) {
														document.querySelector(' .myForm input[name = "latitude"]').value = position.coords.latitude;
														document.querySelector(' .myForm input[name = "longitude"]').value = position.coords.longitude;
													}

													function showError(error) {
														switch(error.code){
															case error.PERMISSION_DENIED:
															alert("You must allow the request for geolocation to fill out the form " );
															location.reload();
															break;

														}

													}

												</script>







											


										</div>
									</div>





								







								





								</aside>
							</div> 
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

	
	<div class="bottombar">
		<div class="container">
			<div class="row">
				
			</div>
		</div>
	</div>
</div>
	
	
	

</body>	

</html>