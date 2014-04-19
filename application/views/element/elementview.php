<?php 
$elementId = $elementDetail['id'];
//print_r($elementDetail);
?>
<script>
	var elementId = <?php echo $elementId; ?>;
</script>
<div class="ws-container" ng-app ng-view ng-cloak>
	
</div>
<script src="<?php echo base_url('static/js/elementapp/main.js') ?>" type="text/javascript" ></script>