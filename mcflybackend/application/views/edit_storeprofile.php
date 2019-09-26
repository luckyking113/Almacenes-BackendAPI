
<!--<div class="row">           
    <div id="breadcrumb" class="col-md-12">
        <ol class="breadcrumb">  
        
            <li ><h3>Add New Store</h3></li> 
            
        </ol>
    </div>
</div>-->
<div class="row" style = "padding-top: 0px;" style="background-color:#e0ad00;">
    <div id="breadcrumb" class="col-md-12" style="background-color:#e0ad00;">
        <ol>
            <h4><font color="white">Edit Profile</font><a href="<?php echo $this->config->base_url(); ?>index.php/admin/store_main" type="button" class="pull-right"><img style="width: 60px; height: 45px; margin-top: -11px;" src="<?php echo $this->config->base_url(); ?>uploadfiles/images/image.png" /></a></h4> 
        </ol>
    </div>
</div>
<br>



<div class="row container-fluid">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          <?php echo validation_errors(); ?>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" onsubmit="validatePassword()"  id = "main-form" action = "<?php echo base_url();?>index.php/Admin/updateStore"  method="POST" enctype="multipart/form-data">
                <!-- Provider -->
                <div class="box-body">
                   <input type="hidden" name = "proid" value = "">
					<h3 style="position: absolute; top: 10px; right: 10px; color: red;">Store ID: <?php echo $admin_info[0]->admin_id; ?></h3>
                <div class="form-group">
                  <label for="exampleInputFile">Profile Photo</label>
                  <input type="file"  name = "proProfileImage" onchange="readURL(this)" >
                 <!-- <img id="proProfileImage_11" style="margin-top: 20px;" width="80" height="80" src = "#">-->
                  
                  <img id="proProfileImage_11" class="img-thumbnail" style="margin-top: 1px; margin-bottom: 1px; margin-left: 1px; margin-right: 1px; width: 120px; height: 120px" onclick="image(this)" src="<?= $admin_info[0]->admin_photourl ?>" />
                  
                  
                  <p class="help-block ">Please upload image in jpg, png format.</p>
                </div>
                
                <div class="form-group">
                  <label for="username">Store Name</label>
                  <input type="text" class="form-control " name = "storename" value = "<?= $admin_info[0]->admin_storename ?>" required>
                </div>
                
                <div class="form-group">                                                                                                                        
                  <label for="username">Store Manager Name</label>
                  <input type="text" class="form-control " name = "managername" value = "<?= $admin_info[0]->admin_managername ?>" required>
                </div>
                <div class="form-group">
                  <label for="idnumber">Phone Number</label>
                  <input type="text" class="form-control " name = "phonenumber" value = "<?= $admin_info[0]->admin_phonenumber ?>" required>
                </div>
                
                <div class="form-group">
                  <label for="idnumber">Email</label>
                  <input type="text" class="form-control " name = "email" value = "<?= $admin_info[0]->admin_email ?>" required>
                </div>
                
                <div class="form-group">
                  <label for="type">Password</label>
                  <input type="text" class="form-control "  name = "password" value = "<?= $admin_info[0]->admin_password ?>" required>
                </div>
                
                <!--<div class="form-group">
                  <label for="password">City</label>
                  <select class="form-control" id="proCity" name="proCity">
                    <option>San Francisco</option>
                    <option>New York</option>
                    <option>Chicago</option>
                    <option>Denver</option>
                  </select>
                </div>-->
                
                <div class="form-group">
                  <label for="password">Address</label>
                  <input type="text" class="form-control "  name = "address" value = "<?= $admin_info[0]->admin_address ?>" required>
                </div>
                <div class="form-group">
                	<div class="row">
                		<div class="col-md-6" style="padding-left:0; padding-right:0;">
                			<label class="col-sm-2" style="text-align: left; margin-right:10px;">Employees</label>
                	
		                	<select multiple="" id="employees" name="employees" style="width: 100%; max-width: 283px;">
		                		<option>Click on name to remove</option>
		                		<?php foreach ($employees_store as $key ) { if($key->employee_id!=''){ ?>
		                			<option class="open-AddBookDialog-delete " data-toggle="modal" data-target="#deleteModal" data-id="<?php  echo $key->employee_id; ?>"  value="<?php echo $key->employee_id; ?>" ><?php echo $key->employee_first_name. " ". $key->employee_last_name; ?></option>
								<?php	} } ?>
		                	</select>
                	
                		</div>
                		<div class="col-md-6">
                		<label class="col-sm-3" style="text-align: left; margin-right:10px;">ADD Employee</label>
                	<input type="text"  name="add_employee" id="add_employee" placeholder="Enter Employee Name"/>
                	<a type="button" data-toggle="modal" data-target="#addModal" id="add_employee_button"  class="btn btn-primary  open-AddBookDialog-add" disabled>ADD</a>
                	</div>
                	</div>
                </div>	<!-- /end form-group -->
       
               <!-- <div class="form-group">
                  <label for="password">Company</label>
                  <input type="text" class="form-control "  name = "proCompany" value = "" required>
                </div> -->  <!-- End of Provider info -->
                
              <div class="box-footer">
                <button type="submit" class="btn btn-primary input-lg col-lg-12" >Update Profile</button>
              </div>
            </form>
          </div>
     </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align: center;"><strong>Are you sure you want to remove this employee?<br />
       </strong></p>
       <div class="col-sm-12" style="margin-top: 10px">
       		<label>Enter Password</label>
	        <input type="Password" name="password" id="password"/>
	    </div>
        <div class="col-sm-6 " style="margin-top: 15px">
	        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">NO</button>
	    </div>
	     <div class="col-sm-6 " style="margin-top: 15px">
	        <a href="" id="cancel_del" class="btn btn-danger pull-left" disabled="">Yes</a>
	    </div>
       	<div class="col-md-12">&nbsp;</div>
	    	<div style="clear:both"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align: center;"><strong>Enter password to add employee?<br />
       </strong></p>
       <div class="col-sm-12" style="margin-top: 10px">
       		<label>Enter Password</label>
	        <input type="Password" name="password_add" id="password_add"/>
	    </div>
        <div class="col-sm-6 " style="margin-top: 15px">
	        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">NO</button>
	    </div>
	     <div class="col-sm-6 " style="margin-top: 15px">
	        <a href="" id="cancel_del_add" class="btn btn-danger pull-left" disabled="">Yes</a>
	    </div>
       	<div class="col-md-12">&nbsp;</div>
	    	<div style="clear:both"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    // $("#main-form").validate({
        // rules: {
            // proFirstName: "required",
            // proLastName: "required",
            // proEmail: "required",
            // proPassword: "required",
            // proCity: "required",
            // proAddress: "required",
            // proCompany: "required"
        // }
    // });
     // $(document).ready(function() {
            // //option A
            // $("form").submit(function(e){
                // alert('submit intercepted');
                // e.preventDefault(e);
            // });
        // });
	
	function remove(employee_id){
		console.log(employee_id);
	}
	
	
    function validatePassword(){
   			
    }
