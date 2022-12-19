</aside>
							</div>


<!-------------------------------------------------------- sidebar -------------------------------------------------------->




							<div class="col-lg-6">

								<div class="central-meta item">




<?php 

$DB= new Database();
$sql="select image,postid from posts where has_image = 1 && IdUser = $user_data[IdUser] order by id desc limit 30 " ;
$images = $DB->read($sql);
$image_class=new Image();

if (is_array($images)) {
	foreach ($images as $image_row) {
		echo "<a href='single_post.php?id=$image_row[postid]' >";
		echo "<img  src='". $image_class->get_thumb_post($image_row['image']) . "' style='width:200px; margin: 10px;'/>";
		echo "</a>";

	}
	
}else {
	echo "No images are available ";
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
