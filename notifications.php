<?php 

	

	include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);
	$USER=$user_data;

	if(isset($_GET['id']) && is_numeric($_GET['id'])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($_GET['id']);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}
 	$User=new User();
	$post=new Post();
	$image_class= new Image();




	
		


	
	



 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Network | Notifications</title>
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
	<div class="editing-interest">
		<h5 class="f-title"><i class="ti-bell"></i>All Notifications </h5>

				<?php 

		$DB = new Database();
		$id = esc($_SESSION['SomanNetwork_IdUser']);
		$follow=array();

		//check content i follow
		$sql = "select * from content_i_follow where disabled = 0 && IdUser = '$id' limit 100";
		$i_follow = $DB->read($sql);
		if(is_array($i_follow)){
			$follow = array_column($i_follow, "contentid");
		}

		if(count($follow) > 0){

$str = "'" . implode("','", $follow) . "'";
$query = "select * from notifications where (IdUser != '$id' && content_owner = '$id') || (contentid in ($str)) order by id desc limit 30";
}else{

$query = "select * from notifications where IdUser != '$id' && content_owner = '$id' order by id desc limit 30";
}
 
		
		




		

		$data = $DB->read($query);?>

		<div class="notification-box">
					<ul>
						<?php if(is_array($data)): ?>

							<?php foreach ($data as $notif_row): 

								include("single_notification.php");

							endforeach;?>
					<?php else:?>
					
					    No notifications are availibale for the moment !	
					<?php endif;?>
					
					</ul>
				</div>
			</div>
		</div>	
	</div><!-- centerl meta -->



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




















































	
	

