<?php 

	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);
	$USER=$user_data;

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
			header("Location:single_post.php?id=$_GET[id]");
			die;
		}
		else {


			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo $result;
			
		}
			
		


		

	}


	$ERROR="";
	$post=new Post();
	$ROW=false;

	if (isset($_GET['id'])){



		$ROW=$post->get_one_post($_GET['id']);

		

			
			

	}else {

		$ERROR="No post was found";
		


	}

	
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Comments | Posts</title>
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

											

										<h4 class="widget-title">Current comments on the post</h4>

										

											<?php

											//check if this is from a notification
											if (isset($_GET['notif'])) {
												notification_seen($_GET['notif']);
											}
											


											$image_class= new Image();

											$User=new User();

											 

											if (is_array($ROW)) {
												$user=new User();
												$ROW_USER= $user->get_user($ROW['IdUser']);
												if ($ROW['parent']==0) {
													include 'post.php';
												}else {
													$COMMENT=$ROW;
													include 'commentTest.php';
												}
												
												
											}



											?>
											<div class="coment-area">
											<ul class="we-comet">



												<?php  
															$comments=$post->get_comments($ROW['postid']);

																	if (is_array($comments)) {
																		 	foreach ($comments as  $COMMENT) {
																		 		$user=new User();
																				$ROW_USER= $user->get_user($COMMENT['IdUser']);
																		 		include 'commentTest.php';
																		 	}
																		 }
										 //get current URL
										$pg=pagination_link(); 

												?>
												<?php if ($ROW['parent']==0):?>
												
												<a href="<?php echo($pg['previous_page']) ?>">
												<button type="button" style="float: left; width: 150px; cursor: pointer;" >Previous page</button></a>
												<a href="<?php  echo($pg['next_page'])  ?>">
												<button type="button" style="float: right; width: 150px; cursor: pointer; ">Next page</button></a>
												<br><br>
											<?php endif;?>







												




											<li class="post-comment">
								<div class="comet-avatar">
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
                            <?php if ($ROW['parent']==0):?>

                            <img src="<?php echo $image?>" alt="">
								</div>
								<div class="post-comt-box">

									<form method="post" enctype="multipart/form-data" >
										<textarea name="post" placeholder="Post your comment"></textarea>
										<input type="file" name="file">
										<input type="hidden" name="parent" value="<?php echo $ROW['postid'] ?>">
										
										<input type="submit" value="Post">
									</form>	


								</div>
							<?php else:?>
							<a href="single_post.php?id=<?php echo($ROW['parent'])?>">	
							<input type="button" value="Back to the main post">	
							</a>
							<?php endif;?>

							</li>

							





							
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