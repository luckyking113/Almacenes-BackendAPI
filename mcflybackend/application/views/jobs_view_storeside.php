<!--container title part-->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/views/sub-admin/Ajax_timer_script/get_alarm_script.js"></script>



<div class="row" style = "padding-top: 0px;" style="background-color:#e0ad00;">
    <div id="breadcrumb" class="col-md-12" style="background-color:#e0ad00;">
        <ol>
            <h4><font color="white">Order History</font></h4> 
        </ol>
    </div>
</div>
<br>
<div id="wrapper">
    
<!-- <div id="page-wrapper" class="gray-bg"> -->
<div class="wrapper wrapper-content date_search">
        <div class="row">
        	<div class="setsize">
            <div class="col-lg-2">
                        <div class="ibox ibox-cutome ibox-cutome-1 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="open"></h1>
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Open Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction('open')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox ibox-cutome ibox-cutome-3 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="accept"></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Fulfilled Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction('accept')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="ibox ibox-cutome ibox-cutome-6 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="orderready"></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Order Ready For Pickup</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction('orderready')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="ibox ibox-cutome ibox-cutome-4 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="pick-up"></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Orders Enroute</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction('pick-up')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="ibox ibox-cutome ibox-cutome-2 float-e-margins">
                            <div class="ibox-content" style="background: transparent;color: #fff;">
                                <h1 class="no-margins" id="close"></h1>
                       
                            </div>
                        <div class="ibox-title" style="background: transparent;border: none;color: #fff;min-height: initial;padding: 0 8px 0 8px;">
                                <h5>Completed Orders</h5>
                            </div><div class="view-detail-link"><a onclick="myFunction('close')">View Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>    </a></div></div>
                    </div>
                    
                    </div>
           
     <form action="<?php echo base_url();?>index.php/Admin/search" method="post" id="searchform">
        <div class="form-group col-lg-12">
            <div class="col-lg-3"><div class="input-group date" id="datetimepicker1">
                <input type="text" class="form-control" placeholder="To Date" name="todate" id="todate" value="<?php if($this->session->userdata('date')!==""){ echo "".$this->session->userdata('date'); } ?>">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
  		</div>
          </div>
            

            <div class="form-group  col-lg-3"><input type="text" placeholder="Enter Order Id" class="form-control" name="order_id" id="order_id" value="<?php if($this->session->userdata('order_id')!==""){ echo "".$this->session->userdata('order_id'); } ?>"></div>
           <div class="form-group col-lg-3"><input type="text" placeholder="Enter Delivery Id" class="form-control" name="delivery_id" id="delivery_id" value="<?php if($this->session->userdata('delivery_id')!==""){ echo "".$this->session->userdata('delivery_id'); } ?>"></div>

            <div class="form-group col-lg-3"><button type="submit" name="formsubmit" id="formsubmit" value="submit" class="btn btn-primary" onClick="clearform();">Search</button></div></div>
           <!-- </div> -->
            
        </form>
                   
</div>
</div>
<!-- </div> -->
</div>     
<div class="box box-primary">  
  <div class = "box-body">
    <div class="row-fluid table-responsive">                
   <form name="submit_checkbox" method="POST" id="checkbox_form" action="<?php echo base_url();?>index.php/Admin/submit_checkbox">
         
     <table class="table table-bordered table-striped table-hover table-heading table-datatable content-fluid" id="datatable-1">
         <thead>
              <tr>
              	  <th id="select_box" style="text-align: center; display: none; ">Select</th>
                  <th style="text-align: center; ">No</th>
                  <th id="delivery_input" style="text-align: center; display: none;">Delivery Id</th>
                  <th style="text-align: center; ">Order Id</th>  
                  <th id="buyer_name" style="text-align: center; ">Buyer Name</th>
                  <th id="customer_name" style="text-align: center; display: none; ">Customer Name</th>              
                  <th id="driver_name" style="text-align: center;">Driver Name</th>                  
                  <th style="text-align: center; ">Address</th>     
                   <!-- <th style="text-align: center; ">Product Name</th>           -->
                  <th style="text-align: center; ">Cost</th>    
                  <th style="text-align: center; ">Status</th>              
                 
                  <?php if($this->session->userdata('login_adminID')==1){?>
                      <th style="text-align: center; ">Shop Name</th>
                  <?php } ?>
                   <th style="text-align: center; ">Details</th>
              </tr>
         </thead>
         	
         	
         
          <tbody style="text-align:center;" id="tbodyid">
          </tbody>
     </table>
     <div class="go_submit pull-right" style="display: none;"> 
     	<input type="hidden" name="check_form" id="check_form" value="open" />
      <div class="col-lg-6" id="delivery_field" style="display: none;"><input type="hidden" placeholder="Enter Delivery Id" class="form-control" name="delivery_id_text" id="delivery_id_text" value=""></div>
      <div><input type="submit" class="btn btn-primary" value="Ready For Pick Up" /></div>
      </div>
    
     
    <!-- <input type="text" placeholder="Enter Delivery Id" class="delivery_id" />
     <button>Go</button>-->
     
     <!--<div class="go_submit_accept pull-right" style="display: none;"> 
      <input type="hidden" name="check_form" value="accept" />
      
      <div class="col-lg-4"><input type="submit" class="btn btn-primary" value="GO" /></div>
     </div>-->
     </form>
     </div>
     
     
     
     
    <!-- <input type="text" placeholder="Enter Delivery Id" class="delivery_id" />
     <button>Go</button>-->
     
     
     <!--<div class="box-footer">
        <a type="button" class="btn btn-primary col-md-12" href="<?php echo base_url();?>index.php/Admin/EM_addEmployee" >Add New  Employee</a>                   
     </div>-->
     
     </div>
  </div>
