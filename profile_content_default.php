<div class="widget">
										<h4 class="widget-title">Following</h4>
										<ul class="followers">
<?php 



	if ($friends) {
		foreach ($friends as $friend) {

		$FRIEND_ROW= $user->get_user($friend['IdUser']);

		include 'user.php';
		
	}
}


?>

											
										</ul>
									</div>


									<!--------------------------- who's following ----------------------------------->
								</aside>
							</div>


<!-------------------------------------------------------- sidebar -------------------------------------------------------->




							<div class="col-lg-6">

								<div class="central-meta item">
										<div class="new-postbox">
											<figure>

							<?php 
								$image=" " ;

								if (isset($USER)) {
									# code...
								

								if ( file_exists($USER['profile_image']) ) {


									$image=$image_class->get_thumb_profile($USER['profile_image']) ;

								}

								elseif ($USER['sexe'] == "masculin") {

									$image="images/user_male.jpg";
									


								} else {

									$image="images/user_female.jpg";
									
								}
								

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
							


<!------------------------------------------------------ add post new box in top ------------------------------------------------------------------->



<?php 



if ($posts) {
	foreach ($posts as $ROW) {

		$user=new User();
		$ROW_USER= $user->get_user($ROW['IdUser']);

		include 'post.php';
		
	}
}





//get current URL
										$pg=pagination_link();


//include 'post3.php';

?>
<a href="<?php echo($pg['previous_page']) ?>">
<button type="button" style="float: left; width: 150px; cursor: pointer;" >Previous page</button></a>
<a href="<?php  echo($pg['next_page'])  ?>">
<button type="button" style="float: right; width: 150px; cursor: pointer; ">Next page</button></a>



							</div>
							</div><!-- centerl meta -->






<!------------------------------------------------------------ centerl meta ------------------------------------------------------------------------------------------>



								</aside>
							</div><!-- sidebar -->

						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>
