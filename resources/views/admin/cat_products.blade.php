
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Lista de Productos</label>
     
       </div>
            @if($warehouse_id)
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_product')}}/{{$warehouse_id}}" class="btn btn-default">Agregar Producto Nuevo</a>
       </div>
            @else
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_product')}}" class="btn btn-default">Agregar Producto Nuevo</a>
       </div>
            @endif
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Lista de Productos</li>
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
                                        <th style="width:70px">Imagen</th>
                                        <th>Producto</th>
                                         <th>Categoria</th>
                                         <th>Precio</th>
                                         <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td style="width:70px">
                                                @if($product->main_image)
                                                <img src="{{asset('public/uploads/product/thumbnail')}}/{{$product->main_image}}" style="width:70px;height:70px">
                                                @endif
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>@if(isset($product->category)){{$product->category->name}} @endif</td>
                                            <td>{{$product->price}}</td>
                                            <td>   
                                                @if($warehouse_id)
                                                  <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/product_edit')}}/{{$product->id}}/{{$warehouse_id}}"><i class=" fa fa-edit"></i></a></div>
                                                @else
                                                  <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/product_edit')}}/{{$product->id}}"><i class=" fa fa-edit"></i></a></div>
                                                @endif
                                                 <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/product_delete')}}/{{$product->id}}" ><i class="fa fa-trash-o"></i></a></div>
<!--                                                 <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/product_move')}}/{{$product->id}}" ><i class="fa fa-forward"></i></a></div>-->
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
