<li>
						
						<?php 


								$image=" " ;


								if ( file_exists($FRIEND_ROW['profile_image']) ) {


									$image=$image_class->get_thumb_profile($FRIEND_ROW['profile_image']) ;

								}
								elseif ($FRIEND_ROW['sexe'] == "masculin") {

									$image="images/user_male.jpg";
									


								} else {

									$image="images/user_female.jpg";
									
								}
								




							?>
												<a href="profil.php?id=<?php echo($FRIEND_ROW['IdUser'])?>">
												<figure>
												<img src="<?php echo $image; ?>" alt="">
												</figure>
												</a>
												<div class="friend-meta">
													<h4><a href="profil.php?id=<?php echo($FRIEND_ROW['IdUser'])?>"><?php echo $FRIEND_ROW['prenom'] . " " . $FRIEND_ROW['nom'];?></a></h4>
													
												</div>
											</li>