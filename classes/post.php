<?php
	
	class Post
	{

		private $error="";

		
		
		public function create_post($data,$IdUser,$files)
		{
			

			if (!empty($data['post']) || !empty($files['file']['name']) ||  isset($data['is_profile_image']) || isset($data['is_cover_image']) || (($data['latitude']!= "") )) {

				$myimage="";
				$has_image=0;
				$is_cover_image=0;
				$is_profile_image=0;

				if (isset($data['is_profile_image']) || isset($data['is_cover_image'])) {


					$myimage=$files;
					$has_image=1;
					if (isset($data['is_cover_image'])) {
					 	$is_cover_image=1;
					 } 

					if (isset($data['is_profile_image'])) {
					 	$is_profile_image=1;
					 } 

				}else {
	
					if (!empty($files['file']['name'])) {
						
						$folder="uploads/" . $IdUser . "/";

						//create folder
						if (!file_exists($folder)) {

							mkdir($folder,0777,true);
							file_put_contents($folder . "index.php", "");
							
						}
						$allowed[]="image/jpeg";

						if (in_array($files['file']['type'],$allowed)) {
							$image_class= new Image();

						$myimage = $folder. $image_class->generate_filename(15) . ".jpg";
						 move_uploaded_file($files['file']['tmp_name'], $myimage);

						 $image_class->resize_image($myimage,$myimage,1500,1500);


						
						$has_image=1;
						}else {
							$this->error .= "The selected image is not a valid type , only jpegs allowed !<br>";
						}
						
				}}

				$post="";
				$latitude="";
				$longitude="";
				if (isset($data['latitude'])  && isset($data['longitude'])) {
					$latitude=$data["latitude"];
					$longitude=$data["longitude"];
				}
				
				if (isset($data['post'])) {
					$post = addslashes($data['post']);
				}

				if ($this->error == "") {
					
				

				$post=addslashes($data['post']);
				$postid= $this->create_postid();
				$parent=0;
				$DB= new Database();

				if (isset($data['parent']) && is_numeric($data['parent'])) {

					$parent=$data['parent'];
					$mypost=$this-> get_one_post($data['parent']);
					if (is_array($mypost)&& $mypost['IdUser']!=$IdUser) {

						//follow this item
						content_i_follow($IdUser,$mypost);

						//add notification
						add_notification($_SESSION['SomanNetwork_IdUser'],"comment",$mypost);
					}
					
					$sql="update posts set comments = comments + 1 where postid='$parent' limit 1";
					$DB->save($sql);
				}

				$query="insert into posts(IdUser,postid,post,image,has_image,is_profile_image,is_cover_image,parent,latitude,longitude)values('$IdUser','$postid','$post','$myimage','$has_image','$is_profile_image','$is_cover_image','$parent','$latitude','$longitude')";

				
				$DB->save($query);

				
				}
			} else {
				$this->error .= "Please try sth here to post !<br>";
			}
			return $this->error;
		}










		public function edit_post($data,$files)
		{
			if (!empty($data['post']) || !empty($files['file']['name']) ) {

				$myimage="";
				$has_image=0;
				
					if (!empty($files['file']['name'])) {
						
						$folder="uploads/" . $IdUser . "/";

						//create folder
						if (!file_exists($folder)) {

							mkdir($folder,0777,true);
							file_put_contents($folder . "index.php", "");
							
						}
						$image_class= new Image();

						$myimage = $folder. $image_class->generate_filename(15) . ".jpg";
						 move_uploaded_file($_FILES['file']['tmp_name'], $myimage);

						 $image_class->resize_image($myimage,$myimage,1500,1500);


						
						$has_image=1;
				}

				$post="";
				if (isset($data['post'])) {
					$post = addslashes($data['post']);
				}

				$post=addslashes($data['post']);
				$postid= addslashes($data['postid']);

				if ($has_image) {
					$query="update posts set post = '$post', image='$myimage' where postid='$postid' limit 1";

				}else {
					$query="update posts set post = '$post' where postid='$postid' limit 1";

				}

				
				
				$DB= new Database();
				$DB->save($query);
			} else {
				$this->error .= "Please try sth here to post !<br>";
			}
			return $this->error;
		}
















		public function get_posts($IdUser)
		{
			$limit=10;
			$page_number=isset($_GET['page'])? (int)$_GET['page'] : 1;
			$page_number=($page_number<1)? 1 : $page_number;
			$offset=($page_number-1)*$limit;
				$query="select * from posts where parent=0 and IdUser=$IdUser order by id desc limit $limit offset $offset";

				$DB= new Database();
				$result=$DB->read($query);

				if ($result) {
					return $result;
				} else {
					return false;
				}
		}


		public function get_comments($id)
		{
			$limit=10;
			$page_number=isset($_GET['page'])? (int)$_GET['page'] : 1;
			$page_number=($page_number<1)? 1 : $page_number;
			$offset=($page_number-1)*$limit;
				$query="select * from posts where parent='$id' order by id asc limit  $limit offset $offset";

				$DB= new Database();
				$result=$DB->read($query);

				if ($result) {
					return $result;
				} else {
					return false;
				}
		}




		public function get_likes($id,$type)
		{
			$DB=new Database();
			if (is_numeric($id)) {
				
				//get like details

				$sql="select likes from likes where type='$type' && contentid = '$id' limit 1";
				$result=$DB->read($sql);
				if (is_array($result)) {
					$likes=json_decode($result[0]['likes'],true);
					return $likes;
				}
			}
			return false;
		}

		public function like_post($id,$type,$SomanNetwork_IdUser)
		{
			
			if ($type=="post") {
				$DB=new Database();
				//save like details

				$sql="select likes from likes where type='post' && contentid = '$id' limit 1";
				$result=$DB->read($sql);
				if (is_array($result)) {

					$likes=json_decode($result[0]['likes'],true);

					$user_ids= array_column($likes, "IdUser");

					if (!in_array($SomanNetwork_IdUser, $user_ids)) {

						$arr["IdUser"]=$SomanNetwork_IdUser;
						$arr["date"]=date("Y-m-d H:i:s");

						$likes[]=$arr;

						$likes_string=json_encode($likes);
						$sql="update likes set likes = '$likes_string' where type='post' && contentid = '$id' limit 1 ";
						$DB->save($sql);

						//increment the posts table
						$sql="update posts set likes = likes + 1 where postid = '$id' limit 1";
						$DB->save($sql);
						$post=new Post();

						$single_post= $post->get_one_post($id);

					//add notification
					add_notification($_SESSION['SomanNetwork_IdUser'],"like",$single_post);

					}else {
						$key = array_search($SomanNetwork_IdUser, $user_ids);
						unset($likes[$key]);
						$likes_string=json_encode($likes);
						$sql="update likes set likes = '$likes_string' where type='$type' && contentid = '$id' limit 1 ";
						$DB->save($sql);

						//decrement the posts table
					$sql="update posts set likes = likes-1 where postid = '$id' limit 1";
					$DB->save($sql);
					}

					
				}else {
					$arr["IdUser"]=$SomanNetwork_IdUser;
					$arr["date"]=date("Y-m-d H:i:s");

					$arr2[]=$arr;

					$likes=json_encode($arr2);
					$sql="insert into likes (type,contentid,likes) values('$type','$id','$likes')";
					$DB->save($sql);
					//increment the posts table
					$sql="update posts set likes = likes + 1 where postid = '$id' limit 1";
					$DB->save($sql);
					$post=new Post();

					$single_post= $post->get_one_post($id);

					//add notification
					add_notification($_SESSION['SomanNetwork_IdUser'],"like",$single_post);
				}
			
			
		} elseif ($type=="user") {

				$DB=new Database();
				//save like details

				$sql="select likes from likes where type='user' && contentid = '$id' limit 1";
				$result=$DB->read($sql);
				if (is_array($result)) {

					$likes=json_decode($result[0]['likes'],true);

					$user_ids= array_column($likes, "IdUser");

					if (!in_array($SomanNetwork_IdUser, $user_ids)) {

						$arr["IdUser"]=$SomanNetwork_IdUser;
						$arr["date"]=date("Y-m-d H:i:s");

						$likes[]=$arr;

						$likes_string=json_encode($likes);
						$sql="update likes set likes = '$likes_string' where type='user' && contentid = '$id' limit 1 ";
						$DB->save($sql);

						//increment the posts table
						$sql="update users set likes = likes + 1 where IdUser = '$id' limit 1";
						$DB->save($sql);
						//$post=new Post();

					//$single_post= $post->get_one_post($id);

					//add notification
					//add_notification($_SESSION['SomanNetwork_IdUser'],"like",$single_post);

					}else {
						$key = array_search($SomanNetwork_IdUser, $user_ids);
						unset($likes[$key]);
						$likes_string=json_encode($likes);
						$sql="update likes set likes = '$likes_string' where type='user' && contentid = '$id' limit 1 ";
						$DB->save($sql);

						//decrement the users table
					$sql="update users set likes = likes-1 where IdUser = '$id' limit 1";
					$DB->save($sql);
					}

					
				}else {
					$arr["IdUser"]=$SomanNetwork_IdUser;
					$arr["date"]=date("Y-m-d H:i:s");

					$arr2[]=$arr;

					$likes=json_encode($arr2);
					$sql="insert into likes (type,contentid,likes) values('$type','$id','$likes')";
					$DB->save($sql);
					//increment the posts table
					$sql="update users set likes = likes + 1 where IdUser= '$id' limit 1";
					$DB->save($sql);
					//$post=new Post();

					//$single_post= $post->get_one_post($id);

					//add notification
					//add_notification($_SESSION['SomanNetwork_IdUser'],"like",$single_post);
				}
			




		}









	}



				public function get_one_post($postid)
		{

				if (!is_numeric($postid)) {
					return false;
				} 
				
				$query="select * from posts where postid=$postid limit 1";

				$DB= new Database();
				$result=$DB->read($query);

				if ($result) {
					return $result[0];
				} else {
					return false;
				}
		}




		public function delete_post($postid)
		{

			$DB= new Database();
			$post=new Post();


				if (!is_numeric($postid)) {
					return false;
				}
				$one_post=$post->get_one_post($postid);

				$sql="select parent from posts where postid='$postid' limit 1";
				$result= $DB->read($sql);
				if (is_array($result)) {
					if ( $result[0]['parent'] > 0) {


					$parent=$result[0]['parent'];
					$sql="update posts set comments = comments - 1 where postid='$parent' limit 1";
					$DB->save($sql);
				} 
				
				}

				
				

				
				$query = "delete from posts where postid = '$postid' limit 1";
				$DB->save($query);

				//delete anyimages and thumbnails

			 	 if ($one_post['image'] !="" && file_exists($one_post['image'])) {
			 	 	unlink($one_post['image']);
			 	 }

			 	 if ($one_post['image'] !="" && file_exists($one_post['image']. "_post_thumb")) {
			 	 	unlink($one_post['image']. "_post_thumb");
			 	 }


			 	 if ($one_post['image'] !="" && file_exists($one_post['image']. "_cover_thumb")) {
			 	 	unlink($one_post['image']. "_cover_thumb");
			 	 }
			 	 if ($one_post['image'] !="" && file_exists($one_post['image']. "_profile_thumb")) {
			 	 	unlink($one_post['image']. "_profile_thumb");
			 	 }

			 	 //delete all comments relative to the deleted post

			 	 $query = "delete from posts where parent = '$postid' ";
				$DB->save($query);

				
		}

		public function i_own_post($postid,$SomanNetwork_IdUser)
		{


				if (!is_numeric($postid)) {
					return false;
				} 
				
				

				$DB= new Database();
				$query = "select * from posts where postid=$postid limit 1";
				$result=$DB->read($query);
				if (is_array($result)) {
					if ($result[0]['IdUser']== $SomanNetwork_IdUser) {
						return true;
					}
				}
				return false;

				
		}





		private function create_postid()
		{

		$length=rand(4,10);
		$number="";

		for ($i=0; $i < $length ; $i++) { 
			$new_rand = rand(0,9);
			$number = $number . $new_rand;
		}


		return $number ;



		
		}




	}



  ?>