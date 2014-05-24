<div class="ws-container">
    <div class="intro-header" style="background-image: url('http://upload.wikimedia.org/wikipedia/commons/0/04/Ahilya_Ghat_by_the_Ganges,_Varanasi.jpg')">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message ws-login-form">
                        <!-- <form action="<?php echo current_url(); ?>" method="post"> -->
                        <form action="<?php echo current_url(); ?>" method="post">
                        	<fieldset>
	                            <legend class="ws-header">Sign Up</legend>
	                            
	                            <!-- displaying success / error message -->
	                            <?php
	                                if(isset($postResult)){
	                            ?>
			                            <div class="alert alert-<?php if($postResult['status']){ echo "success"; }else{ echo "danger"; } ?>">
			                            	<button type="button" class="close" data-dismiss="alert">&times;</button>
			                            	<strong></strong> <?php echo $postResult['message']; ?>
			                            </div>
	                            <?php
	                                }
	                            ?>
	                            
	                            <div class="input-group margin-bottom-sm ws-margin-small">
	                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
	                                <input name="name" class="form-control" type="text" 
	                                	value="<?php if(isset($_POST['name'])) { echo trim($_POST['name']); } ; ?>" placeholder="Name" 
	                                	required="required" />
	                            </div>
	                            
	                          	<div class="input-group margin-bottom-sm ws-margin-small">
	                            	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
	                            	<input name="email" class="form-control" type="email" 
	                            		value="<?php if(isset($_POST['email'])) { echo trim($_POST['email']); } ; ?>" 
	                            		placeholder="Email address" required="required" />
	                          	</div>
		                      	
		                      	<div class="input-group ws-margin-small">
		                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
		                            <input name="password" class="form-control" type="password" placeholder="Password" required="required" />
		                        </div>
	                          	
	                          	<div class="center-block center input-group ws-margin-small">
	                                <div class="center-block center col-lg-6">
	                                    <input type="submit" class="btn btn-primary" value="Submit" />
	                                    <br /><br />
	                                </div>
	                          	</div>
	                            
	                            <div class="input-group ws-margin-small center-block">
	                                <button class="btn btn-social btn-primary" onclick="FB.initFBConnect();">
	                                	<i class="fa fa-facebook fa-fw"></i>Sign in with Facebook
	                                </button>
	                            </div>
	                            
	                            <div class="input-group ws-margin-small center-block">
	                                <button class="btn btn-social btn-danger" onclick="FB.initFBConnect();">
	                                	<i class="fa fa-google-plus fa-fw"></i>Sign in with Google+
	                                </button>
	                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->

    </div>
</div>
<script src="<?php echo base_url('static/js/demoapp/main.js') ?>" type="text/javascript" ></script>
