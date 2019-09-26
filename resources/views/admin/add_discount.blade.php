
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Descuento
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Descuento Nuevo</li>
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
              <h3 class="box-title">Crear Descuento Nuevo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_discount')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Codigo de Descuento *</label>
                  <input id="name" name="name" type="text" placeholder="Codigo de Descuento" class="form-control required" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Porcentaje *</label>
                  <div class="input-group">
                        <input id="value" name="value" type="text" placeholder="Porcentaje de Descuento" class="form-control required" />
                       <div class="input-group-addon">%</div>
                  </div
                 
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Fecha de Inicio *</label>
                  <input id="start_time" name="start_time" type="date"  class="form-control required" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Fecha de Termino *</label>
                  <input id="end_time" name="end_time" type="date"  class="form-control required" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tipo *</label>
                   <select name="type" id="type" class="form-control">
                       <option value="">Selecciona el Tipo de Descuento</option>
                       <option value="General">General</option>
                       <option value="VIP">Embajador</option>
                   </select>
                </div>
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Crear Descuento</button>
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
              $('#sub_category').html('<option value="0">Selecciona Subcategoria</option>'+data);
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
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
