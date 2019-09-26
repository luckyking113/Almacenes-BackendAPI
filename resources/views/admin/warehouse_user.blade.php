
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Lista de Empleados</label>
     
       </div>
            <div class="col-md-2" style="text-align: right">
           <a href="{{asset('admin/add_warehouse_user')}}" class="btn btn-default"> Agregar Nuevo Empleado</a>
       </div>
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Lista de Empleados</li>
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
                  <label for="exampleInputPassword1">Dia</label>
                  <select id="day" name="day" class="form-control" onchange="filterUser(this)"/>
                    <option value=''>Selecciona un Dia </option>
                    <option value='mon'  <?php if($selected_day == 'mon'){ echo 'selected'; }?>>Lunes</option>
                    <option value='tue' <?php if($selected_day == 'tue'){ echo 'selected'; }?>>Martes</option>
                    <option value='wed' <?php if($selected_day == 'wed'){ echo 'selected'; }?>>Miercoles</option>
                    <option value='thru' <?php if($selected_day == 'thru'){ echo 'selected'; }?>>Jueves</option>
                    <option value='fri' <?php if($selected_day == 'fri'){ echo 'selected'; }?>>Viernes</option>
                    <option value='sat' <?php if($selected_day == 'sat'){ echo 'selected'; }?>>Sabado</option>
                    <option value='sun' <?php if($selected_day == 'sun'){ echo 'selected'; }?>>Domingo</option>
                  </select>
                  </div>
           </div>
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Turno Laboral</label>
                  <select id="time_shift" name="time_shift" class="form-control" onchange="filterUser(this)" />
                   <option value=''>Seleciona un Turno </option>
                   @foreach($time_shifts as $time)
                     <option value='{{$time->id}}' <?php if($selected_time_shift == $time->id){ echo 'selected'; }?> >{{$time->time_1}} - {{$time->time_2}}</option>
                   @endforeach
                  </select>
                  </div>
           </div>
           </div> 
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Posicion Laboral</th>
                                       
                                        <th>Numero de Cel</th>
                                       
                                        <th>Almacen</th>
                                       
                                        <th>Acciones</th>
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
                                               {{$user->name}}
                                            </td>
                                             <td>
                                               {{$user->email}}
                                            </td>
                                             <td>
                                              @if(isset($user->type)) {{$user->type->name}} @endif
                                            </td>
                                           
                                             <td>
                                               {{$user->phone}}
                                            </td>
                                           
                                            <td>
                                              @if(isset($user->warehouse)) {{$user->warehouse->name}} @endif
                                            </td>
                                            
                                             <td>   
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/warehouse_user_edit')}}/{{$user->id}}"><i class=" fa fa-edit"></i></a></div>
                                           <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/warehouse_user_delete')}}/{{$user->id}}" ><i class="fa fa-trash-o"></i></a></div>
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
             var time_shift = $('#time_shift').val();
             var warehouse = $('#second_sub_category').val();
             var day = $('#day').val();
            if(warehouse == '' )
            {
                 warehouse = 0;
             }
             
            if(time_shift == '' && day == '')
            {
                 time_shift = 0;
                 day = 0;
             }
             else if(day == '' && time_shift != '')
             {
                 alert("Please select a day");
                 return false;
             }
             else if(time_shift == '' && day != '')
             {
                 alert("Please select a time shift");
                 return false;
             }
             
             window.location.href="<?php echo asset('admin/warehouse_user_list');?>/"+warehouse+'/'+time_shift+'/'+day;
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
