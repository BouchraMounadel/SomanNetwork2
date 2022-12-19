<?php



class Signup
{

	private $error = "";

	public function evaluate($data)
	{


		global $error;

		foreach ($data as $key => $value) {
			if(empty($value))
			{
				$this->error = $this->error . $key ."is empty!<br>";
			}


			if ($key=="email") {
				if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value)) {


					$this->error = $this->error . "invalid email address! <br>";
				}
			}



			if ($key=="first_name") {
				if (is_numeric($value) || strstr($value," ")) {


					$this->error = $this->error . "first name can't be numeric and can t contain spaces! <br>";
				}
			}



			if ($key=="last_name" ) {
				if (is_numeric($value)|| strstr($value," ")) {


					$this->error = $this->error . "last name can't be numeric and can't contain spaces! <br>";
				}
			}




		}

		if ($this->error == "") {

			
			$this->create_user($data);
			
		}else {
			return $this->error;
		}
		
	}



	public function create_user($data)
	{
		$first_name=ucfirst($data['first_name']);
		$last_name=ucfirst($data['last_name']);
		$email=$data['email'];
		$password=$data['password'];
		$sexe=$data['sexe'];
		$school=$data['school'];



		//create these
		$lienProfil=strtolower($first_name) . "." .strtolower($last_name);
		$IdUser=$this->create_userid();

		$query="insert into users(IdUser,nom,prenom,email,password,sexe,school,lienProfil) values ('$IdUser','$last_name','$first_name','$email','$password','$sexe','$school','$lienProfil')";

		//$sql="insert into likes(type,contentid,likes,following) VALUES ('user','$IdUser','[{'IdUser' : '$IdUser','date' : '2022-08-15 13:32:27'}]','[{'IdUser' : '$IdUser','date' : '2022-08-15 13:32:27'}]')";

		echo "$sql";

		
		$DB= new Database();
		$DB->save($query);
		//$DB->save($sql);
		
	}





	private function create_userid()
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