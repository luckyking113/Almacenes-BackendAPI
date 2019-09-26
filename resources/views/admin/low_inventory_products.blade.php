
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
           
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inventario</a></li>
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
           <div class="row">
               <div class="col-md-3 ">
           <div class="form-group">
                   <label for="exampleInputPassword1">Filtrar por Almacen</label>
                  <select name='warehouse' id='warehouse' class='form-control' onchange="filterProduct(this)" >
                      <option value=''>Seleccionar Almacen</option>
                      @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' >{{$warehouse->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
               </div>
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th style="width:70px">Imagen</th>
                                        <th>Producto</th>
                                         <th>Categoria</th>
                                         <th>Precio</th>
                                         <th>Cantidad</th>
                                         <th>Capacidad Minima</th>
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
                                            <td>  {{$product->quantity}}</td>
                                            <td>  {{$product->min_capacity}}</td>
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
  
    function filterProduct(obj)
         {
             var warehouse = $('#warehouse').val();
            
             if(warehouse == '')
                 warehouse = 0;
          
             window.location.href="<?php echo asset('admin/low_inventory_products');?>/"+warehouse;
         }
</script>
     @endsection
