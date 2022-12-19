
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
							<ins><a href="profil.php?id=<?php echo($ROW['IdUser'])?>" title="">
								<?php echo $ROW_USER['prenom'] . " " . $ROW_USER['nom']; 

								if ($ROW['is_profile_image']) {
									echo "<span style='font-weight:normal;color:#aaa;'> updated profile image</span>";
								} elseif($ROW['is_cover_image'])  {
									echo "<span style='font-weight:normal;color:#aaa;'> updated cover image</span>";
								}
								elseif ($ROW['longitude'] != "") {
								 	echo "<span style='font-weight:normal;color:#aaa;'> shared a location </span>";
								 }  
										

							?>
								
							</a>



							<span style="color:#5e9ce6; font-weight: normal; font-size: 14px; float:right"> 

								<?php 

								$post=new Post();


								if ($post->i_own_post($ROW['postid'],$_SESSION['SomanNetwork_IdUser'])) {
								 	echo "
									<a href='edit.php?id= $ROW[postid]'>Edit </a> |
									<a href='delete.php?id= $ROW[postid] ' >Delete </a>";
								 } 
								

							?>   </span>



						</ins>
						<?php $time=new Time();

						$t=$time->get_time($ROW['date']); ?>
							<span>published:<?php echo $ROW['date']; ?></span>

							
						</div>



						<div class="post-meta">

							<div class="description">
								
									<?php echo htmlspecialchars($ROW['post']) ?>

									<?php 
									if ($ROW['longitude'] != "") {
										
									
									 ?>
									 <iframe  src="https://www.google.com/maps?q=<?php echo($ROW['latitude']); ?>,<?php echo($ROW['longitude']); ?>&hl=es;z=14&output=embed"></iframe>
									<br><br>

									<?php 
									} 

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
										<a href="single_post.php?id=<?php echo($ROW['postid']) ?>">

										<span class="comment" data-toggle="tooltip" title="Comments">
											<i class="fa fa-comments-o"></i>

											<?php
											 $comments="";
											 if ($ROW['comments']>0) {
											 	$comments="(" . $ROW['comments'] . ")" ;
											 }


											?>
											<ins><?php echo $comments ?></ins>
										</span>
										</a>
									</li>








									<li>
										<?php 
										$likes="";
										$likes = ($ROW['likes']>0) ? $ROW['likes'] : "" ;
										?>	
										<a onclick="like_post(event)" href="like.php?type=post&id=<?php echo($ROW['postid']) ?>">
											Like

											<?php echo "<ins>";
											echo "(" . $likes . ")";
											echo "</ins>"; ?>
										</span>

										</a>
									</li>
									<li>
									<?php if ($ROW['has_image']) {


										echo "<a href='image_view.php?id=$ROW[postid]' >";
										echo ". View Full Image . ";
										echo "</a>";
										
									} ?>

									
							
									</li>








									<?php
									$i_liked=false;

									if (isset($_SESSION['SomanNetwork_IdUser'])) {
									 	
									 

									$DB=new Database();
									
									$sql="select likes from likes where type='post' && contentid = '$ROW[postid]' limit 1";
									$result=$DB->read($sql);
									if (is_array($result)) {

									$likes=json_decode($result[0]['likes'],true);

									$user_ids= array_column($likes, "IdUser");

									if (in_array($_SESSION['SomanNetwork_IdUser'], $user_ids)) {

										$i_liked=true;



									}}} 

									echo "<a id='info_$ROW[postid]' href='likes.php?type=post&id=$ROW[postid]'>";

										if ($ROW['likes']>0) {

											

											if ($ROW['likes']==1) {


												if ($i_liked) {
													echo "<li>";
											echo "<span style='color:green;' >You liked this post </span>";
											echo "</li>";
												}else{

													echo "<li>";
											echo "<span style='color:green;' >" . $ROW['likes'] ." "."person liked this post </span>";
											echo "</li>";
													
												}


												

											}



											else {

												if ($i_liked) {
													echo "<li>";
											echo "<span style='color:green;'> You and " . ($ROW['likes']-1) ." ". " other people liked this post </span>";
											echo "</li>";
												}else {
													echo "<li>";
											echo "<span style='color:green;' You and >" . $ROW['likes'] ." ". "people liked this post </span>";
											echo "</li>";
													

												}
											
											}

										
											
										}

										echo "</a>";

									?>

									<li>


										


									</li>



									
								
								</ul>
							</div>


							
						</div>
					</div>






					
				</div>
			</div>


			<script type="text/javascript">
				
				function ajax_send(data,element) {

					

					

					var ajax = new XMLHttpRequest();

					ajax.addEventListener('readystatechange',function(){
						if (ajax.readyState == 4 && ajax.status == 200) {
							response(ajax.responseText,element);
						}
					});


					data=JSON.stringify(data);



					ajax.open("post", "ajax.php" ,true);
					ajax.send(data);
				};


				function response(result,element) {

					if (result != "") {

						var obj = JSON.parse(result);

						if (typeof obj.action != 'undefined') {
							if (obj.action=='like_post') {

								var likes="";

								if (typeof obj.likes != 'undefined') {
								   likes = (parseInt(obj.likes) >0) ?  "Like("+ obj.likes + ")" : "Like" ;
								   element.innerHTML = likes;
								}


								if (typeof obj.info != 'undefined') {
								var info_element = document.getElementById(obj.id);
								info_element.innerHTML = obj.info;}

							}
							
						}
						
					}
					
					
				};
				function like_post(e) {

					e.preventDefault();
					var link = e.target.href;

					var data = {};
					data.link=link;
					data.action="like_post";
					ajax_send(data,e.target);
				};

			</script>

			

	
</body>
</html>






















	