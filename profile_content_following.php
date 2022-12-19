</aside>
							</div>


<!-------------------------------------------------------- sidebar -------------------------------------------------------->




							<div class="col-lg-6">

								<div class="central-meta item">


<?php 

$image_class=new Image();
$post_class=new Post();
$user_class= new User();

$following=$user_class->get_following($user_data['IdUser'],"user");

if (is_array($following)) {
	foreach ($following as $follower) {

		echo "<ul class='followers'>";
		$FRIEND_ROW=$user_class->get_user($follower['IdUser']);
		include 'user.php';
		echo "</ul>";


	}
	
}else {
	echo "This user isn't following anyone!";
}



?>





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
