<!--container title part-->


<div class="row" style = "padding-top: 0px;" style="background-color:#e0ad00;">
    <div id="breadcrumb" class="col-md-12" style="background-color:#e0ad00;">
        <ol>
            <h4><font color="white">Order History of <?= $clients_data[0]->order_drivername ?></font></h4> 
        </ol>
    </div>
</div>
<div id="wrapper">
    
<!-- <div id="page-wrapper" class="gray-bg"> -->

</div>
<div class="box box-primary">  
  <div class = "box-body">
    <div class="row-fluid table-responsive">                
     <table class="table table-bordered table-striped table-hover table-heading table-datatable content-fluid" id="datatable-1">
         <thead>
              <tr>
                  <th style="text-align: center; ">No</th>
                  <th style="text-align: center; ">Track Id</th>
                  <th style="text-align: center; ">Driver Name</th>
                  <th style="text-align: center; ">Destination</th>
                  <th style="text-align: center; ">Assigned Time</th>
                  <th style="text-align: center; ">Started Time</th>     
                   <th style="text-align: center; ">Completed Time</th>  
                   <th style="text-align: center; ">Status</th>        
                  <!--<th style="text-align: center; ">Cost</th>   
                     -->
                  <th style="text-align: center; ">Settings</th>
              </tr>
         </thead>
        
            <tbody style="text-align:center;" id="tbodyid">
                 <?php $k = 0;
                    foreach ($clients_data as $client){ 
                        $k++;
                ?>
                    <tr>
                        <td style="text-align: center; "><?=$k?></td>
                        <td style="text-align: center; "><?= $client->track_id?></td>
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
                        <td style="text-align: center; "><?= $client->order_drivername ?></td> 
                        <td style="text-align: center; "><?= $client->order_destination ?></td>
                        <td style="text-align: center; "><?= $client->order_assignedtime ?></td>
                        <td style="text-align: center; "><?= $client->order_startedtime ?></td>
                        <td style="text-align: center; "><?= $client->order_completedtime ?></td>
                    <td style="text-align: center; "> <?php if($client->order_status ==0){echo "Assigned"; }elseif($client->order_status ==1){echo "Driving"; } elseif($client->order_status ==2){echo "Completed";} elseif($client->order_status ==3){echo "Paused";}?> </td>
                      
                        <td style="text-align: center; ">                             
                            <i class="fa fa-trash-o" aria-hidden="true" onclick="deleteClient(<?= $client->order_id?>)"></i>                            
                        </td>
                    </tr>
                <?php 
                    } // end of foreach
                ?>
            </tbody>
     </table>
     
     <!--<div class="box-footer">
        <a type="button" class="btn btn-primary col-md-12" href="<?php echo base_url();?>index.php/Admin/EM_addEmployee" >Add New  Employee</a>                   
     </div>-->
     
     </div>
  </div>
</div>



<script type="text/javascript">
    
    function deleteClient(job_id){
        var r;
        r = confirm("Are you sure to delete this Order item?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/deleteOrder/" + job_id;                
        }
    }
</script> 
      
<script language="javascript" type="text/javascript">
   var status="all";
     
  
    
</script>