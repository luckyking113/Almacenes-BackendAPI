
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Lista para Transferencia de Productos</label>
     
       </div>
          
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Lista para Transferencia de Productos</li>
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
           <form id="productForm" method="POST" action='{{asset('admin/post_move_product')}}' enctype="multipart/form-data" onsubmit="return validateForm(this)" >
                                     {{ csrf_field() }}
           <div class="row">
               <div class="col-md-6">
               <div class="col-md-6">
           <div class="form-group">
                  <label for="exampleInputPassword1">Filtrar por Categoria</label>
                  <select name='category' id='category' class='form-control' onchange="filterProduct(this)">
                      <option value=''>Selecciona una Categoria</option>
                      @foreach($categories as $category)
                      <option value='{{$category->category_id}}' @if($selected_cat == $category->category_id) selected @endif>{{$category->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
              
            <div class="col-md-6">
           <div class="form-group">
                  <label for="exampleInputPassword1">subcategoria</label>
                  <select name='subcategory' id='subcategory' class='form-control' onchange="filterProduct(this)">
                      <option value=''>Selecciona una Subcategoria</option>
                       @foreach($sub_cats as $sub_cat)
                      <option value='{{$sub_cat->category_id}}' @if($selected_subcat == $sub_cat->category_id) selected @endif>{{$sub_cat->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                   </div>
               
               <div class="col-md-6">
                   <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputPassword1">Flete</label>
                      <input type="text" name="driver" class="form-control" placeholder="Escribe el Nombre del Fletero" required="">
                  </div>
               </div>
                   <div class="row " style="margin-top: 4%">
               <div class="col-md-4">
           <div class="form-group">
                  
                  <select name='warehouse' id='warehouse' class='form-control' required >
                      <option value=''>Selecciona un Almacen</option>
                      @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' >{{$warehouse->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
               <div class="col-md-3">
                  <div class="form-group">
                      
                      <input type="submit" name="move" class="btn btn-success" value="Transferir">
                  </div>
               </div>
                       </div>
                   </div>
           </div> 
            <hr style="margin-top: 0px">
           
                  
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th>Fecha</th>
                                        <th style="width:70px">Imagen</th>
                                         <th>Producto</th>
                                         <th>Categoria</th>
                                         <th style="width:50px">Precio</th>
                                         <th style="width:50px">Capacidad Minima</th>
                                         <th style="width:50px">Capacidad Maxima</th>
                                         <th style="width:50px">Cantidad Registrada</th>
                                         <th style="width:50px">Cantidad Disponible</th>
                                         <th>Transferir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <?php
                                    $availQty = $product->left_qty - $product->avail_qty;
                                    if($availQty > 0) {
                                    ?>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td style="width:150px">{{date("m/d/Y H:ia", strtotime($product->incoming_date))}}</td>
                                            <td style="width:70px">
                                                @if($product->main_image)
                                                <img src="{{asset('public/uploads/product/thumbnail')}}/{{$product->main_image}}" style="width:70px;height:70px">
                                                @endif
                                            </td>
                                            <td style="width:200px">{{$product->name}}</td>
                                            <td style="width:150px">@if(isset($product->category)){{$product->category->name}} @endif</td>
                                            <td style="width:50px">{{$product->incoming_cost}}</td>
                                            <td style="width:50px">{{$product->min_capacity}}</td>
                                            <td style="width:50px">{{$product->max_capacity}}</td>
                                            <td style="width:50px">{{$product->left_qty}}</td>
                                            <td style="width:50px">{{$product->left_qty - $product->avail_qty}}</td>
                                            <td >   
                                                <input type="hidden" name="product_id[]" value="{{$product->incoming_id}}">
                                                <input type="hidden" name="left_qty_{{$product->incoming_id}}" id="left_qty_{{$product->incoming_id}}" value="{{$product->left_qty}}">
                                                <input type="text" name="quantitu_{{$product->incoming_id}}" id="quantitu_{{$product->incoming_id}}" class="form-control" value="" >
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    @endforeach
                                </tbody>
                            </table>
              </form>
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
             var category = $('#category').val();
             var subcategory = $('#subcategory').val();
            
             if(subcategory == '')
                 subcategory = 0;
             if(category == '')
                 category = 0;
             window.location.href="<?php echo asset('admin/transfer_products');?>/"+category+'/'+subcategory;
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
  
  function validateForm(form)
  {
           var error = 0;
           $('input[name^="product_id"]').each(function() {
           product_id = $(this).val();
           quantity   = $('#quantitu_'+product_id).val();
           left_quantity   = $('#left_qty_'+product_id).val();
           if(quantity != '')
           {
               if(parseInt(quantity) > parseInt(left_quantity))
               {
                   error = 1;
                   return false;
               }
           }
      });
      if(error == 1)
      {
           alert('You entered bigger quantity to move than current available one');
            return false;
      }

  }
</script>
     @endsection
