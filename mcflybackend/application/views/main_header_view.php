<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trial Drive</title>
        <meta charset="utf-8">
        <meta name="description" content="description">
        <!--<meta name="author" content="DevOOPS">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?php echo base_url();?>/skins/images/logoicon.png"/>
        
        <link href="<?php echo base_url();?>static/dashboard/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>static/dashboard/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>           
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="<?php echo base_url();?>static/dashboard/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/dashboard/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/css/base.less" rel="stylesheet">
        <link href="<?php echo base_url();?>static/dashboard/plugins/select2/select2.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/dashboard/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/dashboard/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/dashboard/css/AdminLTE.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>static/dashboard/css/_all-skins.min.css" rel="stylesheet">
          <link href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
        
        <script src="<?php echo $this->config->base_url();?>static/dashboard/js/bootstrap3.3.4.min.js"></script>     
        <script src="<?php echo $this->config->base_url();?>static/dashboard/js/jquery-2.1.1.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    
<body>
<!--Start Header-->

<!--<div id="modalbox">
    <div class="devoops-modal">
        <div class="devoops-modal-header">

            <div class="box-icons">
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="devoops-modal-inner">
        </div>
        <div class="devoops-modal-bottom">
        </div>
    </div>
</div>-->
<header class="navbar">
    <div class="container-fluid expanded-panel">
        <div class="row">
            <div id="logo" class="col-xs-12 col-sm-2" style="background-color:white;">
                <a href="#"><font color="#77bb55"> Trial Drive Admin</font></a>
            </div>
            <div id="top-panel" class="col-xs-12 col-sm-10">
                <div class="row">
                    <div class="col-xs-8 col-sm-4">
                        <a href="#" class="show-sidebar" style="color: #77bb55;">
                          <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    
                    <div class="col-xs-4 col-sm-8 top-panel-right" >
                        <ul class="nav navbar-nav pull-right panel-menu">   
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                    <div class="avatar">
                                        <img src="<?php echo base_url();?>static/dashboard/img/admin.png" class="img-rounded" alt="avatar" />
                                    </div>
                                    <i class="fa fa-angle-down pull-right"></i>
                                    <div class="user-mini pull-right" style="padding: 9px;">
                                        <span class="welcome">Manager</span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url();?>index.php/admin/logout">
                                            <i class="fa fa-power-off"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!--End Header-->