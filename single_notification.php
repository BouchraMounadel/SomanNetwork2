<?php
				$id = esc($_SESSION['SomanNetwork_IdUser']);
				$actor=$User->get_user($notif_row['IdUser']);
				$owner=$User->get_user($notif_row['content_owner']);
				$link="";
				if ($notif_row['content_type']=='post') {
					$link="single_post.php?id=". $notif_row['contentid'] . "&notif=" . $notif_row['id'];
				}elseif ($notif_row['content_type']=='profile') {
					$link="profil.php?id=". $notif_row['IdUser']. "&notif=" . $notif_row['id'];
				}elseif ($notif_row['content_type']=='comment') {

					$link="single_post.php?id=". $notif_row['contentid']. "&notif=" . $notif_row['id'];
				}
				//check if the notification was seen
				$query = "select * from notification_seen where IdUser = '$id' && notification_id = '$notif_row[id]' limit 1";
				$seen = $DB->read($query);

				if (is_array($seen)) {
					$color="";
				}else {
					$color="#dfe9eb";
					
				}
				
				

				 ?> 
<li style="background-color: <?= $color?> " >
	<figure>
	<?php
				
				if (is_array($actor) && is_array($owner)) {


					$image="images/user_male.jpg" ;

								if ( file_exists($actor['profile_image']) ) {


									$image=$image_class->get_thumb_profile($actor['profile_image']) ;

								}

								elseif ($actor['sexe'] == "masculin") {

									$image="images/user_male.jpg";
									


								} else {

									$image="images/user_female.jpg";
									
								}
							 
				
			 ?>
			 <img src="<?php echo $image?>" alt="">
			 </figure>
			 <?php }?>

	<a href="<?php echo($link); ?>">
		<div class="notifi-meta">

			<p>
				<?php
				$id = esc($_SESSION['SomanNetwork_IdUser']);
				$actor=$User->get_user($notif_row['IdUser']);
				$owner=$User->get_user($notif_row['content_owner']); ?> 
				<?php  
				if (is_array($actor)&& is_array($owner)) {

						echo $actor['prenom']." ".$actor['nom'];
						if ($notif_row['activity']=='like') {
							echo " ";
							echo "liked ";
						}elseif ($notif_row['activity']=='follow') {
							echo " ";
							echo "is following ";
						}elseif ($notif_row['activity']=='comment') {
							echo " ";
							echo "has commented ";
						}
						if ($owner['IdUser']==$id) {
							echo "your ";
						}else {
							echo $owner['prenom']." ".$owner['nom'] . "'s ";
						}

						

						$content_row=$post->get_one_post($notif_row['contentid']);
						if ($notif_row['content_type']=="post") {
							
							if ($content_row['has_image']) {
								
								echo " image ";
								if (file_exists($content_row['image'])) {

										$post_image=$image_class->get_thumb_cover($content_row['image']);

										$post_image=$content_row['image'];


										echo "<img src='$post_image'  style='width:45px; float:right;' />" ;
									}
							}else {
								echo $notif_row['content_type'];
								echo "
								<span style='color:#17a2b8; font-size:14px; float:right; margin-right:50px;' >'". htmlspecialchars(substr($content_row['post'],0,16)). "..'</span>

								";
								
							}
							
						}else {
							echo $notif_row['content_type'];
							
						}
						
						

					
				}
				
			 ?>
			 	
			 </p>



			<span><?php 
			$date=date("jS/M/Y  H:i:s a", strtotime($notif_row['date']));
			echo $date; ?></span>
		</div>
	</a>
	<i class="del fa fa-close"></i>
</li>