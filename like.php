<?php 

include 'classes/autoload.php';


	//isset($_SESSION['SomanNetwork_IdUser']);

	$signin= new Signin();
	$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser']);

	




if (isset($_SERVER['HTTP_REFERER'])) {
	$return_to=$_SERVER['HTTP_REFERER'];
}else {
	$return_to="profil.php";
}

if (isset($_GET['type']) && isset($_GET['id'])) {

	if (is_numeric($_GET['id'])) {

		$allowed[]='post';
		$allowed[]='user';
		$allowed[]='comment';
		if (in_array($_GET['type'], $allowed)) {
			
			$post=new Post();
			$user_class=new User();
			$post->like_post($_GET['id'],$_GET['type'],$_SESSION['SomanNetwork_IdUser']);

			if ($_GET['type']=="user") {
				$user_class->follow_user($_GET['id'],$_GET['type'],$_SESSION['SomanNetwork_IdUser']);
			}
			
			
		}
	}
	
}



header("Location: ".$return_to);
die;







?>