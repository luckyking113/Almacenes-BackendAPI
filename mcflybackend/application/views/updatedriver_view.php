<!--<div class="row">           
    <div id="breadcrumb" class="col-md-12">
        <ol class="breadcrumb">  
        
            <li ><h3>Add New Store</h3></li> 
            
        </ol>
    </div>
</div>-->

<div class="row" style = "padding-top: 0px;" style="background-color:<?php if($this->session->userdata('login_adminID')==1){ echo "#e0ad00"; }else{ echo "#77bb55"; } ?>;">
    <div id="breadcrumb" class="col-md-12" style="background-color:<?php if($this->session->userdata('login_adminID')==1){ echo "#e0ad00"; }else{ echo "#77bb55"; } ?>;">
  
        <ol>
            <h4><font color="white">Update Driver</font></h4> 
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
            <form role="form" id = "main-form" action = "<?php echo base_url();?>index.php/Admin/updateDriver" method="POST" enctype="multipart/form-data">
                <!-- Provider -->
                <div class="box-body">
                   <input type="hidden" name = "proid" value = "<?= $clients_data[0]->driver_id ?>">

               <!-- <div class="form-group">
                  <label for="exampleInputFile">Profile Photo</label>
                  <input type="file"  name = "proProfileImage" onchange="readURL(this)" required>
                  <img id="proProfileImage_11" style="margin-top: 20px;" width="80" height="80" src = "#">
                  <p class="help-block ">Please upload image in jpg, png format.</p>
                </div>  -->
                
                <div class="form-group">
                  <label for="drivername">Driver Name</label>
                  <input type="text" class="form-control " name = "drivername" value = "<?= $clients_data[0]->driver_name ?>" required>
                </div>
                
                <div class="form-group">                                                                                                                        
                  <label for="driveremail">Driver Email</label>
                  <input type="text" class="form-control " name = "driveremail" value = "<?= $clients_data[0]->driver_email ?>" required>
                </div>
                <div class="form-group">
                  <label for="phonenumber">Driver Phone Number</label>
                  <input type="number" class="form-control " name = "phonenumber" value = "<?= $clients_data[0]->driver_phone ?>" required>
                </div>
                
                <div class="form-group">
                  <label for="password">Driver Password</label>
                  <input type="text" class="form-control " name = "password" value = "<?= $clients_data[0]->driver_password ?>" required>
                </div>
                <div class="form-group">
                  <label for="workstatus">Work Status</label>
                    <select class="form-control" id="workstatus" name="workstatus">
                        <option <?php if($clients_data[0]->driver_status ==0) { echo "selected"; }?>>Free</option>
                        <option <?php if($clients_data[0]->driver_status ==1) { echo "selected"; }?>>Working</option>                
                    </select>
                </div>
                <div class="form-group">
                  <label for="accountstatus">Account Status</label>
                  <select class="form-control" id="accountstatus" name="accountstatus">                   
                    <option <?php if($clients_data[0]->driver_accountstatus ==0) { echo "selected"; }?>>Active</option>
                    <option <?php if($clients_data[0]->driver_accountstatus ==1) { echo "selected"; }?>>Inactive</option>               
                  </select>
                </div>
               
                
              <div class="box-footer">
                <button type="submit" class="btn btn-primary input-lg col-lg-12" >Update Driver</button>
              </div>
            </form>
          </div>
     </div>
</div>


<script type="text/javascript">
    $("#main-form").validate({
        rules: {
            proFirstName: "required",
            proLastName: "required",
            proEmail: "required",
            proPassword: "required",
            proCity: "required",
            proAddress: "required",
            proCompany: "required"
        }
    });
    

</script>

<script type="text/javascript">
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