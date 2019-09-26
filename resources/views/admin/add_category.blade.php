
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categorias
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Categoria Nueva</li>
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
              <h3 class="box-title">Agregar Categoria Nueva</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="categoryForm" method="POST" action='{{asset('admin/save_category')}}' enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Categoria Principal</label>
                  <select name="parent_category[]" id="parent_category" class="form-control" multiple="" required="">
                                                           
                                                           @foreach($parent_category as $parent_cat)
                                                             <option value="{{$parent_cat->category_id}}" @if($parent_id == $parent_cat->category_id) selected @endif>{{$parent_cat->name}}</option>
                                                           @endforeach
                                                       </select>
                </div>
<!--                <div class="form-group">
                  <label for="exampleInputPassword1">Subcategoria</label>
                  <select name="sub_category" id="sub_category" class="form-control" disabled="">
                                                            <option value="">Seleccionar Subcategoria</option>
                                                          
                                                       </select>
                </div>-->
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" placeholder="Nombre de Categoria" class="form-control required" />
                </div>
                  
                  <div class="form-group">
                      <label for="exampleInputPassword1">Imagen <i style="font-weight: normal;color:red">(Imagen no debe pasar los 215 pixeles)</i></label>
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" />
		  <i >(Si es sub categoria , debe ser imagen cuadrada)</i> 			
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
           url: 'loadSubCategory/'+category_id,
           success: function(data)
           {
               $('#sub_category').removeAttr("disabled");
              $('#sub_category').html('<option value="">Select Sub Category</option>'+data);
           }
         });
         }
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
