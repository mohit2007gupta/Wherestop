<?php 
$cityCoverUrl = base_url("static/images/placecover/".$placeDetail['cover_image']);
?>
<div class="ws-container" style="background: url('<?php echo $cityCoverUrl; ?>'); background-size: cover">

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message ws-center-align ws-intro-message">
                    <h1><?php echo $placeDetail['name']; ?></h1>
                    <h3></h3>
                    <hr class="intro-divider">
                    <ul class="list-inline intro-social-buttons">
                        <li><a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-map-marker fa-fw"></i> <span class="network-name">Explore Nearby</span></a>
                        </li>
                        <li><a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-plus-circle fa-fw"></i> <span class="network-name">Add New</span></a>
                        </li>
                        <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-search fa-fw"></i> <span class="network-name">Search</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class='col-lg-6'>Hello</div>
            <div class='col-lg-6'>Bye</div>
        </div>
        
    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->


