<?php      
 

define('VALUE_JOB_GOINGLIMIT', 10);
define("VALUE_SEARCH_RANGE", 10);
define('PRICE_PER_MINUTE', 110);
//set stripe ke

require (APPPATH .'third_party/twilio-php-master/Twilio/autoload.php');
use Twilio\Rest\Client;
//require_once( APPPATH . 'third_party/stripe-php/init.php');
//\Stripe\Stripe::setApiKey('sk_test_BW3RP7Ba2e9QDZNlBEtwrJWb');

     
class Api_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
    }
    
    function getallproducts1($warehouseid){
        //==== get all products ========== 
        

            $products = $this->db->query("SELECT a.*, 
                     b.id AS productid, 
                     b.`name` AS productname, 
                     b.`main_image` AS productimage, 
                     b.`price` AS product_price, 
                     b.`tax` AS product_tax, 
                     b.`description` AS product_description, 
                     b.`move_product_id` AS productuniqueid_forimages,
                     c.`name` AS cat_name, 
                     c.`image` AS cat_image, 
                     c.`category_id` AS category_id,
                     d.`category_id` AS subcategory_id,
                     d.`name` AS subcat_name, 
                     d.`image` AS subcat_image,
                     d.`parent_id` AS parent_id,
                     d.`shared_category` AS shared_category 
                     FROM warehouse_products a 
                     LEFT JOIN products b ON a.product=b.`id` 
                     LEFT JOIN category c ON b.`category_id` = c.`category_id` 
                     LEFT JOIN category d 
                     ON b.`sub_category_id` = d.`category_id` 
                     WHERE a.`warehouse` =  ".$warehouseid." 
                     ORDER BY c.`name`, d.`name`")->result();
                     
                     $sharedproducts=array();
                     foreach($products as $product){
                         if($product->shared_category !=null)
                         array_push($sharedproducts, $product);
                     }
        
        
        if(sizeof($products)>0){
            
            $this->db->query("TRUNCATE TABLE `tb_filteredproducts`");
     
            foreach($products as $row) {
               $categoryimage=$row->cat_image;
               $imageheight="";
               $imagewidth="";
               if(strlen($categoryimage)>0){
                list($width, $height, $type, $attr) = getimagesize("https://mcflydelivery.com/public/uploads/category/thumbnail/".$categoryimage);
                $imageheight=$height;
                $imagewidth=$width;
               }
                
               $query = "INSERT INTO `tb_filteredproducts` set 
              `id`  = '".$row->id."',
              `warehouse`  = '".$row->warehouse."',
              `product`  = '".$row->product."',
              `quantity`  = '".$row->quantity."',
              `min_capacity`  = '".$row->min_capacity."',
              `max_capacity`  = '".$row->max_capacity."',
              `avail_qty`  = '".$row->avail_qty."',
              `created_at`  = '".$row->created_at."',
              `updated_at`  = '".$row->updated_at."',
              `productid`  = '".$row->productid."',
              `productname`  = '".str_replace("'","",$row->productname)."',
              `productimage`  = '".$row->productimage."',
              `product_price`  = '".$row->product_price."',
              `product_tax`  = '".$row->product_tax."',
              `product_description`  = '".$row->product_description."',
              `productuniqueid_forimages`  = '".$row->productuniqueid_forimages."',
              `cat_name`  = '".$row->cat_name."',
              `cat_image`  = '".$row->cat_image."',
               `cat_imageheight`  = '".$imageheight."',
               `cat_imagewidth`  = '".$imagewidth."',
              `category_id`  = '".$row->category_id."',
              `subcat_name`  = '".$row->subcat_name."',
              `subcategory_id`  = '".$row->subcategory_id."',
              `subcat_image`  = '".$row->subcat_image."',
              `parent_id`  = '".$row->parent_id."',
              `shared_category`    = '".$row->shared_category."';";
              
              $this->db->query($query);
                        
            }
             
            foreach($sharedproducts as $shared_product){   // for one shared product
                $sharedcategory_array= array();
                $sharedcategory_array=explode(",",$shared_product->shared_category);
               // print_r($shared_product);
                foreach($sharedcategory_array as $oneshared_category){
                    if($oneshared_category !=$shared_product->category_id){   // if the shared category id item is not same with table id(current setted category id)
                       // echo $oneshared_category;
                        
                        $selected_category_objectarray_from_categorytable = $this->db->where('category_id', $oneshared_category)->get('category')->result();
                        
                        if(sizeof($selected_category_objectarray_from_categorytable)>0){    // if the shared category is not deleted from category table
                            $selected_category_object_from_categorytable=$selected_category_objectarray_from_categorytable[0];
                            
                            $categoryimage=$selected_category_object_from_categorytable->image;
                            $imageheight="";
                            $imagewidth="";
                            if(strlen($categoryimage)>0){
                             list($width, $height, $type, $attr) = getimagesize("https://mcflydelivery.com/public/uploads/category/thumbnail/".$categoryimage);
                             $imageheight=$height;
                             $imagewidth=$width;
                            }
                            
                            $query = "INSERT INTO `tb_filteredproducts` set 
                                  `id`  = '".$shared_product->id."',
                                  `warehouse`  = '".$shared_product->warehouse."',
                                  `product`  = '".$shared_product->product."',
                                  `quantity`  = '".$shared_product->quantity."',
                                  `min_capacity`  = '".$shared_product->min_capacity."',
                                  `max_capacity`  = '".$shared_product->max_capacity."',
                                  `avail_qty`  = '".$shared_product->avail_qty."',
                                  `created_at`  = '".$shared_product->created_at."',
                                  `updated_at`  = '".$shared_product->updated_at."',
                                  `productid`  = '".$shared_product->productid."',
                                  `productname`  = '".str_replace("'","",$shared_product->productname)."',
                                  `productimage`  = '".$shared_product->productimage."',
                                  `product_price`  = '".$shared_product->product_price."',
                                  `product_tax`  = '".$shared_product->product_tax."',
                                  `product_description`  = '".$shared_product->product_description."',
                                  `productuniqueid_forimages`  = '".$shared_product->productuniqueid_forimages."',
                                  `cat_name`  = '".$selected_category_object_from_categorytable->name."',
                                  `cat_image`  = '".$selected_category_object_from_categorytable->image."',
                                  `cat_imageheight`  = '".$imageheight."',
                                  `cat_imagewidth`  = '".$imagewidth."',
                                  `category_id`  = '".$selected_category_object_from_categorytable->category_id."',
                                  `subcat_name`  = '".$shared_product->subcat_name."',
                                  `subcategory_id`  = '".$shared_product->subcategory_id."',
                                  `subcat_image`  = '".$shared_product->subcat_image."',
                                  `parent_id`  = '".$shared_product->parent_id."',
                                  `shared_category`    = '".$shared_product->shared_category."';";
                                  
                            $this->db->query($query);
                            
                            
                        }
                    }
                }
            } 
            
        }  
         
      
        $result = $this->db->query("SELECT * FROM `tb_filteredproducts` ORDER BY cat_name, subcat_name")->result();
        return $result;
    }
    
    function getallproducts($warehouseid){
        //==== get all products ========== 
        
         $result = $this->db->query("SELECT a.*, 
             b.id AS productid, b.`name` AS productname, b.`main_image` AS productimage, 
             b.`price` AS product_price, b.`tax` AS product_tax, b.`description` AS product_description, b.`move_product_id` AS productuniqueid_forimages,
             c.`name` AS cat_name, c.`image` AS cat_image, d.`name` AS subcat_name, d.`image` AS subcat_image
             FROM warehouse_products a LEFT JOIN products b ON a.product=b.`id` LEFT JOIN category c ON b.`category_id` = c.`category_id` LEFT JOIN category d 
            ON b.`sub_category_id` = d.`category_id` WHERE a.`warehouse` = ".$warehouseid."  ORDER BY c.`name`, d.`name`")->result();
        return $result;
  
    }
    
    function sendVerifyCode($phonenumber) {
         $account_sid = 'AC6cb42d5adb4527fcba9832e84a2f8cec';
         $auth_token = 'c7daeb7b066ea95e19483491bc52c060';
         $client = new Client($account_sid, $auth_token);
         $verifyCode = $this->generateVerifyCode(6);


         $client->messages->create( 
             $phonenumber, 
              array(
                    'from' => "+1500555006", 
                    'body' => "Phantom Menace was clearly the best of the prequel trilogy." ) );
                    
         return verifyCode;
                    
    }
     
    function generateVerifyCode($digits_needed){
	
	$random_number=''; // set up a blank string	
	$count=0;
	
	while ( $count < $digits_needed ) {
	    $random_digit = mt_rand(0, 9);	    
	    $random_number .= $random_digit;
	    $count++;
	}
	return $random_number;
    }
    
    function Customersignup($json){
        
        //print_r($json);
        $data=json_decode($json);
       // print_r($data);
        $checkphone=$this->checkphone($data->phone);
        
        if($checkphone==0){ // if phone number not exist
            $this->db->set('first_name',$data->firstname);
            $this->db->set('last_name',$data->lastname);
            $this->db->set('email',$data->email);
            $this->db->set('phone',$data->phone);
            $this->db->set('password',$data->password);
            $this->db->set('image',$data->photourl);
            $this->db->set('verifiedtype',$data->verifiedtype);
            $this->db->set('verfified_value',$data->verified_value);
            $this->db->set('token',$data->fcmtoken);
            $this->db->set('birthday',$data->birthday);
            $this->db->insert('customers');
            $customerid = $this->db->insert_id();
            
            $shippingadressarray=$data->shippingaddress;
            foreach($shippingadressarray as $oneshipping){
                $this->db->set("customer_id", $customerid);
                $this->db->set("address_name", $oneshipping->address_name);
                $this->db->set("address_location", $oneshipping->address_location);
                $this->db->set("address_lat", $oneshipping->address_lat);
                $this->db->set("address_lng", $oneshipping->address_lng);
                $this->db->set("address_zipcode", $oneshipping->address_zip);
                $this->db->set("address_imageurl", $oneshipping->address_imageurl);
                $this->db->insert("tb_shippingaddress");
            }
            return $customerid;
        }else{
            return $checkphone;
        }
    }
    
    function updateprofile($json){
        $data=json_decode($json);
        $this->db->where('id', $data->customerid);
        $this->db->set('first_name',$data->firstname);
        $this->db->set('last_name',$data->lastname);
        $this->db->set('email',$data->email);
        $this->db->set('phone',$data->phone);
        $this->db->set('password',$data->password);
        $this->db->set('image',$data->photourl);
        $this->db->set('verifiedtype',$data->verifiedtype);
        $this->db->set('verfified_value',$data->verified_value);
        $this->db->set('token',$data->fcmtoken);
        $this->db->set('birthday',$data->birthday);
        $this->db->update('customers');
       
        $this->db->where('customer_id', $data->customerid)->set('customer_id',"-1")->update('tb_shippingaddress');
        
        $shippingadressarray=$data->shippingaddress;
        foreach($shippingadressarray as $oneshipping){
            $this->db->set("customer_id", $data->customerid);
            $this->db->set("address_name", $oneshipping->address_name);
            $this->db->set("address_location", $oneshipping->address_location);
            $this->db->set("address_lat", $oneshipping->address_lat);
            $this->db->set("address_lng", $oneshipping->address_lng);
            $this->db->set("address_zipcode", $oneshipping->address_zip);
            $this->db->set("address_imageurl", $oneshipping->address_imageurl);
            $this->db->insert("tb_shippingaddress");
        }
       return $data->customerid;
       
    }
    
    function customerlogin($userdataarray){
        //echo $userdataarray['verified_value'];
        $this->db->where('verifiedtype', $userdataarray['verified_type']);
        $this->db->where("verfified_value", $userdataarray['verified_value']);
        $this->db->set("token", $userdataarray['fcmToken']);
        $this->db->update('customers');
        
        $this->db->where('verifiedtype', $userdataarray['verified_type']);
        $this->db->where("verfified_value", $userdataarray['verified_value']);
        $customerdata = $this->db->get('customers')->result();
       //  return $customerdata;
        
        if(sizeof($customerdata)>0)            return $customerdata;
        else            return 0;
    }
    
    function checkphone($userphonenumber) {
        $this->db->where('phone', $userphonenumber);
         $cnt = $this->db->get('customers')->num_rows();
        if ($cnt > 0) {
            return -1;      // phone  exist
        }else {
           return 0;
        }      
    }
    
    function getordernumber(){
        $orderdata = $this->db->get('orders')->result();
        $ret = 1;
        if(count($orderdata) > 0){
            $ret = $orderdata[count($orderdata) - 1]->order_id + 1;
        }
        if($ret > 999) return $ret;
        else if($ret > 99) return "0".$ret;
        else if($ret > 9) return "00".$ret;
        else return "000".$ret;
    }
    function placeNeworder($orderdataarray){
        $this->db->set('order_id',$this->getordernumber());
        $this->db->set('product_ids',$orderdataarray['product_ids']);
        $this->db->set('customer_id',$orderdataarray['customer_id']);
        $this->db->set('amount',$orderdataarray['amount']);
        $this->db->set('card_number',$orderdataarray['card_number']);
        $this->db->set('payment_method',$orderdataarray['payment_method']);
        $this->db->set('order_time',date('Y-m-d H:i:s'));
        $this->db->set('status','1');
        $this->db->set('warehouse_id',$orderdataarray['warehouse_id']);
        $this->db->set('shipping_addressid',$orderdataarray['shipping_address']);
        $this->db->insert("orders");
        $orderid = $this->db->insert_id();
        
        $currenttotalorder=$this->db->where("id", $orderdataarray['customer_id'])->get("customers")->result()[0]->total_order;
        $this->db->where("id", $orderdataarray['customer_id']);
        $this->db->set("total_order", $currenttotalorder+1);
        $this->db->update('customers');
        
        $productidarray=  explode(',', $orderdataarray['product_ids']);
        $quantityarray= explode(',', $orderdataarray['product_quantities']);
        $pricearray = explode(',', $orderdataarray['product_prices']);
        $currentitem =0; 
        foreach($productidarray as $oneproduct){
            $this->db->set('order_id', $orderid);
            $this->db->set('warehouse_id', $orderdataarray['warehouse_id']);
            $this->db->set('product_id', $oneproduct);
            $this->db->set('quantity', $quantityarray[$currentitem]);
            $this->db->set('amount', $pricearray[$currentitem]);
            $this->db->insert('order_products');
            
            
            $qurrentqty = $this->db->where('warehouse',$orderdataarray['warehouse_id'])->where('product', $oneproduct)->get('warehouse_products')->result()[0]->avail_qty;
            $this->db->where('warehouse',$orderdataarray['warehouse_id'])->where('product', $oneproduct)->set('avail_qty', $qurrentqty-$quantityarray[$currentitem])->update('warehouse_products');
            $currentitem++;
        }
        
         $num_totalorder = $this->db->where('id',$orderdataarray['customer_id'])->get('customers')->result()[0]->total_order;
         $this->db->where('id',$orderdataarray['customer_id'])->set('total_order', $num_totalorder+1)->update('customers');
        
        return $orderid;
    }
    
    function customer_changesetting($emailid,$status, $customerid){
        $this->db->where('id', $customerid);
        if($emailid==0)
            $this->db->set('allow_stageemail', $status);
        else
            $this->db->set('allow_discountemail', $status);
        $this->db->update('customers');
    }
    
    function updateshippingaddress($addressdataarray){
       
        $this->db->where('address_id', $addressdataarray['address_id']);
        $this->db->set('address_name', $addressdataarray['name']);
        $this->db->set('address_location', $addressdataarray['address']);
        $this->db->set('address_zipcode', $addressdataarray['zipcode']);
        $this->db->set('address_lat', $addressdataarray['lat']);
        $this->db->set('address_lng', $addressdataarray['lng']);
        $this->db->set('address_imageurl', $addressdataarray['imageurl']);
        $this->db->update('tb_shippingaddress');
        
    }
    
    function addshippingaddress($addressdataarray){
        $this->db->set('address_name', $addressdataarray['name']);
        $this->db->set('address_location', $addressdataarray['address']);
        $this->db->set('address_zipcode', $addressdataarray['zipcode']);
        $this->db->set('address_lat', $addressdataarray['lat']);
        $this->db->set('address_lng', $addressdataarray['lng']);
        $this->db->set('address_imageurl', $addressdataarray['imageurl']);
        $this->db->set('customer_id', $addressdataarray['customer_id']);
        $this->db->insert('tb_shippingaddress');
        return $this->db->insert_id();
    }
    
    function updateEmailstatus($dataarray){
        $this->db->where('id',$dataarray['customerid']);
        if($dataarray['allow_param']==0){
            $this->db->set('allow_stageemail',$dataarray['value']);
        }else if($dataarray['allow_param']==1){
            $this->db->set('allow_discountemail',$dataarray['value']);
        }
        $this->db->update('customers');
    }
    
    









    //===================== Warehouse User and Driver=============
    function employeelogin($userdataarray){
        $this->db->where('email', $userdataarray['email']);
        $useravailable=$this->db->get('users')->result();
        if(sizeof($useravailable)==0){
	    return 0;   // email not exist
        }else{
           $this->db->where('email', $userdataarray['email']);
           $this->db->where('password', $userdataarray['password']);
           $useravailable=$this->db->get('users')->result();
            if(sizeof($useravailable)==0){
                return 1;   // wrong password
            }else{
                 $this->db->where('email', $userdataarray['email']);
                 $this->db->where('password', $userdataarray['password']);
                 $this->db->set('token', $userdataarray['token']);
                 $this->db->update('users');
                
                return $useravailable[0];
            }
        }
    }
    
    function getAll_activeorders($userdataarray){
       
         $status ='1';
        if($userdataarray['usertype']==3)$status = '3';// if(it's driver)
        $string_query="SELECT a.*, 
b.id AS customerid, b.`first_name`AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customerphone, b.`image` AS customerimage,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.address_id
WHERE a.`warehouse_id` =".$userdataarray['warehouseid']." AND a.`status`='".$status."'";
        if($userdataarray['usertype']==3){
            $string_query=$string_query." AND a.`deliverman_id`='".$userdataarray['userid']."'";
        }
        $string_query=$string_query."  ORDER BY a.`order_time`";      
        //print_r($string_query);
        
        $result = $this->db->query($string_query)->result();
        return $result;
    }
    
    function getOrder_detail($orderid){
       /*$result = $this->db->query("SELECT a.*, 
b.id AS productid, b.`main_image` AS productimage, b.`name` AS productname
FROM order_products a 
INNER JOIN products b ON a.product_id=b.`id`
WHERE a.`order_id` = ".$orderid)->result();*/
$reesult= array();
$result=$this->db->where("order_id", $orderid)->get('order_products')->result();
        return $result;
    }
    
    function updateOrderstatus($statusdataarray){
        $datetime= date("Y-m-d H:i:s");
        $status = $statusdataarray['status'];
        if($status == 6) $status = 7;
        if($status=="3"){
             $this->db->where('id', $statusdataarray['orderid']);
             $currentstatus = $this->db->get('orders')->result()[0]->status;
             if($status ==3 && $currentstatus == 2  || $status ==3 && $currentstatus == 3){   //if(it's re assign to another driver  or assign to driver)
                $this->db->where('id', $statusdataarray['orderid']);
                $this->db->set("status","3");
                $this->db->set("deliverman_id",$statusdataarray['driverid']);
                $this->db->set("warehouse_drivername",$statusdataarray['drivername']);
                $this->db->set("collect_order_time", $datetime);
                $this->db->update('orders');
                 
             }else {   // if(it's re assign to another driver but already passed to other status
                 return("you can't assign this order to other driver anymore");
             }
        }else if($status=="4"){     // collect from driver
             $this->db->where('id', $statusdataarray['orderid']);
             $currentstatus = $this->db->get('orders')->result()[0]->status;
             if($currentstatus=="4"){   // if it's already collected by other driver
                 return("Already collected");
             }else{
                $this->db->where('id', $statusdataarray['orderid']);
                $this->db->set("status","4");
                $this->db->set("deliverman_id",$statusdataarray['driverid']);
                $this->db->set("warehouse_drivername",$statusdataarray['drivername']);
                $this->db->set("deliver_order_time", $datetime);
                $this->db->update('orders');
             }
        }else{
        
            $this->db->where('id', $statusdataarray['orderid']);
            if($status=="2"){  // accep order
                $this->db->set("status","2");
                $this->db->set("accept_order_time", $datetime);
                $this->db->set("user_id", $statusdataarray['driverid']);
                $this->db->set("warehouse_username", $statusdataarray['drivername']);
            }/*else if($status=="3"){    // assign to driver
                $this->db->set("status","3");
                 $this->db->set("deliverman_id",$statusdataarray['driverid']);
                $this->db->set("collect_order_time", $datetime);
            }*/else if($status=="5"){     // start driving
                $this->db->set("status","5");          
                $this->db->set("collect_warehouse_time", $datetime);
                $this->db->set("deliverman_id", $statusdataarray['driverid']);
                $this->db->set("warehouse_drivername", $statusdataarray['drivername']);
            }else if($status=="6"){
                $this->db->set("status","6");          
                $this->db->set("arrival_destination_time", $datetime);
            }else if($status=="7"){
                $this->db->set("status","7");          
                $this->db->set("final_deliver_order_time", $datetime);
            }
            $this->db->update('orders');
        }
        
        /*if($status=="2"){
            $productsarray = $this->db->where('order_id', $statusdataarray['orderid'])->get('order_products')->result();
            foreach($productsarray as $oneorderproduct){
                $this->db->where('warehouse', $oneorderproduct->warehouse_id);
                $this->db->where('product', $oneorderproduct->product_id);
                $currentqty= $this->db->get('warehouse_products')->result()[0]->quantity;
                
                $this->db->where('warehouse', $oneorderproduct->warehouse_id);
                $this->db->where('product', $oneorderproduct->product_id);
                $this->db->set('quantity', $currentqty-$oneorderproduct->quantity);
                $this->db->update('warehouse_products');
            }
        }*/
        
        if($status =="5"){
            $this->db->where('id', $statusdataarray['driverid'])->set('working_orderid', $statusdataarray['orderid'])->update('users');
        }else if($status == "6"){
             $this->db->where('id', $statusdataarray['driverid'])->set('working_orderid', "-1")->update('users');
        }
        
        $customerid= $this->db->where('id', $statusdataarray['orderid'])->get('orders')->result()[0]->customer_id;
        $order_id= $this->db->where('id', $statusdataarray['orderid'])->get('orders')->result()[0]->order_id;
        $driver_id= $this->db->where('id', $statusdataarray['orderid'])->get('orders')->result()[0]->deliverman_id;
        $customer = $this->db->where('id', $customerid)->get('customers')->result()[0];
        $sendemailstatus=$customer->allow_stageemail;
        $customername=$customer->first_name." ".$customer->last_name;
        $email=$customer->email;
        $customertoken=$customer->token;
        $order_status="Pendiente";
        if($status=="2"){  // accep order
            $order_status="Procesando";
        }else if($status=="3"){    // assign to driver
            $order_status="En Recolección";
        }else if($status=="4"){     // collect from driver
            $order_status="Recolectada";
        }else if($status=="5"){     // start driving
            $order_status="En Camino";
        }else if($status=="6"){
           $order_status="Entregado";
        }else if($status=="7"){
           $order_status="Confirmed";
        }
        
        if($sendemailstatus==0){
            $this->sendstageemail($email, $customername, $order_status, $order_id);
            
            $message = "Your order #".$order_id." status is ".$order_status.".";
            $this->sendPushNotification($customertoken, "McFly", $message, "0", $statusdataarray['orderid'] ,$status);
        }
        
        if($status=="3"){  // send push to driver
            $this->db->where("id", $driver_id);
            $driver = $this->db->get('users')->result();
            if(sizeof($driver)>0){
                $token= $driver[0]->token;
                $message ="New order has been assigned to you";
                $this->sendPushNotification($token, "McFly", $message, "0",$statusdataarray['orderid'], $status);
            }
        }
        return ("success");
    }
    
    function sendstageemail($email, $customername, $orderstatus, $order_id){
        $subject="McFlydelivery.com" ;
        $content = "Hi. ".$customername."! Your order #".$order_id." is in ".$orderstatus." stage now.";
        $from = "McFlydelivery.com";           
        $hearders = "Mime-Version:1.0";
        $hearders .= "Content-Type : text/html;charset=UTF-8";
        $hearders .= "From: " . $from;           
        mail($email, $subject, $content, $hearders);
    }
    
    function sendgeneralreport($statusdataarray){
        $this->db->set('warehouse_id', $statusdataarray['warehouseid']);
        $this->db->set('user_id', $statusdataarray['userid']);
        $this->db->set('comment', $statusdataarray['report']);
        $this->db->set('report_type',"General report");
        $this->db->set('created_at',date('Y-m-d H:i:s'));
        $this->db->insert('warehouse_reports');
    }
    
    function sendProduct_qtychange_report($reportdataarray){
        $this->db->set('warehouse_id', $reportdataarray['warehouseid']);
        $this->db->set('user_id', $reportdataarray['userid']);
        $this->db->set('comment', $reportdataarray['comment']);
        $this->db->set('report_type',"product quantity change report");
        $this->db->set('product_id',$reportdataarray['productid']);
        $this->db->set('prev_qty',$reportdataarray['prev_qty']);
        $this->db->set('changed_qty',$reportdataarray['changed_qty']);
        $this->db->set('created_at',date('Y-m-d H:i:s'));
        $this->db->insert('warehouse_reports');
        
        
        $this->db->where('warehouse', $reportdataarray['warehouseid']);
        $this->db->where('product',$reportdataarray['productid']);      
        $this->db->set('avail_qty',$reportdataarray['changed_qty']);
        $this->db->set('updated_at',date('Y-m-d H:i:s'));
        $this->db->update('warehouse_products');        
        
    }
            
    function getUsertimesheet($userid){
        $this->db->where("user_id", $userid);
        $usersheetarray = $this->db->get("user_shifts")->result();
        if(sizeof($usersheetarray)>0)return $usersheetarray;
        else            return[];
    }
    
    function saveworkingtime($workingtimedataarray){
        $this->db->set('employee_id', $workingtimedataarray['userid']);
        $this->db->set('from_time', $workingtimedataarray['fromtime']);
        $this->db->set('to_time', $workingtimedataarray['totime']);
        $this->db->insert('employee_payments');
    }
      function confirmstocknoti_t2($confirmtransferdata){
          
         $logs = $this->db->where('log_number', $confirmtransferdata['lognumber'])->get("logs")->result();
   
          foreach($logs as $log)
          {
              $register = $this->db->where('id', $log->register_id)->get('register_products')->result()[0];
              $product_id = $register->product_id;
             
              $main_product = $this->db->from('products')->join('warehouse_products', 'products.id = warehouse_products.product')->where('move_product_id', $product_id)->where('warehouse', $log->warehouse_id)->get();
             
             $check_product = $main_product->num_rows();
       
            
              if($check_product)
              {
                    $main_product = $main_product->result()[0];
                    
                    $warehouseProduct = $this->db->where('product', $main_product->move_product_id)->get('warehouse_products')->result()[0];
                 
                    $this->db->where('product', $main_product->move_product_id);
                    $this->db->set('quantity', $warehouseProduct->quantity - $log->quantity);
                    $this->db->update('warehouse_products');
                    
                    //$order_qty = OrderProduct::where('product_id',$main_product->product)->sum('quantity');
                    $warehouseProduct = $this->db->where('product', $main_product->product)->get('warehouse_products')->result()[0];
                    
                    $this->db->where('product', $main_product->product);
                    $this->db->set('avail_qty', $warehouseProduct->avail_qty + $log->quantity);
                    $this->db->set('quantity', $warehouseProduct->quantity + $log->quantity);
                    $this->db->update('warehouse_products');
                    
          
                   
                    $newprice = $register->price * $log->quantity;
                    
                    $this->db->where('id', $log->register_id);
                    $this->db->set('avail_qty',  $register->avail_qty + $log->quantity);
                    $this->db->update('register_products');
                    
                    $product = $this->db->where('id', $main_product->move_product_id)->get('products')->result()[0];
                    $this->db->where('id', $main_product->move_product_id);
                    $this->db->set('total_moved', $product->total_moved + 1);
                    $this->db->update('products');
                   
                    $this->db->where('log_number', $confirmtransferdata['lognumber']);
                    $this->db->set('received_user', $confirmtransferdata['userid']);
                    $this->db->set('received_date',date('Y-m-d H:i:s'));
                    $this->db->set('status',1);
                    $this->db->update('logs');
                    
                     
        
              }
              else
              {
                  
                   
                  $main_product = $this->db->where('id', $product_id)->get('products')->result()[0];
                
                 // if(isset($main_product->quantity))
                  {
                       
                       
                       $newprice = $register->price * $log->quantity;
                       $this->db->set('name',$main_product->name);
                       $this->db->set('category_id',$main_product->category_id);
                       $this->db->set('sub_category_id',$main_product->sub_category_id);
                       $this->db->set('price',$main_product->price);
                       $this->db->set('description',$main_product->description);
                       $this->db->set('main_image',$main_product->main_image);
                       $this->db->set('move_product_id',$product_id);
                       $this->db->insert('products');
                       $last_product_id = $this->db->insert_id();
                       
                      $warehouseProduct = $this->db->where('product', $main_product->id)->get('warehouse_products')->result()[0];
                       $this->db->where('product', $main_product->id);
                       $this->db->set('quantity', $warehouseProduct->quantity - $log->quantity);
                       $this->db->update('warehouse_products');
                       
                       $this->db->where('id', $log->register_id);
                       $this->db->set('avail_qty',  $register->avail_qty + $log->quantity);
                       $this->db->update('register_products');
                      
                       
                      $this->db->where('id', $product_id);
                      $this->db->set('total_moved', $main_product->total_moved + 1);
                      $this->db->update('products');
                      
                      $warehouse_id = $log->warehouse_id;
                      $quantity = $log->quantity;
                      
                      $this->db->set('warehouse',$warehouse_id);
                       $this->db->set('product',$last_product_id);
                       $this->db->set('quantity',$quantity);
                       $this->db->set('avail_qty',$quantity);
                       $this->db->set('min_capacity',$warehouseProduct->min_capacity);
                       $this->db->set('max_capacity',$warehouseProduct->max_capacity);
                       $this->db->insert('warehouse_products');
                       
                       $this->db->where('log_number', $confirmtransferdata['lognumber']);
                    $this->db->set('received_user', $confirmtransferdata['userid']);
                    $this->db->set('received_date',date('Y-m-d H:i:s'));
                    $this->db->set('status',1);
                    $this->db->update('logs');
                    
//                    $logId = rand(1000,100000);
//                      $this->db->set('warehouse_id',$warehouse_id);
//                       $this->db->set('product_id',$last_product_id);
//                       $this->db->set('quantity',$quantity);
//                       $this->db->set('log_number',$logId);
//                       $this->db->set('price',$main_product->price);
//                       $this->db->set('register_id',$register->id);
//                       $this->db->insert('logs');
                       
                   
                    
                   
                  }
                 
                  
//                  
//          $products = $this->db->query("SELECT a.*, b.id AS productsid, b.warehouse as warehouse, b.product AS product FROM products a INNER JOIN warehouse_products b ON a.id=b.product
//WHERE b.warehouse IS NOT NULL")->result();
//          
//       
//          
//           foreach($products as $product)
//           {
//               
//           $productid =$product->product;
//               if($productid == '193') 
//               {
//              echo  $log_order = $this->db->select_sum('quantity')->where('product_id',$product->product)->from('logs')->get()->result()[0]->quantity;
//            exit;
//                $order_qty = $this->db->select_sum('quantity')->where('product_id',$product->product)->from('order_products')->get()->result()[0]->quantity;
//           $aval = $log_order - $order_qty;  
//                    $this->db->where('product', $product->product);
//                    $this->db->where('warehouse', $product->warehouse);
//                    $this->db->set('avail_qty',$aval);
//                    $this->db->update('warehouse_products');
//               
//               }
//           }
              }
              
          }
        
    
         /* $products=$this->db->from('products')->join('warehouse_products', 'products.id = warehouse_products.product')->where('warehouse IS NOT NULL', null, false)->get()->result();*/
          
      }
    function confirmstocknoti($confirmtransferdata){
        echo 3; exit;
        $this->db->where('log_number', $confirmtransferdata['lognumber']);
        $this->db->set('received_user', $confirmtransferdata['userid']);
        $this->db->set('received_date',date('Y-m-d H:i:s'));
        $this->db->set('status',1);
        $this->db->update('logs');
        
        $logproducts = $this->db->where('log_number', $confirmtransferdata['lognumber'])->get("logs")->result();
        foreach($logproducts as $onelog){
            $warehouse_id= $onelog->warehouse_id;
            $register_id = $onelog->register_id;
            $this->db->where('id', $register_id);
            $registerproductlog = $this->db->get('register_products')->result()[0];
            
            $movedproduct_id = $registerproductlog->product_id;   // main warehouse product id
            $movedproduct_quantity = $registerproductlog->quantity;
            
            //   % what's the total_moved column in products table
            $this->db->where("move_product_id", $movedproduct_id);
            $movedproduct = $this->db->get('products')->result()[0];
            $warehouse_productid = $movedproduct->id;
            
            // decrease main warehouse's product quantity
            $this->db->where('product', $movedproduct_id);
            $currentqty = $this->db->get('warehouse_products')->result()[0]->quantity;
            
            $this->db->where('product', $movedproduct_id);
            $this->db->set('quantity', $currentqty-$movedproduct_quantity);
            $this->db->update('warehouse_products');
            
            
            // increase selected warehouse's product qty 
            $main_product = $this->db->from('products')->join('warehouse_products', 'products.id = warehouse_products.product')->where('move_product_id', $movedproduct_id )->where('warehouse', $warehouse_id)->get()->result()[0];

            $this->db->where('product', $main_product->product);
            $currentwarehouse_product =$this->db->get('warehouse_products')->result()[0];
            $currentqty = $currentwarehouse_product->quantity; 
            $currentavaialbleqty =  $currentwarehouse_product->avail_qty; 
            $this->db->where('product', $main_product->product);
            $this->db->set('quantity', $currentqty+$movedproduct_quantity);
             $this->db->set('avail_qty', $currentavaialbleqty+$movedproduct_quantity);
            $this->db->update('warehouse_products');
        }
    }
    
    function getalltips($userid){
        $result = $this->db->query("SELECT a.*, 
b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, c.tips As tip_amount
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id` 
INNER JOIN order_reviews c ON c.`order_id`=a.`id`
WHERE a.`deliverman_id` = ".$userid." ORDER BY a.`order_time` DESC")->result();
        return $result;
    }
    
     function getOrderhistory_users($userdata){
        $userid= $userdata['userid'];
        $usertype=$userdata['usertype'];
        $comment="user_id` =".$userid;
        if($usertype==3) $comment="deliverman_id` =".$userid;
        
       $result = $this->db->query("SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone, b.`image` AS customerimage,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
LEFT JOIN customers b ON a.customer_id=b.`id`
LEFT JOIN tb_shippingaddress c ON a.shipping_addressid=c.`address_id`
WHERE a.`".$comment." ORDER BY a.`id` DESC")->result();
        return $result;
    }
    
    function sendforgotemail($email){
       $user = $this->db->where('email', $email)->get('users')->result();
       if(sizeof($user)>0){
           $userid= $user[0]->id;
           $code= $this->generateRandomString();
           $this->sendoptemail($email, $code);
           $resultarray= array(
               'userid'=>$userid,
               'code'=>$code,
               'password'=>$user[0]->password
               );
            return $resultarray;   
           
       }else{
           return 0;
       }
    }
    
    function sendoptemail($email, $code){
        $subject="McFlydelivery.com" ;
        $content = "Your Opt Code is ".$code ;
        $from = "McFlydelivery.com";           
        $hearders = "Mime-Version:1.0";
        $hearders .= "Content-Type : text/html;charset=UTF-8";
        $hearders .= "From: " . $from;           
        mail($email, $subject, $content, $hearders);
    }
    
     function generateRandomString() {
        $length = 6;
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
        
        
    function registergpsdata($userdata){
        $this->db->set('order_id',$userdata['order_id']);
        $this->db->set('driver_id',$userdata['driver_id']);
        $this->db->set('order_lat',$userdata['order_lat']);
        $this->db->set('order_lng',$userdata['order_lng']);
        $this->db->insert('tb_ordertrack');
        
    }    
    
    
   

    // send push notification   
    function sendPushNotification($token, $title, $content, $unread, $order_d, $status){

        $message_content = $content;
        $message_title = "New Alert";//$title;  

        $url = "https://fcm.googleapis.com/fcm/send";
//        api_key available in google-services.json

        $api_key = "AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI";

        $notification["to"] = $token;
        $notification["priority"] = "high" ;
        $bodyarray = array(
            "conent"=>$message_content,
            "order_id" =>$order_d,
            "status" =>$status
            );
                       
        $notification['notification'] = array(
                                "body" => $bodyarray,
                                "title" => $message_title,
                                "sound" => "notisound.mp3",
                                "badge" => $unread
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
        return;
    }
    
    
   function get_allcategories($parent_id){
        $this->db->where('parent_id', $parent_id);
        $data = $this->db->get('category')->result();
        return $data;
   }
    
}
     
?>