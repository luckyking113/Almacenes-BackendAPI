<!DOCTYPE html>
<html lang="en">

<head>
    <title>BOLTR</title>    
    <link rel="shortcut icon" href="<?php echo base_url();?>skins/images/icon.ico">  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url(); ?>skins/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>skins/dist/css/sb-admin-2.css" rel="stylesheet" type="text/css">                              
    <link href="<?php echo base_url(); ?>skins/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</head>

<body>    
    
    <div class="container">
        <!-- login form-->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-custom-heading">
                        <h3 class="panel-custom-title" align="center">BOLTR Admin</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo base_url();?>index.php/admin/sendverifycode">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="admin_email" type="text" required autofocus>
                                </div>
                                
                                <br>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Send Verify Code">
                               </div>   
                                                              
                                
                            </fieldset>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>  

    </div><br><br><br><br><br><br><br>
          <div style="text-align: center; position: relative;"><label style="font: italic 40px serif !important; " >BOLTR, Delivery has never been faster!</label></div>
    <div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>  
          <div style="text-align: center; position: relative;"><label style="font: italic 20px serif !important; " >Contact Email :   support@boltr.com</label></div>
    <div>
</body>

</html>   

<?php
        if($this->session->flashdata('message')){
        ?>
        <script>
            alert('<?=$this->session->flashdata('message')?>');
        </script>
        
        
        
    
       function Forgot(){   
            location.href = "<?php echo base_url();?>"+"index.php/admin/Forgot";              
       
        }
        
        
        <?php
        }
?>     