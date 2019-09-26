<!--container title part-->


<div class="row" style = "padding-top: 0px;" style="background-color:#e0ad00;">
    <div id="breadcrumb" class="col-md-12" style="background-color:#e0ad00;">
        <ol>
            <h4><font color="white">Order History</font></h4> 
        </ol>
    </div>
</div>
<div id="wrapper">
    
<!-- <div id="page-wrapper" class="gray-bg"> -->
<div class="wrapper wrapper-content date_search">
        <div class="row">
            <div class="col-lg-3">
                        <div class="ibox ibox-cutome ibox-cutome-1 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="open"><?= $dataarray["qtydata"]["total"] ?></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>All Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction1('All')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ibox-cutome ibox-cutome-3 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="accept"><?= $dataarray["qtydata"]["assigned"] ?></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Assigned Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction1('Assigned')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="ibox ibox-cutome ibox-cutome-4 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="pick-up"><?= $dataarray["qtydata"]["driving"] ?></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Driving Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction1('Driving')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                   <div class="col-lg-3">
                        <div class="ibox ibox-cutome ibox-cutome-2 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="close"><?= $dataarray["qtydata"]["completed"] ?></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Completed Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction1('Completed')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                    
                    
                    
<!--<form action="<?php echo base_url();?>index.php/Admin/search" method="post">-->
        <!--<div class="form-group col-lg-12">
            <div class="col-lg-4"><div class="input-group date" id="datetimepicker1">
                <input type="text" class="form-control" placeholder="To Date" name="todate" id="todate" value="<?php if($this->session->userdata('date')!==""){ echo "".$this->session->userdata('date'); } ?>">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
  </div>
            </div>
            

            <div class="col-lg-4"><input type="text" placeholder="Enter Order Id" class="form-control" name="order_id" id="order_id" value="<?php if($this->session->userdata('order_id')!==""){ echo "".$this->session->userdata('order_id'); } ?>"></div>
               <div class="col-lg-4"><button type="submit" class="btn btn-primary">Search</button></div></div>-->
           <!-- </div> -->
            
           <!-- </form>-->
        </div>
       
    <!-- </div> -->
