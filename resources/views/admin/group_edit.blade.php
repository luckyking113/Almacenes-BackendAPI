
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Embajada
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Embajadores</a></li>
        <li class="active">Editar Embajada</li>
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
              <h3 class="box-title">Editar Embajada</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/save_edit_group')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                     <input type="hidden" name="id" value="{{$group->id}}">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" placeholder="Group Name" value="{{$group->name}}" class="form-control required" />
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
