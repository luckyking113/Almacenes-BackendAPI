
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Categoria</a></li>
        <li class="active">Editar Categoria</li>
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
              <h3 class="box-title">Editar Categoria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="categoryForm" method="POST" action='{{asset('admin/save_edit_category')}}' enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="category_id" value="{{$category->category_id}}">
                <input type="hidden" name="cat_name" value="{{$category->name}}">
                 <input type="hidden" name="category_image" value="{{$category->image}}">
              <div class="box-body">
                  @if($flag == 2)
                                                <?php
                                                   $parent_category = DB::table('category')->where('parent_id', '=', 0)->get();
                                                   $sub_category = DB::table('category')->where('parent_id', '=', $parent_category_id)->get();
                                                ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Categoria Principal</label>
                  <select name="parent_category[]" id="parent_category" class="form-control" multiple="" onchange="loadSubCategory(this)">
                                                            <option value="0">Seleccionar Categoria Principal</option>
                                                           @foreach($parent_category as $parent_cat)
                                                             <option value="{{$parent_cat->category_id}}" <?php if(in_array($parent_cat->category_id,$parent_category_id)) { echo 'selected';}?>>{{$parent_cat->name}}</option>
                                                           @endforeach
                                                       </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Subcategoria</label>
                   <select name="sub_category" id="sub_category" class="form-control" >
                                                            
                                                             @foreach($sub_category as $sub_cat)
                                                             <option value="{{$sub_cat->category_id}}" <?php if($sub_category_id == $sub_cat->category_id) { echo 'selected';}?>>{{$sub_cat->name}}</option>
                                                           @endforeach
                                                       </select>
                </div>
                  @elseif($flag == 1)
                  <?php
                                                   $parent_category = DB::table('category')->where('parent_id', '=', 0)->get();
                                                 ?>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Categoria Principal</label>
                  <select name="parent_category[]" id="parent_category" class="form-control" multiple="" onchange="loadSubCategory(this)">
                                                            <option value="0">Seleccionar Categoria Principal</option>
                                                           @foreach($parent_category as $parent_cat)
                                                             <option value="{{$parent_cat->category_id}}" <?php if(in_array($parent_cat->category_id,$parent_category_id)) { echo 'selected';}?>>{{$parent_cat->name}}</option>
                                                           @endforeach
                                                       </select>
                </div>
                  @endif
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" value="{{$category->name}}" type="text" placeholder="Category Name" class="form-control required" />
                </div>
                
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagen <i style="font-weight: normal;color:red">(Imagen no debe pasar de 215 pixeles)</i></label>
                  <br>
                   @if($category->image)
                      <img src="{{asset('public/uploads/category/thumbnail')}}/{{$category->image}}" style="width:100px;height:80px">
                   @endif
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" />
			(Si es subcategoria, debe ser una imagen cuadrada)		
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
               $('#sub_category').removeAttr("disabled");
              $('#sub_category').html('<option value="">Select Sub Category</option>'+data);
           }
         });
         }
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
