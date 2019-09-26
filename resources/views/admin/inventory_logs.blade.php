
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Inventory Logs</label>
     
       </div>
          
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory Logs</li>
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
           
<form id="productForm" method="POST" action='{{asset('admin/post_filter_logs')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
           <div class="row">
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Warehouse</label>
                  <select name='warehouse' id='warehouse' class='form-control' >
                      <option value=''>Select a warehouse</option>
                      @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($warehouse_id == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
              
            <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Start Date</label>
                  <input type="date" name="start_date" id="start_date" value="{{$start_date}}" class="form-control" style="padding-top: 0px" >
                  </div>
           </div> 
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">End Date</label>
                  <input type="date" name="end_date" id="end_date" value="{{$end_date}}" class="form-control" style="padding-top: 0px">
                  </div>
           </div> 
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1"></label>
                  <input type="submit" name="move" class="btn btn-success" value="Filter" style="margin-top: 10%">
                  </div>
           </div> 
           </div> 
                                     </form>
            <hr style="margin-top: 0px">
           
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>S.No</th>
                                         <th>Moved Date</th>
                                         <th>Warehouse Name</th>
                                         <th>Warehouse User</th>
                                          <th>Date of received inventory</th>
                                          <th>Warehouse user who received</th>
                                        <th>Driver user who delivered</th>
                                        <th style="width:60px !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{date("m/d/Y H:ia",strtotime($log->created_at))}}</td>
                                            <td>@if(isset($log->warehouse)){{$log->warehouse->name}} @endif</td>
                                            <td>@if(isset($log->warehouse->user)){{$log->warehouse->user->name}} @endif</td>
                                            <td>@if($log->received_date){{date("m/d/Y H:ia",strtotime($log->received_date))}} @endif</td>
                                            <td>@if(isset($log->receive_user)){{$log->receive_user->name}} @endif</td>
                                            <td>{{$log->driver}}</td>
                                            <td>
                                                <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/moved_product_list')}}/{{$log->log_number}}" title="View Products"><i class="fa fa-list"></i></a></div>
                                                @if($log->status == 0)
                                                 <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/confirm_inventory_log')}}/{{$log->log_number}}" title="Confirm the log"><i class="fa fa-check"></i></a></div>
                                                 <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/cancel_inventory_log')}}/{{$log->log_number}}" title="Cancel the log"><i class="fa fa-remove"></i></a></div>
                                                  @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
<script type="text/javascript">
        $("#start_date").datetimepicker({
	      format: 'mm/dd/yyyy',
          autoclose: false
        });
      </script>
     <script>
        
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
