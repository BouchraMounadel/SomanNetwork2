</aside>
							</div>


<!-------------------------------------------------------- sidebar -------------------------------------------------------->




							<div class="col-lg-6">

								<div class="central-meta item">
									<div class="newpst-input">


												

													

													
												







											</div>


<form method="post" enctype="multipart/form-data">

<?php 

 $settings_class= new Settings();
 $settings=$settings_class->get_settings($_SESSION['SomanNetwork_IdUser']);

 if (is_array($settings)) {
 	echo "<input type='text' id='textbox' value='".htmlspecialchars($settings['prenom'])."' name='prenom' placeholder='prénom' style='width: 80% ; margin:10px;' />";
echo "<input type='text' value='".htmlspecialchars($settings['nom'])."' placeholder='nom' id='textbox' name='nom' style='width: 80% ; margin:10px;' />";

echo "<input type='text' placeholder='School' value='".htmlspecialchars($settings['school'])."' id='textbox' name='school' style='width: 80% ;margin:10px;' />";

echo "<input type='text' placeholder='email' id='textbox' name='email' value='".htmlspecialchars($settings['email'])."' style='width: 80% ; margin:10px;' />";

echo "<input type='password' placeholder='Password' value='".htmlspecialchars($settings['password'])."'  id='textbox' name='password' style='width: 80% ;margin:10px;' />";


echo "<input type='password' placeholder='Retype password'value='".htmlspecialchars($settings['password'])."'  id='textbox' name='password2' style='width: 80% ;margin:10px;' />";
 }
echo "<br>";
echo " About me : <br>
<textarea name='about' style='height:200px;'>".htmlspecialchars($settings['about'])."</textarea>";



 echo '<button type="submit" style:"text-align:center;">Save</button>';
 


?></form>



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
