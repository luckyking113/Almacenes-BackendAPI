<?php

//test key
   
define("STRIPE_PUBLIC_TEST_KEY", "pk_test_UpC2QScCJiwatjBPlVKXrJIi");   
define("STRIPE_SECRET_TEST_KEY", "sk_test_8SoFMDXlVjDa2xYXqfWOE482");
define("STRIPE_CLIENT_TEST_ID", "ca_CF6PwiZJKO999vpgZrU8Am3mQVe9MzDf");   

define("STRIPE_PUBLIC_LIVE_KEY", "pk_live_DDsbZ5yAhZ8XM646k8h5mnOT");   
define("STRIPE_SECRET_LIVE_KEY", "sk_live_LObU5dJ9iDsnIw3KCJmVxSxI");  
define("STRIPE_CLIENT_LIVE_ID", "ca_CF6PbjacAlixv9B3NhsoTW2D6b4ALS74");

define("CHARGE_STATUS_CHARGED", 1);
define("CHARGE_STATUS_REFUNDED", 10);
define("CHARGE_STATUS_PAID",2);

//app fee rate
define("APP_FEE", 0.05);


require FCPATH . 'application/third_party/stripe-php/init.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Payments extends CI_Model {
         
    function __construct(){
        parent::__construct();    
        date_default_timezone_set('America/Mexico_City');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_TEST_KEY);
        Stripe\Stripe::setClientId(STRIPE_CLIENT_TEST_ID);
    }
    
    
    //====================== Stripe ==============================================================================
    /* customer */
    public function createCustomer($object) {
        try{
            $customer = \Stripe\Customer::create(array(
                "email" => $object["user_email"],
                "source"=>$object["stripe_token"]
            ));
            $this->db->set("customer_cardnumber", $customer->id)->where("email", $object["user_email"])->update("customers");
            //return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "customer"=>$customer];
            return $customer;
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
    
    public function retrieveCustomer($object) {
        try{
            $customer = \Stripe\Customer::retrieve($object["user_stripe_customer"]);
            //return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "customer"=>$customer];
            return $customer;
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
    
    public function addCardToCustomer($object) {
        try{
            $customer = \Stripe\Customer::retrieve($object["user_stripe_customer"]);
            $customer->sources->create(["source"=>$object["stripe_token"]]);
            //return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "customer"=>\Stripe\Customer::retrieve($object["user_stripe_customer"])];
            return ["customer"=>\Stripe\Customer::retrieve($object["user_stripe_customer"])];
           
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }        
        //\Stripe\Customer::createSource($object["user_stripe_customer"], $params);
    }
    
    public function setDefaultCard($object) {
        try{
            $customer = \Stripe\Customer::retrieve($object["user_stripe_customer"]);
            $customer->default_source=$object["id"];
            $customer->save();
            return ["customer"=>\Stripe\Customer::retrieve($object["user_stripe_customer"])];
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
    
    public function removeCard($object) {
        try{
            $cu = \Stripe\Customer::retrieve($object["user_stripe_customer"]);
            $cu->sources->retrieve($object["id"])->delete();
            return ["customer"=>\Stripe\Customer::retrieve($object["user_stripe_customer"])];
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }   
   
    //account side
    
    public function createAccount($object) {
        
        /*$account = Stripe\Account::create(["country"=>"US", "type"=>"custom", "account_token"=>$object["code"]]);
        if(key_exists("id", $account)) {
            $this->db->set("user_stripe_account", $account->id)->where("user_email", $object["user_email"])->update("tbl_users");
            return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "account"=>$account->id];
        } 
        else {
            return [KEY_RES_MESSAGE=>"Registration failed!"];
        }*/
        try{
            $auth = Stripe\OAuth::token(["grant_type"=>"authorization_code", "code"=>$object["code"]]);
            $this->db->set("user_stripe_account", $auth->stripe_user_id)->where("user_email", $object["user_email"])->update("tbl_users");
            return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "account"=>$auth->stripe_user_id];
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
    
    public function getAccountLoginLink($object) {
        try{
            $account = \Stripe\Account::retrieve($object["user_stripe_account"]);
            $login_link = $account->login_links->create();    
            return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "url"=>$login_link->url];
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
    
    
    public function retrieveAccount($object) {
        try{
            $account = Stripe\Account::retrieve($object["user_stripe_account"]);
            return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "account"=>$account];
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
     
    
    public function deleteAccount($object) {
        
    }
    
    
    public function updateAccount($object) {
        
    }
    
    
    function getordernumber(){
        $orderdata = $this->db->get('orders')->result();
        $ret = 1;
        if(count($orderdata) > 0){
            $ret = $orderdata[count($orderdata) - 1]->order_id + 1;
        }
        if($ret > 999) return String.valueOf($ret);
        else if($ret > 99) return "0".$ret;
        else if($ret > 9) return "00".$ret;
        else return "000".$ret;
    }
    
    public function createCharge($orderdataarray) {
        try{
            $chargeArray = array();
            $chargeArray["amount"] = ceil($orderdataarray["amount"]);
            $chargeArray["currency"] = "mxn";
            $chargeArray["customer"] = $orderdataarray["user_stripe_customer"];
            if(key_exists("card_id", $orderdataarray)) {
                $chargeArray["source"] = $orderdataarray["card_id"];
            }
           // $chargeArray["application_fee"] = "0";//$orderdataarray["app_fee"];
            $charge=array();
            if($orderdataarray['card_number']!="Cash" && $orderdataarray['card_number']!="POS"){
              $charge = \Stripe\Charge::create($chargeArray);
            }
            //if($charge = $charge->id) {
            /*$this->db->where("id", $object->order_id)
                    ->set("charge_id", $charge->id)
                    ->set("contract_id", $object["contract_id"])
                    ->set("charge_amount", $object["amount"]["main_amount"])
                    ->set("charge_fee", $object["amount"]["stripe_fee"])
                    ->set("charge_app_fee", $object["amount"]["app_fee"])
                    ->set("charge_status", CHARGE_STATUS_CHARGED)
                    ->set("charge_timestamp", time())
                    ->insert("tbl_charges");*/
            //}

            //fee will be at least $0.99 and additions
            
            $this->db->set('order_id',$this->getordernumber());
            $this->db->set('product_ids',$orderdataarray['product_ids']);
            $this->db->set('customer_id',$orderdataarray['customer_id']);
            $this->db->set('amount',$orderdataarray['amount']/100);
            $this->db->set('card_number',$orderdataarray['card_number']);
            $this->db->set('payment_method',$orderdataarray['payment_method']);
            $this->db->set('order_time',date('Y-m-d H:i:s'));
            $this->db->set('status','1');
            $this->db->set('warehouse_id',$orderdataarray['warehouse_id']);
            $this->db->set('warehouse_name',$orderdataarray['warehouse_name']);
            $this->db->set('cash_amount',$orderdataarray['cash_amount']);
            $this->db->set('shipping_addressid',$orderdataarray['shipping_address']);
            if($orderdataarray['card_number']!="Cash" && $orderdataarray['card_number']!="POS"){
                $this->db->set('charge_id',$charge->id);
            }else{
                $this->db->set('charge_id',"");
            }
           
            $this->db->insert("orders");
            $orderid = $this->db->insert_id();
            
            $currenttotalorder=$this->db->where("id", $orderdataarray['customer_id'])->get("customers")->result()[0]->total_order;
            $this->db->where("id", $orderdataarray['customer_id']);
            $this->db->set("total_order", $currenttotalorder+1);
            $this->db->update('customers');
            
            $productidarray=  explode(',', $orderdataarray['product_ids']);
            $quantityarray= explode(',', $orderdataarray['product_quantities']);
            $pricearray = explode(',', $orderdataarray['product_prices']);
            $productnamearray= explode(',', $orderdataarray['product_names']);
             $productimagearray= explode(',', $orderdataarray['product_images']);
            $currentitem =0; 
            foreach($productidarray as $oneproduct){
                $this->db->set('order_id', $orderid);
                $this->db->set('warehouse_id', $orderdataarray['warehouse_id']);
                $this->db->set('warehouse_name',$orderdataarray['warehouse_name']);
                $this->db->set('product_name',$productnamearray[$currentitem]);
                $this->db->set('product_image',$productimagearray[$currentitem]);
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
             
             
             $this->db->where('warehouse_id',$orderdataarray['warehouse_id']);
             $this->db->where('user_type',"1");
             $warehouseusers = $this->db->get('users')->result();
             foreach($warehouseusers as $warehouseuser){
                 $token = $warehouseuser->token;
                 $title ="McFly";
                 $message = "New Order has been assigned to warehouse";
                 $this->sendPushNotification($token, $title, $message, "0",$orderid, "0");
             }
            
            
            
            
            
           // return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS];
            return $charge;
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
        
    }
    
    function provideFeedback($dataarray){
        
       
        if($dataarray['paytype']==0){   // by cash
            $this->db->set('order_id',$dataarray['orderid']);
            $this->db->set("customer_name", $dataarray['customername']);
            $this->db->set("rating", $dataarray['rating']);
            $this->db->set("tips", $dataarray['tip']);
            $this->db->set("comments", $dataarray['comment']);
            $this->db->insert('order_reviews');
            return "success";
        }else{  // by card
            try{
                $chargeArray = array();
                $chargeArray["amount"] = ceil($dataarray['tip']*100);
                $chargeArray["currency"] = "mxn";
                $chargeArray["customer"] = $dataarray["user_stripe_customer"];
                if(key_exists("card_id", $dataarray)) {
                    $chargeArray["source"] = $dataarray["card_id"];
                }
               // $chargeArray["application_fee"] = "0";//$orderdataarray["app_fee"];
                $charge=array();
                if($dataarray['card_id']!="Cash"){
                  $charge = \Stripe\Charge::create($chargeArray);
                }
                //if($charge = $charge->id) {
               
                //}
                $this->db->set('order_id',$dataarray['orderid']);
                $this->db->set("customer_name", $dataarray['customername']);
                $this->db->set("rating", $dataarray['rating']);
                $this->db->set("tips", $dataarray['tip']);
                $this->db->set("comments", $dataarray['comment']);
                $this->db->insert('order_reviews');
    
               // return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS];
                return $charge;
            }
            catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                
                
                return $this->processStripeError($e);
            } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly            
                
                
                return $this->processStripeError($e);
            } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
                
                
                return $this->processStripeError($e);
            } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
                
                
                return $this->processStripeError($e);
            } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
                
                
                return $this->processStripeError($e);
            } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
                
                
                return $this->processStripeError($e);
            } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
                
                
                return $this->processStripeError($e);
            }
        }
        
       
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
    
    public function transferMoney($object) {
        try{
            $transfer = Stripe\Transfer::create([
                "amount"=>$object["transfer_amount"],
                "currency"=>"usd",
                "destination"=>$object["user_stripe_account"]
            ]);
            if(!$transfer->id) {
                return [KEY_RES_MESSAGE=>"Transfer failed!"];
            }
            else {
                $this->db->set("transfer_id", $transfer->id)
                        ->set("contract_id", $object["contract_id"])
                        ->set("transfer_amount", $object["transfer_amount"])
                        ->set("transfer_timestamp", time())
                        ->insert("tbl_transfers");
                return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "transfer"=>$transfer->id];
            }
        }
        catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly            
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
            
            
            return $this->processStripeError($e);
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
            
            
            return $this->processStripeError($e);
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
            
            
            return $this->processStripeError($e);
        }
    }
    
    function processStripeError($error) {
        $body = $error->getJsonBody();
        $errorObject = $body["error"];
        return [KEY_RES_MESSAGE=>$errorObject['message']];
    }
    
    public function confirmChargeForRequest($object) {
        $requests = $this->db->where("request_id", $object["request_id"])->get("requesteditems")->result();
        if(sizeof($requests) > 0) {
            $request = $requests[0];
            $amount = $this->getPayAmount($request->request_from, $request->request_to, $request->request_unit, $request->request_price);
            return $this->createCharge(["user_stripe_customer"=>$request->user_stripe_customer,
                                    "amount"=>$amount,
                                    "contract_id"=>$object["contract_id"] ]);
        }
        else {
            return [KEY_RES_MESSAGE=>"No request!"];
        }
    }   


    private function getPayAmount($from, $to, $unit, $price) {
        $fromTime = strtotime($from);
        $toTime = strtotime($to);
        $datediff = $toTime - $fromTime;
        $days = round($datediff / 86400);
        
        //calculate total amount
        if($unit == 1) {
            $main_amount = $price * $days;
        }
        else if($unit == 2) {
            $main_amount = $price * $days * 8;
        }
        //calculate app fee
        if($main_amount < 20 * 100) {
                $appfee = 300;
        }
        else if($main_amount < 50 * 100) {
            $appfee = 400;
        }
        else if($main_amount < 100 * 100) {
            $appfee = $main_amount * 0.055;
        }
        else if($main_amount < 200 * 100) {
            $appfee = $main_amount * 0.042;
        }
        else if($main_amount < 300 * 100) {
            $appfee = $main_amount * 0.04;
        }
        else if($main_amount < 400 * 100) {
            $appfee = $main_amount * 0.04;
        }
        else if($main_amount < 500 * 100) {
            $appfee = $main_amount * 0.04;
        }
        else if($main_amount < 600 * 100) {
            $appfee = $main_amount * 0.04;
        }
        else {
            $appfee = $main_amount * 0.04;
        }
        //calculate fee for the deposit
        $stripefee = (($main_amount + $appfee) * 0.029 + 30) / (1 - 0.029);
        $total_price = $main_amount + $appfee + $stripefee;
        return [
            "charge_amount"=>$total_price,
            "app_fee"=>$appfee, 
            "stripe_fee"=>$stripefee, 
            "main_amount"=>$main_amount];
               
    }
    
    
    public function retreiveCharge($object) {
        $charge = \Stripe\Charge::retrieve($object["charge_id"]);
        $transaction = Stripe\BalanceTransaction::retrieve($charge->balance_transaction);
        return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "charge"=> $charge, "transaction"=>$transaction];
    }
        
    public function refundCharge($object) {
        $refund = Stripe\Refund::create(["charge"=>$object["charge_id"]]);
        return [KEY_RES_MESSAGE=>RES_MESSAGE_SUCCESS, "refund"=>$refund];
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
        
}
    