</div>

<script type="text/javascript">
    
    function deleteJob(job_id){
        var r;
        r = confirm("Are you sure to delete this Job?");
        
        if (r == true) {     
            
            location.href = "<?php echo base_url();?>"+"index.php/admin/deleteJob/" + job_id;                
        }
    }
</script> 



<script language="javascript" type="text/javascript">

   var status="all";
   /* updateAlarmCount();*/
//  
    $('body').on('change', '.detail_select', function() {
  		var $val = $("option:selected",this).val();
  		window.location.href = $val;
});
   // $('#detail_id').change(function() {
    // set the window's location property to the value of the option the user has selected
  
//});
    $('#datetimepicker1').datetimepicker({
            sideBySide: true,
            format : 'YYYY/MM/DD',
        });
//setInterval(myFunction, 10000);
var interval=null;
    jQuery(document).ready(function () {
        //status="all";
        setInterval(function(){ myFunction(status); },60000);
        //setInterval(myFunction, 10000);
        //console.log("here");
       //interval= setInterval(myFunction, 10000);
       
        myFunction(status);
        changeCount();
        setInterval(changeCount, 60000);
       // myFunction();
       /* setInterval(function(){ updateAlarmCount(); },3000);*/
    });
   
    function myFunction(statusa){
    	$('#buyer_name').css({'display':'block'});
		$('#customer_name').css({'display':'none'});
		$('#driver_name').css({'display':'table-cell'});
    	$("#select_box").hide();
    	$(".go_submit").hide();
    	$("#delivery_field").hide();
        var date=null;
        status=statusa;
        console.log(status);
        var date=document.getElementById('todate').value;
        var orderid=document.getElementById('order_id').value;
        var deliveryid=document.getElementById('delivery_id').value;
        console.log(date);
        console.log(orderid);
        $.ajax({
            type: 'POST',
            data: {id: "",
            status: status,
            date: date,
            orderid: orderid,
            deliveryid: deliveryid},
            url: "<?php echo base_url();?>index.php/admin/getAlarmsForFamilyID",
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
                            JSONObject[index].buyer_name,
                            JSONObject[index].driver_name,
                            JSONObject[index].buyer_address,
                           // JSONObject[index].productname,                      
                            JSONObject[index].cost,
                            JSONObject[index].status,
                         	JSONObject[index].shop_name,
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
               	
                if(status=="open"){
                    	var alarmsTableRow = function (ignore, index) {
                    	$("#select_box").hide();
                    	$("#delivery_input").hide();
                    	$("#delivery_field").hide();
                    	//$(".go_submit").show();
                    	$("#check_form").val("open");
                    	$('#buyer_name').val();
                    	$('#buyer_name').css({'display':'none'});
                    	$('#customer_name').css({'display':'block'});
                    	$('#driver_name').css({'display':'none'});
                    	//$(".go_submit_accept").hide();
                    	//var checkbox='<input type="checkbox" id="'+JSONObject[index].order_id+ '" name="'+JSONObject[index].order_id+ '" />';
                    	var baseurl="<?php echo base_url();?>";
                    	detail_select='<select class="detail_select"><option value="0">Select Detail</option><option value="'+baseurl+'index.php/admin/viewjobdetail/'+JSONObject[index].order_id+'">Order Detail</option></select>';
	                    return createTableRow([
	                    	//checkbox,
	                        JSONObject[index].No,
	                        JSONObject[index].order_id,
	                        JSONObject[index].buyer_name,
	                        //JSONObject[index].driver_name,
	                        JSONObject[index].buyer_address,
	                       // JSONObject[index].productname,                      
	                        JSONObject[index].cost,
	                        JSONObject[index].status,
	                       // JSONObject[index].detail,
	                       detail_select
	                        // JSONObject[index].shop_name,
	                    ]);
	                };
                    }
                    else if(status=="accept"){
                    	var alarmsTableRow = function (ignore, index) {
                    	$("#select_box").show();
                    	$("#delivery_input").hide();
                    	$(".go_submit").show();
                    	$("#check_form").val("accept");
                    	$("#delivery_field").show();
                    	$("input#delivery_id_text").prop('required',true);
                    	
                    	
                    	
                    	
                    	var checkbox='<input type="checkbox" id="'+JSONObject[index].order_id+ '" name="'+JSONObject[index].order_id+ '" />';
                    	//var random=makeid();
                    	$("input#delivery_id_text").val(makeid());
                    	var baseurl="<?php echo base_url();?>";
                    	detail_select='<select class="detail_select"><option value="0">Select Detail</option><option value="'+baseurl+'index.php/admin/viewjobdetail/'+JSONObject[index].order_id+'">Order Detail</option></select>';
	                    return createTableRow([
	                    	checkbox,
	                        JSONObject[index].No,
	                        JSONObject[index].order_id,
	                        JSONObject[index].buyer_name,
	                        JSONObject[index].driver_name,
	                        JSONObject[index].buyer_address,
	                       // JSONObject[index].productname,                      
	                        JSONObject[index].cost,
	                        JSONObject[index].status,
	                       // JSONObject[index].detail,
	                       detail_select
	                        // JSONObject[index].shop_name,
	                    ]);
	                };
                    }
                    else{
                    	$("#delivery_input").show();
                    	var alarmsTableRow = function (ignore, index) {
                    	
                    	if(JSONObject[index].status=='<font style="color: #00a65a";>Open</font>' || JSONObject[index].status=='<font style="color: #00acd7";>Fulfilled</font>'){
                    		var baseurl="<?php echo base_url();?>";
                    		detail_select='<select class="detail_select"><option value="0">Select Detail</option><option value="'+baseurl+'index.php/admin/viewjobdetail/'+JSONObject[index].order_id+'">Order Detail</option></select>';
                    		
                    		return createTableRow([
		                        JSONObject[index].No,
		                        JSONObject[index].delivery_id,
		                        JSONObject[index].order_id,
		                        JSONObject[index].buyer_name,
		                        JSONObject[index].driver_name,
		                        JSONObject[index].buyer_address,
		                       // JSONObject[index].productname,                      
		                        JSONObject[index].cost,
		                        JSONObject[index].status,
		                      //  JSONObject[index].detail,
		                        detail_select
		                        // JSONObject[index].shop_name,
		                    ]);
                    	}
                    	else{
                    		var baseurl="<?php echo base_url();?>";
	                    	deliver_detail='<a href="'+baseurl+'index.php/admin/viewdeliverydetail/"'+JSONObject[index].delivery_id+'>Delivery Detail&nbsp;<i class="fa fa-commenting" aria-hidden="true"></i></a>';
		                    detail_select='<select class="detail_select"><option value="0">Select Detail</option><option value="'+baseurl+'index.php/admin/viewjobdetail/'+JSONObject[index].order_id+'">Order Detail</option><option value="'+baseurl+'index.php/admin/viewdeliverydetail/'+JSONObject[index].delivery_id+'">Delivery Detail</option></select>';
		                    return createTableRow([
		                        JSONObject[index].No,
		                        JSONObject[index].delivery_id,
		                        JSONObject[index].order_id,
		                        JSONObject[index].buyer_name,
		                        JSONObject[index].driver_name,
		                        JSONObject[index].buyer_address,
		                       // JSONObject[index].productname,                      
		                        JSONObject[index].cost,
		                        JSONObject[index].status,
		                        //JSONObject[index].detail+'|'+JSONObject[index].delivery_detail,
		                        detail_select
		                        // JSONObject[index].shop_name,
		                    ]);
                    	}
                    	
	                };
                  }
                    
                $('#tbodyid').append(
                    $.map(JSONObject, alarmsTableRow)
                );
                }
                
                
                
            }
        });
    } // end of myFunction
    
    // get your select element and listen for a change event on it

    
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
                if(JSONObject.status_orderready!=null){
                    document.getElementById("orderready").innerHTML = JSONObject.status_orderready.total;
                }else{
                    document.getElementById("orderready").innerHTML = "0";
                }
            }
        });
    }
    
    function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 5; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
    
   // function getOrderHistoryByStatus(status){
           // $.ajax({
            // type: 'POST',
            // data: {status: status},
            // url: "<?php //echo base_url();?>index.php/admin/getAllJobsDataByStatus",
            // dataType: 'json',
            // success: function(JSONObject) {
                // clearInterval(interval); 
                // // setTimeout(function(){myFunction();}, 10000);
                // $("#tbodyid").empty(); // clean all table data
//                 
                // function createTableRow(cells) {
                    // var tds = cells.map(function (cellContent) {
                        // return '<td>' + cellContent + '</td>';
                    // }).join('');
                    // return '<tr>' + tds + '</tr>';
                // }
//                 
                // var alarmsTableRow = function (ignore, index) {
                    // return createTableRow([
                        // JSONObject[index].No,
                        // JSONObject[index].buyer_name,
                        // JSONObject[index].driver_name,
                        // JSONObject[index].buyer_address,
                        // JSONObject[index].productname,                      
                        // JSONObject[index].cost,
                        // JSONObject[index].status,
                        // JSONObject[index].detail,
                    // ]);
                // };
//                 
                // $('#tbodyid').append(
                    // $.map(JSONObject, alarmsTableRow)
                // );
            // }
        // });
   // }
    
</script>
<?php
        if($this->session->flashdata('message')){
        ?>
        <script>
            alert('<?=$this->session->flashdata('message')?>');
        </script>
        
      
        
        <?php
        }
?>     
      