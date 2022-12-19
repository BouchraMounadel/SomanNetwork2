<?php 
function pagination_link()
{
	$page_number=isset($_GET['page'])? (int)$_GET['page'] : 1;
	$page_number=($page_number<1)? 1 : $page_number;


	$arr['next_page']="";
	$arr['previous_page']= "";
	//get current URL
	$url="http://" .$_SERVER['SERVER_NAME'].":" .$_SERVER['SERVER_PORT'] . $_SERVER['SCRIPT_NAME'];

	$url .= "?";

	$next_page_link = $url;
	$previous_page_link = $url;
	$page_found= false;
	$num=0;


	foreach ($_GET as $key => $value) {
		$num++;

		
			
		if ($num==1) {

			if ($key=="page") {

				$next_page_link .= $key . "=" . ($page_number + 1);

				$previous_page_link .= $key . "=" . ($page_number - 1);
				$page_found= true;

				
				
			}else {
				$next_page_link .= $key . "=" . $value;
				$previous_page_link .= $key . "=" . $value;
			}
		
		}
		else {
			
			if ($key=="page") {
				$next_page_link .= "&" . $key . "=" . ($page_number + 1);

				$previous_page_link .= "&" . $key . "=" . ($page_number - 1);
				$page_found= true;
		}else {
				
				$next_page_link .= "&" . $key . "=" . $value;
				$previous_page_link .= "&" . $key . "=" . $value;
				


			}
		}

		
	}



	$arr['next_page']=$next_page_link;
	$arr['previous_page']= $previous_page_link;
	if (!$page_found) {
		$arr['next_page']=$next_page_link . "&page=2";
		$arr['previous_page']= $previous_page_link . "&page=1";
	}

	return $arr;
}

function i_own_content($row)
{

	//profiles
	$post=new Post();
	$myid=$_SESSION['SomanNetwork_IdUser'];

	//comments and posts

	if (isset($row['sexe'])&& $myid==$row['IdUser']) {
		return true;

		
	}
	if (isset($row['postid'])) {

		if ($myid==$row['IdUser']) {
			return true;
		}else {
			$one_post=$post->get_one_post($row['parent']);
			if ($myid==$one_post['IdUser']) {
			return true;
		    }
		}
		
		
	}



	return  false;
}

function add_notification($IdUser,$activity,$row)
{

	$row = (object)$row;
	$IdUser = esc($IdUser);
	$activity = esc($activity);
	$content_owner = $row->IdUser;

	$date = date("Y-m-d H:i:s");
	$contentid = 0;
	$content_type = "";

	if(isset($row->postid)){
		$contentid = $row->postid;
		$content_type = "post";

		if($row->parent > 0){
			$content_type = "comment";
		}
	}
	if(isset($row->sexe)){
		$content_type = "profile";
		$contentid = $row->IdUser;

		
	}

	$query = "insert into notifications (IdUser,activity,content_owner,date,contentid,content_type) 
	values ('$IdUser','$activity','$content_owner','$date','$contentid','$content_type')";
	$DB = new Database();
	$DB->save($query);

}


function content_i_follow($IdUser,$row)
{

	$row = (object)$row;

	$IdUser = esc($IdUser);
 	$date = date("Y-m-d H:i:s");
	$contentid = 0;
	$content_type = "";

	if(isset($row->postid)){
		$contentid = $row->postid;
		$content_type = "post";

		if($row->parent > 0){
			$content_type = "comment";
		}
	}
	
	if(isset($row->sexe)){
		$content_type = "profile";
	}

	$query = "insert into content_i_follow (IdUser,date,contentid,content_type) 
	values ('$IdUser','$date','$contentid','$content_type')";
	$DB = new Database();
	$DB->save($query);
}

function esc($value)
{

	return addslashes($value);
}

function notification_seen($id)
{

	$notification_id = addslashes($id);
	$IdUser = $_SESSION['SomanNetwork_IdUser'];
	$DB = new Database();

	$query = "select * from notification_seen where IdUser = '$IdUser' && notification_id = '$notification_id' limit 1";
	$check = $DB->read($query);

	if(!is_array($check)){

		$query = "insert into notification_seen (IdUser,notification_id) 
		values ('$IdUser','$notification_id')";
		
		$DB->save($query);
	}
}

function check_notifications()
{
	$number = 0;

	$IdUser = $_SESSION['SomanNetwork_IdUser'];
	$DB = new Database();

	$follow = array();

	//check content i follow
	$sql = "select * from content_i_follow where disabled = 0 && IdUser = '$IdUser' limit 100";
	$i_follow = $DB->read($sql);
	if(is_array($i_follow)){
		$follow = array_column($i_follow, "contentid");
	}

	if(count($follow) > 0){

		$str = "'" . implode("','", $follow) . "'";
		$query = "select * from notifications where (IdUser != '$IdUser' && content_owner = '$IdUser') || (contentid in ($str)) order by id desc limit 30";
	}else{

		$query = "select * from notifications where IdUser != '$IdUser' && content_owner = '$IdUser' order by id desc limit 30";
	}
 							
 	$data = $DB->read($query);

 	if(is_array($data)){

 		foreach ($data as $row) {
 			# code...
	 		$query = "select * from notification_seen where IdUser = '$IdUser' && notification_id = '$row[id]' limit 1";
			$check = $DB->read($query);

			if(!is_array($check)){

				$number++;
			}
		}
	}

	return $number;

}








?>