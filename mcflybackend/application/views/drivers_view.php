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
                        <!--<th style="text-align: center; ">Photo</th>-->
                        <th style="text-align: center; ">Driver Name</th>
                        <th style="text-align: center; ">Email</th>
                        <th style="text-align: center; ">Phone #</th>
                        <th style="text-align: center; ">Password</th>
                        <th style="text-align: center; ">Working Status</th>
                        <th style="text-align: center; ">Account Status</th>
                      
                        <th style="text-align: center; ">Settings</th>
                    </tr>
                </thead>
                <tbody>                         
                <?php $k = 0;
                    foreach ($clients_data as $client){ 
                        $k++;
                ?>
                    <tr>
                        <td style="text-align: center; "><?=$k?></td>
                        <td style="text-align: center; "><?= $client->driver_id ?></td>
                        <!--<?php
                            if($client->admin_photourl){
                        ?>
                        <td style="text-align: center;;">
                            <img class="img-thumbnail" style="margin-top: 1px; margin-bottom: 1px; margin-left: 1px; margin-right: 1px;" onclick="image(this)" src="<?= $client->admin_photourl ?>" />
                        </td>
                        <?php
                            } else {
                        ?>
                        <td style="text-align: center; ">
                            <img class="img-thumbnail" style="margin: 1px;" src="<?php echo base_url();?>skins/images/photo.png" alt="">
                        </td>    
                        <?php
                        }
                        ?>-->
                        <td style="text-align: center; "><?= $client->driver_name ?></td> 
                        <td style="text-align: center; "><?= $client->driver_email ?></td>
                        <td style="text-align: center; "><?= $client->driver_phone ?></td>
                        <td style="text-align: center; "><?= $client->driver_password ?></td>
                        <td style="text-align: center; "> <?php if($client->driver_status ==0){?> Free <?php } else{?> Working <?php }?> </td>
                        <td style="text-align: center; "><?php if($client->driver_accountstatus ==0){?> Active <?php } else{?> Inactive <?php }?></td>
                       
                 
                        <td style="text-align: center; ">  
                            <i class="fa fa-fw fa-user" onclick="driversDetail(<?= $client->driver_id ?>)"></i>
                            <i class="fa fa-eye" aria-hidden="true" onclick="driverordersDetail(<?= $client->driver_id ?>)"></i>
                            <i class="fa fa-trash-o" aria-hidden="true" onclick="deleteClient(<?= $client->driver_id ?>)"></i>                            
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
    
    function deleteClient(user_id){
        var r;
        r = confirm("Are you sure to delete this driver?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/deleteprovider/" + user_id;                
        }
    }

    function driversDetail(driver_id){
        location.href = "<?php echo base_url();?>"+"index.php/admin/driverDetail/" + driver_id;  
    }

    function driverordersDetail(driver_id){
        location.href = "<?php echo base_url();?>"+"index.php/admin/selecteddriver_ordersdetail/" + driver_id;  
    }
</script>    
