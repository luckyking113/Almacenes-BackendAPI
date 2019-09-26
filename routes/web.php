<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.login');
});
Route::get('admin', function () {
    return view('admin.login');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('admin/login', function () {
    return view('admin.login');
   });
     Route::post('admin/backend_login','AuthController@adminLogin' );
   
  Route::get('admin/forgot_password',function () {
    return view('admin.forgot_password');
   });
   
   Route::post('admin/submit_forgot_password','AdminController@forgotPassword' );
   Route::get('admin/reset_password/{code}','AdminController@resetPassowrd' );
   Route::post('admin/submit_reset_password','AdminController@resetPassword' );
      
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin/admin_dashboard/{warehouse_id?}/{date?}','AdminController@dashboards' );
    
    //category module
    Route::get('admin/add_category/{cat_id?}','AdminController@NewCategory');  
    Route::post('admin/save_category','AdminController@saveCategory' );
    Route::post('admin/save_edit_category','AdminController@saveEditCategory' );
    Route::get('admin/category_list','AdminController@CategoryList' );
    Route::get('admin/subcat_list/{cat_id}','AdminController@CategoryList' );
    Route::get('admin/category_edit/{cat_id}','AdminController@CategoryEdit' )->where('cat_id', '[0-9]+');
    Route::get('admin/category_delete/{category_id}','AdminController@CategoryDelete' )->where('category_id', '[0-9]+');
    Route::get('admin/loadSubCategory/{cat_id}','AdminController@loadSubCategory' )->where('cat_id', '[0-9]+');
    
      // Product module
    Route::get('admin/add_product/{warehouse_id?}','AdminController@NewProduct' );
    Route::post('admin/post_product','AdminController@PostProduct' );
    Route::get('admin/product_list/{warehouse_id?}','AdminController@ProductList' );
    Route::get('admin/low_inventory_products/{warehouse_id?}','AdminController@lowInventoryProductList' );
    Route::get('admin/top_product_list/{warehouse?}','AdminController@warehouseTopProductList' );
    Route::get('admin/least_product_list/{warehouse?}','AdminController@warehouseLeastProductList' );
    Route::get('admin/product_list_subcat/{subcat_id?}','AdminController@ProductListSubCat' );
    Route::get('admin/product_list_cat/{cat_id?}','AdminController@ProductListCat' );
    Route::get('vendor/product_detail/{store_id}/{product_id}','ProductController@ProductDetail' )->where(['store_id' => '[0-9]+', 'product_id' => '[0-9]+']);
    Route::get('admin/product_edit/{product_id}/{warehouse_id?}','AdminController@ProductEdit' )->where([ 'product_id' => '[0-9]+']);
    Route::get('admin/warehouse_product_edit/{product_id}/{warehouse_id?}','AdminController@WarehouseProductEdit' )->where([ 'product_id' => '[0-9]+']);
    Route::post('admin/post_edit_product','AdminController@PostEditProduct' );
    Route::post('admin/post_edit_product2','AdminController@PostEditProduct2' );
    Route::get('admin/delete_product_image/{product_id}/{image_id}','AdminController@DeleteProducImage' );
    Route::get('admin/product_delete/{product_id}','AdminController@ProductDelete' )->where(['product_id' => '[0-9]+']);
    Route::get('admin/product_status/{store_id}/{product_id}','ProductController@ProductStatus' )->where(['store_id' => '[0-9]+', 'product_id' => '[0-9]+']);
    Route::get('admin/product_move/{product_id}','AdminController@ProductMove' )->where(['product_id' => '[0-9]+']);
    Route::post('admin/post_move_product','AdminController@PostMoveProduct' );
    Route::get('admin/transfer_products/{category?}/{subcategory?}','AdminController@transferProducts' );
    Route::get('admin/products_capacity/{category?}/{subcategory?}','AdminController@ProductsCapacity' );
    Route::post('admin/post_update_capacity','AdminController@PostUpdateCapacity' );
    Route::get('admin/warehouse_product_list/{warehouse_id?}','AdminController@warehouseProductList' );
    
    
    //group module
    Route::get('admin/add_group','AdminController@NewGroup');  
    Route::post('admin/post_group','AdminController@saveGroup' );
    Route::post('admin/save_edit_group','AdminController@saveEditGroup' );
    Route::get('admin/group_list','AdminController@GroupList' );
    Route::get('admin/group_edit/{group_id}','AdminController@GroupEdit' )->where('group_id', '[0-9]+');
    Route::get('admin/group_delete/{group_id}','AdminController@GroupDelete' )->where('group_id', '[0-9]+');
   
    //user module
    Route::get('admin/add_user/{group_id?}','AdminController@NewUser');  
    Route::post('admin/post_user','AdminController@saveUser' );
    Route::post('admin/save_edit_user','AdminController@saveEditUser' );
    Route::get('admin/user_list/{group_id?}','AdminController@UserList' );
    Route::get('admin/user_edit/{user_id}','AdminController@UserEdit' )->where('user_id', '[0-9]+');
    Route::get('admin/user_delete/{user_id}','AdminController@UserDelete' )->where('user_id', '[0-9]+');
    
    //warehouse module
    Route::get('admin/add_warehouse','AdminController@NewWareHouse');  
    Route::post('admin/post_warehouse','AdminController@saveWareHouse' );
    Route::post('admin/save_edit_warehouse','AdminController@saveEditWareHouse' );
    Route::get('admin/warehouse_list','AdminController@WareHouseList' );
    Route::get('admin/warehouse_edit/{user_id}','AdminController@WareHouseEdit' )->where('user_id', '[0-9]+');
    Route::get('admin/warehouse_delete/{user_id}','AdminController@WareHouseDelete' )->where('user_id', '[0-9]+');
    
    //warehouse user module
    Route::get('admin/add_warehouse_user','AdminController@NewWareHouseUser');  
    Route::post('admin/post_warehouse_user','AdminController@saveWareHouseUser' );
    Route::post('admin/save_edit_warehouse_user','AdminController@saveEditWareHouseUser' );
    Route::get('admin/warehouse_user_list/{warehouse_id?}/{time_shift?}/{day?}','AdminController@WareHouseUserList' );
    Route::get('admin/warehouse_user_edit/{user_id}','AdminController@WareHouseUserEdit' )->where('user_id', '[0-9]+');
    Route::get('admin/warehouse_user_delete/{user_id}','AdminController@WareHosueUserDelete' )->where('user_id', '[0-9]+');
    
    Route::get('admin/time_sheet', 'AdminController@editTimeSheet');
    Route::post('admin/post_timesheet','AdminController@saveTimeSheet' );
    Route::get('admin/report/{warehouse_id?}','AdminController@report' );
    Route::get('admin/unread_report/{warehouse_id?}','AdminController@unreadReport' );
    Route::get('admin/employee_report/{warehouse_id?}','AdminController@employeeReport' );
    Route::get('admin/orders/{warehouse?}/{account?}/{rating?}','AdminController@orders' );
    Route::get('admin/order_reviews/{order_id}','AdminController@OrderReviews' )->where('order_id', '[0-9]+');
    Route::get('admin/order_details/{order_id}','AdminController@OrderDetails' )->where('order_id', '[0-9]+');
    Route::get('admin/order_time/{order_id}','AdminController@OrderTime' )->where('order_id', '[0-9]+');
    
    //Log
    Route::get('admin/inventory_log','AdminController@inventoryLog' );
    Route::post('admin/post_filter_logs','AdminController@postFilterLogs' );
    Route::get('admin/inventory_dashboard/{page?}','AdminController@inventoryDashboard' );
    Route::get('admin/moved_product_list/{log_number?}','AdminController@MoveProductList' );
    Route::get('admin/register_log','AdminController@registerLog' );
    Route::get('admin/register_product_list/{log_number?}','AdminController@RegisterProductList' );
    Route::post('admin/post_register_filter_logs','AdminController@postRegisterFilterLogs' );
    
    //Customer
    Route::get('admin/customer_list','AdminController@CustomerList' );
    Route::get('admin/view_customer/{id}','AdminController@CustomerDetails' );
    Route::get('admin/change_status/{id}','AdminController@CustomerStatus' );
    Route::get('admin/inventory_capacity/{category?}/{subcategory?}/{warehouse?}','AdminController@InventoryCapacity' );
    Route::get('admin/warehouse_dashboard/{warehouse_id?}','AdminController@warehouseDashboard' );
    Route::post('admin/post_filter_customer','AdminController@postFilterCustomers' );
    Route::get('admin/employee_list/{warehouse_id?}/{time_shift?}/{day?}/{user_type?}','AdminController@employeeList' );
    Route::get('admin/schedule/{warehouse_id?}/{time_shift?}/{user_type?}','AdminController@schedule' );
    Route::post('admin/post_schedule','AdminController@postSchedule' );
    Route::get('admin/evaluation_scale','AdminController@evaluationScale' );
    Route::post('admin/post_settings','AdminController@postSettings' );
    Route::get('admin/paydays/{employee_id?}/{warehouse_id?}/{user_type?}/{year?}/{week?}','AdminController@payDay' );
    Route::get('admin/payday_logs/{year?}','AdminController@payDayLogs' );
    Route::get('admin/weekly_payment_log/{year?}/{week?}', 'AdminController@WeeklyPaymentLog');
    Route::get('admin/employee_payment_log/{year?}/{week?}/{employee_id?}', 'AdminController@EmployeePaymentLog');
    
    Route::get('admin/pay_payment/{id}','AdminController@makePayment' );
    Route::post('admin/post_payment','AdminController@postPayment' );
    Route::post('admin/post_tips_payment','AdminController@postTipsPayment' );
    
    //user types
    
    Route::get('admin/add_user_type',function () { return view('admin.add_user_type');});
    Route::get('admin/user_type_list','AdminController@UserTypeList' );
    Route::post('admin/post_user_type','AdminController@saveUserType' );
    Route::get('admin/user_type_edit/{id}','AdminController@UserTypeEdit' );
    Route::post('admin/save_edit_user_type','AdminController@saveEditUserType' );
    Route::get('admin/user_type_delete/{id}','AdminController@UserTypeDelete' );
    Route::get('admin/employee_dashboard/{type?}/{option?}/{option1?}/{option2?}','AdminController@employeeDashboard' );
    Route::get('admin/user_orders/{type}/{id}','AdminController@UserOrders' );
    
    //admin user module
    Route::get('admin/add_admin_user','AdminController@NewAdminUser');  
    Route::post('admin/post_admin_user','AdminController@saveAdminUser' );
    Route::post('admin/save_edit_admin_user','AdminController@saveEditAdminUser' );
    Route::get('admin/admin_users','AdminController@AdminUserList' );
    Route::get('admin/admin_user_edit/{user_id}','AdminController@AdminUserEdit' )->where('user_id', '[0-9]+');
    Route::get('admin/admin_user_delete/{user_id}','AdminController@AdminUserDelete' )->where('user_id', '[0-9]+');
    
     Route::get('admin/customers_list/{warehouse?}/{account?}/{total_order?}','AdminController@AllCustomerList');  
     Route::get('admin/customer_orders/{id}','AdminController@CustomerOrders' );
     
     Route::get('admin/logout','AuthController@logOut' );
     
     Route::get('admin/discounts','AdminController@Discounts' );
     Route::get('admin/add_discount',function () { return view('admin.add_discount');});
     Route::post('admin/post_discount','AdminController@saveDiscount' );
     Route::get('admin/discount_delete/{discount_id}','AdminController@DiscountDelete' )->where('discount_id', '[0-9]+');
     Route::get('admin/discount_edit/{discount_id}','AdminController@DiscountEdit' )->where('discount_id', '[0-9]+');
     Route::post('admin/post_edit_discount','AdminController@saveEditDiscount' );
     
     Route::get('admin/register_products/{category?}/{subcategory?}','AdminController@registerProducts' );
     Route::post('admin/post_register_product','AdminController@PostRegisterProduct' );
     Route::get('admin/change_report_status/{status?}/{id?}','AdminController@changeReportStatus' );
     Route::get('admin/change_customer_status/{id?}','AdminController@changeCustomerStatus' );
     Route::get('admin/goal_completion','AdminController@goalCompletion' );
     Route::post('admin/post_goal_completion','AdminController@PostGoalCompletion' );
     Route::get('admin/registr_log_delete/{log_id}','AdminController@RegisterLogDelete' )->where('log_id', '[0-9]+');
     Route::get('admin/confirm_inventory_log/{log_id}','AdminController@ConfirmInventoryLog' )->where('log_id', '[0-9]+');
     Route::get('admin/cancel_inventory_log/{log_id}','AdminController@CancelInventoryLog' )->where('log_id', '[0-9]+');
     Route::get('admin/pay_reject/{pay_id}','AdminController@PayReject' )->where('pay_id', '[0-9]+');
     
});