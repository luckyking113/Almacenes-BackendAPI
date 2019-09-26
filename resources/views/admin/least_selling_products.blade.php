
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">100 Articulos Menos Vendidos</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inventario</a></li>
        <li class="active">Articulos Menos Vendidos</li>
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
                                        <label for="exampleInputPassword1">Almacen</label>
                                        <select name='warehouse' id='warehouse' class='form-control' onchange="filterProduct(this)">
                                            <option value="">Todos</option>  
                                            @foreach($warehouses as $warehouse)
                                            <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
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
                                         <th>Cantidad Vendida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_selling_products as $product)
                                    <?php 
                                      $total_qty = \App\Log::where('product_id',$product->id)->sum('quantity');
                                    ?>
                                         <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td style="width:70px">
                                                @if(isset($product->product))
                                                <img src="{{asset('public/uploads/product/thumbnail')}}/{{$product->product->main_image}}" style="width:70px;height:70px">
                                                @endif
                                            </td>
                                            <td>{{$product->product->name}}</td>
                                            <td>@if(isset($product->product->category)){{$product->product->category->name}} @endif</td>
                                            <td>{{$product->total_price}}</td>
                                            <td> {{$product->total_qty}} </td>
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
         
         function filterProduct(obj)
                                            {
                                                var warehouse = $('#warehouse').val();
                                                if (warehouse == '')
                                                    warehouse = 0;
                                              
                                                window.location.href = "<?php echo asset('admin/least_product_list'); ?>/" + warehouse ;
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
