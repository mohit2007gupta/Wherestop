<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wherestop | Explore Plan Share | </title>

    <?php 
        include('commonhead.php');
    ?>
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>static/img/logo.png" />
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Delhi NCR <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/mumbai") ?>">Mumbai</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/lucknow") ?>">Lucknow</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/kolkata") ?>">Kolkata</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/varanasi") ?>">Varanasi</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/udaipur") ?>">Udaipur</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/kashmir") ?>">Kashmir</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/delhi") ?>">Delhi</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("India/jaipur") ?>">Jaipur</a></li>
                          
                        </ul>
                    </li>
                    <li><a href="#services"><i class="fa fa-bell fa-fw"></i> </a>
                    </li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Mohit K <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("user/list"); ?>"><i class="fa fa-list fa-fw"></i> List</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("user/reviews"); ?>"><i class="fa fa-pencil fa-fw"></i> Reviews</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("user/network"); ?>"><i class="fa fa-users fa-fw"></i> Network</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("user/setting"); ?>"><i class="fa fa-gears fa-fw"></i> Setting</a></li>
                          <li role="presentation" class="divider"></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url("userauth/logout"); ?>"><i class="fa fa-user fa-fw"></i> Log out</a></li>
                        </ul>
                    </li>
                    </li>
                    <li>
                        <a href="<?php echo base_url('userauth/login'); ?>" role="button">Login</a>
                    <li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    
    
    