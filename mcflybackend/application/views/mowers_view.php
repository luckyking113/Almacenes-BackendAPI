<!--container title part-->


<div class="row" style = "padding-top: 0px;" style="background-color:<?php if($this->session->userdata('login_adminID')==1){ echo "#e0ad00"; }else{ echo "#77bb55"; } ?>;">
    <div id="breadcrumb" class="col-md-12" style="background-color:<?php if($this->session->userdata('login_adminID')==1){ echo "#e0ad00"; }else{ echo "#77bb55"; } ?>;">
 
        <ol>
            <h4><font color="white">Drivers</font></h4> 
        </ol>
    </div>
</div>
<br>

<div class="box box-primary">  
    <div class = "box-body">
        <div class="row-fluid table-responsive">
            <table class="table table-bordered table-striped table-hover table-heading table-datatable content-fluid" id="datatable-1">
                <thead>
                    <tr>
                        <th style="text-align: center; ">No</th>
                        <th style="text-align: center; ">ID</th>
                        <th style="text-align: center; ">Photo</th>
                        <th style="text-align: center; ">Driver Name</th>
                       
                        <th style="text-align: center; ">Email</th>
                        <th style="text-align: center; ">Password</th>
                        <th style="text-align: center; ">Phone #</th>
                        <th style="text-align: center; ">Address</th>
                       
                        <th style="text-align: center; ">Settings</th>
                    </tr>
                </thead>
                <tbody>                         
                <?php $k = 0;
                    foreach ($mowers_data as $mower){ 
                        $k++;
                ?>
                    <tr>
                        <td style="text-align: center; "><?=$k?></td>
                        <td style="text-align: center; "><?= $mower->user_id ?></td>
                        <?php
                            if($mower->user_photourl){
                        ?>
                        <td style="text-align: center;;">
                            <img class="img-thumbnail" style="margin-top: 1px; margin-bottom: 1px; margin-left: 1px; margin-right: 1px;" onclick="image(this)" src="<?= $mower->user_photourl ?>" />
                        </td>
                        <?php
                            } else {
                        ?>
                        <td style="text-align: center; ">
                            <img class="img-thumbnail" style="margin: 1px;" src="<?php echo base_url();?>skins/images/photo.png" alt="">
                        </td>    
                        <?php
                        }
                        ?>
                        <td style="text-align: center; "><?= $mower->user_firstname." ".$mower->user_lastname ?></td>                        
                        <td style="text-align: center; "><?= $mower->user_email ?></td>
                        <td style="text-align: center; "><?= $mower->user_password ?></td>
                        <td style="text-align: center; "><?= $mower->user_phonenumber ?></td>
                        <td style="text-align: center; "><?= $mower->user_address ?></td>
                       <!-- <?php
                            if($mower->user_available == 0){
                                $strStatus = '<font style="color: #f50606";>Pending</font>';
                            } elseif ($mower->user_available == 1){
                                $strStatus = '<font style="color: #4CAF50";>Available</font>';
                            } elseif ($mower->user_available == 2){
                                $strStatus = '<font style="color: #9C27B0";>Busy</font>';
                            } 
                         ?>
                        <td style="text-align: center; ">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"><?= $strStatus ?>&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li role="presentation" style="background-color: #77bb55;" onclick="updatePending(<?= $mower->user_id ?>)">
                                        <a href="#">Pending</a>
                                    </li>
                                  
                                    <li role="presentation" style="background-color: #77bb55;" onclick="updateAvailable(<?= $mower->user_id ?>)">
                                        <a href="#">Available</a>
                                    </li>
                                    
                                    <li role="presentation" style="background-color: #77bb55;" onclick="updateBusy(<?= $mower->user_id ?>)">
                                        <a href="#">Busy</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td style="text-align: center; "><?= $mower->user_aboutme ?></td>-->
                 
                        <td style="text-align: center; ">
                        <button type="button" class="btn btn-info" onclick="deleteDelivery(<?= $mower->user_id ?>)">Info</button>
                           
                        </td>
                    </tr>
                <?php 
                    } // end of foreach
                ?>
                </tbody>
            </table>     
        </div>
    </div>
</div>
 

<script type="text/javascript">
    function image(img) {
        var src = img.src;
        window.open(src, "width=200,height=100");
    }

    function deleteDelivery(user_id){
       /* var r;
        r = confirm("Are you sure to delete this mower?");
        
        if (r == true) {   */  
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/gotoDetailpage/" + user_id;                
       // }
    }
    
    function updatePending(user_id){
        var r;
        r = confirm("Are you sure to update this status?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/updateMowerAvailable/" + user_id + "/" + 0;                
        }
    }
    
    function updateAvailable(user_id){
        var r;
        r = confirm("Are you sure to update this status?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/updateMowerAvailable/" + user_id + "/" + 1;                
        }
    }
    
    function updateBusy(user_id){
        var r;
        r = confirm("Are you sure to update this status?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/updateMowerAvailable/" + user_id + "/" + 2;
        }
    }
</script>


