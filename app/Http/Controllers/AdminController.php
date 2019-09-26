<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;
use App\Product;
use App\Group;
use App\Warehouse;
use App\TimeSheet;
use App\WarehouseProduct;
use App\WarehouseReport;
use App\Order;
use App\OrderReview;
use App\Category;
use App\Log;
use App\Customer;
use App\UserShift;
use App\Setting;
use App\EmployeePayment;
use App\UserType;
use Carbon\Carbon;
use App\Admin;
use App\Discount;
use App\OrderProduct;
use App\RegisterProduct;
use App\Tb_shippingaddres;

class AdminController extends Controller
{
    public $userTree = array();
    
    public function dashboards(Request $request)
    { 
  
      
        
        $user2_performance = array();
        $warehouse_performance = array();
        $warehouse_capacity_performance = array();
        $warehouse_report = array();
        
        $setting = Setting::find(1);
        $users_list = User::where('user_type','!=', 'VIP');
        $users_list = $users_list->get();
        
        foreach($users_list as $key=>$user)
        {
            if($user->orders->count())
            {
               
               
               
               if($user->user_type != 3)
               {
                  $order_performance = 0;
                  $total_accept_rate = 0;$total_collect_rate = 0;  $total_collect_warehouse_rate = 0; $total_deliver_rate = 0;
                  $total_arrive_destination_rate = 0; $total_taken_deliver_rate = 0;
                   $orders = $user->orders;
                   
                   foreach($orders as $order)
                   {
                        $accept_rate = '';$collect_rate = '';  $collect_warehouse_rate = ''; $deliver_rate = '';
                        $arrive_destination_rate = ''; $taken_deliver_rate = '';
                        
                        if($order->accept_order_time)
                        {
                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->order_time);
                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            $accept_rate = number_format(($diff_in_mins / $setting->accept_order) / 100, 2);
                            $total_accept_rate = $total_accept_rate +$accept_rate;
                        }
                        if($order->collect_order_time)
                        {
                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            $collect_rate = number_format(($diff_in_mins / $setting->collect_items) / 100, 2);
                            $total_collect_rate = $total_collect_rate + $collect_rate;  
                        }
                        if($order->deliver_order_time)
                        {
                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            $deliver_rate =  number_format(($diff_in_mins / $setting->hand_to_driver) / 100, 2);
                            $total_deliver_rate = $total_deliver_rate + $deliver_rate;

                            $performance = number_format(($accept_rate + $collect_rate + $deliver_rate) / 3, 2);
                            $order_performance = $order_performance +$performance;
                        }
                   }
                   
                   if($user->orders->count())
                       $total_orders_count = $user->orders->count();
                   else
                      $total_orders_count = 1;
                   $user2_performance[$user->id]= number_format(($order_performance / $total_orders_count) *100,2);
                 
               }
               elseif($user->user_type == 3)
               { 
                   $order_performance = 0;
                    $total_collect_warehouse_rate = 0;
                        $total_arrive_destination_rate = 0;
                        $total_taken_deliver_rate = 0;
                        $orders = $user->deliver_orders;
                   foreach($orders as $order)
                   {
                        $accept_rate = '';$collect_rate = '';  $collect_warehouse_rate = ''; $deliver_rate = '';
                        $arrive_destination_rate = ''; $taken_deliver_rate = '';

                        if($order->collect_warehouse_time )
                                         { 
                                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            $collect_warehouse_rate = number_format(($diff_in_mins / $setting->collect_from_warehouse) / 100, 2);
                                            $total_collect_warehouse_rate = $total_collect_warehouse_rate + $collect_warehouse_rate;  
                                         }
                                   
                                         if($order->arrival_destination_time)
                                         {
                                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            $arrive_destination_rate = number_format(($diff_in_mins / $setting->arrive_to_destination) / 100, 2);
                                            $total_arrive_destination_rate = $total_arrive_destination_rate + $arrive_destination_rate;
                                        }
                                         
                                        if($order->final_deliver_order_time) 
                                        {
                                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->final_deliver_order_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            $taken_deliver_rate = number_format(($diff_in_mins / $setting->taken_to_deliver) / 100, 2);
                                            $total_taken_deliver_rate = $total_taken_deliver_rate + $taken_deliver_rate;
                                        }
                        
                        $performance = number_format(($collect_warehouse_rate + $arrive_destination_rate + $taken_deliver_rate) / 3, 2);
                        $order_performance = $order_performance +$performance;
                   }
                   if($user->orders->count())
                       $total_orders_count = $user->orders->count();
                   else
                      $total_orders_count = 1;
                   $user2_performance[$user->id]= number_format(($order_performance / $total_orders_count)*100,2);
                 
                  
               }
            }
        }

        $all_warehouse_list = Warehouse::all();
        
        if($request->warehouse_id)
            $warehouse_list = Warehouse::where('id', $request->warehouse_id)->get();
        else
          $warehouse_list = Warehouse::all();
        
        $performance_goal = 0;
        $total_reports = 0;
        $performance_scale = 0;
        $inventory_scale = 0;
        $report_scale = 0;
        foreach($all_warehouse_list as $key=>$warehouse)
        {
            if($warehouse->users->count())
            {
                $users = $warehouse->users;
                $performance = 0;
                foreach($users as $user)
                {
                    if (array_key_exists($user->id, $user2_performance))
                       $performance = $performance + $user2_performance[$user->id];
                    else
                        $performance = 0;
                }
                
                $warehouse_performance[$warehouse->id]= number_format(($performance / $warehouse->users->count()), 2);
                
            }
            else
                $warehouse_performance[$warehouse->id]= 0;
            
        
            $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse', $warehouse->id)->get();
            $total_products = $products->count('products.id');

            $outof = 0;
            $warehouse_capacity = 0;
            if($total_products)
            {
                foreach($products as $product)
                {
                    $capacity =  number_format(($product->quantity / $product->max_capacity)*100,2);
                    $outof = $outof + $capacity;

                }
                $warehouse_capacity = number_format($outof / $total_products,2);
                $warehouse_capacity_performance[$warehouse->id] = $warehouse_capacity;
            }
            else
                $warehouse_capacity_performance[$warehouse->id] = 0;
          
            
            $report = WarehouseReport::where('warehouse_id', $warehouse->id)->where('status',0)->count('id');
            $warehouse_report[$warehouse->id] = $report;
            
            
           
        }
        
        foreach($warehouse_list as $key=>$warehouse)
        {
            if($warehouse->users->count())
            {
                $users = $warehouse->users;
                $performance = 0;
                foreach($users as $user)
                {
                    if (array_key_exists($user->id, $user2_performance))
                       $performance = $performance + $user2_performance[$user->id];
                    else
                        $performance = 0;
                }
                
             
                $performance_goal = $performance_goal + number_format(($performance / $warehouse->users->count()), 2);
            }
           
            if($request->date)
            {
                $date = explode("_", $request->date);
                $curMonth = $date[0]; 
                $maxMonth = $date[1];
                $max_year = $date[2];
                if($curMonth > 6 || $max_year == 2020)
                $performance_goal = 0;
                
               $report1 = WarehouseReport::where('warehouse_id', $warehouse->id)->whereMonth('created_at','>=', $curMonth)->whereMonth('created_at','<=', $maxMonth)->count('id');
            }
            else
            $report1 = WarehouseReport::where('warehouse_id', $warehouse->id)->count('id');
            
            $total_reports = $total_reports + $report1;
            $performance_scale =  $performance_scale + $warehouse->performance_scale;
            $inventory_scale = $inventory_scale + $warehouse->inventory_scale;
            $report_scale = $report_scale + $warehouse->report_scale;
           
        }

        $performance_scale = ($performance_scale) ? number_format($performance_scale / $warehouse_list->count('id'),2 ) : 1;
        $inventory_scale = ($inventory_scale) ? number_format($inventory_scale / $warehouse_list->count('id'),2 ) : 1;
        $performance_goal  = number_format($performance_goal / $warehouse_list->count('id'),2 );
        
        $report_scale = ($report_scale) ? number_format($report_scale / $warehouse_list->count('id'),2 ) : 2;
        $total_reports  = number_format($total_reports / $warehouse_list->count('id'),2 );
      
        $warehosue_ids = array();
        foreach($warehouse_list as $key=>$warehouse)
        {
            if($warehouse->users->count())
            {
                $users = $warehouse->users;
                $performance = 0;
                $total_deliver_warehouse = 0;
                $total_user_warehouse = 0;
                foreach($users as $user)
                {
                    if($user->user_type == 3)
                    {
                         if (array_key_exists($user->id, $user2_performance))
                              $total_deliver_warehouse = $total_deliver_warehouse + $user2_performance[$user->id];
                    }
                    else {
                        if (array_key_exists($user->id, $user2_performance))
                              $total_user_warehouse = $total_user_warehouse + $user2_performance[$user->id];
                    }
                   
                }
                $warehosue_ids[$warehouse->id] = number_format(($total_user_warehouse / $warehouse->users->count()),2) + number_format(($total_deliver_warehouse /  $warehouse->users->count()),2);
               
            }
        }
        
        $warehouse_performance_1 = array();
        $monthArray = array();
        
        if($request->date)
        {
           $date = explode("_", $request->date);
           $curMonth = $date[0]; 
           $maxMonth = $date[1];
           $max_year = $date[2];
            if($curMonth < 7)
            {
              $monthArray = "'January','February','March','April','May', 'June'"; 
              $date_text  = '1 Jan, '.$max_year.' - 30 June, '.$max_year;
            }
            else
            {
               $monthArray = "'July','August','September','October','November', 'December'";
               $date_text  = '1 July, '.$max_year.' - 31 December, '.$max_year;
            }
             
        }
        else
        {
            $curMonth = date('m');
            $maxMonth = $curMonth + 6;
            $max_year = date("Y");
            if($curMonth <= 7)
            { 
                $curMonth = 1;
                $monthArray = "'January','February','March','April','May', 'June'"; 
                $date_text  = '1 Jan, '.$max_year.' - 30 June, '.$max_year;
               
            }
            else
            {
               $monthArray = "'July','August','September','October','November', 'December'";   
               $curMonth = 7;
               $date_text  = '1 July, '.$max_year.' - 31 December, '.$max_year;
                
            }
            
           
        }
        
        $selected_date = $request->date;
        $total_sell = 0;
        $total_cost = 0;
        $total_reports_2 = 0;
        $goal_com_array = array();
        
        for($i=$curMonth;$i<=$maxMonth;$i++)
        {
            
            if($request->warehouse_id)
            {
               $ware_houses = Warehouse::join('orders','warehouses.id','orders.warehouse_id')->where('orders.warehouse_id', $request->warehouse_id)->whereMonth('orders.order_time', $i)->whereYear('orders.order_time', $max_year)->get();
              // $product_cost = Log::where('warehouse_id', $request->warehouse_id)->where('type',0)->whereMonth('created_at', $i)->whereYear('created_at', $max_year)->sum('price');
               $product_logs = Log::where('warehouse_id', $request->warehouse_id)->whereMonth('created_at', $i)->where('type',0)->where('status',1)->whereYear('created_at', $max_year)->select(DB::Raw('product_id'))->groupBy('product_id')->get(); 
            }
            else
            {
               $ware_houses = Warehouse::join('orders','warehouses.id','orders.warehouse_id')->whereMonth('orders.order_time', $i)->whereYear('orders.order_time', $max_year)->get();
               $product_logs = Log::whereMonth('created_at', $i)->where('type',0)->where('status',1)->whereYear('created_at', $max_year)->select(DB::Raw('product_id'))->groupBy('product_id')->get(); 
            }
           
            $sub_total = 0;
            
            foreach($product_logs as $log)
            {
                $cost_product = Log::where('product_id', $log->product_id)->get();
                $sell_product = OrderProduct::join('products','products.id','order_products.product_id')->where('order_products.product_id', $log->product_id)->select(DB::Raw('SUM(order_products.quantity) as sell_qty,products.price'))->groupBy('order_products.product_id')->get();
                $cost = 0;
                $log_count = $cost_product->count();
                if($log_count)
                    $cost = $cost_product[$log_count - 1]->price / $cost_product[$log_count - 1]->quantity;
                if($sell_product->count())
                    $sub_total = $sub_total+($sell_product[0]->sell_qty * $cost);
             
            }
            $total_cost = $total_cost + $sub_total;
            
            
            $performance = 0;
            foreach($ware_houses as $key=>$warehouse)
            {
               if (array_key_exists($warehouse->warehouse_id, $warehosue_ids))
                           $performance = $performance + $warehosue_ids[$warehouse->warehouse_id];
                


            }
            
            $total_warehouse = ($warehouse_list->count()) ? $warehouse_list->count() : 1;
            $warehouse_performance_1[$i]= number_format(($performance / $total_warehouse), 2);
    $total_sell = $total_sell + $ware_houses->sum('amount');
    
            
            $report2 = WarehouseReport::where('warehouse_id', $warehouse->id)->whereMonth('created_at', $i)->whereYear('created_at', $max_year)->count('id');
            $total_reports_2 = $total_reports_2 + $report2;
            $total_reports_2  = number_format($total_reports_2 / $total_warehouse,2 );
            if($i == 3 || $i == 9)
            $goal_com_array[$i] = number_format((($total_reports_2 + ($total_sell/ $total_warehouse)) / $warehouse_list->count())/100,2) ;
            else
                $goal_com_array[$i] = 0;
        }
     
        $setting = Setting::find(1);
       
        $discounts = Discount::orderBy('created_at', 'desc')->take(5)->get();
        $users = Customer::whereNull('type')->orderBy('created_at', 'desc')->take(5)->get();
        
        
  
        if($request->warehouse_id)
        {
            $top_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty, SUM(amount) as total_price'))->where('warehouse_id',$request->warehouse_id)->groupBy('product_id')->orderBy('total_qty','desc')->take(5)->get();
            $least_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty, SUM(amount) as total_price'))->where('warehouse_id',$request->warehouse_id)->groupBy('product_id')->orderBy('total_qty','asc')->take(5)->get();
            $latest_orders = Order::where('warehouse_id', $request->warehouse_id)->orderBy('created_at','desc')->take(10)->get();
            $all_sell = OrderProduct::where('warehouse_id',$request->warehouse_id)->get();
        }
        else
        {
            $top_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty, SUM(amount) as total_price'))->groupBy('product_id')->orderBy('total_qty','desc')->take(5)->get();
            $least_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty, SUM(amount) as total_price'))->groupBy('product_id')->orderBy('total_qty','asc')->take(5)->get();
        
            $latest_orders = Order::orderBy('created_at','desc')->take(10)->get();
            $all_sell = OrderProduct::all();
        }
        $sell_category = array();
   
        foreach ($all_sell as $sell)
        {
           if(array_key_exists($sell->product->category_id, $sell_category))
              $sell_category[$sell->product->category_id] = $sell_category[$sell->product->category_id] + 1;
           else
              $sell_category[$sell->product->category_id] = 1; 
        }
        
        arsort($sell_category);
        reset($sell_category);
        $top_cat = key($sell_category);
        end($sell_category);
        $last_cat = key($sell_category);
       
       
       $top_selling_cat = Category::find($top_cat);
       if(isset($top_selling_cat))
           $top_selling_cat = $top_selling_cat->name;
     
       $least_selling_cat = Category::find($last_cat);
       if(isset($least_selling_cat))
           $least_selling_cat = $least_selling_cat->name;
       
      $last_month =  date('m', strtotime(date('Y-m')." -1 month"));
      $last_year =  date('Y', strtotime(date('Y-m')." -1 month"));
      $cat_curr_month = OrderProduct::join('products','products.id','order_products.product_id')->select(DB::Raw(' SUM(quantity) as total_qty'))->where('category_id',$top_cat)->whereMonth('order_products.created_at',date('m'))->whereYear('order_products.created_at',date('Y'))->get();
      $cat_last_month = OrderProduct::join('products','products.id','order_products.product_id')->select(DB::Raw(' SUM(quantity) as total_qty'))->where('category_id',$top_cat)->whereMonth('order_products.created_at',$last_month)->whereYear('order_products.created_at',$last_year)->get();
      
      $least_cat_curr_month = OrderProduct::join('products','products.id','order_products.product_id')->select(DB::Raw(' SUM(quantity) as total_qty'))->where('category_id',$last_cat)->whereMonth('order_products.created_at',date('m'))->whereYear('order_products.created_at',date('Y'))->get();
      $least_cat_last_month = OrderProduct::join('products','products.id','order_products.product_id')->select(DB::Raw(' SUM(quantity) as total_qty'))->where('category_id',$last_cat)->whereMonth('order_products.created_at',$last_month)->whereYear('order_products.created_at',$last_year)->get();
    
      if($cat_last_month[0]->total_qty)
        $top_cat_increase = ($cat_curr_month[0]->total_qty / $cat_last_month[0]->total_qty)*100; 
      else 
        $top_cat_increase = 500;
      
      if($least_cat_last_month[0]->total_qty)
        $least_cat_increase = ($least_cat_curr_month[0]->total_qty / $least_cat_last_month[0]->total_qty)*100; 
      else 
        $least_cat_increase = 500;

     $warehouse_name = '';
             if($request->warehouse_id)
             {
                 $warehouse_name = $warehouse_list[0]->name;
                
             }

