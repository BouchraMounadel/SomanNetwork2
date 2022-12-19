<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>PostsPage</title>
    <link rel="icon" href="images/Capture.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

   <script src="js/main.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>



	


	<div class="central-meta item">
		<div class="user-post">
					<div class="friend-info">



						<figure>

							<?php 
								$image=" " ;

								if ( file_exists($ROW_USER['profile_image']) ) {


									$image=$image_class->get_thumb_profile($ROW_USER['profile_image']) ;

								}

								elseif ($ROW_USER['sexe'] == "masculin") {

									$image="images/user_male.jpg";
									


								} else {

									$image="images/user_female.jpg";
									
								}
								




							?>


							<img src="<?php echo $image?>" alt="">
						</figure>

						<div class="friend-name">
							<ins><a href="profil.php" title="">
								<?php echo $ROW_USER['prenom'] . " " . $ROW_USER['nom']; 

								if ($ROW['is_profile_image']) {
									echo "<span style='font-weight:normal;color:#aaa;'> updated profile image</span>";
								} else  {
									echo "<span style='font-weight:normal;color:#aaa;'> updated cover image</span>";
								}

							?>
								
							</a>



							



						</ins>
							<span>published:<?php echo $ROW['date'] ?></span>

							
						</div>



						<div class="post-meta">

							<div class="description">
								
									<?php echo htmlspecialchars($ROW['post']) ?>
									<br><br>

									<?php 

									if (file_exists($ROW['image'])) {

										//$post_image=$image_class->get_thumb_post($ROW['image']);

										$post_image=$ROW['image'];


										echo "<img src='$post_image' width='80%' />" ;
									}
									?>
								
							</div>

							
							




					
									
								</div>

							
						
					</div>
				</div>
			</div>

			

	
</body>
</html>






















	