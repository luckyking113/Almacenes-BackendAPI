
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Reseñas de Ordenes</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Ordenes</a></li>
        <li class="active">Reseñas</li>
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
                                        <th>Orden</th>
                                        <th>Cliente</th>
                                        <th>Calificacion</th>
                                        <th>Fecha</th>
                                         <th>Comentario</th>
                                        <th>Propina</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                           
                                           
                                            <td>
                                                {{$order->order_id}}
                                            </td>
                                            <td>
                                                {{$order->customer_name}}
                                            </td>
                                            <td>
                                                {{$order->rating}}
                                            </td>
                                            <td>
                                                {{$order->created_at}}
                                            </td>
                                            <td>
                                                {{$order->comments}}
                                            </td>
                                            <td>
                                                {{$order->tips}}
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
