
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Warehouse Customer List</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Warehouse Customer List</li>
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
               <form id="productForm" method="POST" action='{{asset('admin/post_filter_customer')}}' enctype="multipart/form-data" >
                  {{ csrf_field() }}
               <div class="col-md-12">
               
                   
                   <div class="col-md-3">
                    <div class="form-group">
                           <label for="exampleInputPassword1">Warehouse</label>
                           <select name='warehouse' id='warehouse' class='form-control'>
                                <option value="">All</option>  
                                @foreach($warehouses as $warehouse)
                               <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                               @endforeach

                          </select>
                    </div>
                    </div>
                   <div class="col-md-2">
                        <div class="form-group">
                               <label for="exampleInputPassword1">Min. Amount</label>
                               <input type="text" name="min_amount" placeholder="Enter minimum amount" value="{{@$min_amount}}" class="form-control">
                        </div>
                   </div>
                   <div class="col-md-2">
                        <div class="form-group">
                               <label for="exampleInputPassword1">Max. Amount</label>
                               <input type="text" name="max_amount" placeholder="Enter maximum amount" value="{{@$max_amount}}" class="form-control">
                        </div>
                   </div>
                   <div class="col-md-2">
                        <div class="form-group">
                              <label for="exampleInputPassword1">Total Order</label>
                              <select id="total_order" name="total_order" class="form-control" />
                               <option value='high' @if($selected_order == 'high') selected @endif>High to Low</option>
                               <option value='low' @if($selected_order == 'low') selected @endif>Low to High</option>
                              </select>
                        </div>
                   </div>
                   <div class="col-md-2" style="margin-top: 2%">
                  <div class="form-group">
                      
                      <input type="submit" name="move" class="btn btn-success" value="Search">
                  </div>
               </div>
                  </div>
               </forms>
               
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
                                            <td>
                                               {{$customer->total_order}}
                                            </td>
                                            <td>
                                              @if($customer->sum) ${{$customer->sum}} @else $0 @endif
                                            </td>
                                            <td>    
                                                
                                               <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/view_customer')}}/{{$customer->id}}"><i class=" fa fa-eye"></i></a></div>
                                               @if($customer->cust_status == 1)
                                                 <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/change_status')}}/{{$customer->id}}" title="Suspend this customer" ><i class="fa fa-ban"></i></a></div>
                                               @else
                                                 <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/change_status')}}/{{$customer->id}}" title="Active this customer" ><i class="fa fa-check-square"></i></a></div>
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
            window.location.href="<?php echo asset('admin/user_list');?>/"+obj.value;
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
