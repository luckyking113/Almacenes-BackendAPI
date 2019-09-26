
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Embajadores</label>
     
       </div>
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_group')}}" class="btn btn-default"> Crear Embajada</a>
       </div>
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Embajada</a></li>
        <li class="active">Crear Embajada</li>
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
                                        <th>Embajada</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            
                                            <td>
                                               {{$group->name}}
                                            </td>
                                             <td>   
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/group_edit')}}/{{$group->id}}"><i class=" fa fa-edit"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/group_delete')}}/{{$group->id}}" ><i class="fa fa-trash-o"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/user_list')}}/{{$group->id}}" title="View group users"><i class="fa fa-user"></i></a></div>
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
