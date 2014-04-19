<div class="ws-container">
    <div class="intro-header" style="background-image: url('http://upload.wikimedia.org/wikipedia/commons/0/04/Ahilya_Ghat_by_the_Ganges,_Varanasi.jpg')">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message ws-login-form">
                        <form action="<?php echo current_url(); ?>" method="post">
                            
                            <legend class="ws-header">Login</legend>
                            <?php
                                if(isset($postResult)){
                                    $sessionData = $this->session->all_userdata();
                                    ?>
                                    <div class="alert alert-<?php if($postResult['status']){ echo "success"; }else{ echo "danger"; } ?>">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong></strong> <?php echo $postResult['message']; ?>
                                    </div>
                                    <?php
                                    //echo "<pre>";
                                    //print_r($postResult);
                                    //echo "</pre>";
                                }
                            ?>
                            <div class="input-group margin-bottom-sm ws-margin-small">
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                            <input class="form-control" name="email" type="text" placeholder="Email address">
                          </div>
                          <div class="input-group ws-margin-small">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                            <input class="form-control" name="password" type="password" placeholder="Password">
                          </div>
                          <div class="input-group ws-margin-small">
                              <label class="checkbox">
                                <input type="checkbox"> Remember Me
                              </label>
                              <div class="row">
                                  <div class="center-block center col-lg-6">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                  <div class="center-block center col-lg-6">
                                      <a href="<?php echo base_url('userauth/signup'); ?>" type="submit" class="btn btn-danger">Sign Up</a>
                                  </div>
                              </div>
                              
                          </div>
                            <legend></legend>
                            <div class="input-group ws-margin-small center-block">
                                <button class="btn btn-social btn-primary" onclick="FB.initFBConnect();"><i class="fa fa-facebook fa-fw"></i>Sign in with Facebook</button>
                            </div>
                            <div class="input-group ws-margin-small center-block">
                                <button class="btn btn-social btn-primary" onclick="FB.initFBConnect();"><i class="fa fa-facebook fa-fw"></i>Sign in with Facebook</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
</div>
<script src="<?php echo base_url('static/js/demoapp/main.js') ?>" type="text/javascript" ></script>