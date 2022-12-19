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

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/main.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>



	


	<div class="central-meta item">
		<div class="user-post">
					<div class="friend-info">



						<figure>

							<?php 
								$image=" " ;
								$image_class=new Image();

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



							<span style="color:#5e9ce6; font-weight: normal; font-size: 14px; float:right">  

							<a href="edit.php">Edit </a> |
							<a href="delete.php?id=<?php echo $ROW['postid']; ?>" >Delete </a>   </span>



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

							
							<div class="we-video-info">
								<ul>
									<li>
										<span class="comment" data-toggle="tooltip" title="Comments">
											<i class="fa fa-comments-o"></i>
											<ins>52</ins>
										</span>
									</li>
									<li>
										<span class="like" data-toggle="tooltip" title="like">
											<i class="ti-heart"></i>
											<ins>2.2k</ins>
										</span>
									</li>
									
									<li class="social-media">
										<div class="menu">
										  <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
										  </div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
										  </div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
										  </div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
										  </div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
										  </div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
											</div>
										  </div>
											<div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
											</div>
										  </div>
										  <div class="rotater">
											<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
											</div>
										  </div>

										</div>
									</li>
								</ul>
							</div>


							
						</div>
					</div>






					<div class="coment-area">
						<ul class="we-comet">
							<li>
								<div class="comet-avatar">
									<img src="images/resources/comet-1.jpg" alt="">
								</div>
								<div class="we-comment">
									<div class="coment-head">
										<h5><a href="time-line.html" title="">Jason borne</a></h5>
										<span>1 year ago</span>
										<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
									</div>
									<p>we are working for the dance and sing songs. this car is very awesome for the youngster. please vote this car and like our post</p>
								</div>
								<ul>
									<li>
										<div class="comet-avatar">
											<img src="images/resources/comet-2.jpg" alt="">
										</div>
										<div class="we-comment">
											<div class="coment-head">
												<h5><a href="time-line.html" title="">alexendra dadrio</a></h5>
												<span>1 month ago</span>
												<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
											</div>
											<p>yes, really very awesome car i see the features of this car in the official website of <a href="#" title="">#Mercedes-Benz</a> and really impressed :-)</p>
										</div>
									</li>
									<li>
										<div class="comet-avatar">
											<img src="images/resources/comet-3.jpg" alt="">
										</div>
										<div class="we-comment">
											<div class="coment-head">
												<h5><a href="time-line.html" title="">Olivia</a></h5>
												<span>16 days ago</span>
												<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
											</div>
											<p>i like lexus cars, lexus cars are most beautiful with the awesome features, but this car is really outstanding than lexus</p>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<div class="comet-avatar">
									<img src="images/resources/comet-1.jpg" alt="">
								</div>
								<div class="we-comment">
									<div class="coment-head">
										<h5><a href="time-line.html" title="">Donald Trump</a></h5>
										<span>1 week ago</span>
										<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
									</div>
									<p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel
										<i class="em em-smiley"></i>
									</p>
								</div>
							</li>
							<li>
								<a href="#" title="" class="showmore underline">more comments</a>
							</li>
							<li class="post-comment">
								<div class="comet-avatar">
									<img src="images/resources/comet-1.jpg" alt="">
								</div>
								<div class="post-comt-box">
									<form method="post">
										<textarea placeholder="Post your comment"></textarea>
										<div class="add-smiles">
											<span class="em em-expressionless" title="add icon"></span>
										</div>
										<div class="smiles-bunch">
											<i class="em em---1"></i>
											<i class="em em-smiley"></i>
											<i class="em em-anguished"></i>
											<i class="em em-laughing"></i>
											<i class="em em-angry"></i>
											<i class="em em-astonished"></i>
											<i class="em em-blush"></i>
											<i class="em em-disappointed"></i>
											<i class="em em-worried"></i>
											<i class="em em-kissing_heart"></i>
											<i class="em em-rage"></i>
											<i class="em em-stuck_out_tongue"></i>
										</div>
										<button type="submit"></button>
									</form>	
								</div>

							</li>
						</ul>
						
					</div>
				</div>
			</div>

			

	
</body>
</html>






















	