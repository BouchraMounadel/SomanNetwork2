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
											<div class="newpst-input">


												<form method="post" enctype="multipart/form-data">

													<textarea name="post" rows="2" placeholder="write something"></textarea>

													<div class="attachments">
														<ul>
															<li>
																<a href="data_geolocation.php">
																<i class="ti-share"></i></a>

															</li>
															
															<li>
																<i class="fa fa-image"></i>
																<label class="fileContainer">
																	<input type="file" name="file">
																</label>
															</li>
									
															<li>
																<button type="submit">Publish</button>
															</li>
														</ul>
													</div>
												</form>







											</div>


										</div>
									</div>





								







								<div class="central-meta item">
									<div class="user-post">

										<?php 
										$page_number=isset($_GET['page'])? (int)$_GET['page'] : 1;
										$page_number=($page_number<1)? 1 : $page_number;

										
										
										
										$limit=10;
										$offset=($page_number-1)*$limit;



										$DB= new Database();
										$user_class=new User();
										$image_class= new Image();
										$followers=$user_class->get_following($_SESSION['SomanNetwork_IdUser'],"user");
										$follower_ids=false;

										if (is_array($followers)) {
											$follower_ids = array_column($followers, "IdUser");
											$follower_ids=implode("','", $follower_ids);
										}

										if ($follower_ids) {

											$myuserid= $_SESSION['SomanNetwork_IdUser'];
											$sql = "select * from posts where parent = 0 and IdUser= '$myuserid' || parent = 0 and IdUser in('" . $follower_ids . "') order by id desc limit $limit offset $offset";

											
											$posts=$DB->read($sql);

										}else {
											$myuserid= $_SESSION['SomanNetwork_IdUser'];
											$sql = "select * from posts where parent = 0 and IdUser= '$myuserid'  order by id desc limit $limit offset $offset";
											$posts=$DB->read($sql);
										}

										



											if ($posts) {
												foreach ($posts as $ROW) {

													$user=new User();
													$ROW_USER= $user->get_user($ROW['IdUser']);

													include 'post.php';
													
												}
											}
											//get current URL
										$pg=pagination_link();

?>
<a href="<?php echo($pg['previous_page']) ?>">
<button type="button" style="float: left; width: 150px; cursor: pointer;" >Previous page</button></a>
<a href="<?php  echo($pg['next_page'])  ?>">
<button type="button" style="float: right; width: 150px; cursor: pointer; ">Next page</button></a>
										
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