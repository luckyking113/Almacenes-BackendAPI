
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Lista de Almacenes</label>
     
       </div>
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_warehouse')}}" class="btn btn-default"> Agregar Nuevo Almacen</a>
       </div>
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Lista de Almacenes</li>
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
              <table class="table table-bordered " id="table" style="table-layout:fixed;" width="100%">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th style="width:80px">Imagen</th>
                                        <th>Nombre</th>
                                        <th style="overflow-wrap:break-word">C.P.</th>
                                        <th>Latitud</th>
                                        <th>Longitud</th>
                                        <th>Direccion</th>
                                        <th style="width:100px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($warehouses as $warehouse)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                             <td style="width:80px">
                                                @if($warehouse->image)
                                                <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$warehouse->image}}" style="width:80px;height:50px">
                                                @endif
                                            </td>
                                            <td>
                                               {{$warehouse->name}}
                                            </td>
                                            <td style="overflow-wrap:break-word">
                                               {{$warehouse->zip_code}}
                                            </td>
                                            <td>
                                               {{$warehouse->lat}}
                                            </td>
                                            <td>
                                               {{$warehouse->lon}}
                                            </td>
                                            <td>
                                               {{$warehouse->address}}
                                            </td>
                                             <td>   
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/warehouse_edit')}}/{{$warehouse->id}}"><i class=" fa fa-edit"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/warehouse_delete')}}/{{$warehouse->id}}" ><i class="fa fa-trash-o"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/warehouse_user_list')}}/{{$warehouse->id}}" title="View warehouse users"><i class="fa fa-user"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/orders')}}/{{$warehouse->id}}/high" title="View warehouse orders"><i class="fa fa-list"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/warehouse_dashboard')}}/{{$warehouse->id}}" title="View warehouse dashboard"><i class="fa fa-dashboard"></i></a></div>
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
    $('#table').DataTable({
      "columnDefs": [
    { "width": "40%", "targets": 3 },
  ]
    })
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
