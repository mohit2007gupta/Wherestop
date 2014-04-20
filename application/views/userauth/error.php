<div class="ws-container">
	<section>
		<?php echo $message ?>
	</section>	
	
	<?php
		if(isset($status)){
			if (!$status) {
	?>
				<button value="Resend" >Resend Activation Link</button>		
    <?php
    		}
	    }
    ?>
	
</div>
