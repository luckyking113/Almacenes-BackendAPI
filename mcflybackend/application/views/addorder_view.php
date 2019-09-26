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
            <h4><font color="white">Add New Order</font></h4> 
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
            <form role="form" id = "main-form" action = "<?php echo base_url();?>index.php/Admin/addOrders" method="POST" enctype="multipart/form-data">
                 <div class="box-body">
                   <input type="hidden" name = "proid" value = "">
                
                <div class="form-group">
                  <label for="trackid">Track ID</label>
                  <input type="text" class="form-control " name = "trackid" value = "" required>
                </div>
                <div class="form-group">
                  <label for="destination">Destination</label>
                  <input type="text" class="form-control " name = "destination" value = "" required>
                </div>
                
               
                <div class="form-group">
                  <label for="password">Select Driver</label>
                 
                  <select class="form-control" id="drivername" name="drivername">
                    <?php $k = 0;
                        foreach ($drivers_data as $client){ 
                            $k++;
                    ?>
                        <div class="box-body">                       
                        <option><?= $client->driver_name ?></option>                        
                    <?php 
                        } // end of foreach
                    ?>               
                  </select>
                </div>
                
              <div class="box-footer">
                <button type="submit" class="btn btn-primary input-lg col-lg-12" >Register New Order</button>
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