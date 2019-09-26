
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Registrar Productos</label>
     
       </div>
          
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Registrar Productos</li>
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
           <form id="productForm" method="POST" action='{{asset('admin/post_register_product')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
           <div class="row">
               <div class="col-md-6">
               <div class="col-md-6">
           <div class="form-group">
                  <label for="exampleInputPassword1">Filtrar por Categoria</label>
                  <select name='category' id='category' class='form-control' onchange="filterProduct(this)">
                      <option value=''>Selecionar una Categoria</option>
                      @foreach($categories as $category)
                      <option value='{{$category->category_id}}' @if($selected_cat == $category->category_id) selected @endif>{{$category->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
              
            <div class="col-md-6">
           <div class="form-group">
                  <label for="exampleInputPassword1">Subcategoria</label>
                  <select name='subcategory' id='subcategory' class='form-control' onchange="filterProduct(this)">
                      <option value=''>Seleccionar Subcategoria</option>
                       @foreach($sub_cats as $sub_cat)
                      <option value='{{$sub_cat->category_id}}' @if($selected_subcat == $sub_cat->category_id) selected @endif>{{$sub_cat->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                   </div>
               <div class="col-md-6">
                   <div class="row pull-right" style="margin-top: 4%">
               
               <div class="col-md-3">
                  <div class="form-group">
                      
                      <input type="submit" name="move" class="btn btn-success" value="Registrar">
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
                                        <th style="width:70px">Image</th>
                                        <th>Producto</th>
                                        <th>Categoria</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Impuesto</th>
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
                                            <td>   
                                                <input type="text" name="price_{{$product->product}}" class="form-control" value="" >
                                            </td>
                                            
                                            <td>   
                                                <input type="hidden" name="product_id[]" value="{{$product->product}}">
                                                <input type="text" name="quantitu_{{$product->product}}" class="form-control" value="" >
                                            </td>
                                            <td>   
                                                <input type="text" name="tax_{{$product->product}}" class="form-control" value="" >
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
            
             if(subcategory == '')
                 subcategory = 0;
             if(category == '')
                 category = 0;
             window.location.href="<?php echo asset('admin/register_products');?>/"+category+'/'+subcategory;
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
