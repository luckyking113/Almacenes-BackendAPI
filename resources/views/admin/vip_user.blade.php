
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">VIP User List</label>
     
       </div>
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_user')}}/{{$selected_group}}" class="btn btn-default"> Add New User</a>
       </div>
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">VIP User Lst</li>
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
           <div class="row">
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Filter by group</label>
                  <select name='second_sub_category' id='second_sub_category' class='form-control' onchange="filterUser(this)">
                      <option value=''>Select a group</option>
                      @foreach($groups as $group)
                      <option value='{{$group->id}}' @if($selected_group == $group->id) selected @endif>{{$group->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
           </div>  
           <hr style="margin-top: 0px">
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>S.No</th>
                                        <th style="width:80px">Image</th>
                                        <th>User Email</th>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>User Group</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td style="width:80px">
                                                @if($user->image)
                                                  <img src="{{$user->image}}" style="width:80px;height:50px">
                                                @endif
                                            </td>
                                            <td>
                                               {{$user->email}}
                                            </td>
                                            <td>
                                               {{$user->facebook}}
                                            </td>
                                            <td>
                                               {{$user->instagram}}
                                            </td>
                                            <td>
                                               {{$user->group->name}}
                                            </td>
                                            <td>    
                                                
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/user_edit')}}/{{$user->id}}"><i class=" fa fa-edit"></i></a></div>
                                           <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/user_delete')}}/{{$user->id}}" ><i class="fa fa-trash-o"></i></a></div>
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
         function filterUser(obj)
         {
            window.location.href="<?php echo asset('admin/user_list');?>/"+obj.value;
         }
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
