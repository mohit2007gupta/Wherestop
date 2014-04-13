<?php
$this->load->helper('file');
$placeDetail = array();
$placeDetail['name'] = "India";
$placeDetail['cover_image'] = "wherego.jpg"
?>
<div id="frontLayoutDiv">
<div id="frontContainer">
<div class="center">
    <?php
        $coverImageUrl = "static/assets/citycover/".$placeDetail['cover_image'];
        if(file_exists($coverImageUrl)){
            echo "<img style=\" width: 100%; height: 100%\" src=\"".base_url().$coverImageUrl."\" class=\"cityCover\" />";
        }
    ?>
</div>
<div id="frontElementWrapper">
<div id="frontElement" class="loginContainer">
    <div id="loginForm">
        <div id="loginMessageDiv"></div>
        <form>
            <fieldset>
                <legend><span>Reset your Wherestop account</span></legend>
                
              <div class="center"><input type="text" placeholder="Your email" /></div>
              <div class=" clear"></div>
              <div class="center"><button type="submit" class="btn btn-large submit">Sign In</button></div>
              <div><div class="signup-message">Don't have an account? <a href="<?php echo base_url("userauth/signup") ?>">Sign up</a></div></div>
            </fieldset>
        </form>
    </div>
</div>
</div>

</div>
</div>    