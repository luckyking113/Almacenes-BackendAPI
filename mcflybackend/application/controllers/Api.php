<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Api extends CI_Controller{
    
                
    function __construct(){
        
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('Api_model');
        $this->load->model('Payments');
        $this->load->library('session');
        date_default_timezone_set('America/Mexico_City');  
    }  
     
    private function doRespond($p_result){   
         
        $this->output->set_content_type('application/json')->set_output(json_encode($p_result));
    }

    private function doRespondSuccess($result){
        $result['message'] = "success";
        $this->doRespond($result);
    }
     
    private function doRespondFail($message) {
        $result = array();
        $result['message'] = $message;
        $this->doRespond($result);                  
    }
     
     
    private function doUrlDecode($p_text){         
        $p_text = urldecode($p_text);
        $p_text = str_replace('&#40;', '(', $p_text);
        $p_text = str_replace('&#41;', ')', $p_text);
        $p_text = str_replace('%40', '@', $p_text); 
        $p_text = str_replace('%20',' ', $p_text); 
        $p_text = trim($p_text);
        return $p_text; 
    }
    
    //============================ Customer Side ========================
    function confirmzipcode(){
        $result=array();
        $zipcode = $this->doUrlDecode($_POST['zipecode']);
        $customerid = $this->doUrlDecode($_POST['customerid']);
        
        $warehouseid=-1;
        $warehouses = $this->db->get("warehouses")->result();
        foreach($warehouses as $warehouse){
            $onezipcode=$warehouse->zip_code;
            $warehouse_zipcodes = explode(",",$onezipcode);
            foreach($warehouse_zipcodes as $warehouse_zipcode){
                if($zipcode == $warehouse_zipcode){
                    $warehouseid=$warehouse->id;
                }
            }
        }
        
        /*$orders= $this->db->where('customer_id', $customerid)->order_by('id','desc')->get('orders')->result();*/
         $orders = $this->db->query("SELECT a.*, b.`address_name` AS shippingaddress_name, b.`address_location` AS shipping_addresslocation, b.`address_zipcode` AS shipping_addresszipcode, b.`address_lat` AS shipping_addresslat, b.`address_lng` AS shipping_addresslng, b.`address_imageurl` AS shipping_addressimageurl FROM orders a LEFT JOIN tb_shippingaddress b ON a.shipping_addressid=b.`address_id` WHERE a.`customer_id` = ".$customerid." ORDER BY a.`id` DESC")->result();
        
        
        if($warehouseid!=-1){
            $result['warehouse']=$this->db->where('id', $warehouseid)->get("warehouses")->result();
            $result['warehouseworkingtimestatus']=$this->check_warehouseworkingtime($warehouseid);
            //$this->doRespondSuccess($result);
        }else{
            //$this->doRespondFail("There is no supported warehouse in this zip code.");
            $result['warehouse']="wrong warehouse";
        }  
        $result['orders']=$orders;
       
        $this->doRespondSuccess($result);
    }
    
    function getallproducts($warehouseid, $customerid, $usertype){
        $result= array();
        $products=$this->Api_model->getallproducts1($warehouseid);       
        $result['products']=$products;
        $orders= array();
        
        if($usertype==0){  // from customer
           /* $orders= $this->db->where('customer_id', $customerid)->order_by('id','desc')->get('orders')->result();*/
           $orders = $this->db->query("SELECT a.*, b.`address_name` AS shippingaddress_name, b.`address_location` AS shipping_addresslocation, b.`address_zipcode` AS shipping_addresszipcode, b.`address_lat` AS shipping_addresslat, b.`address_lng` AS shipping_addresslng, b.`address_imageurl` AS shipping_addressimageurl FROM orders a LEFT JOIN tb_shippingaddress b ON a.shipping_addressid=b.`address_id` WHERE a.`customer_id` = ".$customerid." ORDER BY a.`id` DESC")->result();
        }
        $result['orders']=$orders;
        $this->doRespondSuccess($result);
    }
    
     function getallproducts_test($warehouseid, $customerid, $usertype){
        $result= array();
        $products=$this->Api_model->getallproducts1($warehouseid);       
        $result['products']=$products;
        $this->doRespondSuccess($result);
    }

    function getallproductimage($productid){
        /*$result= array();
        $productimages=$this->db->where('product_id', $productid)->get('product_images')->result();
        $result['images']=$productimages;
        $this->doRespondSuccess($result);*/
         $productid = $this->doUrlDecode($productid);
        $result= array();
        $productimages=$this->db->where('product_id', $productid)->get('product_images')->result();
        $result['images']=$productimages;
        $this->doRespondSuccess($result);
    }
    
    function sendVerifyCode() {
         $phonenumber = $_POST["phonenumber"];
         $result = array();
         $result["verify_code"] = "1234";//$this->Api_model->sendVerifyCode($phonenumber);
         $this->doRespondSuccess($result);     
    }
    
    function uploadImage() {

        $result = array();   
        $image_name ="image_".time();
        $upload_path =  "uploadfiles/images/";  

        $upload_url = base_url().$upload_path;
        // Upload file          
        $w_uploadConfig = array(
                'upload_path' => $upload_path,
                'upload_url' => $upload_url,
                'allowed_types' => "*",
                'overwrite' => TRUE,
                'max_size' => 1000000,
                'max_width' => 4000,
                'max_height' => 3000,
                'file_name' => $image_name
            );

        $this->load->library('upload', $w_uploadConfig);
        if ($this->upload->do_upload('image')) { 

             $imageurl = $w_uploadConfig['upload_url'].$this->upload->file_name;  
             $result['image_url'] = $imageurl;
             $this->doRespondSuccess($result);
        } else {

            $this->doRespondFail("Upload image failed");
        }
    }
    
    function customersignup(){
        $userdataarray = array();
        $json = $_POST['json'];
       // print_r($json);
        $result = array();
        $returneddata= $this->Api_model->Customersignup($json);
        if($returneddata==-1){
            $this->doRespondFail("Phone Number already registerred");
        }else{
            $result['customer_id']=$returneddata;
            $result['discountcodes']=$this->getalldiscountcode();
            $this->doRespondSuccess($result);
        }
    }
    
    function updateprofile(){
        $userdataarray = array();
        $json = $this->doUrlDecode($_POST['json']);
        $result = array();
        $customerid=$this->Api_model->updateprofile($json);
        $result['customer_id']=$customerid;
        $result['discountcodes']=$this->getalldiscountcode();
        $this->doRespondSuccess($result);
       
    }
    
    function getLatLng_fromaddressname(){
        $result=array();
        $address =  $_POST["address"];
        $address = str_replace(", ","+",$address);
        $address = str_replace(" ","+",$address);
        $url="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyCKY6_Nrez6G7bBFxbMY0o_fpPmnp2fUGE";
        $json = file_get_contents($url);
        $data=json_decode($json);
        $result['location'] = $data;
        $this->doRespondSuccess($result);
    }
    
    function customerlogin(){
        $userdataarray = array();
        $userdataarray['verified_type'] = $_POST['verified_type'];
        $userdataarray['verified_value'] = $_POST['verified_value'];  
        $userdataarray['fcmToken'] = $_POST['fcmToken'];  
        $customerdetail = $this->Api_model->customerlogin($userdataarray);
        if($customerdetail==0){
            $this->doRespondFail("There is no registered account");
        }else{
            $result=array();
            $result['customerdetail']=$customerdetail;
            
            $customerid= $customerdetail[0]->id;
            $shippingaddresses= $this->db->where('customer_id', $customerid)->get('tb_shippingaddress')->result();
            
            $object = array();
            $object['user_stripe_customer'] = $customerdetail[0]->customer_cardnumber;
            if($object['user_stripe_customer']!=null){
                 $result['carddetail']=$this->Payments->retrieveCustomer($object);
            }
            
            $result['shippingaddresses']=$shippingaddresses;
            $result['discountcodes']=$this->getalldiscountcode();
            
            $this->doRespondSuccess($result);
        }
    }
    
    function getalldiscountcode(){
        $date = date('Y-m-d h:i:s', time());
      
        $result = $this->db->query("SELECT * FROM `discounts` WHERE start_time<='".$date."' AND end_time>='".$date."'")->result();
        return $result;
    }
    
    function placeNeworder(){
        $orderdataarray = array();
        $orderdataarray['product_ids'] = $this->doUrlDecode($_POST['product_ids']);
        $orderdataarray['product_prices'] = $this->doUrlDecode($_POST['product_prices']);  
        $orderdataarray['product_quantities'] = $this->doUrlDecode($_POST['product_quantities']);
        $orderdataarray['customer_id'] = $this->doUrlDecode($_POST['customer_id']);
        $orderdataarray['amount'] = $this->doUrlDecode($_POST['amount']);
        $orderdataarray['card_number'] = $this->doUrlDecode($_POST['card_number']);
        $orderdataarray['payment_method'] = $this->doUrlDecode($_POST['payment_method']);
        $orderdataarray['warehouse_id'] = $this->doUrlDecode($_POST['warehouse_id']);
        $orderdataarray['shipping_address'] = $this->doUrlDecode($_POST['shipping_address']);
        $orderdataarray['cash_amount'] = $this->doUrlDecode($_POST['cash_amount']);
        $orderdataarray['user_stripe_customer'] = $this->doUrlDecode($_POST['user_stripe_customer']);
        $orderdataarray['warehouse_name'] =$_POST['warehouse_name'];
        $orderdataarray['product_images'] =$_POST['product_images'];
        $orderdataarray['product_names'] =$_POST['product_names'];
         
       
        $orderid = $this->Payments->createCharge($orderdataarray);
        $result = array();
        $result['orderid']=$orderid;
        $this->doRespondSuccess($result);
    }
    
    function customerOrderhistory($customer_id){
       // $orders= $this->db->where('customer_id', $customer_id)->order_by('id','desc')->get('orders')->result();
       $orders = $this->db->query("SELECT a.*, b.`address_name` AS shippingaddress_name, b.`address_location` AS shipping_addresslocation, b.`address_zipcode` AS shipping_addresszipcode, b.`address_lat` AS shipping_addresslat, b.`address_lng` AS shipping_addresslng, b.`address_imageurl` AS shipping_addressimageurl FROM orders a LEFT JOIN tb_shippingaddress b ON a.shipping_addressid=b.`address_id` WHERE a.`customer_id` = ".$customer_id." ORDER BY a.`id` DESC")->result();
        $result=array();
        $result['orders']=$orders;
        $this->doRespondSuccess($result);
    }
    
    function customer_changesetting(){
       $emailid = $this->doUrlDecode($_POST['emailid']);
       $status = $this->doUrlDecode($_POST['status']); 
       $customerid = $this->doUrlDecode($_POST['customerid']); 
       $this->Api_model->customer_changesetting($emailid,$status, $customerid);
       $this->doRespondSuccess($result);
    }
    
    function updateshippingaddress(){
        $result = array();
        $addressdataarray = array();
        $addressdataarray['address_id'] = $this->doUrlDecode($_POST['address_id']);  
        $addressdataarray['name'] = $this->doUrlDecode($_POST['name']);
        $addressdataarray['address'] = $this->doUrlDecode($_POST['address']);
        $addressdataarray['zipcode'] = $this->doUrlDecode($_POST['zipcode']);  
        $addressdataarray['lat'] = $this->doUrlDecode($_POST['lat']);
        $addressdataarray['lng'] = $this->doUrlDecode($_POST['lng']);
        $addressdataarray['imageurl'] = $this->doUrlDecode($_POST['imageurl']);
        $this->Api_model->updateshippingaddress($addressdataarray);
        $this->doRespondSuccess($result);
    }
    
     function addnewshippingaddress(){
        $result = array();
        $addressdataarray = array();
        $addressdataarray['name'] = $this->doUrlDecode($_POST['name']);
        $addressdataarray['address'] = $this->doUrlDecode($_POST['address']);
        $addressdataarray['zipcode'] = $this->doUrlDecode($_POST['zipcode']);  
        $addressdataarray['lat'] = $this->doUrlDecode($_POST['lat']);
        $addressdataarray['lng'] = $this->doUrlDecode($_POST['lng']);
        $addressdataarray['imageurl'] = $this->doUrlDecode($_POST['imageurl']);
        $addressdataarray['customer_id']= $this->doUrlDecode($_POST['customer_id']);
        $returnvalue = $this->Api_model->addshippingaddress($addressdataarray);
        $result['addressid']=$returnvalue;
        $this->doRespondSuccess($result);
    }
    
    function updateEmailconfirm(){
        $result = array();
        $dataarray = array();
        $dataarray['customerid'] = $this->doUrlDecode($_POST['customerid']);
        $dataarray['allow_param'] = $this->doUrlDecode($_POST['allow_param']);  // allow_param : 0: stage email, 1: discount email
        $dataarray['value'] = $this->doUrlDecode($_POST['value']);     // value : 0: allow, 1: not allow
        $this->Api_model->updateEmailstatus($dataarray);
        $this->doRespondSuccess($result);
    }
    
    function provideFeedback(){
        $result = array();
        $dataarray = array();
        $dataarray['orderid'] = $this->doUrlDecode($_POST['orderid']);
        $dataarray['user_stripe_customer'] = $this->doUrlDecode($_POST['user_stripe_customer']);
        $dataarray['card_id'] = $this->doUrlDecode($_POST['card_id']);
        $dataarray['paytype'] = $this->doUrlDecode($_POST['paytype']);
        $dataarray['rating'] = $this->doUrlDecode($_POST['rating']);  
        $dataarray['comment'] = $this->doUrlDecode($_POST['feedback']);
        $dataarray['tip'] = $this->doUrlDecode($_POST['tip']);
        $dataarray['customername'] = $this->doUrlDecode($_POST['customername']);
        $this->Payments->provideFeedback($dataarray);
        $this->doRespondSuccess($result);
    }
    
    function getlocationdata_byorderid($orderid){
        $result = array();
        $this->db->where("order_id", $orderid);
        $this->db->order_by('id', 'desc');
        $trackdata=$this->db->get('tb_ordertrack')->result();
        if(sizeof($trackdata)==0){
            $this->doRespondFail("There is no Driver Log for this order");
        }else{
            $result['trackdata']=$trackdata;
            $this->doRespondSuccess($result);
        }
    }
    
    
    function getdirection(){
      $result=array();
      $start_lat =  $_POST["start_lat"];
      $start_lng =  $_POST["start_lng"];
      $end_lat =  $_POST["end_lat"];
      $end_lng =  $_POST["end_lng"];
     
      $url="https://maps.googleapis.com/maps/api/directions/json?origin=".$start_lat.",".$start_lng."&destination="."$end_lat".","."$end_lng"."&sensor=false&mode=driving&key=AIzaSyAQvcyl8x3WyBjym7tJW3UKLrzwFyyfsIc";
            $json = file_get_contents($url);
            $data=json_decode($json);

             $result['location'] = $data;
             $result['url'] = $url;

            $this->doRespondSuccess($result);
    }
    
    function getAddress(){
      $result=array();
      $address =  $_POST["address"];
      $address = str_replace(", ","+",$address);
      $address = str_replace(" ","+",$address);
           $url="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyCKY6_Nrez6G7bBFxbMY0o_fpPmnp2fUGE";

           // $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
           //echo $url;
            $json = file_get_contents($url);
            $data=json_decode($json);

             $result['location'] = $data;

            $this->doRespondSuccess($result);
    }
    
    function getsugestedaddress(){
      $result=array();
      $address =  $_POST["address"];
     
      //$url="https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$address."&key=AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI";
      $url="https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$address."&key=AIzaSyBxpGGieh0iZocW-YqKJy9vD7nP6u0MMYs";
      
      
      
     
   
      
            $json = file_get_contents($url);
           // echo $json;
            $data=json_decode($json);

             $result['location'] = $data;
             $result['url'] = $url;

            $this->doRespondSuccess($result);
    }
    
    
   /*  function getLatLng_fromaddressname(){
        $result=array();
        $address =  $_POST["address"];
        $address = str_replace(", ","+",$address);
        $address = str_replace(" ","+",$address);
        $url="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyAQvcyl8x3WyBjym7tJW3UKLrzwFyyfsIc";
        $json = file_get_contents($url);
        $data=json_decode($json);
        $result['location'] = $data;
        $this->doRespondSuccess($result);
    }*/
    
    
    
    // Customer Payment Part
    
    function createCustomer(){
        $result = array();
        $dataarray = array();
        $dataarray['user_email'] = $_POST['user_email'];
        $dataarray['stripe_token'] = $_POST['stripe_token']; 
        $message = $this->Payments->createCustomer($dataarray);
        $result['data'] = $message;
        $this->doRespondSuccess($result);
        
    }
    
    function retrieveCustomer(){
        $result = array();
        $dataarray = array();
        $dataarray['user_stripe_customer'] = $_POST['user_stripe_customer'];
        $message = $this->Payments->retrieveCustomer($dataarray);
        $result['data'] = $message;
        $this->doRespondSuccess($result);
    }
    
    function addCardToCustomer(){
        $result = array();
        $dataarray = array();
        $dataarray['user_stripe_customer'] = $_POST['user_stripe_customer'];
         $dataarray['stripe_token'] = $_POST['stripe_token'];
        $message = $this->Payments->addCardToCustomer($dataarray);
        $result['data'] = $message;
        $this->doRespondSuccess($result);
    }
    
    function setDefaultCard(){
        $result = array();
        $dataarray = array();
        $dataarray['user_stripe_customer'] = $_POST['user_stripe_customer'];
         $dataarray['id'] = $_POST['id'];
        $message = $this->Payments->setDefaultCard($dataarray);
        $result['data'] = $message;
        $this->doRespondSuccess($result);
    }
    
    function removeCard(){
        $result = array();
        $dataarray = array();
        $dataarray['user_stripe_customer'] = $_POST['user_stripe_customer'];
         $dataarray['id'] = $_POST['id'];
        $message = $this->Payments->removeCard($dataarray);
        $result['data'] = $message;
        $this->doRespondSuccess($result);
    }
    
    function createCharge(){
        $result = array();
        $dataarray = array();
        $dataarray['user_stripe_customer'] = $_POST['user_stripe_customer'];
         $dataarray['id'] = $_POST['id'];
        $message = $this->Payments->createCharge($dataarray);
        $result['data'] = $message;
        $this->doRespondSuccess($result);
    }
    
    function registerToken($userid, $token){
         $result = array();
         $this->db->where("id", $userid);
         $this->db->set('token', $token);
         $this->db->update('customers');
    }


























    //============ Warehouse User and Driver ===========
    function employeelogin(){
        $userdataarray = array();
        $userdataarray['email'] = $this->doUrlDecode($_POST['email']);
        $userdataarray['password'] = $this->doUrlDecode($_POST['password']); 
        $userdataarray['token'] = $this->doUrlDecode($_POST['token']); 
        
        $result = array();
        $returneddata= $this->Api_model->employeelogin($userdataarray);
        if($returneddata=="0") $this->doRespondFail("Email not exist");
        elseif($returneddata=="1")$this->doRespondFail("Wrong password");
        else{
            if($returneddata->user_type==1){
                $warehouseid=$returneddata->warehouse_id; 
                $result['drivers']=$this-> getactivedrivers($warehouseid);
            }else if ($returneddata->user_type==3){
                $currentorderid = $returneddata->working_orderid;
                $this->db->where('id', $currentorderid);
                $order= $this->db->get('orders')->result();
                if(sizeof($order)>0) $result['currentworkingorder']= $order[0];
            }
            
           $result['warehouedata']= $this->db->where('id',$returneddata->warehouse_id)->get('warehouses')->result();
            
            $result['userdata']=$returneddata;
            $result['workingtime_status']= $this->checkworkingtime($returneddata->id);
            $this->doRespondSuccess($result);   
        }
    }
    
    function getactivedrivers($warehouseid){
        $this->db->where('warehouse_id', $warehouseid);
        $this->db->where("user_type", 3);
        $drivers=$this->db->get('users')->result();
        $driverdataarray = array();
        foreach($drivers as $onedriver){
            $driverid=$onedriver->id;
            $driverworkingstatus = $this->checkworkingtime($driverid);
            $onedriverarray= array(
                "id"     =>$driverid,
                "email"  =>$onedriver->email,
                "name"   =>$onedriver->name,
                "phone"  =>$onedriver->phone,
                "image"  =>$onedriver->image,
                "token"  =>$onedriver->token,
                "driverworkingstatus"=>$driverworkingstatus,
                );
            if($driverworkingstatus==1)
            array_push($driverdataarray, $onedriverarray);
        }
        return $driverdataarray;
    }
    
    function getAll_activeorders(){
        $userdataarray = array();
        $userdataarray['warehouseid'] = $this->doUrlDecode($_POST['warehouseid']);
        $userdataarray['userid'] = $this->doUrlDecode($_POST['userid']);  
        $userdataarray['usertype'] = $this->doUrlDecode($_POST['usertype']);    // 1 manager, 3: driver
        $result = array();
        $returneddata= $this->Api_model->getAll_activeorders($userdataarray);
        $result['orderdata']=$returneddata;
        
        $this->db->where('warehouse_id', $userdataarray['warehouseid']);
        $this->db->where("status","0");
        $this->db->group_by("log_number");
        $this->db->order_by("id", "desc");
        $transfernoti = $this->db->get("logs")->num_rows();
        $result['newnoticount']= $transfernoti;
        $result['workingtime_status']=$this->checkworkingtime($userdataarray['userid']);
        $result['drivers']=$this-> getactivedrivers($userdataarray['warehouseid']);
        
        $this->doRespondSuccess($result);
    }
    
    function getOrder_detail($orderid){
        $result = array();
        $returneddata= $this->Api_model->getOrder_detail($orderid);
        $result['orderdata']=$returneddata;
        $completedstatus = $this->db->where('order_id',$orderid)->get('order_reviews')->result();
        $result['review']=$completedstatus;
        $this->doRespondSuccess($result);
    }
    
    function updateOrderstatus(){// Accept. Collect product, Assign, Accept on driver , delivery time , complete order time
        $result = array();               // for assign only will have the driver id real value
        $statusdataarray = array();
        $statusdataarray['orderid'] = $this->doUrlDecode($_POST['orderid']);
        $statusdataarray['driverid'] = $this->doUrlDecode($_POST['driverid']);
        $statusdataarray['drivername'] = $this->doUrlDecode($_POST['drivername']);
        $statusdataarray['status'] = $this->doUrlDecode($_POST['status']);    // 1 manager, 3: driver
        $returndata = $this->Api_model->updateOrderstatus($statusdataarray);
        if($returndata == "success"){
             $this->doRespondSuccess($result);
        }else{
            $this->doRespondFail($returndata);
        }
    }
    
    function sendgeneralreport(){
        $result = array();               
        $reportdataarray = array();
        $reportdataarray['userid'] = $this->doUrlDecode($_POST['userid']);
        $reportdataarray['warehouseid'] = $this->doUrlDecode($_POST['warehouseid']);
        $reportdataarray['report'] = $this->doUrlDecode($_POST['report']);
        $this->Api_model->sendgeneralreport($reportdataarray);
        $this->doRespondSuccess($result);
    }
    
    function sendProduct_qtychange_report(){
        $result = array();               
        $reportdataarray = array();
        $reportdataarray['userid'] = $this->doUrlDecode($_POST['userid']);
        $reportdataarray['warehouseid'] = $this->doUrlDecode($_POST['warehouseid']);
        $reportdataarray['comment'] = $this->doUrlDecode($_POST['comment']);
        $reportdataarray['productid'] = $this->doUrlDecode($_POST['productid']);
        $reportdataarray['prev_qty'] = $this->doUrlDecode($_POST['prev_qty']);
        $reportdataarray['changed_qty'] = $this->doUrlDecode($_POST['changed_qty']);
        $this->Api_model->sendProduct_qtychange_report($reportdataarray);
        $this->doRespondSuccess($result);
    }
    
    function getalltimesheet($userid){
        $result = array();  
        $timesheetarray = $this->db->get('time_sheets')->result();
        $userassignedsheet = $this->Api_model->getUsertimesheet($userid);
        $result['timesheetarray']= $timesheetarray;
        $result['usersheet']=$userassignedsheet;
        $this->doRespondSuccess($result);
    }
    
    function confirmworkingtime(){
        $result = array();               
        $workingtimedataarray = array();
        $workingtimedataarray['userid'] = $this->doUrlDecode($_POST['userid']);
        $workingtimedataarray['fromtime'] = $this->doUrlDecode($_POST['fromtime']);
        $workingtimedataarray['totime'] = $this->doUrlDecode($_POST['totime']);
        $this->Api_model->saveworkingtime($workingtimedataarray);
        $this->doRespondSuccess($result);
    }
   
    function transferstocknoti($warehouseid){
        $result = array();   
        $this->db->where('warehouse_id', $warehouseid);
        $this->db->where("status","0");
        $this->db->group_by("log_number");
        $this->db->order_by("id", "desc");
        $transfernoti = $this->db->get("logs")->result();
        $result['transfternoti']= $transfernoti;
        $this->doRespondSuccess($result);
    }
    
    function confirmstocknoti(){
        $result = array();               
        $confirmtransferdata = array();
        $confirmtransferdata['userid'] = $this->doUrlDecode($_POST['userid']);
        $confirmtransferdata['lognumber'] = $this->doUrlDecode($_POST['lognumber']);
       // $this->Api_model->confirmstocknoti($confirmtransferdata);
        $this->Api_model->confirmstocknoti_t2($confirmtransferdata);
        $this->doRespondSuccess($result);
    }
    
    function getalltips($userid){
        $result = array();   
        $result['tips']=$this->Api_model->getalltips($userid);
        $this->doRespondSuccess($result);
    }
    
    function getOrderhistory_driver(){
        $result = array();               
        $userdata = array();
        $userdata['userid'] = $this->doUrlDecode($_POST['userid']);
        $userdata['usertype'] = $this->doUrlDecode($_POST['usertype']);
        $orderdata= $this->Api_model->getOrderhistory_users($userdata);
        
        $offsideuserdata_array=array();
        foreach($orderdata as $oneorder){
            $offsideuserid = $oneorder->user_id;
            If($userdata['usertype']==1) $offsideuserid=$oneorder->deliverman_id;
            if($offsideuserid==NULL){
                array_push($offsideuserdata_array, array());
            }else{
                $offsideuserdata=$this->db->where('id', $offsideuserid)->get('users')->result();
                array_push($offsideuserdata_array, $offsideuserdata);
            }
        }
        
        $result['orderdata']= $orderdata;
        $result['driverdata']=$offsideuserdata_array;
        $this->doRespondSuccess($result);
    }
    
    function sendforgotemail(){
        $result = array(); 
        $email = $this->doUrlDecode($_POST['email']);
        $checkemail = $this->Api_model->sendforgotemail($email);
        if($checkemail==0){
            $this->doRespondFail("Wrong email");
        }else{
            $result['data']=$checkemail;
            $this->doRespondSuccess($result);
        }
    }
    
    function changepassword(){
        $result = array(); 
        $id = $this->doUrlDecode($_POST['id']);
        $password = $this->doUrlDecode($_POST['password']);
        $this->db->where("id", $id)->set('password', $password)->update('users');
        $this->doRespondSuccess($result);
    }
    
    function registergpsdata(){
        $result = array();               
        $userdata = array();
        $userdata['order_id'] = $this->doUrlDecode($_POST['order_id']);
        $userdata['driver_id'] = $this->doUrlDecode($_POST['driver_id']);
        $userdata['order_lat'] = $this->doUrlDecode($_POST['order_lat']);
        $userdata['order_lng'] = $this->doUrlDecode($_POST['order_lng']);
        $orderdata= $this->Api_model->registergpsdata($userdata);
        $this->doRespondSuccess($result);
    }
    
    function registerToken_driver($userid, $token){
         $result = array();
         $this->db->where("id", $userid);
         $this->db->set('token', $token);
         $this->db->update('users');
    }
    
    function check_warehouseworkingtime($warehouseid){
        $currentworking_available_status=0;   // not working time
        $date = date("Y-m-d");  //'w', strtotime(date())
        $currenttime= date('g:ia');
        
        $unixTimestamp = strtotime($date);
        $dayOfWeek = date("l", $unixTimestamp);   // Thursday4, Sunday :1
        $day_of_week = date('N', strtotime($dayOfWeek));
        
        $warehouseobject = $this->db->where('id', $warehouseid)->get('warehouses')->result()[0];
        
        $starttime="";
        $endtime="";
       // echo $dayOfWeek;
        if($dayOfWeek == "Monday"){
            $starttime=$warehouseobject->mon_working_starttime;
            $endtime=$warehouseobject->mon_working_endtime;
        }else if($dayOfWeek == "Tuesday"){
            $starttime=$warehouseobject->tue_working_starttime;
            $endtime=$warehouseobject->tue_working_endtime;
        }else if($dayOfWeek == "Wednesday"){
            $starttime=$warehouseobject->wed_working_starttime;
            $endtime=$warehouseobject->wed_working_endtime;
        }else if($dayOfWeek == "Thursday"){
            $starttime=$warehouseobject->thu_working_starttime;
            $endtime=$warehouseobject->thu_working_endtime;
        }else if($dayOfWeek == "Friday"){
            $starttime=$warehouseobject->fri_working_starttime;
            $endtime=$warehouseobject->fri_working_endtime;
        }else if($dayOfWeek == "Saturday"){
            $starttime=$warehouseobject->sat_working_starttime;
            $endtime=$warehouseobject->sat_working_endtime;
        }else if($dayOfWeek == "Sunday"){
            $starttime=$warehouseobject->sun_working_starttime;
            $endtime=$warehouseobject->sun_working_endtime;
        }
        
        try {
            $start_time=strtotime($starttime);
            $end_time=strtotime($endtime);
            $current_time = strtotime($currenttime);
            
            if($start_time<$current_time && $end_time > $current_time){
                $currentworking_available_status=1;
            }
            
        } catch (Exception $e) {
            $currentworking_available_status=0;
        }
        
        return $currentworking_available_status;
    }
    
    function checkworkingtime($userid){
        
        
        
        $currentworking_available_status=0;   // not working time
        $date = date("Y-m-d");  //'w', strtotime(date())
        $currenttime= date('g:ia');
                    
        
        $unixTimestamp = strtotime($date);
        $dayOfWeek = date("l", $unixTimestamp);   // Thursday4, Sunday :1
        $day_of_week = date('N', strtotime($dayOfWeek));
        //echo $day_of_week;
        //echo('br');
        
        $timestamp_00am=strtotime('12am');
        $timestamp_08am=strtotime('08am');
        $current_time = strtotime($currenttime);
        
        if($current_time<$timestamp_08am && $current_time > $timestamp_00am){
            $day_of_week = $day_of_week-1;
        }
        if($day_of_week==0) $day_of_week==7;
        
        $workingtime_number="";
        $usersheet= $this->db->where('user_id', $userid)->get('user_shifts')->result();
        if(sizeof($usersheet)>0){
            //echo sizeof($usersheet);
            $userassignedsheet = $usersheet[0];
            if($day_of_week==1){   // Monday
                $workingtime_number=$userassignedsheet->mon;
            }else if($day_of_week==2){   // Tuesday
                $workingtime_number=$userassignedsheet->tue;
            }else if($day_of_week==3){   // Wednesday
                $workingtime_number=$userassignedsheet->wed;
            }else if($day_of_week==4){   // Thursday
                $workingtime_number=$userassignedsheet->thru;
            }else if($day_of_week==5){   // Friday
                $workingtime_number=$userassignedsheet->fri;
            }else if($day_of_week==6){   // Saturday
                $workingtime_number=$userassignedsheet->sat;
            }else if($day_of_week==7){   // Sunday
                $workingtime_number=$userassignedsheet->sun;
            }
           // print_r($userassignedsheet);
            $workingtimeids=explode(",", $workingtime_number);
            
           
            
            if(sizeof($workingtimeids)>0){
                $workingtimeonject=$this->db->where("id", $workingtimeids[0])->get('time_sheets')->result();
                
                if(sizeof($workingtimeonject)>0){
                   
                    //echo $workingstarttime = $workingtimeonject[0]->time_1;
                    $workingstarttime = $workingtimeonject[0]->time_1;
                    $workingendtime=$workingtimeonject[0]->time_2;
                    
                    if(sizeof($workingtimeids)>1){
                        $workingtimeonject_end=$this->db->where("id", $workingtimeids[sizeof($workingtimeids)-1])->get('time_sheets')->result();
                        if(sizeof($workingtimeonject_end)>0){
                            $workingendtime=$workingtimeonject[0]->time_2; 
                        }
                    }
                    
                    $registered_starttime= strtotime($workingstarttime);
                    $registered_endtime= strtotime($workingendtime);
                    if($current_time>$registered_starttime && $current_time<$registered_endtime) $currentworking_available_status=1;
                }
            }
            
            /*foreach($workingtimeids as $oneworkingtimeid){
                 $workingtimeonject=$this->db->where("id", $oneworkingtimeid)->get('time_sheets')->result();
                 if(sizeof($workingtimeonject)>0){
                     $workingstarttime = $workingtimeonject[0]->time_1;
                     $workingendtime=$workingtimeonject[0]->time_2;
                     
                     $registered_starttime= strtotime($workingstarttime);
                     $registered_endtime= strtotime($workingendtime);
                    
                     if($current_time>$registered_starttime && $current_time<$registered_endtime) $currentworking_available_status=1;
                 }
                 
            }*/
        }
        
       
       // return $currentworking_available_status;
       return 1;
    }
            
// Insert by Lyuba Popov 2019.08.21
// Get all categories by parent category        
    function getcategories($parent_id){
        if(!isset($parent_id)) $parent_id = 0;
        $result['categories'] = $this->Api_model->get_allcategories($parent_id);
        $this->doRespondSuccess($result);
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     

    
    
   
    
    
    
   
     
     function sendverifyEmail(){
         $result=array();
         $useremail = $_POST['user_email'];
          $useremail=$this->doUrlDecode($useremail);
          $verificationcode=$this->generateRandomString(); 
          $this->sendforgotverifycode($useremail, $verificationcode);
          $result['verificationcode']= $verificationcode;
          $this->doRespondSuccess($result);
         
     }
     
     function sendforgotverifycode($email, $verificationcode){         
        $subject="From BOLTR.com" ;
        $content = "Your verification code is   ".$verificationcode;
        $from = "BOLTR.com";           
        $hearders = "Mime-Version:1.0";
        $hearders .= "Content-Type : text/html;charset=UTF-8";
        $hearders .= "From: " . $from;           
        mail($email, $subject, $content, $hearders); 
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
   
     
      
     
    
    
    
}

?>