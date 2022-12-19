<?php 

$signin= new Signin();
$_SESSION['SomanNetwork_IdUser']=isset($_SESSION['SomanNetwork_IdUser']) ? $_SESSION['SomanNetwork_IdUser'] : 0;
$user_data=$signin->check_login($_SESSION['SomanNetwork_IdUser'],false);

//check if not logged in
if ($_SESSION['SomanNetwork_IdUser']==0) {

	$obj=(object)[];
	
	$obj->action="like_post";
	
	
	echo json_encode($obj);
	die;
	
}

	//isset($_SESSION['SomanNetwork_IdUser']);

	if (!isset($_SESSION['SomanNetwork_IdUser'])) {
	 	die;
	 } 

$query_string=explode("?", $data->link);
$query_string= end($query_string);



$str=explode("&", $query_string);
foreach ($str as  $value) {
	$value= explode("=", $value);
	$_GET[$value[0]]=$value[1];
	
}

$_GET['id']=addslashes($_GET['id']);
$_GET['type']=addslashes($_GET['type']);




if (isset($_GET['type']) && isset($_GET['id'])) {
	$post=new Post();

	if (is_numeric($_GET['id'])) {

		$allowed[]='post';
		$allowed[]='user';
		$allowed[]='comment';
		if (in_array($_GET['type'], $allowed)) {
			
			
			$user_class=new User();
			
			$post->like_post($_GET['id'],$_GET['type'],$_SESSION['SomanNetwork_IdUser']);

			

			if ($_GET['type']=="user") {
				$user_class->follow_user($_GET['id'],$_GET['type'],$_SESSION['SomanNetwork_IdUser']);
				//$single_post= $user_class->get_user($_GET['id']);
			}
			
			
			
		}
	}

	//read likes
	$likes=$post->get_likes($_GET['id'],$_GET['type']);

	//create info

$likes=array();	
$info="";
	
$i_liked=false;

if (isset($_SESSION['SomanNetwork_IdUser'])) {
	


$DB=new Database();

$sql="select likes from likes where type='post' && contentid = '$_GET[id]' limit 1";
$result=$DB->read($sql);
if (is_array($result)) {

$likes=json_decode($result[0]['likes'],true);

$user_ids= array_column($likes, "IdUser");

if (in_array($_SESSION['SomanNetwork_IdUser'], $user_ids)) {

$i_liked=true;



}}} 


$like_count=count($likes);
if ($like_count>0) {


	if ($like_count==1) {


		if ($i_liked) {
			$info.= "<li>";
	$info.= "<span style='color:green;' >You liked this post </span>";
	$info.= "</li>";
		}else{

			$info.= "<li>";
	$info.= "<span style='color:green;' >" . $like_count ." "."person liked this post </span>";
	$info.= "</li>";
			
		}


		

	}



	else {

		if ($i_liked) {
			$info.= "<li>";
	$info.= "<span style='color:green;'> You and " . ($like_count-1) ." ". " other people liked this post </span>";
	$info.= "</li>";
		}else {
			echo "<li>";
	$info.= "<span style='color:green;' You and >" . $like_count ." ". "people liked this post </span>";
	$info.= "</li>";
			

		}
	
	}

	
	




	
}
///77///7////77
									



	$obj=(object)[];
	$obj->likes=count($likes);
	$obj->action="like_post";
	$obj->info=$info;
	$obj->id="info_$_GET[id]";
	
	echo json_encode($obj);
	
}










?>