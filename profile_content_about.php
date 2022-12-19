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
 
 	
echo "<br>";
echo " <h5 style='color:#088dcd;'> About me : <br> </h5>
<div style='height:200px; text-align:center;'> ".htmlspecialchars($settings['about'])."</div>";



 
 }
 


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
