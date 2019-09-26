
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Lista de Categorias</label>
     
       </div>
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_category')}}" class="btn btn-default">Agregar Nuevas Categorias</a>
       </div>
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Lista de Categorias</li>
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
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th style="width:80px">Imagen</th>
                                        <th>Nombre de Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td style="width:80px">
                                                @if($category->image)
                                                <img src="{{asset('public/uploads/category/thumbnail')}}/{{$category->image}}" style="width:80px;height:50px">
                                                @endif
                                            </td>
                                            <td>
                                               <?php
//                                                    if($category->flag == 2)
//                                                    {
//                                                        $sub_category = DB::table('category')->select('name','parent_id')->where('category_id', '=', $category->parent_id)->get();
//                                                        $sub_category_name = $sub_category[0]->name;
//                                                        $parent_category = DB::table('category')->select('name')->where('category_id', '=', $sub_category[0]->parent_id)->get();
//                                                        $parent_category_name = $parent_category[0]->name;
//                                                        echo $parent_category_name." >> ".$sub_category_name." >> ".$category->name;
//                                                    }
//                                                    else if($category->flag == 1)
//                                                    {
//                                                        $parent_category = DB::table('category')->select('name')->where('category_id', '=', $category->parent_id)->get();
//                                                        $parent_category_name = $parent_category[0]->name;
//                                                        
//                                                        echo $parent_category_name." >> ".$category->name;
//                                                    }
//                                                    else
                                                      echo $category->name;  
     
                                               ?>
                                            <td>
                                                
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/category_edit')}}/{{$category->category_id}}"><i class=" fa fa-edit"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/category_delete')}}/{{$category->category_id}}" ><i class="fa fa-trash-o"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/subcat_list')}}/{{$category->category_id}}" title="View sub category"><i class="fa fa-list"></i></a></div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
              
              </table>
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
