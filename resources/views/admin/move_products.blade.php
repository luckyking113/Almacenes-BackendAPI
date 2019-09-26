
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Lista de Productos Transferidos</label>
     
       </div>
          
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Transferir Productos</a></li>
        <li class="active">Lista de Productos Transferidos</li>
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
           

           
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                         <th>Serie</th>
                                         
                                         <th>Imagen</th>
                                         <th>Fecha</th>
                                         <th>Producto</th>
                                         <th>Cantidad</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                           
                                            <td style="width:70px">
                                                @if(isset($log->product->main_image))
                                                <img src="{{asset('public/uploads/product/thumbnail')}}/{{$log->product->main_image}}" style="width:70px;height:70px">
                                                @endif
                                            </td>
                                             <td>{{date("m/d/Y H:ia",strtotime($log->created_at))}}</td>
                                            <td>@if(isset($log->product)){{$log->product->name}} @endif</td>
                                            <td>{{$log->quantity}}</td>
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
