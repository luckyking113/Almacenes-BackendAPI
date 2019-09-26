
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
        <li class="active">Editar</li>
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
              <h3 class="box-title">Editar</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form id="productForm" method="POST" action='{{asset('admin/post_edit_product2')}}' enctype="multipart/form-data" onsubmit="return checkvalidity(this);" >
                                     {{ csrf_field() }}
                                     <input type='hidden' name='product_id' value='{{$product->id}}'>
                                     <input type='hidden' name='warehouse_id' value='{{$warehouse_id}}'>
                                     <input type='hidden' name='quantity' value='{{@$quantity->quantity}}'>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Categoria Principal</label>
                  <select name='category' id='category' class='form-control' onchange="loadSubCategory(this)" required=""> 
                                                            <option value=''>Seleccionar Categoria</option>
                                                                @foreach ($category as $cat)
                                                                   <option value='{{$cat->category_id}}' @if($product->category_id == $cat->category_id) selected=selected @endif>{{$cat->name}}</option>
                                                                @endforeach
                                                        </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Subcategoria</label>
                  <select name='sub_category' id='sub_category' class='form-control'  required=""> 
                                                            <option value=''>Seleccionar Subcategoria</option>
                                                                @foreach ($sub_category as $sub_cat)
                                                                   <option value='{{$sub_cat->category_id}}' @if($product->sub_category_id == $sub_cat->category_id) selected=selected @endif>{{$sub_cat->name}}</option>
                                                                @endforeach
                                                                <option value='9999' @if($product->sub_category_id == '9999') selected=selected @endif>Other</option>
                                                        </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" value="{{$product->name}}" placeholder="Nombre del Producto" class="form-control required" />
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Precio *</label>
                   <input id="price" name="price" value="{{$product->price}}" type="text" class="form-control" />
                </div>
<div class="form-group">
                  <label for="exampleInputPassword1">Impuesto *</label>
                   <input id="tax" name="tax" type="text" class="form-control" value="{{$product->tax}}" required="" />
                </div>
<div class="form-group">
                  <label for="exampleInputPassword1">Capacidad Minima</label>
                   <input id="min_capacity" name="min_capacity" value="{{@$quantity->min_capacity}}" type="text" class="form-control" required="" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Capacidad Maxima</label>
                   <input id="max_capacity" name="max_capacity" value="{{@$quantity->max_capacity}}" type="text" class="form-control" required="" />
                </div>
<!--                <div class="form-group">
                  <label for="exampleInputPassword1">Quantity</label>
                   <input id="quantity" name="quantity" value="" type="text" class="form-control" />
                </div>-->

                <div class="form-group">
                  <label for="exampleInputPassword1">Descripcion</label>
                   <textarea name="description" class="form-control">{{$product->description}}</textarea>
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagen Principal (cuadrada) </label>  <br/>
                  @if($product->main_image)
                                                <img src="{{asset('public/uploads/product/thumbnail')}}/{{$product->main_image}}" style="width:70px;height:70px">
                                                @endif
                                               <br/>
                  <input type="file" name="main_file" id="main_file" class="inputfile inputfile-6"  />
					
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Detalles de Producto</label>
                  <div class="row">
                  <input type="hidden" id="total_image" value="<?php echo count($product_image);?>">
                  @foreach ($product_image as $key=>$pro_image)   
                                    <div class="col-md-2" id="abcd<?php echo $key+1;?>">
                                        <img class="img-responsive" style="width:100px" <img src="{{asset('public/uploads/product/thumbnail/')}}/{{$pro_image->image}}" alt="image1">
                                        <a href="javascript:void(0)" alt="delete" onclick="removeImage({{$pro_image->id}},{{$pro_image->product_id}},{{$loop->iteration}})">Remove</a>
                                    </div>
                                @endforeach
		</div>
                  <input type="file" name="file[]" id="file" class="inputfile inputfile-6" multiple />
					
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
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
              $('#sub_category').html('<option value="0">Select Sub Category</option>'+data);
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
              $('#second_sub_category').html('<option value="0">Select Second Sub Category</option>'+data);
           }
         });
         }
         
          function removeImage(image_id,product_id,abc)
{   
    
      $.ajax({
                type: 'GET',
                url: '<?php echo asset('admin/delete_product_image');?>/'+product_id+'/'+image_id,
                success: function(data) {
                  if(data == 1)
                     $("#abcd"+ abc).remove(); 
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
                 alert('Please enter min and max capacity');
                 return false;
             }
             else
             {
                    if(parseInt(quantity) < parseInt(min_capacity))
                    {
                        alert('You should enter quantity more than '+min_capacity);
                        return false;
                    }
                    else if(parseInt(quantity) > parseInt(max_capacity))
                    {
                        alert('You should enter quantity less than '+max_capacity);
                        return false;
                    }
                    else if(parseInt(quantity) > parseInt(max_capacity) && parseInt(quantity) < parseInt(min_capacity))
                    {
                        alert('You should enter quantity between '+min_capacity+' and '+max_capacity);
                        return false;
                    }
                    else
                        return true;
            }
         }
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