</script>

<script type="text/javascript">
//$('#add_employee_button').attr("disabled","disabled");
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#proProfileImage_11')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#password").on('change keyup paste', function() {
    	console.log('del');
		 var password = $("#password").val();
		 if(password==''){
		 	$('#cancel_del').attr("disabled","disabled");
		 	console.log('passwoednot');
		 }
		 var admin_id="<?php echo $this->session->userdata('login_adminID'); ?>";
		  $.ajax({
            type: 'POST',
            data: {admin_id: admin_id,
            password: password},
            url: "<?php echo base_url();?>index.php/admin/validatePassword",
            dataType: 'json',
            success: function(JSONObject) {
            	console.log(JSONObject);
             	if(JSONObject.total>0){
             		console.log('done');
             		$('#cancel_del').removeAttr("disabled");
             	}else{
             		$('#cancel_del').attr("disabled","disabled");
             	}
            }
        });
		 
    });
    
     $("#password_add").on('change keyup paste', function() {
    	console.log('add');
		 var password_add = $("#password_add").val();
		 if(password_add==''){
		 	$('#cancel_del').attr("disabled","disabled");
		 	console.log('passwoednot');
		 }
		 var admin_id="<?php echo $this->session->userdata('login_adminID'); ?>";
		  $.ajax({
            type: 'POST',
            data: {admin_id: admin_id,
            password: password_add},
            url: "<?php echo base_url();?>index.php/admin/validatePassword",
            dataType: 'json',
            success: function(JSONObject) {
            	console.log(JSONObject);
             	if(JSONObject.total>0){
             		console.log('done');
             		$('#cancel_del_add').removeAttr("disabled");
             	}else{
             		$('#cancel_del_add').attr("disabled","disabled");
             	}
            }
        });
		 
    });
    $("#add_employee").on('change keyup paste', function() {
		 var add_employee = $("#add_employee").val();
		// console.log(add_employee);
		// if(add_employee==''){
		 	$('#add_employee_button').removeAttr("disabled");
		//}
    });
    
    $(document).on("click", ".open-AddBookDialog-delete", function () {
	 var orgid = $(this).data('id');
	 old_href='<?php echo base_url()."index.php/admin/removeEmployee";?>';
	 new_href= old_href+"?id="+orgid;
	 $("#cancel_del").prop("href", new_href)
	 return false;
	});
	
	$(document).on("click", ".open-AddBookDialog-add", function () {
	 var orgid = $(this).data('id');
	 var employee_name=$('#add_employee').val();
	 old_href='<?php echo base_url()."index.php/admin/addEmployeeToStore";?>';
	 new_href= old_href+"?employee_name="+employee_name;
	 $("#cancel_del_add").prop("href", new_href)
	 return false;
	});
	
	function addEmployee () {
		var employee_name=$('#add_employee').val();
	   $.ajax({
            type: 'POST',
            data: {employee_name: employee_name},
            url: "<?php echo base_url();?>index.php/admin/addEmployeeToStore",
            dataType: 'json',
            success: function(JSONObject) {
            	console.log(JSONObject);
             	if(JSONObject.result!='no'){
             		$('#add_employee').val('');
             		location.reload(true);
             		console.log('inserted');
             	}else{
             		console.log('not insrted');
             	}
            }
        });
	}
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