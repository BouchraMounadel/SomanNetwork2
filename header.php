<?php 


$corner_image = "images/user_male.jpg";
	if(isset($USER)){
		
		if(file_exists($USER['profile_image']))
		{
			$image_class = new Image();
			$corner_image = $image_class->get_thumb_profile($USER['profile_image']);
		}else{

			if($USER['sexe'] == "Feminin"){

				$corner_image = "images/user_female.jpg";
			}
		}
	}

	

?>	
	
	
	
<div class="topbar stick">
		<div class="logo">
			<a title="" href="index.php"><img src="images/logos.png" alt=""></a>
		</div>
		
		<div class="top-area">
			<ul class="main-menu">
				<li>
					<a href="index.php" title="">Home</a>
					
				</li>
				<li>
					<a href="#" title="">My infos</a>
					<ul>
						<li><a href="profil.php" title="">profil</a></li>
						
						<li><a href="404.html" title="">people nearby</a></li>
					</ul>
				</li>
				
				
			</ul>
			

			<ul class="setting-area">

				<li>
					<a href="index.php" title="search" data-ripple=""><i class="ti-search"></i></a>
					<div class="searched">
						<form method="get" action="search.php" class="form-search">
							<input name="find" type="text" placeholder="Search Friend">
							
						</form>
					</div>
				</li>
				
				<a href="index.php" style="margin: 5px;" title="Home" data-ripple=""><i class="ti-home"></i></a>
				&nbsp;
				
					<a href="notifications.php" title="Notification" data-ripple="">
						<i class="ti-bell"></i>

						<?php 
						$notif=check_notifications();
						 ?>
						 <?php if ($notif>0) : ?>
						 	<span style="width:25px;font-size:12px; color:#088dcd; margin-top: 10px; " ><?= $notif; ?></span> <?php endif;?>
						
					</a>
				&nbsp;&nbsp;
				
				<li>
					<a href="#" title="Messages" data-ripple=""><i class="ti-comment"></i><span>12</span></a>
					<div class="dropdowns">
						<span>5 New Messages</span>
						<ul class="drops-menu">
							<li>
								<a href="notifications.html" title="">
									<img src="images/resources/thumb-1.jpg" alt="">
									<div class="mesg-meta">
										<h6>sarah Loren</h6>
										<span>Hi, how r u dear ...?</span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag green">New</span>
							</li>
							<li>
								<a href="notifications.html" title="">
									<img src="images/resources/thumb-2.jpg" alt="">
									<div class="mesg-meta">
										<h6>Jhon doe</h6>
										<span>Hi, how r u dear ...?</span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag red">Reply</span>
							</li>
							<li>
								<a href="notifications.html" title="">
									<img src="images/resources/thumb-3.jpg" alt="">
									<div class="mesg-meta">
										<h6>Andrew</h6>
										<span>Hi, how r u dear ...?</span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag blue">Unseen</span>
							</li>
							<li>
								<a href="notifications.html" title="">
									<img src="images/resources/thumb-4.jpg" alt="">
									<div class="mesg-meta">
										<h6>Tom cruse</h6>
										<span>Hi, how r u dear ...?</span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag">New</span>
							</li>
							<li>
								<a href="notifications.html" title="">
									<img src="images/resources/thumb-5.jpg" alt="">
									<div class="mesg-meta">
										<h6>Amy</h6>
										<span>Hi, how r u dear ...?</span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag">New</span>
							</li>
						</ul>
						<a href="messages.html" title="" class="more-mesg">view more</a>
					</div>
				</li>
				
			</ul>


			<?php if (isset($USER)) :?>
				<a href="profil.php"><img src="<?php echo($corner_image)?>" style="width: 50px; border-radius:30px;" alt=""></a>
			<?php else:?>	
				<a href="login.php" style="width: 50px; border-radius:30px;" alt="">

					<button class="mtr-btn "  type="submit" ><span>Login</span></button>

				 </a>
				 <a href="register.php"> <button  class="mtr-btn " type="button"><span >Register</span></button></a>
			<?php endif;?>

			
			
			
			
		</div>
	</div>