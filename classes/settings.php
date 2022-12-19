<?php 
/**
 * 
 */
class Settings 
{
	
	public function get_settings($id)
	{
		$DB= new Database();
		$sql= "select * from users where IdUser='$id' limit 1";
		$row=$DB->read($sql);

		if (is_array($row)) {
			return $row[0];
		}

	}


	public function save_settings($data,$id)
	{
		$DB = new Database();
		$password= $data['password'];
		if ($data['password'] == $data['password2']) {
			$password= $data['password'];
		}else {
			unset($data['password']);
		}

		unset($data['password2']);
		$sql="update users set ";

		foreach ($data as $key => $value) {
			$sql .= $key . "='" . $value. "',";
			
		}

		$sql = trim($sql,",");
		$sql .= " where IdUser = '$id' limit 1";
		
		$DB->save($sql);





















	}





































	
}





?>