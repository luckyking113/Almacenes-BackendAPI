@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        VIP Users
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit User</li>
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
              <h3 class="box-title">Edit User</h3>
            </div>
           
                <form role="form"  method="POST" action="{{asset('admin/save_edit_user')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$user->id}}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Group</label>
                   <select name="group" id="group" class="form-control" required>
                                                            <option value="">Select a group</option>
                                                           @foreach($groups as $group)
                                                             <option value="{{$group->id}}" <?php if($user->group_id == $group->id) { echo 'selected';}?>>{{$group->name}}</option>
                                                           @endforeach
                                                       </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name *</label>
                  <input id="first_name" name="first_name" type="text" placeholder="Enter First Name" value="{{$user->first_name}}" class="form-control" required="" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Last Name *</label>
                  <input id="last_name" name="last_name" type="text" placeholder="Enter Last Name" value="{{$user->last_name}}" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email *</label>
                  <input id="email" name="email" type="email" placeholder="Enter Email" value="{{$user->email}}" class="form-control" required />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Phone</label>
                  <input id="text" name="phone" type="text" placeholder="Enter Phone" value="{{$user->phone}}" class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Have Job?</label>
                   <select name="job" id="job" class="form-control" required>
                                                            <option value="Yes" <?php if($user->job == 'Yes') { echo 'selected';}?>>Yes</option>
                                                            <option value="No" <?php if($user->job == 'No') { echo 'selected';}?>>No</option>
                                                       </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Facebook URL</label>
                  <input id="facebook" name="facebook" type="text" placeholder="Enter Facebook Profile Link" value="{{$user->facebook}}" class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Instagram URL</label>
                  <input id="instagram" name="instagram" type="text" placeholder="Enter Instagram Profile Link" value="{{$user->instagram}}" class="form-control" />
                </div>  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Image <i style="font-weight: normal;color:red">(Image width should be less than 215pixel)</i></label>
                  <br>
                   @if($user->image)
                      <img src="{{$user->image}}" style="width:100px;height:80px">
                   @endif
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" />
				
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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