        return view('admin.dashboard', compact('warehouse_name','products','warehouse_performance','warehouse_capacity_performance','warehouse_list','all_warehouse_list','warehouse_report','warehouse_performance_1','monthArray', 'performance_goal','setting','total_reports','selected_date','total_cost','total_sell','performance_scale','report_scale','inventory_scale','discounts','users','top_selling_products','latest_orders','least_selling_products','top_selling_cat','least_selling_cat','date_text','goal_com_array','top_cat_increase','least_cat_increase')); 
      
    }
    
    public function warehouseTopProductList(Request $request)
    {
        $warehouses = Warehouse::all(); 
        if($request->warehouse)
        {
            $top_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty'))->where('warehouse_id',$request->warehouse)->groupBy('product_id')->get();
        }
        else
        {
            $top_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty, SUM(amount) as total_price'))->groupBy('product_id')->orderBy('total_qty','desc')->get();
        }
        $selected_warehouse = $request->warehouse;
//        echo "<pre>";
//        print_r($top_selling_products->toArray()); exit;
         return view('admin.top_selling_products', compact('top_selling_products','warehouses','selected_warehouse'));
    }
    
     public function warehouseLeastProductList(Request $request)
    {
        $warehouses = Warehouse::all(); 
        if($request->warehouse)
        {
            $top_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty'))->where('warehouse_id',$request->warehouse)->orderBy('total_qty','asc')->get();
        }
        else
        {
            $top_selling_products = OrderProduct::select(DB::Raw('*, SUM(quantity) as total_qty, SUM(amount) as total_price'))->groupBy('product_id')->orderBy('total_qty','asc')->get();
        }
        $selected_warehouse = $request->warehouse;
//        echo "<pre>";
//        print_r($top_selling_products->toArray()); exit;
         return view('admin.least_selling_products', compact('top_selling_products','warehouses','selected_warehouse'));
    }
    public function changeReportStatus(Request $request)
    { 
  
        $report = WarehouseReport::find($request->id);
        
        $report->status = $request->status;
        $report->save();
        echo 1;
        exit;
      
    }
    public function changeCustomerStatus(Request $request)
    { 
  
        $customer = Customer::find($request->id);
        if($customer->status == 1)
          $customer->status = 0;
        else
          $customer->status = 1;
       $update = $customer->save();
        if($update)
            return redirect('admin/customers_list')->with('success', 'Customer status has been updated successfully ');
        else
            return redirect('admin/customers_list')->with('success', 'Customer status has not been updated');
      
    }
    public function evaluationScale(Request $request)
    { 
  
        $setting = Setting::find(1);
        $user_types = UserType::all();
        
        return view('admin.settings', compact('setting','user_types')); 
      
    }
    public function goalCompletion(Request $request)
    { 
  
        $setting = Setting::find(1);
        
        return view('admin.goal_completion', compact('setting')); 
      
    }
    public function InventoryCapacity(Request $request)
    {
         $warehouses = Warehouse::all();   
         
        
         
        if($request->warehouse)
           $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse',$request->warehouse);
        else
            $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse');
        
         $sub_cats = array();
         if(!empty($request->category))  
         {    
           $products = $products->where('category_id', $request->category); 
           $sub_cats = Category::where('parent_id', $request->category)->get();
         }
         if(!empty($request->subcategory))     
           $products = $products->where('sub_category_id', $request->subcategory); 
//         if(!empty($request->warehouse))     
//           $products = $products->where('warehouse_products.warehouse', $request->warehouse);
         
         $products = $products->get();
         
         
         $categories = DB::table('category')->where('parent_id', '=', 0)->get();
         $tab = 'warehouse';

	 return view('admin.products_capacity', ['tab'=>$tab,'products' => $products,'warehouses' => $warehouses, 'categories' => $categories,'selected_cat'=>$request->category,'selected_subcat'=>$request->subcategory,'selected_warehouse'=>$request->warehouse,'sub_cats'=>$sub_cats]);
    }
    public function inventoryDashboard(Request $request)
    { 
       
        if($request->page > 1)
            $page = $request->page*1;
        else
            $page =1;
        $category = Category::where('parent_id', 0)->get();
       
        $total_category = $category->count('category_id');
        
         $category_2 = Category::where('parent_id', 0)->get();
        
        $subcategory = Category::where('parent_id', '>' , 0)->get();
       
        $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse')->get();
        $total_products = $products->count('products.id');
        
        $product_capacity = array(); 
        $outof = 0;
        foreach($products as $product)
        {
            $capacity =  ($product->quantity / $product->max_capacity)*100;
            $product_capacity[] =  array("name" => $product->name, "capacity" => $capacity);
          $capacity = number_format($capacity,2,'.','');
           // if($product->quantity < $product->min_capacity)
            $outof = $outof + $capacity;
           
        }

        $warehouse_capacity = number_format($outof / $total_products,2);
       
        
        $category_capacity = array(); 
        foreach($category_2 as $cat)
        {
            $cat_product = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse')->where('category_id',$cat->category_id)->get();
            $total_cat_product = $cat_product->count();
         
            if($total_cat_product)
            {
                $outof = 0;
                foreach($cat_product as $product)
                {
                     $capacity =  ($product->quantity / $product->max_capacity)*100;
                     $outof = $outof + $capacity;
//                    if($product->quantity < $product->min_capacity)
//                        $outof = $outof + 1;
                }
             
                //$cat_capacity = (($total_cat_product - $outof) / $total_cat_product)*100;
                 $cat_capacity = number_format($outof / $total_cat_product,2);
                $category_capacity[] = array('name'=> $cat->name,'capacity'=>$cat_capacity);
            }
//            else
//             $category_capacity[] = array('name'=> $cat->name,'capacity'=>0);   
          }
          
          
        $subcategory_capacity = array(); 
        foreach($subcategory as $cat)
        {
            $cat_product = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse')->where('sub_category_id',$cat->category_id)->get();
            $total_cat_product = $cat_product->count();
         
            if($total_cat_product)
            {
                $outof = 0;
                foreach($cat_product as $product)
                {
                    $capacity =  ($product->quantity / $product->max_capacity)*100;
                     $outof = $outof + $capacity;
                }
                 $cat_capacity = number_format($outof / $total_cat_product,2);
               // $cat_capacity = (($total_cat_product - $outof) / $total_cat_product)*100;
                $subcategory_capacity[] = array('id'=>$cat->category_id,'name'=> $cat->name,'capacity'=>$cat_capacity);
            }
 
          }
          
         $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) order by id desc limit 10");
         
         $most_product_move = Product::orderBy('total_moved', 'desc')->first();
         $most_warehouse_move = WarehouseProduct::select(DB::Raw('warehouse, COUNT(*) as count'))->whereNotNull('warehouse')->groupBy('warehouse')->orderBy('count','desc')->first();
         if(isset($most_warehouse_move))
           $most_warehouse_name = Warehouse::find($most_warehouse_move->warehouse);
         
         
          $warehouses = WareHouse::orderBy('created_at', 'desc')->get();

        return view('admin.inventory_dashboard', compact('warehouses','total_category', 'total_products','product_capacity','category_capacity','subcategory_capacity','products','warehouse_capacity','most_product_move','most_warehouse_name','category_2')); 
      
    }
    public function employeeDashboard(Request $request)
    { 
        $orders = Order::all();
        $setting = Setting::find(1);
        $users = User::where('user_type','!=', 'VIP')->get();
        $warehouses = Warehouse::all();
        $user_types = UserType::all();
        $user_performance = array();
        $user2_performance = array();
        $warehouse_performance = array();
        $type_performance = array();
        $user3_performance = array();
        $warehouse_type_performance = array();
        $selected_user_warehouse = '';
        $selected_user_type = '';
        
        $users_list = User::where('user_type','!=', 'VIP');
                
        if($request->type == 'employee')
        { 
            if($request->option)
            {
                $users_list = $users_list->where('warehouse_id',$request->option);
                $selected_user_warehouse = $request->option;
            }
            if($request->option2)
            {
                $users_list = $users_list->where('user_type',$request->option2);
                $selected_user_type = $request->option2;
            }
        }
        $users_list = $users_list->get();
        
        
        foreach($users_list as $key=>$user)
        {
           // if($user->orders->count())
            {
              
               
               
               if($user->user_type != 3)
               {
                  $order_performance = 0;
                  $total_accept_rate = 0;$total_collect_rate = 0;  $total_collect_warehouse_rate = 0; $total_deliver_rate = 0;
                  $total_arrive_destination_rate = 0; $total_taken_deliver_rate = 0;
                  
                  $orders = $user->orders;
                   foreach($orders as $order)
                   {
                        $accept_rate = 0;$collect_rate = 0;  $collect_warehouse_rate = 0; $deliver_rate = 0;
                        $arrive_destination_rate = 0; $taken_deliver_rate = 0;
                       if($order->accept_order_time){
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->order_time);
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                        $diff_in_mins = $to->diffInMinutes($from);
                        $accept_rate = number_format(($diff_in_mins / $setting->accept_order) / 100, 2, '.', '');
                        $total_accept_rate = $total_accept_rate +$accept_rate;
                       }
                 
                       if($order->collect_order_time){
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                        $diff_in_mins = $to->diffInMinutes($from);
                        $collect_rate = number_format(($diff_in_mins / $setting->collect_items) / 100, 2, '.', '');
                        $total_collect_rate = $total_collect_rate + $collect_rate;  
                       }
                       if($order->deliver_order_time){
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                        $diff_in_mins = $to->diffInMinutes($from);
                        $deliver_rate =  number_format(($diff_in_mins / $setting->hand_to_driver) / 100, 2, '.', '');
                        $total_deliver_rate = $total_deliver_rate + $deliver_rate;
                       }
                        $performance = number_format(($accept_rate + $collect_rate + $deliver_rate) / 3, 2, '.', '');
                        $order_performance = $order_performance +$performance;
                   }
                   if($user->orders->count())
                       $total_orders_count = $user->orders->count();
                   else
                      $total_orders_count = 1;
                   
                   
                   $user_performance[$user->id]= array("value"=> number_format(($order_performance / $total_orders_count)*100,2, '.', ''), "name"=>$user->name,'user_type'=>$user->user_type,'user_type_name'=>$user->type->name,'user_warehouse'=>$user->warehouse->name);
                   $user2_performance[$user->id]= number_format(($order_performance / $total_orders_count) *100,2);
                   $user3_performance[$user->id]= array(
                                                         "accept_rate"=> number_format(($total_accept_rate / $total_orders_count)*100,2, '.', ''), 
                                                         "collect_rate"=> number_format(($total_collect_rate / $total_orders_count)*100,2, '.', ''),
                                                         "deliver_rate"=> number_format(($total_deliver_rate / $total_orders_count)*100,2, '.', ''), 
                                                         "name"=>$user->name, 
                       'total' => number_format(($total_accept_rate / $total_orders_count)*100,2, '.', '') + number_format(($total_collect_rate / $total_orders_count)*100,2, '.', '') + number_format(($total_deliver_rate / $total_orders_count)*100,2, '.', ''),
                                                         'user_type'=>$user->user_type,
                                                          'user_id'=>$user->id
                                                       );
                 
                   
                  
                  
               }
               elseif($user->user_type == 3)
               { 
                   $order_performance = 0;
                    $total_collect_warehouse_rate = 0;
                        $total_arrive_destination_rate = 0;
                        $total_taken_deliver_rate = 0;
                      $orders = $user->deliver_orders;  
                      
                   foreach($orders as $order)
                   {
                        $accept_rate = 0;$collect_rate = 0;  $collect_warehouse_rate =0; $deliver_rate = 0;
                        $arrive_destination_rate = 0; $taken_deliver_rate = 0;

                        if($order->collect_warehouse_time )
                                         { 
                                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            $collect_warehouse_rate = number_format(($diff_in_mins / $setting->collect_from_warehouse) / 100, 2, '.', '');
                                            $total_collect_warehouse_rate = $total_collect_warehouse_rate + $collect_warehouse_rate;  
                                         }
                                   
                                         if($order->arrival_destination_time)
                                         {
                                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            $arrive_destination_rate = number_format(($diff_in_mins / $setting->arrive_to_destination) / 100, 2, '.', '');
                                            $total_arrive_destination_rate = $total_arrive_destination_rate + $arrive_destination_rate;
                                        }
                                         
                                        if($order->final_deliver_order_time) 
                                        {
                                            $from = Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $order->final_deliver_order_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            $taken_deliver_rate = number_format(($diff_in_mins / $setting->taken_to_deliver) / 100, 2, '.', '');
                                            $total_taken_deliver_rate = $total_taken_deliver_rate + $taken_deliver_rate;
                                        }
                        
                        $performance = number_format(($collect_warehouse_rate + $arrive_destination_rate + $taken_deliver_rate) / 3, 2, '.', '');
                        $order_performance = $order_performance +$performance;
                   }
                   
                   if($user->orders->count())
                       $total_orders_count = $user->orders->count();
                   else
                      $total_orders_count = 1;
                   $user_performance[$user->id]= array("value"=> number_format(($order_performance / $total_orders_count)*100,2, '.', ''), "name"=>$user->name,'user_type'=>$user->user_type,'user_type_name'=>$user->type->name,'user_warehouse'=>$user->warehouse->name);
                   $user2_performance[$user->id]= number_format(($order_performance / $total_orders_count)*100,2, '.', '');
                   
                   $user3_performance[$user->id]= array(
                                                         "collect_warehouse_rate"=> number_format(($total_collect_warehouse_rate / $total_orders_count)*100,2, '.', ''), 
                                                         "arrival_destimation_rate"=> number_format(($total_arrive_destination_rate / $total_orders_count)*100,2, '.', ''),
                                                         "taken_deliver_rate"=> number_format(($total_taken_deliver_rate / $total_orders_count)*100,2, '.', ''), 
                                                         "name"=>$user->name, 
                       'total' => number_format(($total_collect_warehouse_rate / $total_orders_count)*100,2, '.', '') + number_format(($total_arrive_destination_rate / $total_orders_count)*100,2, '.', '') + number_format(($total_taken_deliver_rate / $total_orders_count)*100,2, '.', ''),
                                                         'user_type'=>$user->user_type,
                                                         'user_id'=>$user->id
                                                       );
                  
               }
            }
        }
         usort($user_performance, function($a, $b) { return $a['value'] - $b['value'];});
   
        $selected_employee_sort = 'high'; 
        if($request->type == 'employee')
        { 
            if($request->option1 == 'high')
               usort($user3_performance, function($a, $b) { return $b['total'] - $a['total'];});
            elseif($request->option1 == 'low')
               usort($user3_performance, function($a, $b) { return $a['total'] - $b['total'];});
            
           $selected_employee_sort = $request->option1;
        }
        else
            usort($user3_performance, function($a, $b) { return $b['total'] - $a['total'];});
            
