
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Customer List</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer List</li>
      </ol>
   
            
    </section>

    <!-- Main content -->
    <section class="content">
     
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
                @if ($message = Session::get('success'))
           <div class="alert alert-success alert-dismissable margin5" style="text-align: center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <strong>{{ $message }}</strong>
            </div>
           @endif
             <div class="row">
              
               <div class="col-md-12">
               
                   
                   <div class="col-md-3">
                    <div class="form-group">
                           <label for="exampleInputPassword1">Warehouse</label>
                           <select name='warehouse' id='warehouse' class='form-control' onchange="filterUser(this)">
                                <option value="">All</option>  
                                @foreach($warehouses as $warehouse)
                               <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                               @endforeach

                          </select>
                    </div>
                    </div>
                   <div class="col-md-2">
                        <div class="form-group">
                              <label for="exampleInputPassword1">Account</label>
                              <select id="account" name="account" class="form-control" onchange="filterUser(this)" />
                               <option value='high' @if(@$selected_account == 'high') selected @endif>Newer to Older</option>
                               <option value='low' @if(@$selected_account == 'low') selected @endif>Older to Newer</option>
                              </select>
                        </div>
                   </div>
                   <div class="col-md-2">
                        <div class="form-group">
                              <label for="exampleInputPassword1">Total Order</label>
                              <select id="total_order" name="total_order" class="form-control" onchange="filterUser(this)" />
                               <option value='high' @if($selected_order == 'high') selected @endif>High to Low</option>
                               <option value='low' @if($selected_order == 'low') selected @endif>Low to High</option>
                              </select>
                        </div>
                   </div>
                   
                  </div>
            
               
           </div> 
            <hr style="margin-top: 0px">
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>S.No</th>
                                        <th style="width:80px">Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Zip Code</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Total Order</th>
                                        <th>Total Money Sent</th>
                                       <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                             <td style="width:80px">
                                                @if($customer->image)
                                                  <img src="{{$customer->image}}" style="width:80px;height:50px">
                                                @endif
                                            </td>
                                            <td>
                                               {{$customer->first_name}}&nbsp;{{$customer->last_name}}
                                            </td>
                                            <td>
                                               {{$customer->email}}
                                            </td>
                                            <td>
                                               {{$customer->phone}}
                                            </td>
                                            <td>
                                               {{$customer->zip_code}}
                                            </td>
                                            <td>@if($customer->cust_status == 1) Active @else Inactive @endif</td>
                                            <td>@if($customer->type == 'VIP') VIP @else General Customer @endif</td>
                                            <td>
                                               {{$customer->total_order}}
                                            </td>
                                            <td>
                                              @if($customer->sum) ${{$customer->sum}} @else $0 @endif
                                            </td>
                                           
                                            <td>    
                                                
                                               <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/customer_orders')}}/{{$customer->cust_id}}"><i class=" fa fa-list"></i></a></div>
                                               @if($customer->cust_status == 1)
                                                  <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/change_customer_status')}}/{{$customer->cust_id}}"><i class=" fa fa-ban"></i></a></div>
                                               @else
                                                  <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/change_customer_status')}}/{{$customer->cust_id}}"><i class=" fa fa-check-circle"></i></a></div>
                                               @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
     <script>
         function filterUser(obj)
         {
            var warehouse = $('#warehouse').val();
            if(warehouse == '')
                warehouse = 0;
            var account = $('#account').val();
            var total_order = $('#total_order').val();
            
            window.location.href="<?php echo asset('admin/customers_list');?>/"+warehouse+'/'+account+'/'+total_order;
         }
  $(function () {
    $('#table').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
     @endsection
