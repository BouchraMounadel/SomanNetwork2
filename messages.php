<?php 

	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);
	$USER=$user_data;
	$ERROR="";
	$post=new Post();

	if(isset($_GET['id']) && is_numeric($_GET['id'])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($_GET['id']);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}




		


	//if a message was posted

	if ($ERROR=="" && $_SERVER['REQUEST_METHOD']=="POST") {
		print_r($_POST);
		print_r($_FILES);
		$msg_class=new Messages();
		$msg_class->send($_POST,$_FILES);
		
		//header("Location: ".$_SESSION['return_to']);
		//die;
	
	} 
	



 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Messages | SomaNetwork</title>
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



											<form method="post" enctype="multipart/form-data" >

												<?php if ($ERROR!="") {echo $ERROR; }
						
												else {

													echo "<br>";
												if (isset($_GET['type'])) {
														$type = $_GET['type'];
													}	
												
												if (isset($type) && $type=="new") {
													echo "<h3> Start New Message with </h3>";
													if (isset($_GET['id']) && is_numeric($_GET['id'])) {
														?>
														<div class="newpst-input">
														<ul class="followers">
															
														<?php 
														$image_class= new Image();
														$user= new User();
														$FRIEND_ROW=$user->get_user($_GET['id']);
														include 'user.php';?>
														
														</ul>
														</div>
														<div class="newpst-input">


												

													<textarea name="message" rows="2" placeholder="write a new message"></textarea>

													<div class="attachments">
														<ul>
															<li>
																<a href="data_geolocation.php">
																<i class="ti-share"></i></a>

															</li>
															
															<li>
																<i class="fa fa-image"></i>
																<label class="fileContainer">
																	<input type="file" name="file" >
																</label>
															</li>

									
															<li> <button type="submit">Send</button> </li> </ul> </div>
</form>







											</div>
											<?php 

														

													}else {
														echo "That user could not be found";
													}
													
												}else
												 {
												echo "<h2>  Messages </h2>";
												$user= new User();
												$ROW_USER=$user->get_user($ROW['IdUser']);
												include 'message.php';
												
												echo "<hr>";
												

		 										echo "<input type='hidden' name='postid' value='$ROW[postid]' >";

		 										echo "<input type='submit'  value='Delete' >";}
												} 
												echo "<br>";
												echo "<hr>";?>
												
												
												
												

												

												
												
												
														
												
											</form>
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