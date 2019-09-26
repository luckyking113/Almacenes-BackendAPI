<?php

class Admin_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    function getAlldriver($superadmin_id){ //1-client, 2-mower
        $this->db->select('*')
                 ->from('tb_driver')
                // <!--where('admin_id !=', $superadmin_id)->
                 ->order_by('driver_id', 'asc');
                 
        return $this->db->get()->result();
    }

    function getAllorders($filtertype){
        if($filtertype=="All"){
        }else{
            $filterid = 0;
            if($filtertype == "Assigned"){
                $filterid=0;
            }elseif($filtertype=="Driving"){
                $filterid=1;
            }else if($filtertype=="Completed"){
                $filterid=2;
            }
            $this->db->where("order_status", $filterid);
           
        }
        $this->db->order_by("order_id","DESC");
        return $this->db->get("tb_orders")->result();
    }

    function getAllnumbers(){
        $this->db->where("order_status", 0);
        $assigned = $this->db->get("tb_orders")->num_rows();

        $this->db->where("order_status", 1);
        $driving = $this->db->get("tb_orders")->num_rows();

        $this->db->where("order_status", 2);
        $completed = $this->db->get("tb_orders")->num_rows();

        $total = $assigned+$driving+$completed;

        $qty = array();
        $qty=  array(
            "total"=>$total,
            "assigned"=>$assigned,
            "driving"=>$driving,
            "completed"=>$completed,
            
        );
        return $qty;
    }

    function add_driver($drivername, $driveremail, $phonenumber, $password, $status){
        $emaildata = $this->db->where('driver_email', $driveremail)->get('tb_driver')->row();
        $phonedata = $this->db->where('driver_phone', $phonenumber)->get('tb_driver')->row();
        $status =3;
        if(!empty($emaildata)) {$status=1;}    // email already exist
        elseif(!empty($phonedata)) {$status=2;}    // phone already exist
        else{
            $this->db->set('driver_name', $drivername); // provider profile image url
            $this->db->set('driver_email', $driveremail);
            $this->db->set('driver_phone', $phonenumber);
            $this->db->set('driver_password', $password);
            if($status== "Active")
                $this->db->set('driver_accountstatus', 0);
            else
                $this->db->set('driver_accountstatus', 1);
            $this->db->insert('tb_driver');
            $status = 3;            
        }
        return $status;
    }

    function getDriverdetail($driver_id){
        $driverdata = $this->db->where('driver_id', $driver_id)->get('tb_driver')->result();
        return $driverdata;
    }

    function updatedriver($driverid, $drivername, $driveremail, $phonenumber, $password, $workstatus, $accountstatus){
        $this->db->where('driver_id',$driverid);
        $this->db->set('driver_name', $drivername); // provider profile image url
        $this->db->set('driver_email', $driveremail);
        $this->db->set('driver_phone', $phonenumber);
        $this->db->set('driver_password', $password);
        if($workstatus== "Free")
            $this->db->set('driver_status', 0);
        else
            $this->db->set('driver_status', 1);


        if($accountstatus== "Active")
            $this->db->set('driver_accountstatus', 0);
        else
            $this->db->set('driver_accountstatus', 1);
        $this->db->update('tb_driver');
    }

    function getOrderdetail($driver_id){
        $driverdata = $this->db->where('order_driverid', $driver_id)->get('tb_orders')->result();
        return $driverdata;
    }

    function addneworder($trackid,$destination, $drivername, $latitude, $longitude){
        $driverid= $this->db->where("driver_name", $drivername)->get("tb_driver")->result()[0]->driver_id;

        $this->db->set('track_id', $trackid); 
        $this->db->set('order_destination', $destination);
        $this->db->set('order_lat', $latitude);
        $this->db->set('order_lng', $longitude);
        $this->db->set('order_driverid', $driverid);
        $this->db->set('order_drivername', $drivername);
        $this->db->set('order_assignedtime',date("m/d/Y H:i"));
        $this->db->insert('tb_orders');
    }

    
    
   
//============================ Old One===================  
    
  
	
	public function split_name($name) {
	    $name = trim($name);
	    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
	    $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
	    return array($first_name, $last_name);
	}
	
	
	
	public function change_status_by_order_id($order_id){
		$this->db->set('status',3);
		$this->db->set('fillfulledtime',date("Y-m-d H:i:s"));
		$this->db->where('order_id',$order_id);
		$result=$this->db->update('tb_orderhistory');
		return $result;
	}
	
    
  
}
?>