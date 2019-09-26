
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Productos
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Producto Nuevo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Producto Nuevo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_product')}}' enctype="multipart/form-data" onsubmit="return checkvalidity(this)">
                                     {{ csrf_field() }}
                                     <input type='hidden' name='warehouse_id' value='{{$warehouse_id}}'>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                   <select name='category' id='category' class='form-control' onchange="loadSubCategory(this)" required>
                                                            <option value=''>Seleccionar Categoria Principal</option>
                                                                @foreach ($category as $cat)
                                                                   <option value='{{$cat->category_id}}'>{{$cat->name}}</option>
                                                                @endforeach
                                                        </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Sub Category</label>
                 <select name='sub_category' id='sub_category' class='form-control' required="">
                                                            <option value=''>Seleccionar Subcategoria</option>
                                                            <option value='9999'>Other</option>
                                                              
                                                        </select>
                </div>
<!--                  <div class="form-group">
                  <label for="exampleInputPassword1">Second Sub Category</label>
                 <select name='second_sub_category' id='second_sub_category' class='form-control'>
                                                            <option value='0'>Select Second Sub Category</option>
                                                              
                                                        </select>
                </div>-->
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre de Producto *</label>
                  <input id="name" name="name" type="text" placeholder="Producto" class="form-control" required="" />
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Precio *</label>
                   <input id="price" name="price" type="text" class="form-control" required="" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Impuesto *</label>
                   <input id="tax" name="tax" type="text" class="form-control" required="" />
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Capacidad Minima</label>
                   <input id="min_capacity" name="min_capacity" value="{{@$quantity->min_capacity}}" type="text" class="form-control" required="" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Capacidad Maxima</label>
                   <input id="max_capacity" name="max_capacity" value="{{@$quantity->max_capacity}}" type="text" class="form-control" required="" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Cantidad</label>
                  <input id="quantity" name="quantity" value="{{@$quantity->quantity}}" type="text" class="form-control" required="" />
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Descriptcion</label>
                   <textarea name="description" class="form-control"></textarea>
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagen Principal (cuadrada)</label>
                  <input type="file" name="main_file" id="main_file" class="inputfile inputfile-6" required="" />
					
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagenes de Detalles</label>
                  <input type="file" name="file[]" id="file" class="inputfile inputfile-6" multiple />
					
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Crear Producto</button>
              </div>
            </form>
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
     <script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
     <script>
         function loadSubCategory(obj)
         {
            var category_id = obj.value;
            $.ajax({
           type: "GET",
           url: '<?php echo asset('admin/loadSubCategory/');?>/'+category_id,
           success: function(data)
           {
              $('#sub_category').html('<option value="0">Seleccionar Subcategoria</option>'+data);
           }
         });
         }
         
         function loadSecondSubCategory(obj)
         {
            var category_id = obj.value;
            $.ajax({
           type: "GET",
           url: '<?php echo asset('admin/loadSubCategory/');?>/'+category_id,
           success: function(data)
           {
              $('#second_sub_category').html('<option value="0">Seleccionar Segunda Subcategoria</option>'+data);
           }
         });
         }
         
         function checkvalidity(frm)
         {
             var min_capacity = $('#min_capacity').val();
             var max_capacity = $('#max_capacity').val();
             var quantity     = $('#quantity').val();
             if(min_capacity == '' || max_capacity == '')
             {
                 alert('Por favor escribe capacidad minima y maxima');
                 return false;
             }
             else
             {
                    if(parseInt(quantity) < parseInt(min_capacity))
                    {
                        alert('Debes ingresar cantidad mayor a '+min_capacity);
                        return false;
                    }
                    else if(parseInt(quantity) > parseInt(max_capacity))
                    {
                        alert('Debes ingresar cantidad menor a '+max_capacity);
                        return false;
                    }
                    else if(parseInt(quantity) > parseInt(max_capacity) && parseInt(quantity) < parseInt(min_capacity))
                    {
                        alert('Debes ingresar una cantidad entre'+min_capacity+' y '+max_capacity);
                        return false;
                    }
                    else
                        return true;
            }
         }
     </script>
   
     @endsection