<!--</div></div>-->
<h4><font color="red"><?= $dataarray["type"] ?> Order History</font></h4> 
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
                  <th style="text-align: center; ">Order Status</th>
                  <th style="text-align: center; ">Assigned Time</th>
                  <th style="text-align: center; ">Started Time</th>     
                   <th style="text-align: center; ">Completed Time</th>          
                  <!--<th style="text-align: center; ">Cost</th>   
                  <th style="text-align: center; ">Status</th>   -->
                  <th style="text-align: center; ">Settings</th>
              </tr>
         </thead>
        
         <tbody style="text-align:center;" id="tbodyid">
                <?php $k = 0;
                    foreach ($dataarray["orderdata"] as $client){ 
                        $k++;
                ?>
                    <tr>
                        <td style="text-align: center; "><?=$k?></td>
                        <td style="text-align: center; "><?= $client->track_id ?></td>
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
                        <td style="text-align: center; "> <?php if($client->order_status ==0){ echo "Assigned";} elseif($client->order_status ==1){echo "Driving";}elseif($client->order_status ==2){echo "Completed";} elseif($client->order_status ==3){echo "Paused";}?> </td>
                    
                        <td style="text-align: center; "><?= $client->order_assignedtime ?></td>
                        <td style="text-align: center; "><?= $client->order_startedtime ?></td>
                        <td style="text-align: center; "><?= $client->order_completedtime ?></td>
                        
                        <td style="text-align: center; ">                             
                            <i class="fa fa-trash-o" aria-hidden="true" onclick="deleteClient1(<?= $client->order_id ?>)"></i>                            
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
    function deleteClient1(job_id){
        var r;
        r = confirm("Are you sure to delete this Order item?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/deleteOrder1/" + job_id+"/"+"All";                
        }
    }
</script> 
      
<script language="javascript" type="text/javascript">
   var status="all";
     
      
    $('#datetimepicker1').datetimepicker({
            sideBySide: true,
            format : 'YYYY/MM/DD',
        });
//setInterval(myFunction, 10000);
var interval=null;
    jQuery(document).ready(function () {
        //status="all";
        setInterval(function(){ myFunction(status); },10000);
        //setInterval(myFunction, 10000);
        //console.log("here");
       //interval= setInterval(myFunction, 10000);
       
        myFunction(status);
        changeCount();
        setInterval(changeCount, 10000);
       // myFunction();
       /* setInterval(function(){ updateAlarmCount(); },3000);*/
    });
    function myFunction(statusa){
        var date=null;
        status=statusa;
        console.log(status);
        var date=document.getElementById('todate').value;
        var orderid=document.getElementById('order_id').value;
        console.log(date);
        console.log(orderid);
        $.ajax({
            type: 'POST',
            data: {id: "",
            status: status,
            date: date,
            orderid: orderid},
            url: "<?php echo base_url();?>index.php/admin/getAlarmsForFamilyIDAdmin",
            dataType: 'json',
            success: function(JSONObject) {
                // setTimeout(function(){myFunction();}, 10000);
                 // clean all table data
                
               
                var admin_id="<?php echo $this->session->userdata('login_adminID'); ?>";
                console.log(admin_id);
                if(admin_id==1){
                    $("#tbodyid").empty();
                     function createTableRow(cells) {
                    var tds = cells.map(function (cellContent) {
                        return '<td>' + cellContent + '</td>';
                    }).join('');
                    return '<tr>' + tds + '</tr>';
                }
                    var alarmsTableRow = function (ignore, index) {
                    return createTableRow([
                            JSONObject[index].No,
                            JSONObject[index].order_id,
                            JSONObject[index].shop_name,
                            JSONObject[index].buyer_name,
                            JSONObject[index].driver_name,
                            JSONObject[index].buyer_address,
                            JSONObject[index].productname,                      
                            JSONObject[index].cost,
                            JSONObject[index].status,
                            //JSONObject[index].shop_name,
                            JSONObject[index].detail,
                            
                        ]);
                    };
                    $('#tbodyid').append(
                    $.map(JSONObject, alarmsTableRow)
                );
                }else{
                    $("#tbodyid").empty();
                     function createTableRow(cells) {
                    
                    var tds = cells.map(function (cellContent) {
                        return '<td>' + cellContent + '</td>';
                    }).join('');
                    return '<tr>' + tds + '</tr>';
                }
                    var alarmsTableRow = function (ignore, index) {
                    return createTableRow([
                        JSONObject[index].No,
                        JSONObject[index].order_id,
                        JSONObject[index].buyer_name,
                        JSONObject[index].driver_name,
                        JSONObject[index].buyer_address,
                        JSONObject[index].productname,                      
                        JSONObject[index].cost,
                        JSONObject[index].status,
                        JSONObject[index].detail,
                        // JSONObject[index].shop_name,
                    ]);
                };
                $('#tbodyid').append(
                    $.map(JSONObject, alarmsTableRow)
                );
                }
                
                
                
            }
        });
    } // end of myFunction
    
    
    function changeCount(){
        $.ajax({
            type: 'POST',
            data: {id: "",
            status: status},
            url: "<?php echo base_url();?>index.php/admin/getcount",
            dataType: 'json',
            success: function(JSONObject) {
                // setTimeout(function(){myFunction();}, 10000);
                console.log(JSONObject);
                if(JSONObject.status_accept!=null){
                    document.getElementById("accept").innerHTML = JSONObject.status_accept.total;
                }else{
                    document.getElementById("accept").innerHTML = "0";
                }
                if(JSONObject.status_open!=null){
                    document.getElementById("open").innerHTML = JSONObject.status_open.total;
                }else{
                    document.getElementById("open").innerHTML = "0";
                }
                if(JSONObject.status_close!=null){
                    document.getElementById("close").innerHTML = JSONObject.status_close.total;
                }else{
                    document.getElementById("close").innerHTML = "0";
                }
                
                if(JSONObject.status_pickup!=null){
                    document.getElementById("pick-up").innerHTML = JSONObject.status_pickup.total;
                }else{
                    document.getElementById("pick-up").innerHTML = "0";
                }
            }
        });
    }

    function myFunction1(status){
        location.href = "<?php echo base_url();?>"+"index.php/admin/orderslists/" + status;  
    }
    
   
    
</script>