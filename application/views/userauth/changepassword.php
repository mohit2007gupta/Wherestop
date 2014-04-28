<div class="ws-container">
	<div class="intro-header" 
		style="background-image: url('http://upload.wikimedia.org/wikipedia/commons/0/04/Ahilya_Ghat_by_the_Ganges,_Varanasi.jpg')">
	
		<div class="container">
			<div class="row">
			
				<div class="col-lg-12">
					<div class="intro-message ws-login-form">
						<form action="<?php echo current_url();?>" method="post" class="form-horizontal" role="form">
							<fieldset>
								<legend class="ws-header">New Password</legend>
								
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
								
								
								<div class="input-group ws-margin-small">
									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
									<input class="form-control" name="password" type="password" placeholder="Password" required="required">
								</div>
								
								<div class="input-group ws-margin-small">
									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
									<input class="form-control" name="repassword" type="password" placeholder="Re-Type Password" required="required">
								</div>
								
								<input type="submit" value="Submit" class="btn btn-info" />
							</fieldset>
						</form>
					</div>
				</div>
			
			</div><!-- /.row -->
		</div><!-- /.container -->
		
	</div><!-- /.intro-header -->
</div><!-- /.ws-container -->