//            echo "<pre>";
//            print_r($user3_performance);
//            exit;
         
        if($request->type == 'warehouse')
        { 
            if($request->option)
                $warehouse_list = Warehouse::where('id',$request->option)->get();
            else
                $warehouse_list = Warehouse::all();
        }
        else
            $warehouse_list = Warehouse::all();
        
        $selected_warehouse = $request->option;
        $selected_sort = $request->option1;
        
        $top_low_warehosue = array();
        foreach($warehouse_list as $key=>$warehouse)
        {
            if($warehouse->users->count())
            {
                $users = $warehouse->users;
                $performance = 0;
                foreach($users as $user)
                {
                    if (array_key_exists($user->id, $user2_performance))
                       $performance = $performance + $user2_performance[$user->id];
                    else
                        $performance = 0;
                }
                $top_low_warehosue[$warehouse->id]= array("value"=>number_format(($performance / $warehouse->users->count()), 2),"name"=>$warehouse->name);
                $warehouse_performance[$warehouse->id]= array("value"=>number_format(($performance / $warehouse->users->count()), 2),"name"=>$warehouse->name);
            }
        }
        usort($top_low_warehosue, function($a, $b) { return $a['value'] - $b['value'];});
        if($request->type == 'warehouse')
        { 
            if($request->option1)
            {
               if($request->option1 == 'high')
                  usort($warehouse_performance, function($a, $b) { return $b['value'] - $a['value'];});
               elseif($request->option1 == 'low')
                 usort($warehouse_performance, function($a, $b) { return $a['value'] - $b['value'];});
            }
            else
                 usort($warehouse_performance, function($a, $b) { return $b['value'] - $a['value'];});
        }
        else
            usort($warehouse_performance, function($a, $b) { return $b['value'] - $a['value'];});
        
        
        
        
        $low_type_performance = array();
        foreach($user_types as $key=>$type)
        { 
            $type_warehouse_performance = array();
           foreach($warehouse_list as $key=>$warehouse)
           {
                $warehouse_user_types = User::where('warehouse_id',$warehouse->id)->where('user_type',$type->id)->whereNotNull('warehouse_id');
                if($warehouse_user_types->count())
                {
                    $users = $warehouse_user_types->get();
                   
                    $performance = 0;
                    foreach($users as $key=>$user)
                    {

                      if (@array_key_exists($user->id, $user2_performance))
                          $performance = $performance + $user2_performance[$user->id];
                      else
                          $performance = 0;
                    }

                    $type_warehouse_performance[$warehouse->id]= array("value"=>number_format(($performance / $warehouse_user_types->count()), 2),"warehouse_name"=>$warehouse->name);
                 }
                 else
                   $type_warehouse_performance[$warehouse->id] = array("value"=> 0,"warehouse_name"=>$warehouse->name);  
                 
             
           }
           
           
           usort($type_warehouse_performance, function($a, $b) { return $b['value'] - $a['value'];});
            
           $type_performance[$type->id] = array('value' => $type_warehouse_performance[0]['value'],'warehouse_name' => $type_warehouse_performance[0]['warehouse_name'],'type_name' => $type->name);
           $low_type_performance[$type->id] = array('value' => $type_warehouse_performance[count($type_warehouse_performance) - 1]['value'],'warehouse_name' => $type_warehouse_performance[count($type_warehouse_performance) - 1]['warehouse_name'],'type_name' => $type->name);
             
           
           }
    
        usort($type_performance, function($a, $b) { return $b['value'] - $a['value'];});
         
        usort($low_type_performance, function($a, $b) { return $a['value'] - $b['value'];});

        $warehosue_ids = array();
        foreach($warehouses as $key=>$warehouse)
        {
            if($warehouse->users->count())
            {
                $users = $warehouse->users;
                $performance = 0;
                $total_deliver_warehouse = 0;
                $total_user_warehouse = 0;
                foreach($users as $user)
                {
                    if($user->user_type == 3)
                    {
                         if (array_key_exists($user->id, $user2_performance))
                              $total_deliver_warehouse = $total_deliver_warehouse + $user2_performance[$user->id];
                    }
                    else {
                        if (array_key_exists($user->id, $user2_performance))
                              $total_user_warehouse = $total_user_warehouse + $user2_performance[$user->id];
                    }
                   
                }
                $warehosue_ids[$warehouse->id] = number_format(($total_user_warehouse / $warehouse->users->count()),2) + number_format(($total_deliver_warehouse /  $warehouse->users->count()),2);
                $warehouse_user_performance[$warehouse->id]= array(
                                                         "warehouse_user"=> number_format(($total_user_warehouse / $warehouse->users->count()),2), 
                                                         "deliver_man"=> number_format(($total_deliver_warehouse /  $warehouse->users->count()),2),
                                                         "total" => number_format(($total_user_warehouse / $warehouse->users->count()),2) + number_format(($total_deliver_warehouse /  $warehouse->users->count()),2),
                                                         "name"=>$warehouse->name
                                                       );
                
            }
        }
        
        
        
        $warehouse_performance_1 = array();
        for($i=1;$i<=12;$i++)
        {
            $ware_houses = Warehouse::join('orders','warehouses.id','orders.warehouse_id')->whereMonth('orders.created_at', $i)->get();

            $performance = 0;
            foreach($ware_houses as $key=>$warehouse)
            {
               if (array_key_exists($warehouse->warehouse_id, $warehosue_ids))
                           $performance = $performance + $warehosue_ids[$warehouse->warehouse_id];
                


            }
            
            $total_warehouse = ($ware_houses->count()) ? $ware_houses->count() : 1;
            $warehouse_performance_1[$i]= number_format(($performance / $total_warehouse), 2);
        }
       
        $reports = WarehouseReport::whereNotNull('warehouse_id')->where('report_type','General report')->get();
        $selected_dep_sort = 'high';
        if($request->type == 'dep_warehouse')
        {
            if($request->option == 'low')
               usort($warehouse_user_performance, function($a, $b) { return $a['total'] - $b['total'];});
            elseif($request->option == 'hig')
               usort($warehouse_user_performance, function($a, $b) { return $b['total'] - $a['total'];});
            else
                usort($warehouse_user_performance, function($a, $b) { return $b['total'] - $a['total'];}); 
                
                $selected_dep_sort = $request->option;
        }
        else
          usort($warehouse_user_performance, function($a, $b) { return $b['total'] - $a['total'];}); 
   
      
         return view('admin.employee_dashboard', compact('top_low_warehosue','user_performance', 'type_performance','low_type_performance', 'warehouse_performance','user3_performance','warehouse_user_performance','warehouse_performance_1','reports','warehouses','selected_warehouse','selected_sort','user_types','selected_user_warehouse','selected_user_type','selected_dep_sort','selected_employee_sort'));
        
        
    }
    public function UserOrders(Request $request)
    {
        if($request->type == 3)
            $orders = Order::where('deliverman_id', $request->id)->get();
        else
           $orders = Order::where('user_id', $request->id)->get();
        
        $setting = Setting::find(1);
     
        return view('admin.user_orders', compact('orders','setting')); 
    }
    
    public function Discounts(Request $request)
    {
        $general_discounts = Discount::where('type', 'general')->get();
        $vip_discounts = Discount::where('type', 'VIP')->get();
       
        return view('admin.discounts', compact('general_discounts','vip_discounts')); 
    }
    public function CustomerOrders(Request $request)
    {
        $orders = Order::where('customer_id', $request->id)->get();
        $setting = Setting::find(1);
     
        return view('admin.user_orders', compact('orders','setting')); 
    }
    public function employeeDashboard_2(Request $request)
    {
        $orders = Order::all();
        $setting = Setting::find(1);
        
        $users = User::where('user_type','!=', 'VIP')->get();
        $warehouses = Warehouse::all();
        $user_types = UserType::all();
        
        $user_chart = array();
        $user_value = array();
        $selected_warehouse = '';
        $selected_user = '';
        $selected_type = '';
        $warehouse_chart = array();
        $chart_label = array();
        $value = array(28, 48, 40, 19, 86,50,15,20,30,40,60,10);
     
       
        if($request->type && $request->type == 'warehouse')
        { 
            $type = $request->type;
            $selected_warehouse =  $request->type;
            if($request->id)
            {
                for($i = 0; $i<7;$i++)
                {
                   $chart_label[] = "'".date('m/d/Y', strtotime(date('Y-m-d'). ' + '.$i. 'days'))."'";
                   $chart_value[] = $value[$i]; 
                }
            }
            else
            {
                foreach($warehouses as $key=>$warehouse)
                {
                    $chart_label[] = "'".$warehouse->name."'";
                    $chart_value[] = $value[$key];
                }
            }
        }
        elseif($request->type && $request->type == 'employee')
        { 
            $type = $request->type;
            $selected_user =  $request->type;
            if($request->id)
            {
                for($i = 0; $i<7;$i++)
                {
                   $chart_label[] = "'".date('m/d/Y', strtotime(date('Y-m-d'). ' + '.$i. 'days'))."'";
                   $chart_value[] = $value[$i]; 
                }
            }
            else
            {
                foreach($users as $key=>$user)
                {
                    $chart_label[] = "'".$user->name."'";
                    $chart_value[] = $value[$key];
                }
            }
        }
        elseif($request->type && $request->type == 'department')
        { 
            $type = $request->type;
            $selected_type =  $request->type;
            if($request->id)
            {
                for($i = 0; $i<7;$i++)
                {
                   $chart_label[] = "'".date('m/d/Y', strtotime(date('Y-m-d'). ' + '.$i. 'days'))."'";
                   $chart_value[] = $value[$i]; 
                }
            }
            else
            {
                foreach($user_types as $key=>$user_type)
                {
                    $chart_label[] = "'".$user_type->name."'";
                    $chart_value[] = $value[$key];
                }
            }
        }
        else
        { 
            $type = 'employee';
            $selected_user =  'employee';
            if($request->id)
            {
                for($i = 0; $i<7;$i++)
                {
                   $chart_label[] = "'".date('m/d/Y', strtotime(date('Y-m-d'). ' + '.$i. 'days'))."'";
                   $chart_value[] = $value[$i]; 
                }
            }
            else
            {
                foreach($users as $key=>$user)
                {
                    $chart_label[] = "'".$user->name."'";
                    $chart_value[] = $value[$key];
                }
            }
        }
       // echo implode(",", $chart_label); exit;
        
        return view('admin.employee_dashboard', compact('orders', 'setting','users','warehouses','type','selected_warehouse','chart_label','chart_value','selected_user','selected_type','user_types'));
    }
    
    public function warehouseDashboard(Request $request)
    { 
  
        $warehouses = WareHouse::all();
       
         
        $category = Category::where('parent_id', 0)->get();
      //  $total_category = $category->count('category_id');
        
        $subcategory = Category::where('parent_id', '>' , 0)->get();
       
        if($request->warehouse_id)
            $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse', $request->warehouse_id)->get();
        else
            $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse')->get();
        
        
        $total_products = $products->count('products.id');
        
        $product_capacity = array(); 
        $outof = 0;
        foreach($products as $product)
        {
            $capacity =  number_format(($product->quantity / $product->max_capacity)*100,2);
            $product_capacity[] =  array("name" => $product->name, "capacity" => $capacity);
            
           // if($product->quantity < $product->min_capacity)
               $outof = $outof + $capacity;
           
        }
        
        if($outof)
          $warehouse_capacity = number_format($outof / $total_products,2);
      else {
          $warehouse_capacity = 0;
      }
        
        $category_capacity = array(); 
        $total_category = 0;
        foreach($category as $cat)
        {
            if($request->warehouse_id)
                $cat_product = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse', $request->warehouse_id)->where('category_id',$cat->category_id)->get();
            else
                $cat_product = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse')->where('category_id',$cat->category_id)->get();
            $total_cat_product = $cat_product->count();
         
            if($total_cat_product)
            {
                $outof = 0;
                foreach($cat_product as $product)
                {
                     $capacity =  ($product->quantity / $product->max_capacity)*100;
                     $outof = $outof + $capacity;
//                    if($product->quantity < $product->min_capacity)
//                        $outof = $outof + 1;
                }
             
                //$cat_capacity = (($total_cat_product - $outof) / $total_cat_product)*100;
                 $cat_capacity = number_format($outof / $total_cat_product,2);
                $category_capacity[] = array('name'=> $cat->name,'capacity'=>$cat_capacity);
                $total_category++;
            }
//            else
//             $category_capacity[] = array('name'=> $cat->name,'capacity'=>0);   
          }
          
        
        $subcategory_capacity = array(); 
        foreach($subcategory as $cat)
        {
            if($request->warehouse_id)
               $cat_product = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse', $request->warehouse_id)->where('sub_category_id',$cat->category_id)->get();
            else
              $cat_product = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse')->where('sub_category_id',$cat->category_id)->get();  
            $total_cat_product = $cat_product->count();
         
            if($total_cat_product)
            {
                $outof = 0;
                foreach($cat_product as $product)
                {
                    $capacity =  ($product->quantity / $product->max_capacity)*100;
                     $outof = $outof + $capacity;
                }
                 $cat_capacity = number_format($outof / $total_cat_product,2);
               // $cat_capacity = (($total_cat_product - $outof) / $total_cat_product)*100;
                $subcategory_capacity[] = array('id'=>$cat->category_id,'name'=> $cat->name,'capacity'=>$cat_capacity);
            }
 
          }
          
//         $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
//                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) order by id desc limit 10");
//       
         if($request->warehouse_id) 
             $most_product_move = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse', $request->warehouse_id)->orderBy('total_moved', 'desc')->first();
         else 
             $most_product_move = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse')->orderBy('total_moved', 'desc')->first();
         
         if($request->warehouse_id)
             $most_warehouse_move = WarehouseProduct::select(DB::Raw('warehouse, COUNT(*) as count'))->groupBy('warehouse')->where('warehouse', $request->warehouse_id)->orderBy('count','desc')->first();
         else
             $most_warehouse_move = WarehouseProduct::select(DB::Raw('warehouse, COUNT(*) as count'))->groupBy('warehouse')->whereNotNull('warehouse')->orderBy('count','desc')->first();
         
         if(isset($most_warehouse_move->warehouse))
           $most_warehouse_name = Warehouse::find($most_warehouse_move->warehouse);
         else
              $most_warehouse_name = '';
        
         if($request->warehouse_id)
           $selected_warehouse_name = Warehouse::find($request->warehouse_id);
         else
             $selected_warehouse_name = '';
         
         $selected_warehouse = $request->warehouse_id;
         
         

        return view('admin.warehouse_dashboard', compact('selected_warehouse_name','selected_warehouse','warehouses','total_category', 'total_products','product_capacity','category_capacity','subcategory_capacity','products','warehouse_capacity','most_product_move','most_warehouse_name')); 
      
    }
    
    public function report(Request $request)
    { 
        $warehouses = Warehouse::all(); 
         
        
        if($request->warehouse_id)
           $reports = WarehouseReport::where('warehouse_id', $request->warehouse_id)->where('report_type','product quantity change report')->get();
        else
          $reports = WarehouseReport::whereNotNull('warehouse_id')->where('report_type','product quantity change report')->get();
        
        $warehouse_id = $request->warehouse_id;
        
        return view('admin.report', compact('reports', 'warehouses', 'warehouse_id')); 
      
    }
    
    public function unreadReport(Request $request)
    { 
        $warehouses = Warehouse::all(); 
         
        
        if($request->warehouse_id)
           $reports = WarehouseReport::where('warehouse_id', $request->warehouse_id)->where('status',0)->where('report_type','product quantity change report')->get();
        else
          $reports = WarehouseReport::whereNotNull('warehouse_id')->where('status',0)->where('report_type','product quantity change report')->get();
        
        $warehouse_id = $request->warehouse_id;
        
        return view('admin.unread_report', compact('reports', 'warehouses', 'warehouse_id')); 
      
    }
    
     public function employeeReport(Request $request)
    { 
        $warehouses = Warehouse::all(); 
         
        
        if($request->warehouse_id)
           $reports = WarehouseReport::where('warehouse_id', $request->warehouse_id)->where('report_type','General report')->get();
        else
          $reports = WarehouseReport::whereNotNull('warehouse_id')->where('report_type','General report')->get();
        
        $warehouse_id = $request->warehouse_id;
        
        return view('admin.general_report', compact('reports', 'warehouses', 'warehouse_id')); 
      
    }
    
    public function Orders(Request $request)
    { 
  
        $orders = Order::where('orders.id', '>',0);
        if($request->warehouse)
            $orders = $orders->where('warehouse_id', $request->warehouse);
        if($request->rating)
            $orders = $orders->leftJoin('order_reviews','order_reviews.order_id', 'orders.id')->where('order_reviews.rating', $request->rating);
        if($request->account == 'high')
            $orders = $orders->orderBy('orders.order_time','desc');
        elseif($request->account == 'low')
            $orders = $orders->orderBy('orders.order_time','asc');
        else
            $orders = $orders->orderBy('orders.order_time','desc');
          
        $orders = $orders->paginate(5);
        $setting = Setting::find(1);
        $warehouses = Warehouse::all(); 
        $selected_warehouse = $request->warehouse;
        $selected_account = $request->account;
        $selected_rating = $request->rating;
   
        $setting = Setting::find(1);
              
     
        return view('admin.orders', compact('orders','setting','warehouses','selected_warehouse','selected_account','setting','selected_rating')); 
      
     }
    
    public function OrderReviews(Request $request)
    { 
  
        $orders = OrderReview::where('order_id', $request->order_id)->get();
      
        return view('admin.order_reviews', compact('orders')); 
      
    }
    
    public function NewCategory(Request $request)
    {
       $parent_category = DB::table('category')->where('parent_id', '=', 0)->get();
       $parent_id = $request->cat_id;
       return view('admin.add_category', ['parent_category' => $parent_category,'parent_id'=> $parent_id]);
    }
    
    public function saveTimeSheet(Request $request)
    {
        TimeSheet::truncate();
        
        for($i = 1;$i <= 6; $i++)
        {
            $time = new TimeSheet;
            $time->time_1 = $request->input('shift_'.$i.'_1');
            $time->time_2 = $request->input('shift_'.$i.'_2');
            $time->save();
        }
        
        return redirect('admin/time_sheet')->with('success', 'Time sheets has been updated successfully ');
       
      // return view('admin.time_sheet', ['time_sheets' => $time_sheets]);
    }
    
    public function saveDiscount(Request $request)
    {
        $discount = new Discount;
        $discount->name = $request->input('name');
        $discount->value = $request->input('value');
        $discount->type = $request->input('type');
        $discount->start_time = $request->input('start_time');
        $discount->end_time = $request->input('end_time');
        $insert = $discount->save();       
       
       if($insert)
        {
            if($request->input('type') == 'VIP')
               $customers = Customer::where('type','VIP')->where('allow_discountemail',0)->get();
            else
                $customers = Customer::where('type','!=','VIP')->orWhereNull('type')->where('allow_discountemail',0)->get();
           
            foreach($customers as $customer)
            {
                $to =  $customer->email;
                $subject = 'New Discount Offer';
                $message = "New discount code from McFly<br><br>";
                $message .= "Name: ".$request->input('name');
                $message .= "<br>Start Time: ".$request->input('start_time');
                $message .= "<br>End Time: ".$request->input('end_time');
                $message .= "<br>Amount: ".$request->input('value');
            
                // To send HTML mail, the Content-type header must be set
                $headers = "From: titu41@gmail.com" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
            $mail  =  mail($to, $subject, $message, $headers);
           
            }
          return redirect('admin/discounts')->with('success', 'Time discount has been saved successfully ');
        }
       else
           return redirect('admin/discounts')->with('success', 'Time discount has not been saved successfully ');
       
       
    }
    
    public function saveEditDiscount(Request $request)
    {
        $discount = Discount::find($request->input('id'));
        $discount->name = $request->input('name');
        $discount->value = $request->input('value');
        $discount->type = $request->input('type');
        $discount->start_time = $request->input('start_time');
        $discount->end_time = $request->input('end_time');
        $insert = $discount->save();       
       
        if($insert)
           return redirect('admin/discounts')->with('success', 'Time discount has been updated successfully ');
        else
            return redirect('admin/discounts')->with('success', 'Time discount has not been updated successfully ');
       
       
    }
    public function editTimeSheet(Request $request)
    {
       $time_sheets = TimeSheet::orderBy('id', 'asc')->get();
       
       return view('admin.time_sheet', ['time_sheets' => $time_sheets]);
    }
    public function DiscountEdit(Request $request)
    {
       $discount = Discount::find($request->discount_id);
       
       return view('admin.edit_discount', ['discount' => $discount]);
    }
    public function NewUser(Request $request)
    {
       $groups = Group::all();
       $selected_group = $request->group_id;
       
       return view('admin.add_user', ['groups' => $groups,'selected_group' => $selected_group]);
    }
    
    public function NewAdminUser(Request $request)
    {
     
       return view('admin.add_admin_user');
    }
    
    public function NewGroup(Request $request)
    {
      return view('admin.add_group');
    }
    
    public function inventoryLog(Request $request)
    {
       $logs = Log::where('type',0)->groupBy('log_number')->orderBy('created_at','desc')->get();
   
     
       $warehouses = Warehouse::all();
       $warehouse_id = '';
       $start_date = date('Y-m-d', strtotime('-7 days'));
       $end_date = date('Y-m-d');
      
       return view('admin.inventory_logs', compact('logs', 'warehouses','warehouse_id','start_date','end_date'));
    }
    
    public function registerLog(Request $request)
    {
       $logs = Log::where('type',1)->groupBy('log_number')->orderBy('created_at','desc')->get();
   
     
       $warehouses = Warehouse::all();
       $warehouse_id = '';
       $start_date = date('Y-m-d', strtotime('-7 days'));
       $end_date = date('Y-m-d');
      
       return view('admin.register_logs', compact('logs', 'warehouses','warehouse_id','start_date','end_date'));
    }
    
    public function MoveProductList(Request $request)
    {
       $logs = Log::where('log_number', $request->log_number)->orderBy('created_at','desc')->get();
   
      
       return view('admin.move_products', compact('logs'));
    }
    public function RegisterProductList(Request $request)
    {
       $logs = Log::where('log_number', $request->log_number)->orderBy('created_at','desc')->get();
   
      
       return view('admin.register_products_list', compact('logs'));
    }
    public function postFilterCustomers(Request $request)
    {
        $warehouses = Warehouse::all(); 
        
        $warehouse_id = $request->input('warehouse');
        $min_amount   = $request->input('min_amount',0);
        $max_amount   = $request->input('max_amount',0);
         
        $selected_warehouse = $warehouse_id;
        
        if($warehouse_id)
            $customers = Customer::join('orders','customers.id','orders.customer_id')->where('orders.warehouse_id', $warehouse_id);
        else
            $customers = Customer::join('orders','customers.id','orders.customer_id')->whereNotNull('orders.warehouse_id', $warehouse_id);
        
        if($request->input('total_order') == 'high')
            $customers = $customers->orderBy('total_order','desc');
        else if($request->input('total_order') == 'low')
            $customers = $customers->orderBy('total_order','asc');

        $customers = $customers->groupBy('customer_id')->selectRaw('*, sum(amount) as sum')->get();
     
        if($min_amount && $max_amount)
        {
            $customers = $customers->filter(function($item) use(&$min_amount,&$max_amount){
         
             if($item->sum >= $min_amount && $item->sum <= $max_amount)
              return true;
             
             });
       }
       elseif($min_amount && empty($max_amount))
       {
            $customers = $customers->filter(function($item) use(&$min_amount){
         
             if($item->sum >= $min_amount )
              return true;
             
             });
       }
       elseif(empty($min_amount) && $max_amount)
       {
            $customers = $customers->filter(function($item) use(&$max_amount){
         
             if($item->sum <= $max_amount )
              return true;
             
             });
       }
          


               
        return view('admin.customers', ['customers' => $customers, 'selected_warehouse' => $selected_warehouse,'warehouses' => $warehouses,'min_amount'=>$min_amount,'max_amount' => $max_amount,'selected_order' => $request->input('total_order')]);
    }
    public function postFilterLogs(Request $request)
    {
       $logs = Log::where('type',0)->groupBy('log_number')->orderBy('created_at', 'desc');
       $warehouse_id = $request->input('warehouse');
       $start_date   = $request->input('start_date');
       $end_date   = $request->input('end_date');
       
       if(!empty($warehouse_id))
       {
          $logs = $logs->where('warehouse_id', $warehouse_id) ;
       }
       if(!empty($start_date))
       {
          $logs = $logs->whereDate('created_at','>=', $start_date) ;
       }
       if(!empty($end_date))
       {
          $logs = $logs->whereDate('created_at','<=', $end_date) ;
       }
       
       $logs = $logs->get();
       $warehouses = Warehouse::all();
       
       return view('admin.inventory_logs', compact('logs', 'warehouses','warehouse_id','start_date','end_date'));
    }
    
     public function postRegisterFilterLogs(Request $request)
    {
       $logs = Log::where('type',1)->groupBy('log_number')->orderBy('created_at', 'desc');
      // $warehouse_id = $request->input('warehouse');
       $start_date   = $request->input('start_date');
       $end_date   = $request->input('end_date');
       
//       if(!empty($warehouse_id))
//       {
//          $logs = $logs->where('warehouse_id', $warehouse_id) ;
//       }
       if(!empty($start_date))
       {
          $logs = $logs->whereDate('created_at','>=', $start_date) ;
       }
       if(!empty($end_date))
       {
          $logs = $logs->whereDate('created_at','<=', $end_date) ;
       }
       
       $logs = $logs->get();
       $warehouses = Warehouse::all();
       
       return view('admin.register_logs', compact('logs', 'warehouses','warehouse_id','start_date','end_date'));
    }
    
    public function NewWarehouse(Request $request)
    {
      return view('admin.add_warehouse');
    }
    public function NewWarehouseUser(Request $request)
    {
        $warehouses = WareHouse::orderBy('created_at', 'desc')->get();
        $time_shifts = TimeSheet::orderBy('id','asc')->get();
        $user_types = UserType::all(); 
       
        return view('admin.add_warehouse_user',compact('warehouses','time_shifts','user_types'));
    }
    
    public function loadSubCategory($category_id)
    {
         
         // get all stores of logged in vendor
        $options = '';
        if($category_id)
        {
            $categories = DB::table('category')->where([['parent_id', '=', $category_id],])->orderBy('name', 'ASC')->get();

          //  $options = '<option value="">Select Sub Category</option>';
            foreach($categories as $category)
            {
                $options .= "<option value='".$category->category_id."'>".$category->name."</option>";
            }
            $options .= "<option value='9999'>Other</option>";
         }
         echo $options;
        
    }
    
    public function saveCategory(Request $request)
    {
        $category_name = $request->input('name');
        $parent_category_ids   = $request->input('parent_category'); 
        $sub_category_id      = $request->input('sub_category');
        $admin_id =  Auth::guard('admin')->id();
        $imageName = '';
        
         if($request->has('file'))
         {
                $file = $request->file('file');
                $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/category/thumbnail');
                     $destinationPath1 = public_path('/uploads/category');
                     
                     $image->move($destinationPath, $input['imagename']);
                   //  $image->move($destinationPath1, $input['imagename']);

//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $imageName = $input['imagename'];
     
              
            }
        if(is_array($parent_category_ids))
        {
            $shared_cateroy = implode(",", $parent_category_ids);
            
            foreach($parent_category_ids as $parent_category_id)
            {
                $total_category = DB::table("category")->where([['name', '=', $category_name],['category_id', '=', $parent_category_id],])->count('category_id');
                if($total_category < 1)
                {
                    if(empty($parent_category_id))
                        $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(0,'".$category_name."',0,1,'".$imageName."')");
                    else if(!empty($parent_category_id) && empty($sub_category_id))
                        $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image,shared_category) VALUES(1,'".$category_name."',$parent_category_id,1,'".$imageName."','".$shared_cateroy."')");
                    else if(!empty($parent_category_id) && !empty($sub_category_id))
                        $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(2,'".$category_name."',$sub_category_id,1,'".$imageName."')");
                    

                }
            }
             return redirect('admin/category_list')->with('success', 'Your category has been saved successfully');
        }
        else
        {
            $parent_category_id = $parent_category_ids;
            $total_category = DB::table("category")->where([['name', '=', $category_name],])->count('category_id');
            if($total_category > 0)
                return redirect('admin/add_category')->with('success', 'Your entered group already existed ');
            else 
            {
                if(empty($parent_category_id))
                    $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(0,'".$category_name."',0,1,'".$imageName."')");
                else if(!empty($parent_category_id) && empty($sub_category_id))
                    $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(1,'".$category_name."',$parent_category_id,1,'".$imageName."')");
                else if(!empty($parent_category_id) && !empty($sub_category_id))
                    $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(2,'".$category_name."',$sub_category_id,1,'".$imageName."')");
                if($insert)
                {
                     return redirect('admin/category_list')->with('success', 'Your category has been saved successfully');
                }
                else
                {
                     return redirect('admin/add_category')->with('success', 'Your category has not been saved ');
                }

            }
        }
    }
    
    public function saveWareHouseUser(Request $request)
    {
        $user_type  = $request->input('user_type');
        $name       = $request->input('name'); 
        $email      = $request->input('email');
        $password   = $request->input('password');
        $phone      = $request->input('phone');
        $warehouse_id      = $request->input('warehouse');
        
        
        $imageName = '';
        
         if($request->has('file'))
         {
                $file = $request->file('file');
                     $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/warehouse/thumbnail');
                     $destinationPath1 = public_path('/uploads/warehouse');
                     $image->move($destinationPath, $input['imagename']);

//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $imageName = asset('public/uploads/warehouse/thumbnail').'/'.$input['imagename'];
     
              
            }
        
        $total_user = User::where('email', $email)->where('user_type','!=','VIP')->count('id');
        if($total_user > 0)
            return redirect('admin/add_warehouse_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->image = $imageName;
            $user->phone = $phone;
            $user->user_type = $user_type;
            $user->warehouse_id = $warehouse_id;
            $insert = $user->save();
            
            if($insert)
            {
                $user_shift = new UserShift;
                $user_shift->user_id = $user->id;
                $user_shift->mon = (is_array($request->input('mon_shift'))) ? implode(",", $request->input('mon_shift')) : '';
                $user_shift->tue = (is_array($request->input('tue_shift'))) ? implode(",", $request->input('tue_shift')) : '';
                $user_shift->wed = (is_array($request->input('wed_shift'))) ? implode(",", $request->input('wed_shift')) : '';
                $user_shift->thru = (is_array($request->input('thru_shift'))) ? implode(",", $request->input('thru_shift')) : '';
                $user_shift->fri = (is_array($request->input('fri_shift'))) ? implode(",", $request->input('fri_shift')) : '';
                $user_shift->sat = (is_array($request->input('sat_shift'))) ? implode(",", $request->input('sat_shift')) : '';
                $user_shift->sun = (is_array($request->input('sun_shift'))) ? implode(",", $request->input('sun_shift')) : '';
                $user_shift->save();
                
                return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has been saved successfully');
            }
            else
            {
                 return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has not been saved ');
            }
            
        }
        
    }
    
    public function saveEditWareHouseUser(Request $request)
    {
        $user_type = $request->input('user_type');
        $name   = $request->input('name'); 
        $email      = $request->input('email');
      //  $password = $request->input('password');
        $phone      = $request->input('phone');
        $warehouse_id =  $request->input('warehouse');
        
        $id      = $request->input('id');
        
        $user = User::find($id);
           
         if($request->has('file'))
         {
                $file = $request->file('file');
                     $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/warehouse/thumbnail');
                     $destinationPath1 = public_path('/uploads/warehouse');
                     
                     $image->move($destinationPath, $input['imagename']);

//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $user->image = asset('public/uploads/warehouse/thumbnail').'/'.$input['imagename'];
     
              
            }
        
        $total_user = User::where('email', $email)->where('user_type','!=','VIP')->where('id','!=',$id)->count('id');
        if($total_user > 0)
            return redirect('admin/add_warehouse_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user->name = $name;
            $user->email = $email;
           // $user->password = $password;
            $user->phone = $phone;
            $user->user_type = $user_type;
            $user->warehouse_id = $warehouse_id;
            $insert = $user->save();
            
            if($insert)
            {
                $user_shift = UserShift::where('user_id', $id)->get()[0];
                $user_shift->mon = (is_array($request->input('mon_shift'))) ? implode(",", $request->input('mon_shift')) : '';
                $user_shift->tue = (is_array($request->input('tue_shift'))) ? implode(",", $request->input('tue_shift')) : '';
                $user_shift->wed = (is_array($request->input('wed_shift'))) ? implode(",", $request->input('wed_shift')) : '';
                $user_shift->thru = (is_array($request->input('thru_shift'))) ? implode(",", $request->input('thru_shift')) : '';
                $user_shift->fri = (is_array($request->input('fri_shift'))) ? implode(",", $request->input('fri_shift')) : '';
                $user_shift->sat = (is_array($request->input('sat_shift'))) ? implode(",", $request->input('sat_shift')) : '';
                $user_shift->sun = (is_array($request->input('sun_shift'))) ? implode(",", $request->input('sun_shift')) : '';
                $user_shift->save();
                
                return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has been updated successfully');
            }
            else
            {
                 return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has not been updated ');
            }
            
        }
        
    }
    public function postSchedule(Request $request)
    {
        $users = $request->input('user');
       
        foreach($users as $user_id)
        {
                $user_shift = UserShift::where('user_id', $user_id)->get()[0];
                $user_shift->mon = (is_array($request->input('mon_shift'))) ? implode(",", $request->input('mon_shift')) : '';
                $user_shift->tue = (is_array($request->input('tue_shift'))) ? implode(",", $request->input('tue_shift')) : '';
                $user_shift->wed = (is_array($request->input('wed_shift'))) ? implode(",", $request->input('wed_shift')) : '';
                $user_shift->thru = (is_array($request->input('thru_shift'))) ? implode(",", $request->input('thru_shift')) : '';
                $user_shift->fri = (is_array($request->input('fri_shift'))) ? implode(",", $request->input('fri_shift')) : '';
                $user_shift->sat = (is_array($request->input('sat_shift'))) ? implode(",", $request->input('sat_shift')) : '';
                $user_shift->sun = (is_array($request->input('sun_shift'))) ? implode(",", $request->input('sun_shift')) : '';
                $user_shift->save();
        }
        
         return redirect('admin/schedule')->with('success', 'Employees schedule has been set up successfully');
    }
    
    public function postSettings(Request $request)
    {
        $admin = $request->input('admin');
         
        
        $id = $request->input('id');
       
        $setting = Setting::find($id);
        $setting->admin_rate = $admin;
        $setting->accept_order = $request->input('accept_order');
        $setting->collect_items = $request->input('collect_items');
        $setting->hand_to_driver = $request->input('hand_to_driver');
        $setting->collect_from_warehouse = $request->input('collect_from_warehouse');
        $setting->arrive_to_destination = $request->input('arrive_to_destination');
        $setting->taken_to_deliver = $request->input('taken_to_deliver');
        $setting->tax_rate = $request->input('tax_rate');
        $update = $setting->save();
        
        $user_types = UserType::all();
        foreach($user_types as $type)
        {
            $user = UserType::find($type->id);
            $user->rate =  $request->input('user_type_'.$type->id);
            $user->save();
        }
        
    
        if($update)
            return redirect('admin/evaluation_scale')->with('success', 'Evaluation scale has been set up successfully');
        else
             return redirect('admin/evaluation_scale')->with('success', 'Evaluation scale has not been set up');
    }
    
    public function PostGoalCompletion(Request $request)
    {
        $admin = $request->input('admin');
         
        
        $id = $request->input('id');
       
        $setting = Setting::find($id);
        $setting->performance_scale = $request->input('performance');
        $setting->inventory_scale = $request->input('inventory');
        $setting->website_scale = $request->input('website');
        $setting->report_scale = $request->input('reports');
        $update = $setting->save();
        
        
    
        if($update)
            return redirect('admin/goal_completion')->with('success', 'Goal completion scale has been set up successfully');
        else
             return redirect('admin/goal_completion')->with('success', 'Goal completion scale has not been set up');
    }
    public function saveGroup(Request $request)
    {
        $group_name = $request->input('name');
       
        $total_group = DB::table("groups")->where([['name', '=', $group_name],])->count('id');
        if($total_group > 0)
           return redirect('admin/add_group')->with('success', 'Your entered group already existed ');
        else 
        {
            $group = new Group;
            $group->name = $group_name;
            $insert = $group->save();
            
            if($insert)
            {
                 return redirect('admin/group_list')->with('success', 'Your group has been saved successfully');
            }
            else
            {
                 return redirect('admin/group_list')->with('success', 'Your group has not been saved ');
            }
            
        }
        
    }
    
     public function saveUserType(Request $request)
    {
        $name = $request->input('name');
        $rate = $request->input('rate');
       
        $total_group = DB::table("user_types")->where([['name', '=', $name],])->count('id');
        if($total_group > 0)
           return redirect('admin/add_user_type')->with('success', 'Your entered user type already existed ');
        else 
        {
            $type = new UserType;
            $type->name = $name;
            $type->rate = $rate;
            $insert = $type->save();
            
            if($insert)
            {
                 return redirect('admin/user_type_list')->with('success', 'Your user type has been saved successfully');
            }
            else
            {
                 return redirect('admin/user_type_list')->with('success', 'Your user type has not been saved ');
            }
            
        }
        
    }
    public function saveWareHouse(Request $request)
    {
          $name = $request->input('name');
          $zip_code = $request->input('zip_code');
          $address = $request->input('address');
          $lat = $request->input('lat');
          $lon = $request->input('lon');
       
          $warehouse = new Warehouse;
          $warehouse->name = $name;
          $warehouse->zip_code = $zip_code;
          $warehouse->address = $address;
          $warehouse->lat = $lat;
          $warehouse->lon = $lon;
          $warehouse->performance_scale = $request->input('performance');
          $warehouse->inventory_scale = $request->input('inventory');
          $warehouse->report_scale = $request->input('report');
          $warehouse->website_scale = $request->input('website');
          $warehouse->delivery_fee = $request->input('deliver_fee');
          $warehouse->mon_working_starttime = $request->input('shift_mon_1');
          $warehouse->mon_working_endtime = $request->input('shift_mon_2');
          $warehouse->tue_working_starttime = $request->input('shift_tue_1');
          $warehouse->tue_working_endtime = $request->input('shift_tue_2');
          $warehouse->wed_working_starttime = $request->input('shift_wed_1');
          $warehouse->wed_working_endtime = $request->input('shift_wed_2');
          $warehouse->thu_working_starttime = $request->input('shift_thu_1');
          $warehouse->thu_working_endtime = $request->input('shift_thu_2');
          $warehouse->fri_working_starttime = $request->input('shift_fri_1');
          $warehouse->fri_working_endtime = $request->input('shift_fri_2');
          $warehouse->sat_working_starttime = $request->input('shift_sat_1');
          $warehouse->sat_working_endtime = $request->input('shift_sat_2');
          $warehouse->sun_working_starttime = $request->input('shift_sun_1');
          $warehouse->sun_working_endtime = $request->input('shift_sun_2');
       
          if($request->has('file'))
         {
                $file = $request->file('file');
                $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/warehouse/thumbnail');
                     $destinationPath1 = public_path('/uploads/warehouse');
                     
                     $image->move($destinationPath, $input['imagename']);
                   //  $image->move($destinationPath1, $input['imagename']);

//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $warehouse->image = $input['imagename'];
     
              
            }
          
          $insert = $warehouse->save();
            
          if($insert)
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has been saved successfully');
          }
          else
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has not been saved ');
          }
            
      
    }
    
    public function saveEditWareHouse(Request $request)
    {
          $name = $request->input('name');
          $zip_code = $request->input('zip_code');
          $address = $request->input('address');
          $lat = $request->input('lat');
          $lon = $request->input('lon');
       
          $warehouse = Warehouse::find($request->input('id'));
          $warehouse->name = $name;
          $warehouse->zip_code = $zip_code;
          $warehouse->address = $address;
          $warehouse->lat = $lat;
          $warehouse->lon = $lon;
          $warehouse->performance_scale = $request->input('performance');
          $warehouse->inventory_scale = $request->input('inventory');
          $warehouse->report_scale = $request->input('report');
          $warehouse->website_scale = $request->input('website');
          $warehouse->delivery_fee = $request->input('deliver_fee');
          $warehouse->mon_working_starttime = $request->input('shift_mon_1');
          $warehouse->mon_working_endtime = $request->input('shift_mon_2');
          $warehouse->tue_working_starttime = $request->input('shift_tue_1');
          $warehouse->tue_working_endtime = $request->input('shift_tue_2');
          $warehouse->wed_working_starttime = $request->input('shift_wed_1');
          $warehouse->wed_working_endtime = $request->input('shift_wed_2');
          $warehouse->thu_working_starttime = $request->input('shift_thu_1');
          $warehouse->thu_working_endtime = $request->input('shift_thu_2');
          $warehouse->fri_working_starttime = $request->input('shift_fri_1');
          $warehouse->fri_working_endtime = $request->input('shift_fri_2');
          $warehouse->sat_working_starttime = $request->input('shift_sat_1');
          $warehouse->sat_working_endtime = $request->input('shift_sat_2');
          $warehouse->sun_working_starttime = $request->input('shift_sun_1');
          $warehouse->sun_working_endtime = $request->input('shift_sun_2');
          
          if($request->has('file'))
          {
                $file = $request->file('file');
                $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/warehouse/thumbnail');
                     $destinationPath1 = public_path('/uploads/warehouse');
                     
                     $image->move($destinationPath, $input['imagename']);
                   //  $image->move($destinationPath1, $input['imagename']);

//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $warehouse->image = $input['imagename'];
     
              
            }
          
          $insert = $warehouse->save();
            
          if($insert)
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has been updated successfully');
          }
          else
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has not been updated ');
          }
            
      
    }
    
    public function saveUser(Request $request)
    {
        $email = $request->input('email');
        $group = $request->input('group');
        $password = $request->input('password');
        $facebook = $request->input('facebook');
        $instagram = $request->input('instagram');
        $phone = $request->input('phone');
        $job = $request->input('jonb');
       
        $total_user = DB::table("customers")->where([['email', '=', $email],])->count('id');
        if($total_user > 0)
           return redirect('admin/add_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user = new Customer;
            $user->email = $email;
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->password = $password;
            $user->group_id = $group;
            $user->type = 'VIP';
            $user->facebook = $facebook;
            $user->instagram = $instagram;
            $user->phone = $phone;
            $user->verfified_value = $phone;
            $user->job = $job;
            
            if($request->has('file'))
            {
                   $file = $request->file('file');
                        $image = $file;
                        $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                        $destinationPath = public_path('/uploads/warehouse/thumbnail');
                        $destinationPath1 = public_path('/uploads/warehouse');

                        $image->move($destinationPath, $input['imagename']);

   //                     $img = Image::make($image->getRealPath());
   //                     $img->resize(300, 300, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath.'/'.$input['imagename']);
   //                     $img->resize(800, 800, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath1.'/'.$input['imagename']);

                        $user->image = asset('public/uploads/warehouse/thumbnail').'/'.$input['imagename'];


               }
            
            $insert = $user->save();
            
            if($insert)
            {
                 return redirect('admin/user_list')->with('success', 'The user has been saved successfully');
            }
            else
            {
                 return redirect('admin/user_list')->with('success', 'The user has not been saved ');
            }
            
        }
        
    }
    
    public function saveAdminUser(Request $request)
    {
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $password = bcrypt($request->input('password'));
        $phone = $request->input('phone');
       
       
        $total_user = DB::table("admin")->where([['email', '=', $email],])->count('id');
        if($total_user > 0)
           return redirect('admin/add_admin_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user = new Admin;
            $user->email = $email;
            $user->password = $password;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone = $phone;
            $user->status = 1;
            $user->type = 1;
            
            if($request->has('file'))
            {
                   $file = $request->file('file');
                        $image = $file;
                        $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                        $destinationPath = public_path('/uploads/warehouse/thumbnail');
                        $destinationPath1 = public_path('/uploads/warehouse');

                        $image->move($destinationPath, $input['imagename']);

   //                     $img = Image::make($image->getRealPath());
   //                     $img->resize(300, 300, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath.'/'.$input['imagename']);
   //                     $img->resize(800, 800, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath1.'/'.$input['imagename']);

                        $user->image = $destinationPath."/".$input['imagename'];


               }
            
            $insert = $user->save();
            
            if($insert)
            {
                 
                $to =  $email;
                $subject = 'Admin account has been created';
                $message = "Your McFly admin access account has been created successfully<br><br>";
                $message .= "Url: ".asset("admin/login");
                $message .= "<br>Email: ".$email;
                $message .= "<br>Password: ".$request->input('password');
            
                // To send HTML mail, the Content-type header must be set
                $headers = "From: titu41@gmail.com" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
              $mail  =  mail($to, $subject, $message, $headers);
               
                 return redirect('admin/admin_users')->with('success', 'The user has been saved successfully');
            }
            else
            {
                 return redirect('admin/admin_users')->with('success', 'The user has not been saved ');
            }
            
        }
        
    }
    
    public function CategoryList(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
         if($request->cat_id)
         {
             // get all stores of logged in vendor
            $categories = DB::table('category')->where('flag',1)->where('parent_id', $request->cat_id)->orderBy('name', 'ASC')->get();
            $parent = DB::table('category')->where('category_id',$request->cat_id)->where('flag', 0)->orderBy('name', 'ASC')->get();
            return view('admin.sub_category', ['categories' => $categories,'parent' => $parent[0]]);
         }
         else
         {
            // get all stores of logged in vendor
            $categories = DB::table('category')->where('flag',0)->orderBy('name', 'ASC')->get();

            return view('admin.category', ['categories' => $categories]);
         }
    }
    public function UserList(Request $request)
    {
        $groups = Group::orderBy('created_at', 'desc')->get();
        if($request->group_id)
           $users = Customer::where('type','VIP')->where('group_id', $request->group_id)->orderBy('created_at', 'desc')->get();
        else 
            $users = Customer::where('type','VIP')->orderBy('created_at', 'desc')->get();
	return view('admin.vip_user', ['users' => $users,'groups'=>$groups,'selected_group' => $request->group_id]);
    }
    
    public function AdminUserList(Request $request)
    {
        $users = Admin::where('type','!=','0')->get();
	return view('admin.admin_user', ['users' => $users]);
    }
    
    public function CustomerList(Request $request)
    {
        $warehouses = Warehouse::all(); 
        
      //  $customers = Customer::join('orders','customers.id','orders.customer_id')->where('orders.warehouse_id', $warehouse_id)->orderBy('customers.created_at', 'desc')->get();
        $selected_warehouse = $request->warehouse_id;
        
        $customers = Customer::join('orders','customers.id','orders.customer_id')->whereNotNull('orders.warehouse_id')
                    ->whereNull('customers.type')
                    ->groupBy('customer_id')
                    ->selectRaw('*,customers.id as cust_id ,sum(amount) as sum, count(customer_id) as total_order, customers.status as cust_status')
                    ->orderBy('total_order','desc')
                    ->get();
      
        return view('admin.customers', ['customers' => $customers, 'selected_warehouse' => $selected_warehouse,'warehouses' => $warehouses,'selected_order' => 'high']);
    }
    
     public function AllCustomerList(Request $request)
    {
        $warehouses = Warehouse::all(); 
        
        $selected_warehouse = $request->warehouse;
        
        $customers = Customer::leftJoin('orders','customers.id','orders.customer_id')
                   ->groupBy('customers.id')
                   ->selectRaw('*,customers.id as cust_id ,sum(amount) as sum, count(customer_id) as total_order,customers.status as cust_status');
                  
        
        if($request->warehouse)
            $customers = $customers->where('warehouse_id', $request->warehouse);
        
         if($request->total_order == 'high')
            $customers = $customers->orderBy('sum','desc');
        elseif($request->total_order == 'low')
            $customers = $customers->orderBy('sum','asc');
        else
            $customers = $customers->orderBy('sum','desc');
        
        if($request->account == 'high')
            $customers = $customers->orderBy('customers.created_at','desc');
        elseif($request->account == 'low')
            $customers = $customers->orderBy('customers.created_at','asc');
        else
             $customers = $customers->orderBy('customers.created_at','desc');
        
       
        
         $customers = $customers->get();
        
         $selected_account = $request->account;
         $selected_order   = $request->total_order; 
    
         
      
        return view('admin.all_customers', ['customers' => $customers, 'selected_warehouse' => $selected_warehouse,'warehouses' => $warehouses,'selected_account' => $selected_account,'selected_order' => $selected_order]);
    }
    
    public function CustomerDetails(Request $request)
    {
        $customer = Customer::find($request->id);
       
        return view('admin.customer_details', ['customer' => $customer]);
    }
    public function CustomerStatus(Request $request)
    {
        $customer = Customer::find($request->id);
        if($customer->status == 1)
          $customer->status = 0;
        else
          $customer->status = 1;
        
        $update = $customer->save();
        
        if($update)
            return redirect('admin/customer_list')->with('success', 'The customer status has been updated');
        else
            return redirect('admin/customer_list')->with('success', 'The customer status has not been updated');
    }
    
    public function GroupList()
    {
         $groups = Group::orderBy('created_at', 'desc')->get();
         
	 return view('admin.group', ['groups' => $groups]);
    }
    
    public function UserTypeList()
    {
         $types = UserType::orderBy('created_at', 'desc')->get();
         
	 return view('admin.user_types', ['types' => $types]);
    }
    
    public function WareHouseList()
    {
         $warehouses = WareHouse::orderBy('created_at', 'desc')->get();
         
	 return view('admin.warehouse', ['warehouses' => $warehouses]);
    }
    public function payDayLogs(Request $request)
    {
        
        if(empty($request->year))
           $year = date("Y");
        else
            $year = $request->year;
        
        $payments = EmployeePayment::where('payment_status', 1)->where('hour_status',1)->whereYear('created_at', $year)->get();
        $setting = Setting::find(1);
        
        $week_payment = array();
        foreach($payments as $payment)
        {
           
            $to = Carbon::createFromFormat('Y-m-d H:s:i',$payment->from_time);
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $payment->to_time);
            $total_hours = $to->diffInHours($from);
            $amount = 0;
            
            if($payment->employee->type->name == 'Manager')
                $amount = $total_hours * $setting->manager_rate;
            elseif($payment->employee->type->name == 'Worker')
                $amount = $total_hours * $setting->worker_rate;
            elseif($payment->employee->type->name == 'Delivery Man')
                $amount = $total_hours * $setting->deliveryman_rate;
            
            $week = date("W", strtotime($payment->created_at));

            if(array_key_exists($week, $week_payment))
               $week_payment[$week] = $week_payment[$week] + $amount; 
            else
              $week_payment[$week] = $amount;   
        
        }
       
       $selected_year = $year;
       ksort($week_payment);
       
         return view('admin.payday_logs', compact('week_payment', 'selected_year'));
    }
    public function WeeklyPaymentLog(Request $request)
    {
        
        $week  = $request->week - 1;
        $year = $request->year;

         $users = User::join('employee_payments','users.id','employee_payments.employee_id')->where('user_type','!=', 'VIP')->whereNotNull('warehouse_id')->where('payment_status', 1)->where('hour_status',1)->whereYear('employee_payments.created_at', $year);
         $users = $users->where(DB::raw("week(employee_payments.created_at)"),$week);
         $users = $users->selectRaw('*,sum(TIMESTAMPDIFF(HOUR, `from_time`, `to_time`)) AS `total_hours`,week(employee_payments.created_at)');
         $users = $users->groupBy('employee_payments.employee_id');
        
      //  $users = $users->groupBy(DB::raw("week(employee_payments.created_at)"));
         $users = $users->get();
         $selected_week = $request->week;
         
         $orders = Order::join('users','orders.user_id','users.id')->orderBy('orders.created_at','desc');
         $orders = $orders->selectRaw('*,sum(orders.tips) AS `total_tips`, orders.id as order_id');
         $orders = $orders->groupBy('orders.user_id');
         $orders = $orders->where(DB::raw("week(orders.created_at)"),$week)->whereYear('orders.created_at', $year);
         $orders = $orders->get();
         
         $tips = array();
         foreach($orders as $order)
         {
             $tips[$order->user_id] = $order->total_tips;
         }
     
          $setting = Setting::find(1);
        return view('admin.week_payday_logs', compact('users','setting','selected_week','year','tips'));
         
    }
    
    public function EmployeePaymentLog(Request $request)
    {
        
        $week  = $request->week-1;
        $year  = $request->year;
        
        $employee = $request->employee_id;

         $users = User::join('employee_payments','users.id','employee_payments.employee_id')->where('user_type','!=', 'VIP')->whereNotNull('warehouse_id')->where('payment_status', 1)->where('hour_status',1)->whereYear('employee_payments.created_at', $year);
         $users = $users->where(DB::raw("week(employee_payments.created_at)"),$week)->orderBy('employee_payments.created_at');
       //  $users = $users->selectRaw('*,sum(TIMESTAMPDIFF(HOUR, `from_time`, `to_time`)) AS `total_hours`');
        
         if($request->employee_id)
             $users = $users->where('employee_id', $employee);
         $users = $users->get();
         
         $orders = Order::join('users','orders.user_id','users.id')->orderBy('orders.created_at','desc');
         $orders = $orders->where(DB::raw("week(orders.created_at)"),$week)->whereYear('orders.created_at', $year)->orderBy('orders.created_at');
         $orders = $orders->select('orders.*');
         $orders = $orders->get();
//        echo "<pre>";
//        print_r($orders->toArray()); exit;
         $selected_week = $request->week;
         $employee = User::find($employee) ;
         
         $year =  date("Y", strtotime($users[0]->created_at));
         
         $date = Carbon::now();
         $date->setISODate($year,$request->week);
         $date_range = date("m/d/Y",strtotime($date->startOfWeek()))."-".date("m/d/Y",strtotime($date->endOfWeek())); 

       
          $setting = Setting::find(1);
        return view('admin.employee_payday_logs', compact('users','setting','selected_week','employee','date_range','orders'));
         
    }
    
    public function payDay(Request $request)
    {
        $warehouses = WareHouse::all();
        if(empty($request->week))
           $current_week = date("W", strtotime(date("Y-m-d")));
        else
          $current_week = $request->week;
        if(empty($request->year))
           $year = date("Y");
        else
            $year = $request->year;
        
        $date = Carbon::now();
        $date->setISODate($year,$current_week);
        $start_date = date("Y-m-d",strtotime($date->startOfWeek())); 
        $end_date   = date("Y-m-d",strtotime($date->endOfWeek()));
        
        $ddate = date("Y-m-d");
        $duedt = explode("-", $ddate);
        $date  = mktime(0, 0, 0, 0, 12, 2018);
        $total_week  = date("W",strtotime('28th December '.$ddate[0]));
    
        $week_arr = array();
        $date = Carbon::now();
        for($i = 1; $i<= $total_week; $i++)
        {
            $date->setISODate($year,$i);
            $start = date("m/d/Y",strtotime($date->startOfWeek())); 
            $end   = date("m/d/Y",strtotime($date->endOfWeek()));
            $week_arr[$i] = $start." - ".$end;
        }

        if($request->warehouse_id)
          $users = User::join('employee_payments','users.id','employee_payments.employee_id')->where('user_type','!=', 'VIP')->where('warehouse_id', $request->warehouse_id);
        else 
            $users = User::join('employee_payments','users.id','employee_payments.employee_id')->where('user_type','!=', 'VIP')->whereNotNull('warehouse_id');
         
         if($request->user_type)
             $users = $users->where('user_type', $request->user_type);
         if($request->employee_id)
             $users = $users->where('employee_id', $request->employee_id);
         
          $users = $users->where('hour_status', 1);
         
         if($request->status)
         {
             $status = ($request->status == 'paid') ? 1 :0;
             $users = $users->where('payment_status', $status);
         }
         $users = $users->selectRaw('*,sum(TIMESTAMPDIFF(HOUR, `from_time`, `to_time`)) AS `total_hours`');
         $users = $users->groupBy('employee_payments.employee_id');
    
         $users = $users->whereBetween('employee_payments.created_at', [$start_date, $end_date]);
         $users = $users->get();
         
        
         $setting = Setting::find(1);
         $selected_warehouse = $request->warehouse_id;
         $selected_user_type = $request->user_type;
         $selected_status = $request->status;
         
         $orders = Order::join('users','orders.user_id','users.id')->orderBy('orders.created_at','desc');
         if($request->warehouse_id)
             $orders = $orders->where('orders.warehouse_id', $request->warehouse_id);
        // if($request->user_type)
        $orders = $orders->where('users.user_type',$request->user_type);
         
         $orders = $orders->selectRaw('*,sum(orders.tips) AS `total_tips`, orders.id as order_id');
         $orders = $orders->groupBy('orders.user_id');
         $orders = $orders->whereBetween('orders.created_at', [$start_date, $end_date]);
         
         $orders = $orders->get();
     
         
         $selected_year = $year;
         $selected_week = $current_week;
         
         $user_types = UserType::all();
         
         if($request->employee_id)
           $selected_employee = $request->employee_id;
         else
           $selected_employee = 0;  
         
         return view('admin.paydays', compact('users','setting','warehouses','selected_warehouse', 'selected_user_type','selected_status','orders','week_arr','current_week','selected_year','selected_week','user_types','selected_employee'));
    }
    public function PayReject(Request $request)
    {
        $payday = EmployeePayment::find($request->pay_id);
        $payday->hour_status = 0;
        $payday->save();
        return redirect('admin/paydays')->with('success', 'working hour history has been rejected successfully');
        
    }
    public function WareHouseUserList(Request $request)
    {
         $warehouses = WareHouse::all();
        if(empty($request->warehouse_id))
           $warehouse_id = $warehouses->first()->id;
        else
            $warehouse_id = $request->warehouse_id;

         if($request->warehouse_id)
            $users = User::leftJoin('user_shifts','users.id','user_shifts.user_id')->select('users.*','mon','tue','wed','thru','fri','sat','sun')->where('user_type','!=', 'VIP')->where('warehouse_id', $request->warehouse_id)->orderBy('users.created_at', 'desc');
         else
             $users = User::leftJoin('user_shifts','users.id','user_shifts.user_id')->select('users.*','mon','tue','wed','thru','fri','sat','sun')->where('user_type','!=', 'VIP')->whereNotNull('warehouse_id')->orderBy('users.created_at', 'desc');
         
          $users = $users->get();
          if($request->time_shift)
         {
             $day = $request->day; 
             $shift = $request->time_shift;
             
             $users = $users->filter(function($item) use(&$day,&$shift){
                 $time_shift = array();
                 if($item->$day)
                  $time_shift = explode(",", $item->$day);    
               
                 if(in_array($shift, $time_shift))
                   return true;
             
             });
         }
//         if($request->warehouse_id)
//            $users = $users->where('warehouse_id', $request->warehouse_id);
//         else
//            $users = User::where('user_type','!=', 'VIP')->orderBy('created_at', 'desc')->whereNotNull('warehouse_id')->get();
         
        
         $time_shifts = TimeSheet::orderBy('id','asc')->get();
         
         
	 return view('admin.warehouse_user', ['users' => $users,'warehouses'=>$warehouses,'selected_warehouse' => $request->warehouse_id,'selected_time_shift' => $request->time_shift,'selected_day' => $request->day,'time_shifts'=>$time_shifts]);
    }
    public function employeeList(Request $request)
    {
         $warehouses = WareHouse::all();
      
         if($request->warehouse_id)
            $users = User::leftJoin('user_shifts','users.id','user_shifts.user_id')->select('users.*','mon','tue','wed','thru','fri','sat','sun')->where('user_type','!=', 'VIP')->where('warehouse_id', $request->warehouse_id)->orderBy('users.created_at', 'desc');
         else
            $users = User::leftJoin('user_shifts','users.id','user_shifts.user_id')->select('users.*','mon','tue','wed','thru','fri','sat','sun')->where('user_type','!=', 'VIP')->whereNotNull('warehouse_id')->orderBy('users.created_at', 'desc');
         
         if($request->user_type)
          {
             $users =  $users->where('user_type', $request->user_type);
          }
          
          $users = $users->get();
          if($request->time_shift)
          {
             $day = $request->day; 
             $shift = $request->time_shift;
             
             $users = $users->filter(function($item) use(&$day,&$shift){
                 $time_shift = array();
                 if($item->$day)
                  $time_shift = explode(",", $item->$day);    
               
                 if(in_array($shift, $time_shift))
                   return true;
             
             });
         }
        
         $time_shifts = TimeSheet::orderBy('id','asc')->get();
         $user_types = UserType::all();
         
	 return view('admin.employees', ['tab'=>'employee','users' => $users,'warehouses'=>$warehouses,'selected_warehouse' => $request->warehouse_id,'selected_time_shift' => $request->time_shift,'selected_day' => $request->day,'time_shifts'=>$time_shifts,'selected_user_type' => $request->user_type,'user_types' => $user_types]);
    }
    
    public function schedule(Request $request)
    {
         $warehouses = WareHouse::all();
          if(empty($request->warehouse_id))
           $warehouse_id = $warehouses->first()->id;
         else
            $warehouse_id = $request->warehouse_id;
         
         if($request->warehouse_id)
            $users = User::leftJoin('user_shifts','users.id','user_shifts.user_id')->select('users.*','mon','tue','wed','thru','fri','sat','sun')->where('user_type','!=', 'VIP')->where('warehouse_id', $request->warehouse_id)->orderBy('users.created_at', 'desc');
         else
           $users = User::leftJoin('user_shifts','users.id','user_shifts.user_id')->select('users.*','mon','tue','wed','thru','fri','sat','sun')->where('user_type','!=', 'VIP')->whereNotNull('warehouse_id')->orderBy('users.created_at', 'desc');
         
          if($request->user_type)
          {
             $users =  $users->where('user_type', $request->user_type);
          }
          
          $users = $users->get();
          if($request->time_shift)
          {
             $shift = $request->time_shift;
             
             $users = $users->filter(function($item) use(&$shift){
             $time_shift = array();
             $mon_shift = explode(",", $item->mon);    
             $tue_shift = explode(",", $item->tue);    
             $wed_shift = explode(",", $item->wed);
             $thru_shift = explode(",", $item->thru);
             $fri_shift = explode(",", $item->fri);
             $sat_shift = explode(",", $item->sat);
             $sun_shift = explode(",", $item->sun);
             
             if(in_array($shift, $mon_shift) || in_array($shift, $tue_shift) || in_array($shift, $wed_shift) || in_array($shift, $thru_shift) || in_array($shift, $fri_shift) || in_array($shift, $sat_shift) || in_array($shift, $sun_shift))
                   return true;
             
             });
         }
        
         $time_shifts = TimeSheet::orderBy('id','asc')->get();
         $user_types = UserType::all();
         
	 return view('admin.schedule', ['tab'=>'employee','users' => $users,'warehouses'=>$warehouses,'selected_warehouse' => $request->warehouse_id,'selected_time_shift' => $request->time_shift,'selected_day' => $request->day,'time_shifts'=>$time_shifts,'selected_user_type' => $request->user_type, 'user_types'=>$user_types]);
    }
    public function saveEditCategory(Request $request)
    {
        $category_name = $request->input('name');
        $category_id   = $request->input('category_id');
        $admin_id      =  Auth::guard('admin')->id();
        $parent_category_id   = $request->input('parent_category'); 
        $sub_category_id      = $request->input('sub_category');
        
        if($request->has('file'))
        {
                $file = $request->file('file');
                     $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/category/thumbnail');
                     $destinationPath1 = public_path('/uploads/category');
$image->move($destinationPath, $input['imagename']);
//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $imageName = $input['imagename'];
     
              
         }
         else
           $imageName = $request->input('category_image');  
            
        $main_category = DB::table("category")->where([['category_id', '=', $category_id],])->get();
         if($main_category[0]->flag == 1)
         { $parent_category_ids = $request->input('parent_category'); 
             if(is_array($parent_category_ids))
            {
                 
               $cat_name = $request->input('cat_name'); 
                  Category::where('name',$cat_name)->delete();
                foreach($parent_category_ids as $parent_category_id)
                {
                    $total_category = DB::table("category")->where([['name', '=', $category_name],['category_id', '=', $parent_category_id],])->count('category_id');
                    if($total_category < 1)
                    {
                        if(empty($parent_category_id))
                            $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(0,'".$category_name."',0,1,'".$imageName."')");
                        else if(!empty($parent_category_id) && empty($sub_category_id))
                            $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(1,'".$category_name."',$parent_category_id,1,'".$imageName."')");
                        else if(!empty($parent_category_id) && !empty($sub_category_id))
                            $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(2,'".$category_name."',$sub_category_id,1,'".$imageName."')");


                    }
                }
                 return redirect('admin/category_list')->with('success', 'Your category has been updated successfully');
            }
         }
 else {
        $total_category = DB::table("category")->where([['name', '=', $category_name],['category_id', '!=', $category_id],])->count('category_id');
        if($total_category > 0)
            echo 2;
        else 
        {
            if(empty($parent_category_id))
                $update = DB::update("UPDATE `category` SET name = '".$category_name."',parent_id= 0,status = 1,image='".$imageName."' WHERE `category_id` = $category_id");
            else if(!empty($parent_category_id) && empty($sub_category_id))
                $update = DB::update("UPDATE `category` SET name = '".$category_name."',parent_id= $parent_category_id,status = 1,image='".$imageName."' WHERE `category_id` = $category_id");
            else if(!empty($parent_category_id) && !empty($sub_category_id))
                $update = DB::update("UPDATE `category` SET name = '".$category_name."',parent_id= $sub_category_id,status = 1,image='".$imageName."' WHERE `category_id` = $category_id");
            if($update)
            {
                 return redirect('admin/category_list')->with('success', 'Your category has been updated successfully');
            }
            else
            {
                return redirect('admin/category_list')->with('success', 'Your category has not been updated');
            }
            
        }
 }
        
    }
    
    
    public function saveEditGroup(Request $request)
    {
        $group_name = $request->input('name');
        $id = $request->input('id');
        
        $total_group = DB::table("groups")->where([['name', '=', $group_name],['id', '!=', $id],])->count('id');
        if($total_group > 0)
            return redirect('admin/group_edit/'.$id)->with('success', 'The group is already existed');
        else 
        {
            $group = Group::find($id);
            $group->name = $group_name;
            $update = $group->save();
            
            if($update)
            {
                 return redirect('admin/group_list')->with('success', 'The group has been updated successfully');
            }
            else
            {
                return redirect('admin/group_list')->with('success', 'The group has not been updated');
            }
            
        }
        
    }
     public function saveEditUserType(Request $request)
    {
        $name = $request->input('name');
        $rate = $request->input('rate');
        $id = $request->input('id');
        
        $total_group = DB::table("user_types")->where([['name', '=', $name],['id', '!=', $id],])->count('id');
        if($total_group > 0)
            return redirect('admin/user_type_edit/'.$id)->with('success', 'The user type is already existed');
        else 
        {
            $group = UserType::find($id);
            $group->name = $name;
            $group->rate = $rate;
            $update = $group->save();
            
            if($update)
            {
                 return redirect('admin/user_type_list')->with('success', 'The user type has been updated successfully');
            }
            else
            {
                return redirect('admin/user_type_list')->with('success', 'The  user type has not been updated');
            }
            
        }
        
    }
    
    
    public function saveEditUser(Request $request)
    {
        $email = $request->input('email');
        $id = $request->input('id');
        $group = $request->input('group');
        $facebook = $request->input('facebook');
        $instagram = $request->input('instagram');
        $phone = $request->input('phone');
        $job = $request->input('job');
        
        $total_user = DB::table("customers")->where([['email', '=', $email],['id', '!=', $id],])->count('id');
        if($total_user > 0)
            return redirect('admin/user_edit/'.$id)->with('success', 'The user is already existed');
        else 
        {
            $user = Customer::find($id);
            $user->email = $email;
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->facebook = $facebook;
            $user->instagram = $instagram;
            $user->group_id = $group;
            $user->phone = $phone;
            $user->verfified_value = $phone;
            $user->job = $job;
            
             if($request->has('file'))
            {
                   $file = $request->file('file');
                        $image = $file;
                        $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                        $destinationPath = public_path('/uploads/warehouse/thumbnail');
                        $destinationPath1 = public_path('/uploads/warehouse');

                        $image->move($destinationPath, $input['imagename']);

   //                     $img = Image::make($image->getRealPath());
   //                     $img->resize(300, 300, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath.'/'.$input['imagename']);
   //                     $img->resize(800, 800, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath1.'/'.$input['imagename']);

                        $user->image = asset('public/uploads/warehouse/thumbnail').'/'.$input['imagename'];


               }
            
            $update = $user->save();
            
            if($update)
            {
                 return redirect('admin/user_list')->with('success', 'The user has been updated successfully');
            }
            else
            {
                return redirect('admin/user_list')->with('success', 'The user has not been updated');
            }
            
        }
        
    }
    
    public function saveEditAdminUser(Request $request)
    {
        $email = $request->input('email');
        $id = $request->input('id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        
        $total_user = DB::table("admin")->where([['email', '=', $email],['id', '!=', $id],])->count('id');
        if($total_user > 0)
            return redirect('admin/admin_user_edit/'.$id)->with('success', 'The user is already existed');
        else 
        {
            $user = Admin::find($id);
            $user->email = $email;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone = $phone;
           
            
             if($request->has('file'))
            {
                   $file = $request->file('file');
                        $image = $file;
                        $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                        $destinationPath = public_path('/uploads/warehouse/thumbnail');
                        $destinationPath1 = public_path('/uploads/warehouse');

                        $image->move($destinationPath, $input['imagename']);

   //                     $img = Image::make($image->getRealPath());
   //                     $img->resize(300, 300, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath.'/'.$input['imagename']);
   //                     $img->resize(800, 800, function ($constraint) {
   //                         $constraint->aspectRatio();
   //                     })->save($destinationPath1.'/'.$input['imagename']);

                        $user->image = $input['imagename'];


               }
            
            $update = $user->save();
            
            if($update)
            {
                 return redirect('admin/admin_users')->with('success', 'The user has been updated successfully');
            }
            else
            {
                return redirect('admin/admin_users')->with('success', 'The user has not been updated');
            }
            
        }
        
    }
    public function CategoryEdit(Request $request, $category_id)
    {
       $category = DB::table('category')->where('category_id', '=', $category_id)->get();
       $sub_category_id = '';
       $parent_category_id = array();
       if($category[0]->flag == 2)
       {
           $sub_category = DB::table('category')->where('category_id', '=', $category[0]->parent_id)->get();
           $sub_category_id = $category[0]->parent_id;
           $parent_category = DB::table('category')->where('category_id', '=', $sub_category[0]->parent_id)->get();
           $parent_category_id = $sub_category[0]->parent_id;
          
       }
       else if($category[0]->flag == 1)
       {
           $categories = DB::table('category')->select('parent_id')->where('parent_id', '!=', 0)->where('name',$category[0]->name)->get();
           foreach($categories as $cat)
           $parent_category_id[] = $cat->parent_id;
       } 
       
       return view('admin.category_edit', ['flag'=>$category[0]->flag, 'category' => $category[0],'sub_category_id'=>$sub_category_id,'parent_category_id'=>$parent_category_id]);
    }
    
    public function GroupEdit(Request $request, $group_id)
    {
       $group = Group::find($group_id);
     
       return view('admin.group_edit', [ 'group' => $group]);
    }
    
     public function UserTypeEdit(Request $request, $type_id)
    {
       $type = UserType::find($type_id);
     
       return view('admin.user_type_edit', [ 'type' => $type]);
    }
    
    public function WareHouseEdit(Request $request, $warehouse_id)
    {
       $warehouse = Warehouse::find($warehouse_id);
     
       return view('admin.warehouse_edit', [ 'warehouse' => $warehouse]);
    }
    
    public function WareHouseUserEdit(Request $request, $warehouse_id)
    {
       $user = User::find($warehouse_id);
       $warehouses = WareHouse::orderBy('created_at', 'desc')->get();
       $time_shifts = TimeSheet::orderBy('id','asc')->get();
    
       $user_shift = UserShift::where('user_id', $user->id)->get();
       if(!empty($user_shift[0]))
           $user_shift=  $user_shift[0];
       else
           $user_shift=  array();
       
       $user_types = UserType::all(); 
       return view('admin.warehouse_user_edit', [ 'user' => $user,'warehouses'=>$warehouses,'time_shifts' => $time_shifts,'user_shift' => $user_shift,'user_types'=>$user_types]);
    }
    
    public function UserEdit(Request $request, $user_id)
    {
       $groups = Group::all();
       $user   = Customer::find($user_id);
     
       return view('admin.user_edit', compact('groups','user'));
    }
    
    public function OrderDetails(Request $request)
    {
       $order   = Order::find($request->order_id);
       $setting = Setting::find(1);
     
       return view('admin.order_details', compact('order','setting'));
    }
    
    public function OrderTime(Request $request)
    {
       $order   = Order::find($request->order_id);
       $setting = Setting::find(1);
     
       return view('admin.order_time', compact('order','setting'));
    }
    
    public function AdminUserEdit(Request $request, $user_id)
    {
       
       $user   = Admin::find($user_id);
     
       return view('admin.admin_user_edit', compact('user'));
    }
    
    public function CategoryDelete(Request $request, $category_id)
    {
        
       
        $category = DB::table('category')->where('category_id', '=', $category_id)->get()[0];
        if($category->image)
        {
            $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/category/thumbnail/'.$category->image;
            @unlink($image_path);
            $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/category/'.$category->image;
            @unlink($image_path);
        }
        $delete = DB::table('category')->where('category_id', '=', $category_id)->delete();
            
            if($delete)
                return redirect('admin/category_list')->with('success', 'Your category has been deleted successfully');
            else
               return redirect('admin/category_list')->with('success', 'Your category has not been deleted');
    }
    
    public function GroupDelete(Request $request, $group_id)
    {
        DB::table('users')->where('group_id', '=', $group_id)->delete();
        
        $delete = DB::table('groups')->where('id', '=', $group_id)->delete();
            
        if($delete)
           return redirect('admin/group_list')->with('success', 'The group has been deleted successfully');
        else
          return redirect('admin/group_list')->with('success', 'The group has not been deleted');
    }
    
    public function UserTypeDelete(Request $request, $id)
    {
        
        $delete = DB::table('user_types')->where('id', '=', $id)->delete();
            
        if($delete)
           return redirect('admin/user_type_list')->with('success', 'The user type has been deleted successfully');
        else
          return redirect('admin/user_type_list')->with('success', 'The user type has not been deleted');
    }
    
    public function UserDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('customers')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/user_list')->with('success', 'The user has been deleted successfully');
        else
          return redirect('admin/user_list')->with('success', 'The user has not been deleted');
    }
    
    public function DiscountDelete(Request $request, $discount_id = 0)
    {
       
        $delete = DB::table('discounts')->where('id', '=', $discount_id)->delete();
            
        if($delete)
           return redirect('admin/discounts')->with('success', 'The discount has been deleted successfully');
        else
          return redirect('admin/discounts')->with('success', 'The discount has not been deleted');
    }
    
    public function AdminUserDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('admin')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/admin_users')->with('success', 'The user has been deleted successfully');
        else
          return redirect('admin/admin_users')->with('success', 'The user has not been deleted');
    }
    
    public function WareHouseDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('warehouses')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/warehouse_list')->with('success', 'The warehouse has been deleted successfully');
        else
          return redirect('admin/warehouse_list')->with('success', 'The warehouse has not been deleted');
    }
    
    public function WareHosueUserDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('users')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has been deleted successfully');
        else
          return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has not been deleted');
    }
    
    public function NewProduct(Request $request)
    {
       $admin_id =  Auth::guard('admin')->id(); 
       $category = DB::table('category')->where([['parent_id', '=', 0],])->orderBy('name', 'ASC')->get();
       
       return view('admin.add_product', ['category' => $category,'warehouse_id'=>$request->warehouse_id]);
    }
    
    public function PostProduct(Request $request)
    {
       $name = $request->input('name');
       $category = $request->input('category');
       $sub_category = $request->input('sub_category');
       
       $sharedCat = Category::where('category_id', $sub_category)->where('parent_id', $category)->get()[0];
       if( $sharedCat->shared_category)
       {
        $shared_cat = $products = DB::select("SELECT * FROM `category` where shared_category IS NOT NULL AND parent_id IN(".$sharedCat->shared_category.")");
        $sharedcatid = array();
        foreach($shared_cat as $cat)
        {
            $sharedcatid[] = $cat->category_id;
        }
       }
     
      
       $price = $request->input('price');
       $tax = $request->input('tax');
      
       $description = $request->input('description');
       $imageName   = '';
       $product = new Product;
       if($request->has('main_file'))
        {
                $file = $request->file('main_file');
                $image = $file;
                $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path('/uploads/product/thumbnail');
                $destinationPath1 = public_path('/uploads/product');
                $image->move($destinationPath, $input['imagename']);
//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                $imageName = $input['imagename'];
     
              
         }
       
       $admin_id =  Auth::guard('admin')->id(); 
       $product->name = $name;
       $product->category_id = $category;
       $product->sub_category_id = $sub_category;
       $product->price = $price;
       $product->description = $description;
       $product->main_image = $imageName;
       if(count($sharedcatid) > 0)
           $product->shared_subcat = implode(",", $sharedcatid);
       $product->tax = $tax;
       $product->save();
       $id = $product->id;
       
//       $insert  = DB::insert('insert into products (name,category_id,sub_category_id,price,description,main_image,tax) values (?, ?, ?,? ,? ,?.? )', 
//                  [$name, $category,$sub_category,$price,$description,$imageName,$tax]);
//       
//       $id = DB::getPdo()->lastInsertId();
       
       if($id)
        {
            if($request->has('quantity'))
            {
                 
                $warehouse = new WarehouseProduct;
                $warehouse->warehouse = $request->input('warehouse_id');
                $warehouse->product = $id;
                $warehouse->quantity =  $request->input('quantity');
                $warehouse->min_capacity =  $request->input('min_capacity');
                $warehouse->max_capacity =  $request->input('max_capacity');
                $warehouse->save();
            }
            $file = $request->file('file');
            if($request->has('file'))
            {
            if(count($file) > 0)
            {
            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                $image = $file[$i];
                $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();
                
                $destinationPath = public_path('/uploads/product/thumbnail');
                $destinationPath1 = public_path('/uploads/product');
                $image->move($destinationPath, $input['imagename']);
//                $img = Image::make($image->getRealPath());
//                $img->resize(300, 300, function ($constraint) {
//                    $constraint->aspectRatio();
//                })->save($destinationPath.'/'.$input['imagename']);
//                $img->resize(800, 800, function ($constraint) {
//                    $constraint->aspectRatio();
//                })->save($destinationPath1.'/'.$input['imagename']);
                

                $imageName = $input['imagename'];
                
               DB::insert('insert into product_images (product_id,image) values (?, ?)', [$id,$imageName]);
            }
            }
        }
        }
        
        if($id)
          return redirect('admin/product_list')->with('success', 'Your product has been uploaded successfully');
        else
            return redirect('admin/product_list')->with('success', 'Your product has not been uploaded');
    }
    
    public function ProductList(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
       
//             $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
//                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) ");
         
         $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse')->get(); 

	 return view('admin.products', ['products' => $products,'warehouse_id' => $request->warehouse_id]);
    }
    
    public function warehouseProductList(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
         if($request->warehouse_id)    
            $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->where('warehouse', $request->warehouse_id)->get(); 
         else
           $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse')->get();   
         
         $warehouses = Warehouse::all();
         
	 return view('admin.warehouse_products', ['products' => $products,'warehouse_id' => $request->warehouse_id,'warehouses' => $warehouses]);
    }
    
    public function lowInventoryProductList(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
         if($request->warehouse_id)
            $products = Product::join('warehouse_products','products.id','warehouse_products.product')->where('warehouse', $request->warehouse_id)->whereColumn('quantity', '<', 'min_capacity')->get(); 
         else
             $products = Product::join('warehouse_products','products.id','warehouse_products.product')->whereColumn('quantity', '<', 'min_capacity')->get(); 
         
         $warehouses = Warehouse::all();
         
	 return view('admin.low_inventory_products', ['products' => $products,'warehouse_id' => $request->warehouse_id,'warehouses'=>$warehouses]);
    }
    
     public function ProductListSubCat(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
          
         $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse')->where('sub_category_id', $request->subcat_id)->get(); 

	 return view('admin.products', ['products' => $products,'warehouse_id' => $request->warehouse_id]);
    }
    
    public function transferProducts(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
       
//             $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
//                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) ");
             
         $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->join('register_products','register_products.product_id','products.id')->whereNull('warehouse')->where('register_products.quantity','>',0)->select('products.*' ,'warehouse_products.*','register_products.quantity as left_qty', 'register_products.price as incoming_cost', 'register_products.id as incoming_id', 'register_products.created_at as incoming_date', 'register_products.avail_qty');     
         $sub_cats = array();
         if(!empty($request->category))  
         {    
           $products = $products->where('category_id', $request->category); 
           $sub_cats = Category::where('parent_id', $request->category)->get();
         }
         if(!empty($request->subcategory))     
           $products = $products->where('sub_category_id', $request->subcategory); 
         
         $products = $products->get();
//         echo "<pre>";
//         print_r($products->toArray()); exit;
         
         $warehouses = Warehouse::all();   
         $categories = DB::table('category')->where('parent_id', '=', 0)->get();

	 return view('admin.transfer_products', ['products' => $products,'warehouses' => $warehouses, 'categories' => $categories,'selected_cat'=>$request->category,'selected_subcat'=>$request->subcategory,'sub_cats'=>$sub_cats]);
    }
    
    public function registerProducts(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
         $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse');     
         $sub_cats = array();
         if(!empty($request->category))  
         {    
           $products = $products->where('category_id', $request->category); 
           $sub_cats = Category::where('parent_id', $request->category)->get();
         }
         if(!empty($request->subcategory))     
           $products = $products->where('sub_category_id', $request->subcategory); 
         
         $products = $products->get();
         
         $warehouses = Warehouse::all();   
         $categories = DB::table('category')->where('parent_id', '=', 0)->get();

	 return view('admin.register_products', ['products' => $products,'warehouses' => $warehouses, 'categories' => $categories,'selected_cat'=>$request->category,'selected_subcat'=>$request->subcategory,'sub_cats'=>$sub_cats]);
    }
    
    public function ProductsCapacity(Request $request)
    {
               
         $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNull('warehouse');     
         $sub_cats = array();
         if(!empty($request->category))  
         {    
           $products = $products->where('category_id', $request->category); 
           $sub_cats = Category::where('parent_id', $request->category)->get();
         }
         if(!empty($request->subcategory))     
           $products = $products->where('sub_category_id', $request->subcategory); 
         
         $products = $products->get();
         
         $warehouses = Warehouse::all();   
         $categories = DB::table('category')->where('parent_id', '=', 0)->get();

	 return view('admin.products_capacity', ['tab'=>'','products' => $products,'warehouses' => $warehouses, 'categories' => $categories,'selected_cat'=>$request->category,'selected_subcat'=>$request->subcategory,'sub_cats'=>$sub_cats]);
    }
    
    public function ProductListCat(Request $request)
    {
         $admin_id =  Auth::guard('admin')->id();
         
       
//             $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
//                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) where sub_category_id = '".$request->cat_id."'");
//             
        $cat = Category::find($request->cat_id);
        if($cat->shared_category)
        {
            $products = DB::select("SELECT products.* FROM `products` inner join category on(products.sub_category_id = category.category_id) where locate('".$request->cat_id."',shared_subcat)>0");
        
            //$products = Product::join('category','category.category_id','products.category_id')->select('products.*')->where('sub_category_id',$request->cat_id)->get();
        }
        else
         $products = Product::join('category','category.category_id','products.category_id')->select('products.*')->where('sub_category_id',$request->cat_id)->get();

	 return view('admin.cat_products', ['products' => $products,'warehouse_id' => $request->warehouse_id]);
    }
    
    public function ProductDelete(Request $request, $product_id)
    {
        
        $product_image = DB::table('product_images')->where('product_id', '=', $product_id)->get();
     
        if(count($product_image)>0){
            foreach($product_image as $key=>$image)
            {

               $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/thumbnail/'.$image->image;
               @unlink($image_path);
               $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/'.$image->image;
               @unlink($image_path);
            }
            DB::table('product_images')->where('product_id', '=', $product_id)->delete();
            
        }
        
        $delete = DB::table('warehouse_products')->where('product', '=', $product_id)->whereNotNull('warehouse')->delete();
        $delete = DB::table('products')->where('id', '=', $product_id)->delete();
            
            if($delete)
                return redirect('admin/product_list')->with('success', 'Your product has been deleted successfully');
            else
               return redirect('admin/product_list')->with('success', 'Your product has not been deleted');
    }
    
    public function ProductEdit(Request $request,  $product_id)
    {
        $admin_id =  Auth::guard('admin')->id();
         
         
        $products = Product::find($product_id);
        
        if($request->warehouse_id)
        {
            $quantity = WarehouseProduct::where('product', $product_id)->where('warehouse',$request->warehouse_id)->get();
        }
        else
        {
            $quantity = WarehouseProduct::where('product', $product_id)->get();
        }
       
        
        $product_image = DB::table('product_images')->where('product_id', '=', $product_id)->get();
        $category = DB::table('category')->where('parent_id', '=', 0)->orderBy('name', 'ASC')->get();
        $sub_category = DB::table('category')->where('parent_id', '=', $products->category_id)->orderBy('name', 'ASC')->get();
        $sub_category_2 = DB::table('category')->where('parent_id', '=', $products->sub_category_id)->orderBy('name', 'ASC')->get();
      
    
        return view('admin.product_edit', ['product_image' => $product_image,'product' => $products,'category' => $category, 'sub_category'=>$sub_category,'sub_category_2'=>$sub_category_2,'warehouse_id'=> $request->warehouse_id,'quantity'=>@$quantity[0]]);
    }
    
    public function WarehouseProductEdit(Request $request,  $product_id)
    {
        $admin_id =  Auth::guard('admin')->id();
         
         
        $products = Product::find($product_id);
        
        if($request->warehouse_id)
        {
            $quantity = WarehouseProduct::where('product', $product_id)->where('warehouse',$request->warehouse_id)->get();
        }
        else
        {
            $quantity = WarehouseProduct::where('product', $product_id)->get();
        }
       
        
        $product_image = DB::table('product_images')->where('product_id', '=', $product_id)->get();
        $category = DB::table('category')->where('parent_id', '=', 0)->orderBy('name', 'ASC')->get();
        $sub_category = DB::table('category')->where('parent_id', '=', $products->category_id)->orderBy('name', 'ASC')->get();
        $sub_category_2 = DB::table('category')->where('parent_id', '=', $products->sub_category_id)->orderBy('name', 'ASC')->get();
      
    
        return view('admin.warehouse_product_edit', ['product_image' => $product_image,'product' => $products,'category' => $category, 'sub_category'=>$sub_category,'sub_category_2'=>$sub_category_2,'warehouse_id'=> $request->warehouse_id,'quantity'=>@$quantity[0]]);
    }
    
    public function ProductMove(Request $request,  $product_id)
    {
        $admin_id =  Auth::guard('admin')->id();
         
         
        $products = Product::find($product_id);
        $warehouses = Warehouse::all();
       
        return view('admin.product_move', ['product' => $products,'warehouses' => $warehouses]);
    }
    
    public function PostEditProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $products = Log::where('type', 0)->where('status',1)->where('product_id', $product_id)->orderBy('price','desc')->get();
        $avail_qty = $products->sum('quantity');
        if($avail_qty > $request->input('quantity'))
        {
           $changed_qty = $avail_qty - $request->input('quantity');
           
            foreach($products as $product)
            {
                if($changed_qty == $product->quantity)
                {
                    Log::find($product->id)->delete();
                    return redirect('admin/warehouse_product_list')->with('success', 'Your product quantity has been updated successfully');
                }
                elseif($changed_qty > $product->quantity)
                {
                    $changed_qty = $changed_qty - $product->quantity;
                    Log::find($product->id)->delete();

                }
                elseif($changed_qty < $product->quantity)
                {

                    $log = Log::find($product->id);
                    $register = RegisterProduct::where('id', $log->register_id)->get()[0];
                    $log->quantity = $changed_qty;
                    $log->price = $changed_qty * $register->price;
                    $log->save();
                    $changed_qty = 0;
                    return redirect('admin/warehouse_product_list')->with('success', 'Your product quantity has been updated successfully');
                }

            }
        }
        else
        {
          
                    $log = Log::find($products[0]->id);
                    $register = RegisterProduct::where('id', $log->register_id)->get()[0];
                   
                    $log->quantity = $request->input('quantity');
                    $log->price = $request->input('quantity') * $register->price;
                    $log->save();
                    $changed_qty = 0;
                    return redirect('admin/warehouse_product_list')->with('success', 'Your product quantity has been updated successfully');
        }
        
        return redirect('admin/warehouse_product_list')->with('success', 'Your product quantity has been updated successfully');
        
    }
    public function PostEditProduct2(Request $request)
    {
       $name = $request->input('name');
       $category = $request->input('category');
       $sub_category = $request->input('sub_category');
       $sub_category_2 = $request->input('second_sub_category',0);
       $price = $request->input('price');
       $description = $request->input('description');
       
       $admin_id =  Auth::guard('admin')->id(); 
       $product_id = $request->input('product_id');
       $product = Product::find($product_id);
       $product->name = $name;
       $product->category_id = $category;
       $product->sub_category_id = $sub_category;
       $product->sub_category_id_2 = $sub_category_2;
       $product->price = $price;
       $product->tax = $request->input('tax');
       $product->description = $description;
       
       if($request->has('main_file'))
        {
                $file = $request->file('main_file');
                $image = $file;
                $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path('/uploads/product/thumbnail');
                $destinationPath1 = public_path('/uploads/product');
                $image->move($destinationPath, $input['imagename']);
//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

              $product->main_image = $input['imagename'];
     
              
         }
       
       $update = $product->save();
       
       $file = $request->file('file');   
       if($request->has('file'))
       {
        if(count($file) > 0){
        {
            

            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                $image = $file[$i];
                $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();
                
                $destinationPath = public_path('/uploads/product/thumbnail');
                $destinationPath1 = public_path('/uploads/product');
                $image->move($destinationPath, $input['imagename']);
//                $img = Image::make($image->getRealPath());
//                $img->resize(300, 300, function ($constraint) {
//                    $constraint->aspectRatio();
//                })->save($destinationPath.'/'.$input['imagename']);
//                $img->resize(800, 800, function ($constraint) {
//                    $constraint->aspectRatio();
//                })->save($destinationPath1.'/'.$input['imagename']);
                
                $imageName = $input['imagename'];
                
               DB::insert('insert into product_images (product_id,image) values (?,  ?)', [$product_id,$imageName]);
            }}
        }
       }
        if($update)
        { 
            //if($request->has('quantity'))
            {
                $warehouse_id = $request->input('warehouse_id');
                $quantity = $request->input('quantity');
                WarehouseProduct::where('warehouse',$warehouse_id)->where('product',$product_id)->delete();
               
           
                $warehouse = new WarehouseProduct;
                $warehouse->warehouse = $warehouse_id;
                $warehouse->product = $product_id;
                $warehouse->quantity =  $quantity;
                $warehouse->min_capacity =  $request->input('min_capacity');
                $warehouse->max_capacity =  $request->input('max_capacity');
                $warehouse->save();
                
                $register = Product::where('move_product_id', $product_id)->get();
                if($register)
                {
                    foreach($register as $reg)
                    { 
                        $pro = Product::find($reg->id);
                        $pro->price = $price;
                        $pro->save();
                    }
                }
            }
            return redirect('admin/product_list')->with('success', 'Your product has been updated successfully');
        }
        else
            return redirect('admin/product_list')->with('success', 'Your product has not been updated');
    }
    public function CancelInventoryLog(Request $request)
    {
     
        $logs = Log::where('log_number',$request->log_id)->delete();
//        foreach($logs as $log_id)
//        {echo $log_id->id;
//            $log = Log::find($log_id->id);
//           // $log->delete();
//        }
//      
//  exit;
            return redirect('admin/inventory_log')->with('success', 'The log has been deleted successfully');
       
    }
    
    public function PostMoveProduct(Request $request)
    {
        $logId = rand(1000,100000);
        
        foreach( $request->input('product_id') as $incoming_id)
        {  
            $register = RegisterProduct::find($incoming_id);
            $product_id = $register->product_id;
            $newprice = $register->price * $request->input('quantitu_'.$register->id);
         
            if($request->input('quantitu_'.$register->id))
            {
                $log = new Log;
                $log->warehouse_id = $request->input('warehouse');
                $log->product_id = $product_id;
                $log->quantity =  $request->input('quantitu_'.$register->id);
                $log->log_number = $logId;
                $log->warehouse_id = $request->input('warehouse');
                $log->driver = $request->input('driver');
                $log->admin_name = Auth::guard('admin')->user()->first_name." ".Auth::guard('admin')->user()->last_name;
                $log->price = $newprice;
                $log->register_id = $register->id;
                $insert = $log->save();
                
                
                $warehouse = Warehouse::find($request->input('warehouse'));
                if(isset($warehouse->user))
                {
                    $token = $warehouse->user->token; 
                    $content = "New Products has been sent to ".$warehouse->name."<br>Transaction id is #".$logId."<br>Please confirm";
                    $this->sendPushNotification($token, 'Transfer products notification', $content, 1);
                }

            }
            
            
        }
        return redirect('admin/transfer_products')->with('success', 'Your product has been moved successfully');
    }
    // send push notification
    public function sendPushNotification($token, $title, $content, $unread){

    $message_content = $content;
    $message_title = "New Alert";//$title;

    $url = "https://fcm.googleapis.com/fcm/send";
    // api_key available in google-services.json

    $api_key = "AIzaSyB6PgYyHoP671jzWPRYXLTHF-n2G3oR3bI";

    $notification["to"] = $token;
    $notification["priority"] = "high" ;

    $notification['notification'] = array(
    "body" => $message_content,
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
   
    }
    public function ConfirmInventoryLog(Request $request)
    {
     
           $logs = Log::where('log_number',$request->log_id)->get();
           foreach($logs as $log)
           {
              
           $register = RegisterProduct::find($log->register_id);
           $product_id = $register->product_id;
            
   
            $main_product = Product::join('warehouse_products','products.id','warehouse_products.product')->where('move_product_id', $product_id)->where('warehouse', $log->warehouse_id)->get();
            $check_product = $main_product->count(); 
            if($check_product) 
            {
                   $main_product = $main_product[0];
                 
                    $warehouseProduct = WarehouseProduct::where('product',$main_product->move_product_id)->get()[0];
                   
                    $warehouseProduct->quantity = $warehouseProduct->quantity - $log->quantity;
                    $warehouseProduct->save();

                    $warehouseProduct = WarehouseProduct::where('product',$main_product->product)->get()[0];
                    $warehouseProduct->quantity = $warehouseProduct->quantity + $log->quantity;
                    $warehouseProduct->save();
                    
                    $newprice = $register->price * $log->quantity;
                    
                    $register->avail_qty = $register->avail_qty + $log->quantity;
                    
                    $register->save();
 
                    $product = Product::find($main_product->move_product_id);
                    $product->total_moved = $product->total_moved + 1;
                    $product->save();
                    
                    $log->product_id = $main_product->product;
                    $log->status = 1;
                    $log->save();
                
            }
            else
            {    
                $main_product = Product::find($product_id); 

                if(isset($main_product->quantity))
                {
                   
                        $name = $main_product->name;
                        $category = $main_product->category_id;
                        $sub_category = $main_product->sub_category_id;
                        $price = $main_product->price;
                        $description = $main_product->description;
                        $main_image = $main_product->main_image;
                        
                        $newprice = $register->price * $log->quantity;

                        $product = new Product;
                        $product->name = $name;
                        $product->category_id = $category;
                        $product->sub_category_id = $sub_category;
                        $product->price = $price;
                        $product->description = $description;
                        $product->main_image = $main_image;
                        $product->move_product_id = $product_id;


                        $insert = $product->save();

                        if($insert)
                        {
                             $warehouseProduct = WarehouseProduct::where('product',$main_product->id)->get()[0];
                             $warehouseProduct->quantity = $warehouseProduct->quantity - $log->quantity;
                             $warehouseProduct->save();
                             
                             $register->avail_qty = $register->avail_qty + $log->quantity;
                             $register->save();

                             $main_product->total_moved = $main_product->total_moved + 1;
                             $main_product->save();

                            
                                $warehouse_id = $log->warehouse_id;
                                $quantity = $log->quantity;

                                $warehouse = new WarehouseProduct;
                                $warehouse->warehouse = $warehouse_id;
                                $warehouse->product = $product->id;
                                $warehouse->quantity =  $quantity;
                                $warehouse->min_capacity =  $warehouseProduct->min_capacity;
                                $warehouse->max_capacity =  $warehouseProduct->max_capacity;
                                $warehouse->save();

                                $log->status = 1;
                                $log->product_id = $product->id;
                                $log->save();

                                if(isset($main_product->product_image))
                                {
                                    foreach($main_product->product_image as $image)
                                    {
                                        $product_image = new ProductImage;
                                        $product_image->product_id = $image->product_id;
                                        $product_image->image = $image->image;
                                        $product_image->save();
                                    }
                                }
                            
                        }

                    
                }
          }
          
            
            
          
           }
          $products = Product::join('warehouse_products', 'products.id', '=', 'warehouse_products.product')->whereNotNull('warehouse')->get();
           foreach($products as $product)
           {
                $log_order = Log::where('product_id',$product->product)->sum('quantity');
                $order_qty = OrderProduct::where('product_id',$product->product)->sum('quantity');
                $aval = $log_order - $order_qty;
                $product = WarehouseProduct::where('product',$product->product)->where('warehouse', $product->warehouse)->get()[0];
                $product->avail_qty = $aval;
                $product->save();
           }
      return redirect('admin/inventory_log')->with('success', 'Your log has been confirmed successfully');
    }
    
    public function PostMoveProductConfirm(Request $request)
    {
     
      $logId = rand(1000,100000);
      foreach( $request->input('product_id') as $incoming_id)
      {
          $register = RegisterProduct::find($incoming_id);
          $product_id = $register->product_id;
        
     
          if($request->input('quantitu_'.$register->id))
          {
          
            $main_product = Product::join('warehouse_products','products.id','warehouse_products.product')->where('move_product_id', $product_id)->where('warehouse', $request->input('warehouse'))->get();
            $check_product = $main_product->count(); 
            if($check_product) 
            {
                   $main_product = $main_product[0];
                 
                    $warehouseProduct = WarehouseProduct::where('product',$main_product->move_product_id)->get()[0];
                   
                    $warehouseProduct->quantity = $warehouseProduct->quantity - $request->input('quantitu_'.$register->id);
                    $warehouseProduct->save();

                    $warehouseProduct = WarehouseProduct::where('product',$main_product->product)->get()[0];
                    $warehouseProduct->quantity = $warehouseProduct->quantity + $request->input('quantitu_'.$register->id);
                    $warehouseProduct->save();
                    
                    $newprice = $register->price * $request->input('quantitu_'.$register->id);
                    
                    $register->avail_qty = $register->avail_qty + $request->input('quantitu_'.$register->id);
                   // $register->price = $newprice;
                    $register->save();
 
                    $product = Product::find($main_product->move_product_id);
                    $product->total_moved = $product->total_moved + 1;
                   // $product->price = $newprice;
                    $product->save();
                    
                    $log = new Log;
                    $log->warehouse_id = $request->input('warehouse');
                    $log->product_id = $main_product->product;
                    $log->quantity =  $request->input('quantitu_'.$register->id);
                    $log->log_number = $logId;
                    $log->warehouse_id = $request->input('warehouse');
                    $log->price = $newprice;
                    $log->admin_name = Auth::guard('admin')->user()->first_name." ".Auth::guard('admin')->user()->last_name;
                    $log->register_id = $register->id;
                    $log->save();
                
            }
            else
            {    
                $main_product = Product::find($product_id); 

                if(isset($main_product->quantity))
                {
                   // if($request->input('quantitu_'.$product_id) <= $main_product->quantity->quantity )
                    {
                        $name = $main_product->name;
                        $category = $main_product->category_id;
                        $sub_category = $main_product->sub_category_id;
                        $price = $main_product->price;
                        $description = $main_product->description;
                        $main_image = $main_product->main_image;
                        
                        $newprice = $register->price * $request->input('quantitu_'.$register->id);

                        $product = new Product;
                        $product->name = $name;
                        $product->category_id = $category;
                        $product->sub_category_id = $sub_category;
                        $product->price = $price;
                        $product->description = $description;
                        $product->main_image = $main_image;
                        $product->move_product_id = $product_id;


                        $insert = $product->save();

                        if($insert)
                        {
                             $warehouseProduct = WarehouseProduct::where('product',$main_product->id)->get()[0];
                             $warehouseProduct->quantity = $warehouseProduct->quantity - $request->input('quantitu_'.$register->id);
                             $warehouseProduct->save();
                             
                         
                             $register->avail_qty = $register->avail_qty + $request->input('quantitu_'.$register->id);
                            // $register->price = $newprice;
                             $register->save();

                             $main_product->total_moved = $main_product->total_moved + 1;
                             $main_product->save();

                            if($request->has('quantitu_'.$register->id))
                            {
                                $warehouse_id = $request->input('warehouse');
                                $quantity = $request->input('quantitu_'.$register->id);

                                $warehouse = new WarehouseProduct;
                                $warehouse->warehouse = $warehouse_id;
                                $warehouse->product = $product->id;
                                $warehouse->quantity =  $quantity;
                                $warehouse->min_capacity =  $warehouseProduct->min_capacity;
                                $warehouse->max_capacity =  $warehouseProduct->max_capacity;
                                $warehouse->save();

                                $log = new Log;
                                $log->warehouse_id = $warehouse_id;
                                $log->product_id = $product->id;
                                $log->quantity =  $quantity;
                                $log->log_number = $logId;
                                $log->warehouse_id = $request->input('warehouse');
                                $log->price = $newprice;
                                $log->admin_name = Auth::guard('admin')->user()->first_name." ".Auth::guard('admin')->user()->last_name;
                                $log->register_id = $register->id;
                                $log->save();

                                if(isset($main_product->product_image))
                                {
                                    foreach($main_product->product_image as $image)
                                    {
                                        $product_image = new ProductImage;
                                        $product_image->product_id = $image->product_id;
                                        $product_image->image = $image->image;
                                        $product_image->save();
                                    }
                                }
                            }

                        }

                    }
                }
          }
          }
      }
     
      return redirect('admin/transfer_products')->with('success', 'Your product has been moved successfully');
    }
    
    public function RegisterLogDelete(Request $request)
    {
        $log_id = $request->log_id;
        $log = Log::find($log_id);
        
        $mainProduct = WarehouseProduct::where('product',$log->product_id)->get()[0];
        $mainProduct->quantity = $mainProduct->quantity - $log->quantity;
        $mainProduct->save();
        
        $register = RegisterProduct::find($log->register_id);
        $register->delete();
        
        $log->delete();
        
        return redirect('admin/register_log')->with('success', 'The log has been removed successfully');
    }
     public function PostRegisterProduct(Request $request)
    {
     
        
      $logId = rand(1000,100000);
      foreach( $request->input('product_id') as $product_id)
      {
          if($request->input('quantitu_'.$product_id))
          {

                    
                     $mainProduct = WarehouseProduct::where('product',$product_id)->get()[0];
                     $product = RegisterProduct::where('product_id',$product_id); 
                     $id_product = $product->count();
                 
//                    if($id_product)
//                    {
//                        $product =$product->get()[0];
//                        $product->price = $product->price + $request->input('price_'.$product_id);
//                        $product->tax = $product->tax + $request->input('tax_'.$product_id);
//                        $product->quantity = $product->quantity+$request->input('quantitu_'.$product_id);
//                        $product->save();
//                    }
//                    else
//                    {
                     
                        
                        $mainProduct->quantity = $mainProduct->quantity + $request->input('quantitu_'.$product_id);
                        $mainProduct->save();
                        
                        $newproduct = new RegisterProduct;
                        $newproduct->product_id = $product_id;
                        $newproduct->quantity = $request->input('quantitu_'.$product_id);
                        $newproduct->price = $request->input('price_'.$product_id);
                        $newproduct->tax = $request->input('tax_'.$product_id);
                        $newproduct->created_at = date("Y-m-d H:i:s");
                        $newproduct->updated_at = date("Y-m-d H:i:s");
                        $newproduct->save();
                  //  }
                    
                    $log = new Log;
                    $log->warehouse_id = $mainProduct->warehouse;
                    $log->product_id = $product_id;
                    $log->quantity =  $request->input('quantitu_'.$product_id);
                    $log->price =  $request->input('price_'.$product_id);
                    $log->log_number = $logId;
                    $log->admin_name = Auth::guard('admin')->user()->first_name." ".Auth::guard('admin')->user()->last_name;
                    $log->type = 1;
                    $log->register_id = $newproduct->id;
                    $log->save();
          
          }
      }
     
      return redirect('admin/register_products')->with('success', 'Your product has been registered successfully');
    }
    
    public function PostUpdateCapacity(Request $request)
    {
     
      
        foreach( $request->input('product_id') as $product_id)
        {
            $warehouseProduct = WarehouseProduct::where('product',$product_id)->get()[0];
            if($request->input('min_capacity_'.$product_id))
            {
                $warehouseProduct->min_capacity = $request->input('min_capacity_'.$product_id);
            }
            if($request->input('max_capacity_'.$product_id))
            {
                $warehouseProduct->max_capacity = $request->input('max_capacity_'.$product_id);
            }
            $warehouseProduct->save();

        }
        
        if($request->input('tab') == 'warehouse')
           return redirect('admin/inventory_capacity')->with('success', 'Products capacity has been updated successfully');
        else
            return redirect('admin/products_capacity')->with('success', 'Products capacity has been updated successfully');
    }
    
    public function PostPayment(Request $request)
    {
     
      
        foreach( $request->input('user_id') as $user_id)
        {
           $user = EmployeePayment::find($user_id);
           $user->payment_status = 1;
           $update = $user->save();

        }
        
         return redirect('admin/paydays')->with('success', 'The employee payment has been done successfully');
    }
    
    public function PostTipsPayment(Request $request)
    {
     
      
        foreach( $request->input('order_id') as $id)
        {
           $user = Order::find($id);
           $user->payment_status = 1;
           $update = $user->save();

        }
        
         return redirect('admin/paydays')->with('success', 'The Tips payment has been done successfully');
    }
    public function makePayment(Request $request)
    {
     
      $user = EmployeePayment::find($request->id);
      $user->payment_status = 1;
      $update = $user->save();
      
       if($update)
           return redirect('admin/paydays')->with('success', 'The employee payment has been done successfully');
        else
            return redirect('admin/paydays')->with('success', 'The employee payment has not been done');
    }
    public function DeleteProducImage(Request $request)
    {
      $product_id = $request->product_id;
     
        $image_id = $request->image_id;
        $product_image = DB::table('product_images')->where('id', '=', $image_id)->get();
     
        if(count($product_image)>0){
            foreach($product_image as $key=>$image)
            {

              $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/thumbnail/'.$image->image;
              $image_path1 = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/'.$image->image;
              @unlink($image_path);
              @unlink($image_path1);
            }
            DB::table('product_images')->where('id', '=', $image_id)->delete();
           echo 1;
        }
    }
    public function incrementalHash($length = 32){
     $random_string="";
                while(strlen($random_string)<$length && $length > 0) {
                        $randnum = mt_rand(0,61);
                        $random_string .= ($randnum < 10) ?
                                chr($randnum+48) : ($randnum < 36 ? 
                                        chr($randnum+55) : $randnum+61);
                 }
                return $random_string;
}
    
    public function forgotPassword(Request $request)
   {
     
          
          $cc = Admin::where('email', $request->input('email'))->get();
          $isExist= $cc->count('id');
             if($isExist)
             {
                 $admin = Admin::find($cc[0]->id);
                 $code = $this->incrementalHash(10);
                 $admin->activation_code = $code;
                 $admin->save();
                 
                 $subject = 'Reset Password';

                // message
                $message = 'Please click following link to reset your password';
                $message .= "<br> <a href='".asset('admin/reset_password/'.$code)."'>Reset Password</a>";
          

                // To send HTML mail, the Content-type header must be set
                $headers = "From: titu41@gmail.com" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
              $mail  =  mail($request->input('email'), $subject, $message, $headers); 
                if($mail)
                    return redirect('admin/forgot_password')->with('success', 'An email has been sent to reset your password');
                else
                    return redirect('admin/forgot_password')->with('success', 'Password reset request failed');
             }
             else
             { 
                 return redirect('admin/forgot_password')->with('success', 'You entered wrong email address');
             }
      
   }
   
   public function resetPassowrd(Request $request)
    {
        $code = $request->code;
       return view('admin.reset_password', compact('code'));
    }
    
     public function resetPassword(Request $request)
   {
     
          
             $cc = Admin::where('activation_code', $request->input('code'))->get();
             $isExist= $cc->count('id');
             if($isExist)
             {
                 $client = Admin::find($cc[0]->id);
                 $client->password = bcrypt($request->input('password'));;
                 $client->activation_code = '';
                 $client->save();
                 
                 $subject = 'Password reseted successfully';

                // message
                $message = "Hello, Dear user, ";
                $message .= "<br><br> Your password has been reseted successfully. Please click on below link to login";
                $message .= "<br> <a href='".asset('admin/login')."'>Login</a>";
          

                // To send HTML mail, the Content-type header must be set
                $headers = "From: titu41@gmail.com" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $mail  =  mail($cc[0]->email, $subject, $message, $headers); 
                return redirect('admin/login')->with('success', 'Password reseted successfully.');
             }
             else
             { 
                 return redirect('admin/reset_password/'.$request->input('code'))->with('success', 'You entered wrong activation code');
             }
      
   }
    
}
