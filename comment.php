
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
							<ins><a href="profil.php?id=<?php echo($COMMENT['IdUser'])?>" title="">
								<?php echo $ROW_USER['prenom'] . " " . $ROW_USER['nom']; 

								if ($COMMENT['is_profile_image']) {
									echo "<span style='font-weight:normal;color:#aaa;'> updated profile image</span>";
								} elseif($COMMENT['is_cover_image'])  {
									echo "<span style='font-weight:normal;color:#aaa;'> updated cover image</span>";
								}

							?>
								
							</a>



							<span style="color:#5e9ce6; font-weight: normal; font-size: 14px; float:right"> 

								<?php 

								$post=new Post();


								if ($post->i_own_post($COMMENT['postid'],$_SESSION['SomanNetwork_IdUser'])) {
								 	echo "
									<a href='edit.php?id= $COMMENT[postid]'>Edit </a> |";
									
								 } 
								 if (i_own_content($COMMENT)) {
								 	echo "<a href='delete.php?id= $COMMENT[postid] ' >Delete </a>";
								 }
								

							?>   </span>



						</ins>
							<span>published:<?php echo $COMMENT['date'] ?></span>

							
						</div>



						<div class="post-meta">

							<div class="description">
								
									<?php echo htmlspecialchars($COMMENT['post']) ?>
									<br><br>

									<?php 

									if (file_exists($COMMENT['image'])) {

										//$post_image=$image_class->get_thumb_post($ROW['image']);

										$post_image=$COMMENT['image'];


										echo "<img src='$post_image' width='80%' />" ;
									}
									?>
								
							</div>

							
							<div class="we-video-info">
								<ul>



									<li>
										<?php 
										$likes="";
										$likes = ($COMMENT['likes']>0) ? $COMMENT['likes'] : "" ;
										?>	
										<a href="like.php?type=post&id=<?php echo($COMMENT['postid']) ?>">
											<span class="like" data-toggle="tooltip" title="like">
											<i class="ti-heart"></i>

											<?php echo "<ins>";
											echo $likes;
											echo "</ins>"; ?>
										</span>

										</a>
									</li>
									<li>
									<?php if ($COMMENT['has_image']) {


										echo "<a href='image_view.php?id=$COMMENT[postid]' >";
										echo ". View Full Image . ";
										echo "</a>";
										
									} ?>

									
							
									</li>








									<?php
									$i_liked=false;

									if (isset($_SESSION['SomanNetwork_IdUser'])) {
									 	
									 

									$DB=new Database();
									
									$sql="select likes from likes where type='post' && contentid = '$COMMENT[postid]' limit 1";
									$result=$DB->read($sql);
									if (is_array($result)) {

									$likes=json_decode($result[0]['likes'],true);

									$user_ids= array_column($likes, "IdUser");

									if (in_array($_SESSION['SomanNetwork_IdUser'], $user_ids)) {

										$i_liked=true;



									}}} 



										if ($COMMENT['likes']>0) {

											echo "<a href='likes.php?type=post&id=$COMMENT[postid]'>";

											if ($COMMENT['likes']==1) {


												if ($i_liked) {
													echo "<li>";
											echo "<span style='color:green;' >You liked this comment </span>";
											echo "</li>";
												}else{

													echo "<li>";
											echo "<span style='color:green;' >" . $COMMENT['likes'] ." "."person liked this comment </span>";
											echo "</li>";
													
												}


												

											}



											else {

												if ($i_liked) {
													echo "<li>";
											echo "<span style='color:green;'> You and " . ($COMMENT['likes']-1) ." ". " other people liked this comment</span>";
											echo "</li>";
												}else {
													echo "<li>";
											echo "<span style='color:green;' You and >" . $COMMENT['likes'] ." ". "people liked this comment </span>";
											echo "</li>";
													

												}
											
											}

											echo "</a>";
											




											
										}

									?>

									<li>


										


									</li>



									
								
								</ul>
							</div>


							
						</div>
					</div>






					
				</div>
			</div>

			

	
</body>
</html>






















	