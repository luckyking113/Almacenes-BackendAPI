<!--Start Container-->
<div id="main" class="container-fluid" >
    <div class="row">
        <div id="sidebar-left" class="col-xs-2 col-sm-2" style="background-color:<?php if($this->session->userdata('login_adminID')==1){ echo "#e0ad00"; }else{ echo "#77bb55"; } ?>;">
            <ul class="nav main-menu sidebar-menu">
                
                <li class = "dropdown"> 
                    <a class = "dropdown-toggle">  <!-- href="<?php echo base_url();?>index.php/admin/main"-->
                        <img src="<?php echo base_url();?>/skins/images/ic_jobs.png" alt="Mountain View" style="width:16px;height:16px;">
                        <span class="hidden-xs">&nbsp;Order Histories</span>
                    </a>
                       
                    <ul class="dropdown-menu">
                        <li><a  href="<?php echo base_url();?>index.php/admin/orderslists/All">Order List</a></li> 
                        <li><a  href="<?php echo base_url();?>index.php/admin/addorderview">Add New Order</a></li>
                    </ul>         
                </li>
                
                
                
                <li class="dropdown">
                    <a  class = "dropdown-toggle">
                        <i class="fa fa-group"></i>
                        <span class="hidden-xs">Drivers</span>
                    </a>
                    <ul class="dropdown-menu">
                         <li><a  href="<?php echo base_url();?>index.php/admin/driverlists">Driver List</a></li> 
                        <li><a  href="<?php echo base_url();?>index.php/admin/adddriver">Add New Driver</a></li>
                    </ul>
                </li>
                
                <!--
                <li class="dropdown">
                    <a  href = "#" class="dropdown-toggle">      
                        <i class="fa fa-wrench"></i>
                        <span class="hidden-xs">Version Management</span>
                    </a>
                        <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>index.php/admin/versionInfo">Version Info</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </div>
                 
        <!--Start Content-->
        <div id="content" class="col-xs-12 col-sm-10">
            <div >        