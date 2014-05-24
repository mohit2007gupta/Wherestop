<div class="ws-container">
	<div class="intro-header" 
		style="background-image: url('http://upload.wikimedia.org/wikipedia/commons/0/04/Ahilya_Ghat_by_the_Ganges,_Varanasi.jpg')">
	
		<div class="container">
			<div class="row">
			
				<div class="col-lg-12">
					<div class="intro-message ws-login-form">
						<form action="<?php echo current_url();?>" method="post" class="form-horizontal" role="form">
							<fieldset>
								<legend class="ws-header">Forgot Password</legend>
								
								<?php 
									if (isset($postResult)) {
										$sessionData = $this->session->all_userdata();
								?>
										<div class="alert alert-<?php if($postResult['status']){echo "success";}else{echo "danger";}?>">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong></strong> <?php echo $postResult['message']; ?>		
										</div>
								<?php 
									}
								?>
								
								<div class="input-group margin-bottom-sm ws-margin-small">
									<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
									<input class="form-control" name="email" type="email" placeholder="Email address" required="required">
								</div>
								
								<input type="submit" value="Send Mail" class="btn btn-info" />
							</fieldset>
						</form>
					</div>
				</div>
			
			</div> <!-- /.row -->
		</div><!-- /.container -->
	
	</div><!-- /.intro-header -->
</div><!-- /.ws-container -->