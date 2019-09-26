<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    
    function __construct(){
        
        parent::__construct();
		
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');      
        $this->load->library('session');
        $this->load->database();
        $this->load->model('admin_model'); 
        date_default_timezone_set('America/Chicago');      
    }
    
    private function doUrlDecode($p_text){
        $p_text = urldecode($p_text);
        $p_text = str_replace('&#40;', '(', $p_text);
        $p_text = str_replace('&#41;', ')', $p_text);
        $p_text = trim($p_text);
        return $p_text; //.test
    }
    
    function createKey(){        
        $time = explode(' ', microtime());
        $NameTime = substr($time[0], 2, 5);        
        $NameRand = mt_rand(0, 0xffff);
        $key = $NameRand.$NameTime; 
        $key = $key * 10 / 10;
        $len = strlen($key);        
        if($len < 16){
            for ($i = 0; $i < 16-$len; $i++)
              $key .= mt_rand(0,9);
        }
        //echo $key."-----".strlen($key);
        return $key;
    }
    
    
    function sessionCheck(){
      
        if (!$this->session->userdata('is_login')){
            redirect("/Admin/index");
        }
    }    
    
    function index(){
        $this->load->view('login_view');
    }
    
    function logout(){
        
        $this->session->sess_destroy();
        redirect('/Admin/index');        
    }
    

