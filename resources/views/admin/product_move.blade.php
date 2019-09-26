
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Move Product
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Move Product</li>
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
              <h3 class="box-title">Transferir Producto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form id="productForm" method="POST" action='{{asset('admin/post_move_product')}}' enctype="multipart/form-data" onsubmit="return checkvalidity(this);" >
                                     {{ csrf_field() }}
                                     <input type='hidden' name='product_id' value='{{$product->id}}'>
                                     
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Almacen</label>
                  <select name='warehouse' id='warehouse' class='form-control' required=""> 
                                                            <option value=''>Seleccionar Almacen</option>
                                                                @foreach ($warehouses as $warehouse)
                                                                   <option value='{{$warehouse->id}}' >{{$warehouse->name}}</option>
                                                                @endforeach
                                                        </select>
                </div>
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Producto *</label>
                  <input id="name" name="name" type="text" value="{{$product->name}}" placeholder="Nombre de Producto" class="form-control" disabled="" />
                </div>
                  
                  
                <div class="form-group">
                  <label for="exampleInputPassword1">Capacidad Minima</label>
                   <input id="min_capacity" name="min_capacity" value="{{$product->quantity->min_capacity}}" type="text" class="form-control" readonly="" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Capacidad Maxima</label>
                   <input id="max_capacity" name="max_capacity" value="{{$product->quantity->max_capacity}}" type="text" class="form-control" readonly="" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Cantidad Restante</label>
                   <input id="remaining_quantity" name="remaining_quantity" value="{{$product->quantity->quantity}}" type="text" class="form-control" disabled=""  />
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Cantidad</label>
                   <input id="quantity" name="quantity" value="" type="text" class="form-control" placeholder="Cantidad a Transferir"  />
                </div>
                  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Transferir</button>
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
             var remaining_quantity     = $('#remaining_quantity').val();
             var quantity     = $('#quantity').val();
             if(quantity == '')
             {
                 alert('Please enter move quantity');
                 return false;
             }
             else
             {
                    if(parseInt(quantity) > parseInt(remaining_quantity))
                    {
                        alert('You should enter quantity less than '+remaining_quantity);
                        return false;
                    }
                   else
                        return true;
            }
         }
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
