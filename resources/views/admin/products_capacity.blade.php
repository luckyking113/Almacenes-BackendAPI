
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Capacidad de Productos</label>
     
       </div>
          
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Update Capacidad de Productos</li>
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
           <form id="productForm" method="POST" action='{{asset('admin/post_update_capacity')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                     <input type="hidden" name="tab" value="{{$tab}}">
           <div class="row">
               <div class="col-md-8">
               <div class="col-md-4">
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
              
            <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">Filtrar por Subcategoria</label>
                  <select name='subcategory' id='subcategory' class='form-control' onchange="filterProduct(this)">
                      <option value=''>Selecciona una Subcategoria</option>
                       @foreach($sub_cats as $sub_cat)
                      <option value='{{$sub_cat->category_id}}' @if($selected_subcat == $sub_cat->category_id) selected @endif>{{$sub_cat->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                   @if($tab == 'warehouse')
                   <div class="col-md-4">
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
                   @endif
                   </div>
               
               <div class="col-md-4">
                   <div class="row pull-right" style="margin-top: 4%">
               
               <div class="col-md-12">
                  <div class="form-group">
                      
                      <input type="submit" name="move" class="btn btn-success" value="Update Capacidad">
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
                                         <th>Producto</th>
                                         <th>Categoria</th>
                                         <th>Capacidad Restante</th>
                                         <th>Capacidad Minima</th>
                                         <th>Capacidad Maxima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            
                                            <td>{{$product->name}}</td>
                                            <td>@if(isset($product->category)){{$product->category->name}} @endif</td>
                                             <td>{{$product->quantity}}</td>
                                            <td>   
                                                <input type="hidden" name="product_id[]" value="{{$product->product}}">
                                                <input type="text" name="min_capacity_{{$product->product}}" class="form-control" value="{{$product->min_capacity}}" >
                                            </td>
                                            <td>   
                                                <input type="text" name="max_capacity_{{$product->product}}" class="form-control" value="{{$product->max_capacity}}" >
                                            </td>
                                        </tr>
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
             var warehouse = $('#warehouse').val();
            
             if(subcategory == '')
                 subcategory = 0;
             if(category == '')
                 category = 0;
             if(warehouse == '')
                 warehouse = 0;
            
                window.location.href="<?php echo asset('admin/inventory_capacity');?>/"+category+'/'+subcategory+'/'+warehouse;
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
