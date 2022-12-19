<?php 

	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);
	$USER=$user_data;
	if (isset($_GET['find'])) {
		$find=addslashes($_GET['find']);
		$sql="select * from users where prenom like '%$find%' || nom like '%$find%' limit 30 ";
		$DB=new Database();
		$DB->read($sql);
		$results=$DB->read($sql);

	}


	

	
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Search for friends | Users</title>
    <link rel="icon" href="images/Capture.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">


    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/main.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</head>
<body>
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





								<div class="central-meta">


									<div class="new-postbox">
										
										<div class="newpst-input">

											

										<h4 class="widget-title">The users found :</h4>

										<ul class="followers">

											<?php


											$image_class= new Image();

											$User=new User();

											 

											if (is_array($results)) {
												foreach ($results as $row) {

													$FRIEND_ROW=$User->get_user($row['IdUser']);

													include 'user.php';

													echo "<br>";
													



												}
											}else {
												echo "No results were found";
											}



											?>


										</ul>



											
										</div>
									</div>
								</div><!-- add post new box -->





								






									




								</aside>
							</div><!-- sidebar -->
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