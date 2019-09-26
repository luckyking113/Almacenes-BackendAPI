
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Descuentos & Promociones</label>
     
       </div>
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_discount')}}" class="btn btn-default"> Crear Descuento</a>
       </div>
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Descuentos & Promociones</li>
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
           <h4> Descuentos Generales</h4>
           <hr>
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th>Nombre</th>
                                        <th>Descuento</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Termino</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($general_discounts as $discount)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            
                                            <td>
                                               {{$discount->name}}
                                            </td>
                                            <td>
                                               {{$discount->value}}%
                                            </td>
                                            <td>
                                               {{date("m/d/Y", strtotime($discount->start_time))}}
                                            </td>
                                             <td>
                                               {{date("m/d/Y", strtotime($discount->end_time))}}
                                            </td>
                                             <td>   
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/discount_edit')}}/{{$discount->id}}"><i class=" fa fa-edit"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/discount_delete')}}/{{$discount->id}}" ><i class="fa fa-trash-o"></i></a></div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
              
              
            </div>
            
            
            <!-- /.box-body -->
          </div>
            
            <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
                
           <h4> Descuentos Embajadores</h4>
           <hr>
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th>Nombre</th>
                                        <th>Descuento</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Termino</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vip_discounts as $discount)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            
                                            <td>
                                               {{$discount->name}}
                                            </td>
                                            <td>
                                               {{$discount->value}}%
                                            </td>
                                            <td>
                                               {{date("m/d/Y", strtotime($discount->start_time))}}
                                            </td>
                                             <td>
                                               {{date("m/d/Y", strtotime($discount->end_time))}}
                                            </td>
                                             <td>   
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/discount_edit')}}/{{$discount->id}}"><i class=" fa fa-edit"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/discount_delete')}}/{{$discount->id}}" ><i class="fa fa-trash-o"></i></a></div>
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
