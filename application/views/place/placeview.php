<?php 
$cityCoverUrl = base_url("static/images/placecover/".$placeDetail['cover_image']);
$cityId = $placeDetail['id'];
?>
<script>
	var cityId = <?php echo $cityId; ?>;
</script>
<div class="ws-container" style="background: url('<?php echo $cityCoverUrl; ?>'); background-size: cover" ng-app ng-view>
	
</div>
<script src="<?php echo base_url('static/js/placeapp/main.js?place=aaa') ?>" type="text/javascript" ></script>