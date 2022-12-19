<?php 

	session_start();

	include 'classes/connect.php';
	include 'classes/signin.php';
	include 'classes/user.php';
	include 'classes/post.php';
	include 'classes/image.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);




	echo "<pre>";
	print_r($_GET);
	echo "</pre>";

	




	if ($_SERVER['REQUEST_METHOD'] == "POST") {


		

		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {


			


			if ($_FILES['file']['type'] == "image/jpeg") {


				$allowed_size=1024*1024*9;

				if ($_FILES['file']['size'] < $allowed_size) {
					//everything is fine

					$folder="uploads/" . $user_data['IdUser'] . "/";

					//create folder
					if (!file_exists($folder)) {

						mkdir($folder,0777,true);
						
					}
					$image= new Image();

					$filename = $folder. $image->generate_filename(15) . ".jpg";
					 move_uploaded_file($_FILES['file']['tmp_name'], $filename);

					$change="profile";
				 	if (isset($_GET['change'])) {
				 	$change=$_GET['change'];
					 } 

					 


					 if ($change=="cover") {

					 	 if (file_exists($user_data['cover_image'])) {
					 	 	//unlink($user_data['cover_image']);
					 	 }

					 	 $image->resize_image($filename,$filename,1500,1500);
					 } 
					 else
					 {

					 	 if (file_exists($user_data['profile_image'])) {
					 	 	//unlink($user_data['profile_image']);
					 	 }
					 	$image->resize_image($filename,$filename,1500,1500);
					 }
					 
					
					 


					 if (file_exists($filename)) {

							 	$IdUser=$user_data['IdUser'];




							 	

							 	if ($change == "cover") {

							 		$query="update users set cover_image ='$filename' where IdUser= '$IdUser' limit 1 ";
							 		$_POST['is_cover_image']=1;
							 		
							 	} else {
							 		$query="update users set profile_image='$filename' where IdUser= '$IdUser' limit 1 ";
							 		$_POST['is_profile_image']=1;
							 	}

						
							 	$DB=new Database();
							 	$DB->save($query);



							 	//create a post
							 	$post=new Post();




								$result=$post->create_post($_POST,$IdUser,$filename);





							    header("Location: profil.php");
							 	die;
					 }

				} else {
					
			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo "Only images of size 3Mb are allowed";


				}
				
				

			}else {


			echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo "Only images of jpeg type are allowed";
				
			}

		 	  

		 } else {

		 	echo "<div style='text-align:center'>";
			echo "the following errors occured <br>";
			echo "please add a valid image";
			
		 	

		 }

		


		


		
		}




 ?>