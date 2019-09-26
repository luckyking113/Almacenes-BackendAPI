
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escala de Metas
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Escala de Metas</li>
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
              <h3 class="box-title">Ajustes de Metas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_goal_completion')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                     <input type="hidden" name="id" value="{{$setting->id}}">
              <div class="box-body">
                

                  <div class="form-group" style="width:50%" >
                  <label for="exampleInputPassword1">Rendimiento*</label>
                  <input id="performance"  name="performance" type="text"  value="{{$setting->performance_scale}}" class="form-control"  required />
                  
                </div>
                  <div class="form-group" style="width:50%" >
                  <label for="exampleInputPassword1">Inventario*</label>
                  <input id="inventory"  name="inventory" type="text"  value="{{$setting->inventory_scale}}" class="form-control"  required />
                  
                </div>
                  <div class="form-group" style="width:50%" >
                  <label for="exampleInputPassword1">Reportes*</label>
                  <input id="reports"  name="reports" type="text"  value="{{$setting->report_scale}}" class="form-control"  required />
                  
                </div>
                  <div class="form-group" style="width:50%" >
                  <label for="exampleInputPassword1">Visitas Web*</label>
                  <input id="website"  name="website" type="text"  value="{{$setting->website_scale}}" class="form-control"  required />
                  
                </div>
                   
                  
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
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
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
