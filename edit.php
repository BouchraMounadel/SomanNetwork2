<?php 

	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);
	$USER=$user_data;
	$ERROR="";
	$post=new Post();

	if (isset($_GET['id'])) {
		

			
			$ROW=$post->get_one_post($_GET['id']);

			if(!$ROW) {
				$ERROR="No such post was found";
			}else {
				if ($ROW['IdUser']!= $_SESSION['SomanNetwork_IdUser']) {
					$ERROR="Access denied! You can't delete this file!";
				}
			}

	}else {

		$ERROR="No such post was found";
		


	}

	//if sth was posted

	if ($_SERVER['REQUEST_METHOD']=="POST") {

		$post->edit_post($_POST,$_FILES);


		if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'],"edit.php")) {
		$_SESSION['return_to']=$_SERVER['HTTP_REFERER'];
		}else {
		$_SESSION['return_to']="profil.php";
		}

		header("Location: ".$_SESSION['return_to']);
		die;
	} 
	



 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Edit | Posts</title>
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



											<form method="post" enctype="multipart/form-data">

												<?php if ($ERROR!="") {echo $ERROR; }
												
												

												else {
													echo "<br>";
												echo "<h2> Edit Post</h2>";
												echo "<br>";
												echo "<hr>";

												echo "Edit the post";

												echo'<textarea name="post" rows="2" placeholder="write something">'
												. $ROW['post'] .


												'</textarea>';

													echo '<div class="attachments">
														<ul>
															
															<li>

																<i class="fa fa-image"></i>
																<label class="fileContainer">
																	<input type="file" name="file">
																</label>
															</li>
									
															
														</ul>
													</div>';
												

												
												
												

		 										echo "<input type='hidden' name='postid' value='$ROW[postid]' >";

		 										echo "<input type='submit'  value='Save'>";

		 										echo "<br>";
												} ?>


												<?php 

												if (file_exists($ROW['image'])) {

													//$post_image=$image_class->get_thumb_post($ROW['image']);

													$post_image=$ROW['image'];

													echo "<br>";
													echo "<div style='text-align:center;'> <img src='$post_image' width='60%' /> </div>" ;
													echo "<hr>";
												}
												?>


												
														
												
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

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="widget">
						<div class="foot-logo">
							<div class="logo">
								<a href="index-2.html" title=""><img src="images/logo.png" alt=""></a>
							</div>	
							<p>
								The trio took this simple idea and built it into the world’s leading carpooling platform.
							</p>
						</div>
						<ul class="location">
							<li>
								<i class="ti-map-alt"></i>
								<p>33 new montgomery st.750 san francisco, CA USA 94105.</p>
							</li>
							<li>
								<i class="ti-mobile"></i>
								<p>+1-56-346 345</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					
				</div>
				<div class="col-lg-2 col-md-4">
					
				</div>
				
				<div class="col-lg-2 col-md-4">
					<div class="widget">
						<div class="widget-title"><h4>download apps</h4></div>
						<ul class="colla-apps">
							<li><a href="https://play.google.com/store?hl=en" title=""><i class="fa fa-android"></i>android</a></li>
							<li><a href="https://www.apple.com/lae/ios/app-store/" title=""><i class="ti-apple"></i>iPhone</a></li>
							<li><a href="https://www.microsoft.com/store/apps" title=""><i class="fa fa-windows"></i>Windows</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- footer -->
	<div class="bottombar">
		<div class="container">
			<div class="row">
				
			</div>
		</div>
	</div>
</div>
	
	
	

</body>	

</html>