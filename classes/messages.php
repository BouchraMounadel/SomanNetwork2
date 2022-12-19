<?php 

/**
 
 */
class Messages
{
	public function send($data,$files)
		{
			

			if (!empty($data['message']) || !empty($files['file']['name']) || (($data['latitude']!= "") )) {

				$myimage="";
				$has_image=0;
 
	
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
						
				}

				$message="";
				$latitude="";
				$longitude="";
				if (isset($data['latitude'])  && isset($data['longitude'])) {
					$latitude=$data["latitude"];
					$longitude=$data["longitude"];
				}
				
				if (isset($data['message'])) {
					$message = addslashes($data['message']);
				}

				if ($this->error == "") {
					
				

				$post=addslashes($data['message']);
				$msgid= $this->create_msgid();
			
				$DB= new Database();

				$sender=esc($SESSION_['SomanNetwork_IdUser']);
				$receiver=esc($_GET['id']);
				$file=esc($myimage);
				

				$query="insert into messages(sender,msgid,receiver,message,file,latitude,longitude)values('$sender','$msgid','$receiver','$message','$file','$latitude','$longitude')";

				
				$DB->save($query);

				
				}
			} else {
				$this->error .= "Please try sth here to send !<br>";
			}
			return $this->error;
		}

	
	











}


?>