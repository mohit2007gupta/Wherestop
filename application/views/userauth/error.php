<div class="ws-container">
	<div class="intro-header" 
		style="background-image: url('http://upload.wikimedia.org/wikipedia/commons/0/04/Ahilya_Ghat_by_the_Ganges,_Varanasi.jpg')">
	
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="intro-message ws-login-form">
						<?php 
							if (isset($message)) {
						?>
								<div class="alert alert-danger alert-dismissable">
									<strong>Warning!</strong>
									<?php echo $message;?>
									<?php 
										if(isset($link)){
											echo "<a title=\"".$link['title']."\" href=\"".$link['href']."\">".$link['label']."</a>";
										}
									?>
								</div>	
						<?php 
							}
						?>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
		
	</div><!-- /.intro-header -->
</div><!-- /.ws-container -->