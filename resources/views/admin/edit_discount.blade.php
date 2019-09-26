
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Descuento
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-star"></i> Descuentos</a></li>
        <li class="active">Editar Descuento</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     @if ($message = Session::get('success'))
           <div class="alert alert-success alert-dismissable margin5" style="text-align: center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <strong>{{ $message }}</strong>
            </div>
           @endif
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Descuento</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_edit_discount')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                     <input type="hidden" name="id" value="{{$discount->id}}">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" placeholder="Discount Name" value="{{$discount->name}}" class="form-control required" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Porcentaje *</label>
                  <div class="input-group">
                        <input id="value" name="value" type="text" placeholder="Discount Value" value="{{$discount->value}}" class="form-control required" />
                       <div class="input-group-addon">%</div>
                  </div
                 
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Fecha de Inicio *</label>
                  <input id="start_time" name="start_time" type="date" value="{{$discount->start_time}}"  class="form-control required" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Fecha de Termino *</label>
                  <input id="end_time" name="end_time" type="date" value="{{$discount->end_time}}"  class="form-control required" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tipo *</label>
                   <select name="type" id="type" class="form-control">
                       <option value="">Select discount type</option>
                       <option value="General" @if($discount->type == 'General') selected @endif>General</option>
                       <option value="VIP" @if($discount->type == 'VIP') selected @endif>Embajador</option>
                   </select>
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
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