// login confirm called by login_view form
    function loginConfirm() {
    
        $admin_email    = $this->input->post('admin_email');
        $admin_password = $this->input->post('admin_password');
       
        $adminData = $this->db->where('admin_email', $admin_email)->get('tb_admin')->row();
      
        if (!empty($adminData)) { // if there is result, then compare password
            if ($admin_password == $adminData->admin_password) { // if the tmpPwd == admin password
                // register adminID into Session variable
                $this->session->set_userdata(array('is_login' => true, 'login_adminID' => $adminData->admin_id));   
                if($adminData->admin_id == 1){            
                  redirect('/admin/orderslists/All');                  
                }
                return;
            } else { // wrong password entered
                $this->session->set_flashdata('message',"Wrong password. Please try again.");
                redirect('/Admin/index');
            }    
        } else { // no such email
            $this->session->set_flashdata('message',"No such Email.");
            redirect('/Admin/index');
        }
        
    } //end of loginConfirm

   


    function adddriver(){
        $this->sessionCheck(); 
       $this->load->view('main_header_view');
       $this->load->view('main_container_view');
       $this->load->view('adddriver_view');
       $this->load->view('main_footer_view');
   }

   // to display clients out of tb_users table
   function driverlists(){   
        $this->sessionCheck();
                    
        $clients_data = $this->admin_model->getAlldriver(1); // get all clients-user_type==1
        
        $this->load->view('main_header_view');
        $this->load->view('main_container_view');
        $this->load->view('drivers_view', array('clients_data'=>$clients_data));
        $this->load->view('main_footer_view');
    }

    

    function addorderview(){
        $this->sessionCheck(); 

        $allavailabledrivers = $this->db->where('driver_status', 0)->where('driver_accountstatus', 0)->get('tb_driver')->result();

        $this->load->view('main_header_view');
        $this->load->view('main_container_view');
        $this->load->view('addorder_view',array('drivers_data'=>$allavailabledrivers));
        $this->load->view('main_footer_view');
    }

    function orderslists($filtertype){
        $this->sessionCheck();
                    
        $clients_data = $this->admin_model->getAllorders($filtertype); // All, Assigned, driving, completed
        $totalnumberoforders_pertype = $this->admin_model->getAllnumbers();

        $dataarray = array(
            "orderdata"=>$clients_data,
            "qtydata"=>$totalnumberoforders_pertype,
            "type"=>$filtertype,
        );
        
        $this->load->view('main_header_view');
        $this->load->view('main_container_view');
        $this->load->view('orders_view', array('dataarray'=>$dataarray));
        $this->load->view('main_footer_view');

    }

    function addProvider(){        
        $this->sessionCheck();   
        $this->load->helper('url');     
       $drivername = $this->input->post('drivername');
       $driveremail = $this->input->post('driveremail');
       $phonenumber = $this->input->post('phonenumber');
       $password = $this->input->post('password');
       $status = $this->input->post('status');

       $status = $this->admin_model->add_driver($drivername, $driveremail, $phonenumber, $password, $status);
       if($status == 1){
        echo ("Email Already exist!");
       }else if($status == 2){
        echo ("Phone Number already exist!");
       }else if($status == 3){
        redirect('Admin/driverlists');
       }   
    }

    function deleteprovider($user_id){
        $this->db->where('driver_id', $user_id);
        $this->db->delete('tb_driver'); 
        redirect('/admin/driverlists');
    }


    function driverDetail($driver_id){
        $this->sessionCheck();
                    
        $clients_data = $this->admin_model->getDriverdetail($driver_id); // get all clients-user_type==1
        
        $this->load->view('main_header_view');
        $this->load->view('main_container_view');
        $this->load->view('updatedriver_view', array('clients_data'=>$clients_data));
        $this->load->view('main_footer_view');

    }

    function updateDriver(){
        $this->sessionCheck();   
        $this->load->helper('url');  
        $driverid = $this->input->post('proid');
        $drivername = $this->input->post('drivername');
        $driveremail = $this->input->post('driveremail');
        $phonenumber = $this->input->post('phonenumber');
        $password = $this->input->post('password');
        $workstatus = $this->input->post('workstatus');
        $accountstatus = $this->input->post('accountstatus');

        $this->admin_model->updatedriver($driverid, $drivername, $driveremail, $phonenumber, $password, $workstatus, $accountstatus);
        redirect('/admin/driverlists');

    }

    function selecteddriver_ordersdetail($driver_id){
        $clients_data = $this->admin_model->getOrderdetail($driver_id); // get all clients-user_type==1

        if(sizeof($clients_data)==0){
            echo ("There is no Order history for this driver");
        }else {        
            $this->load->view('main_header_view');
            $this->load->view('main_container_view');
            $this->load->view('selecteddriver_orders_view', array('clients_data'=>$clients_data));
            $this->load->view('main_footer_view');
        }
    }

    function deleteOrder($job_id){
        $driver_id = $this->db->where('order_id', $job_id)->get('tb_orders')->row()->order_driverid;

        $this->db->where('order_id', $job_id);
        $this->db->delete('tb_orders'); 
        $this->selecteddriver_ordersdetail($driver_id);
    }


    function deleteOrder1($job_id, $type){
        $driver_id = $this->db->where('order_id', $job_id)->get('tb_orders')->row()->order_driverid;

        $this->db->where('order_id', $job_id);
        $this->db->delete('tb_orders'); 
        $this->orderslists($type);
    }


     function addOrders(){
        $trackid = $this->input->post('trackid');
        $destination = $this->input->post('destination');
        $drivername = $this->input->post('drivername');
       // $driverid = $this->input->post('driverid');
       
        $locationObject = $this->getAddress($destination);
        $object1 = $locationObject->results;
        if (sizeof($object1 ) > 0) {
            $coordinates = $object1[0]->geometry->location;
            $latitude = $coordinates->lat;
            $longitude= $coordinates->lng;
            echo ($latitude);
            echo($longitude);
            // $this->admin_model->addneworder($trackid,$destination, $drivername, $latitude, $longitude);
            // redirect('/admin/orderslists/All');
        
        }else{
           echo ("Incorrect Address");        
        }
        
        
      
        
    }

    function getAddress($address){
    
        $address = str_replace(", ","+",$address);
        $address = str_replace(" ","+",$address);
        $url="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyASpkitvYYqzTVi1U3M1t1g0w9sHqLvk_g";                                                         //AIzaSyCKY6_Nrez6G7bBFxbMY0o_fpPmnp2fUGE
        $json = file_get_contents($url);
        $data=json_decode($json); 
       // print_r($data);
        return $data; 
     }
    




















    //========================= Old Code ========================



    function debugg(){
        $adminData = $this->db->where('admin_email', $email)->get('tb_admin')->row();      
        
        if ($adminData > 0) { // if there is result, then compare email
    
            $this->session->set_flashdata('message',"Email already exist.");    
            redirect('/Admin/addstore');
        } else { // no such email
        
             $adminData1 = $this->db->where('admin_phonenumber', $phonenumber)->get('tb_admin')->row();    
             if ($adminData1 > 0) { // if there is result, then compare phone number        
                    $this->session->set_flashdata('message',"Phone Number already exist.");    
                    redirect('/Admin/addstore');
                } else { 
                     
                    if(!($this->upload->do_upload('proProfileImage'))){               
                     
                        $error = $this->upload->display_errors();
                        redirect('/Admin/main');
                                
                    } else {
                    
                        $data = array('upload_data'=>$this->upload->data());

                       
                        
                        $upload_path = "uploadfiles/images/";        
                        $upload_url = base_url()."uploadfiles/images/";   
                        // Upload file                
                        $image_name = $managername."_photo";            
                        $w_uploadConfig = array(
                                'upload_path' => $upload_path,
                                'upload_url' => $upload_url,
                                'allowed_types' => "*",
                                'overwrite' => TRUE,
                                'max_size' => 10000000,
                                'max_width' => 4000,
                                'max_height' => 3000,
                                'file_name' => $image_name.intval(microtime(true) * 10)
                            );       
                        $this->load->library('upload', $w_uploadConfig);   
                                 
                        if ($this->upload->do_upload('proProfileImage')) {                
                             $profile_url = $w_uploadConfig['upload_url'].$this->upload->file_name;
                            //result['photo_url']  = $photo_url;                  
                        } else {
                           //  $this->doRespond(105, $result);
                            $profile_url = base_url().'uploadfiles/provider/'.$data['upload_data']['file_name'];
                             //turn;
                        }
                        
                        $locationObject = $this->getAddress($address); 
		        $object1 = $locationObject->results;
		        if (sizeof($object1 ) > 0) {
		                $coordinates = $object1[0]->geometry->location;                       
                    
	                        $this->admin_model->addProvider(array(
	                            
	                            'admin_photourl'    =>$profile_url,
	                            'admin_storename'   =>$storename, 
	                            'admin_managername' =>$managername,
	                            'admin_email'        =>$email,
	                            'admin_phonenumber'  =>$phonenumber,
	                            'admin_password'     =>$password,
	                            'admin_address'      =>$address,
	                            'latitude'           =>$coordinates->lat,
	                            'longitude'          =>$coordinates->lng 
	                           
	                        ));
	                        $content="Congratlations!
	                        Your BOLTR.com account was be created." ;
	                        $this->sendEmail($email, $content);

                       		 redirect('Admin/addstore');
                        }else{
                     	   echo ("Incorrect Address");
                        }
                    }
                }
        }  
    }




     function forgot(){
            $this->load->view('forgotpassword');
    }
    
    function sendverifycode(){
        
         $email    = $this->input->post('admin_email');
        
         $adminData = $this->db->where('admin_email', $email)->get('tb_admin')->row();
          if (!empty($adminData)) { // if there is result, then compare password
               if($adminData->admin_deletestatus==0){
                      $this->sendforgotverifycode($email);
               } else{
                   echo "This account was be removed by Admin." ;
                   exit;
               }
          } else{
              echo "This is invalid mail.";
              exit; 
          }               
    }
    
    function sendforgotverifycode($email){
        $verificationcode=$this->generateRandomString();  
                
        $this->db->where('admin_email',$email);
        $this->db->set('admin_forgotcode',$verificationcode); 
        $this->db->update('tb_admin'); 
        
        $subject="From BOLTR.com" ;
        $content = "Your verification code is   ".$verificationcode;      
         
        $from = "BOLTR.com";           
        $hearders = "Mime-Version:1.0";
        $hearders .= "Content-Type : text/html;charset=UTF-8";
        $hearders .= "From: " . $from;
        
        mail($email, $subject, $content, $hearders);  
        
        $this->load->view('forgot_verifyview');
    }
    
    function generateRandomString() {
        $length = 5;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function verifyConfirm(){
        $email  = $this->input->post('admin_email');
        $password= $this->input->post('admin_password');
        $verificationcode=$this->input->post('admin_verificationcode');
        
          $adminData = $this->db->where('admin_email', $email)->get('tb_admin')->row();
          if (!empty($adminData)) { // if there is result, then compare password
               if($adminData->admin_deletestatus==0){
                      if($adminData->admin_forgotcode == $verificationcode){
                           $this->db->where('admin_email',$email);
                            $this->db->set('admin_password',$password); 
                            $this->db->update('tb_admin'); 
                            
                            $this->index();                          
                      } else {
                          echo "Invalid Verification code";
                      }
               } else{
                   echo "This account was be removed by Admin." ;
                   exit;
               }
          } else{
              echo "This is invalid mail.";
              exit; 
          }    
        
        
        
    }

  
   
    
    
    function sendPushNotification($shopname){

        $user_data = $this->db->where('user_deletestatus', 2)->get('tb_user');
        $usersnumrow=$user_data->num_rows();
         // echo ($usersnumrow);
        foreach ($user_data->result() as $user) {
        
            $token = $user->token;   
           // echo ($token);           
           
            
            $message_title = "New Alert";//$title;  
            $message_content = "Created New Order by ".$shopname;
            
            $url = "https://fcm.googleapis.com/fcm/send";
    //        api_key available in google-services.json

            $api_key = "AIzaSyCfEgr0jMv0X1kNoHphkUR8xP0HLM_uido";

            $notification["to"] = $token;
            $notification["priority"] = "high" ;
                           
            $notification['notification'] = array(
                                    "body" => $message_content,
                                    "title" => $message_title,
                                    "sound" => "notisound.mp3",
                                    
                                    );

            $headers = array(
                            'Content-Type:application/json',
                            'Authorization:key='.$api_key
                            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));

            $result = curl_exec($ch);

            if ($result === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
        }
        return;
    }
    
    
  
	
    function updateStore(){
        $this->sessionCheck();   
        $this->load->helper('url');   
       
            
        $config['upload_path'] = './uploadfiles/images/';  //upload directory 
        $config['allowed_types'] = 'gif|jpg|png';           
        $config['max_size'] = '1024000';                         
           
        $this->upload->initialize($config);//important part!!!
        $this->load->library('upload', $config);
        $data0 =  $this->input->post('proProfileImage');
        $storename = $this->input->post('storename');
        $managername = $this->input->post('managername');
        $phonenumber = $this->input->post('phonenumber');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');        
                   
        if(!($this->upload->do_upload('proProfileImage'))){ 
        
              $locationObject = $this->getAddress($address); 
              $object1 = $locationObject->results;
	     if (sizeof($object1 ) > 0) {
		      $coordinates = $object1[0]->geometry->location;   

	             $this->admin_model->updateAdmin1(array(
	                'admin_id'          => $this->session->userdata('login_adminID'),                
	              
	                'admin_storename'   =>$storename, 
	                'admin_managername' =>$managername,
	                'admin_email'        =>$email,
	                'admin_phonenumber'  =>$phonenumber,
	                'admin_password'     =>$password,
	                'admin_address'      =>$address,
	                'latitude'           =>$coordinates->lat,
		        'longitude'          =>$coordinates->lng 
	               
	            ));

              		redirect('Admin/editstoreprofile');     
            }else{
              echo("Incorrect Address");
            }            
        } else {
        
            $data = array('upload_data'=>$this->upload->data());

           
            
            $upload_path = "uploadfiles/images/";        
            $upload_url = base_url()."uploadfiles/images/";   
            // Upload file                
            $image_name = $username."_photo";            
            $w_uploadConfig = array(
                    'upload_path' => $upload_path,
                    'upload_url' => $upload_url,
                    'allowed_types' => "*",
                    'overwrite' => TRUE,
                    'max_size' => 10000000,
                    'max_width' => 4000,
                    'max_height' => 3000,
                    'file_name' => $image_name.intval(microtime(true) * 10)
                );       
            $this->load->library('upload', $w_uploadConfig);   
                     
            if ($this->upload->do_upload('proProfileImage')) {                
                 $profile_url = $w_uploadConfig['upload_url'].$this->upload->file_name;
                //result['photo_url']  = $photo_url;                  
            } else {
               //  $this->doRespond(105, $result);
                $profile_url = base_url().'uploadfiles/provider/'.$data['upload_data']['file_name'];
                 //turn;
            }
            
             $locationObject = $this->getAddress($address); 
	     $object1 = $locationObject->results;
             if (sizeof($object1 ) > 0) {
		    $coordinates = $object1[0]->geometry->location;  
            
        
	            $this->admin_model->updateAdmin(array(
	                'admin_id'          => $this->session->userdata('login_adminID'),                 
	                'admin_photourl'    =>$profile_url,
	                'admin_storename'   =>$storename, 
	                'admin_managername' =>$managername,
	                'admin_email'        =>$email,
	                'admin_phonenumber'  =>$phonenumber,
	                'admin_password'     =>$password,
	                'admin_address'      =>$address,
	                'latitude'           =>$coordinates->lat,
	                'longitude'          =>$coordinates->lng 
	               
	            ));
	            redirect('Admin/editstoreprofile');
            }else{
                echo("Incorrect Address");
            }
        }     
        
    }
    
    
    
    
    
    
    
   
    
    function sendEmail($useremail, $content){   
        $to = $useremail;
        $subject = "From BOLTR.com";
       
         
        $from = "BOLTR.com";           
        $hearders = "Mime-Version:1.0";
        $hearders .= "Content-Type : text/html;charset=UTF-8";
        $hearders .= "From: " . $from;
        
        mail($to, $subject, $content, $hearders);
    }
    
  
    
    
}
                         

            
        