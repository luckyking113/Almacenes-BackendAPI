
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Horario de Empleados</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Horario de Empleados</li>
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
                  <label for="exampleInputPassword1">Filtrar por Almacen</label>
                  <select name='second_sub_category' id='second_sub_category' class='form-control' onchange="filterUser(this)">
                     <option value="">Todos</option> 
                      @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                      @endforeach
                 </select>
                  </div>
           </div>
               
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Posicion Laboral</label>
                  <select name='user_type' id='user_type' class='form-control' onchange="filterUser(this)">
                     <option value="">Seleccionar Posicion</option>
                     @foreach($user_types as $type)
                    <option value="{{$type->id}}" @if($selected_user_type == $type->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                 </select>
                  </div>
           </div>
               
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Turno Laboral</label>
                  <select id="time_shift" name="time_shift" class="form-control" onchange="filterUser(this)" />
                   <option value=''>Seleccionar un Turno </option>
                   @foreach($time_shifts as $time)
                     <option value='{{$time->id}}' <?php if($selected_time_shift == $time->id){ echo 'selected'; }?> >{{$time->time_1}} - {{$time->time_2}}</option>
                   @endforeach
                  </select>
                  </div>
           </div>
           </div> 
           <form id="productForm" method="POST" action='{{asset('admin/post_schedule')}}' enctype="multipart/form-data" onsubmit="return validateUser()" >
                                     {{ csrf_field() }}
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Tipo</th>
                                       
                                        <th>Celular</th>
                                       
                                        <th>Almacen</th>
                                       
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    
                                        <tr>
                                            <td><input type='checkbox' name='user[]' value='{{$user->id}}}' class='user_id'></td>
                                            <td style="width:80px">
                                                @if($user->image)
                                                <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$user->image}}" style="width:80px;height:50px">
                                                @endif
                                            </td>
                                            <td>
                                               {{$user->name}}
                                            </td>
                                             <td>
                                               {{$user->email}}
                                            </td>
                                             <td>
                                               {{$user->user_type}}
                                            </td>
                                           
                                             <td>
                                               {{$user->phone}}
                                            </td>
                                           
                                            <td>
                                              @if(isset($user->warehouse)) {{$user->warehouse->name}} @endif
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
              
            <h3>Time Shift</h3>
               <div class="form-group">
                  <div class="row">
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Lunes</label>
                                <select id="time_shift" name="mon_shift[]" class="form-control time_shift" multiple="" />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}'>{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Martes</label>
                                <select id="time_shift" name="tue_shift[]" class="form-control time_shift" multiple="" />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}'  >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Miercoles</label>
                                <select id="time_shift" name="wed_shift[]" class="form-control time_shift" multiple=""  />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}'  >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Jueves</label>
                                <select id="time_shift" name="thru_shift[]" class="form-control time_shift" multiple=""  />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}' >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Viernes</label>
                                <select id="time_shift" name="fri_shift[]" class="form-control time_shift" multiple=""  />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}'  >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Sabado</label>
                                <select id="time_shift" name="sat_shift[]" class="form-control time_shift" multiple=""  />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}' >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Domingo</label>
                                <select id="time_shift" name="sun_shift[]" class="form-control time_shift" multiple="" />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}'  >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                  </div>
                  
                </div>
                 <div class="box-footer" style="text-align: center">
                     <button type="submit" class="btn btn-primary" >Guardar</button>
              </div>
            </form>
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
         function validateUser()
         {
             

if ($('input.user_id').is(':checked')) {
 return true;
}
else
{
    alert('Please select an employee');

return false;
}
         }
         function filterUser(obj)
         {
             var time_shift = $('#time_shift').val();
             var warehouse = $('#second_sub_category').val();
             var user_type = $('#user_type').val();
            
              if(warehouse == '')
                 warehouse = 0;
             if(user_type == '')
                 user_type = 0;
              if(time_shift == '')
                 time_shift = 0;
             
             window.location.href="<?php echo asset('admin/schedule');?>/"+warehouse+'/'+time_shift+'/'+user_type;
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
