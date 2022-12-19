<?php
	


	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$_SESSION['SomanNetwork_IdUser']=isset($_SESSION['SomanNetwork_IdUser']) ? $_SESSION['SomanNetwork_IdUser'] : 0;

	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser'],false);

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

		if (isset($_POST['prenom'])) {
			$settings_class= new Settings();
			$settings_class->save_settings($_POST,$_SESSION['SomanNetwork_IdUser']);
		}else {


			$post=new Post();

		$IdUser=$_SESSION['SomanNetwork_IdUser'];

		$result=$post->create_post($_POST,$IdUser,$_FILES);
		
		if ($result=="") {
			header("Location:profil.php");
			die;
		}
		else {


			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo $result;
			
		}
			
		}


		

	}


	//collect posts


		$post=new Post();
		

		$IdUser=$user_data['IdUser'];

		$posts=$post->get_posts($IdUser);



	//collect friends

		$user=new User();

		

		$friends=$user->get_following($user_data['IdUser'],"user");

		$image_class = new Image();

		//check if this is from a notification
		if (isset($_GET['notif'])) {
			notification_seen($_GET['notif']);
		}







  ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>ProfilPage</title>
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
	
	








<!----------------------------------------------------- topbar -------------------------------------------------------------------->

	
	<?php include 'header.php'; ?>


	<!--------------------------------------------- topbar ----------------------------------------->	




		
	<section>
		<div class="feature-photo">

			<figure>	

				<?php 
					$image="images/placeholdercoverimage.jpg";
					if (file_exists($user_data['cover_image'])) {
						$image =$image_class->get_thumb_cover($user_data['cover_image']) ;
					} ?>

					<img src="<?php echo $image;?>" alt=""></figure>

			<div class="add-btn">

				<?php $mylikes="";
				if ($user_data['likes'] > 0) {

					$mylikes= $user_data['likes'];
					
				}



				 ?>
				<span> <?php echo "$mylikes"; ?> Followers</span>




				<a href="like.php?type=user&id=<?php echo($user_data['IdUser']) ?>" title="" data-ripple="">
				<input type="button" value="Follow" name="" style="background-color:#088dcd; border-color:#088dcd;  "></a>

				<?php if ($user_data['IdUser'] == $_SESSION['SomanNetwork_IdUser']): ?>
				<a href="messages.php" title="" data-ripple="" >
				<input type="button" value="Messages" name="" style="background-color:#088dcd; border-color:#088dcd;  "></a>
				<?php else: ?>
				<a href="messages.php?type=new&id=<?php echo($user_data['IdUser']) ?>" title="" data-ripple="" >
				<input type="button" value="Message" name="" style="background-color:#088dcd; border-color:#088dcd;  "></a>
				<?php endif;?>


			</div>

			<?php if (i_own_content($user_data)):?>
			<form class="edit-phto" method="post" action="change_profile_image.php?change=cover" enctype="multipart/form-data">
				<i class="fa fa-camera-retro"></i>
				<label class="fileContainer">

					Edit Cover Photo
				<input type="file" name="file" />
				</label>
				<input type="submit" value="Change" name="">
			</form>
			<?php endif;?>






			<div class="container-fluid">
				<div class="row merged">


					<div class="col-lg-2 col-sm-3">
						<div class="user-avatar">
							<figure>

								<?php 


								
								$image= "images/user_female.jpg";
								if ($user_data['sexe']== "masculin") {
									$image= "images/user_male.jpg";
								}



								if (file_exists($user_data['profile_image'])) {
									$image =$image_class->get_thumb_profile($user_data['profile_image']) ;
								} 
								
								?>
								<img src="<?php echo $image;?>" alt="">

								<?php if (i_own_content($user_data)):?>
								<form class="edit-phto" method="post" action="change_profile_image.php?change=profile" enctype="multipart/form-data">


									<i class="fa fa-camera-retro"></i>
									<label class="fileContainer">
										Edit Display Photo
										<input type="file" name="file" />

									</label>
									<input type="submit" value="Change" name="">
								</form>

								<?php endif;?>
							</figure>
						</div>
					</div>


					<div class="col-lg-10 col-sm-9">
						<div class="timeline-info">
							<ul>
								<li class="admin-name">
								  
								  	<a href="profil.php?section=default&id=<?php echo($user_data['IdUser'])?>" >

								  		<h5>
								  	<?php echo $user_data['prenom'] . " " . $user_data['nom']; ?> </h5>
								  		

								  	</a>
								  	
								 
								  
								</li>
								<li>
									<a class="" href="profil.php?section=default&id=<?php echo($user_data['IdUser'])?>" >time line</a>
									<a class="" href="profil.php?section=about&id=<?php echo($user_data['IdUser'])?>" >about</a>
									<a class="" href="profil.php?section=photos&id=<?php echo($user_data['IdUser'])?>" >Photos</a>
									<a class="" href="profil.php?section=following&id=<?php echo($user_data['IdUser'])?>">Following</a>
									<a class="" href="profil.php?section=followers&id=<?php echo($user_data['IdUser'])?>" >Followers</a>
									<a class="" href="profil.php?section=groups" title="" data-ripple="">Groups</a>
									


									
									<?php 
									if ($user_data['IdUser']==$_SESSION['SomanNetwork_IdUser']) {
										echo'<a href="profil.php?section=settings&id=' . $user_data['IdUser'] . '"> Settings</a>';
									}
									?>

								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--------------------------------------------------------------------- top area ------------------------------------------------------------->
		
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">



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
									<!-------------------------------------------------------------------- Shortcuts --------------------------------------->





									<?php 

									$section="default";

									if (isset($_GET['section'])) {
										$section = $_GET['section'];
									}
									if ($section=="default") {
										include 'profile_content_default.php';
									}elseif ($section=="photos") {
										include 'profile_content_photos.php';
									}elseif ($section=="about") {
										include 'profile_content_about.php';
									}elseif ($section=="following") {
										include 'profile_content_following.php';
									}elseif ($section=="followers") {
										include 'profile_content_followers.php';
									}elseif ($section=="settings") {
										include 'profile_content_settings.php';
									}
									 ?>








<!-- ---------------------------------------------------footer-------------------- ------------------------------->
	




	<!-- ---------------------------------------------------footer-------------------- ------------------------------->
	


</div>
		
	
	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

</body>	

</html>