
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Almacen
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Nuevo Empleado</li>
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
              <h3 class="box-title">Agregar Empleado Nuevo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_warehouse_user')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputPassword1">Almacen *</label>
                  <select id="warehouse" name="warehouse"  class="form-control" required />
                    <option value="">Selecciona un Almacen</option>
                    @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' >{{$warehouse->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Posicion Laboral *</label>
                  <select id="user_type" name="user_type"  class="form-control" required />
                    <option value="">Seleccionar una Posicion Laboral</option>
                    @foreach($user_types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" placeholder="Escribir Nombre" class="form-control" required />
                </div>
                   <div class="form-group">
                  <label for="exampleInputPassword1">Correo *</label>
                  <input id="email" name="email" type="text" placeholder="Escribir Correo" class="form-control" required />
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña *</label>
                  <input id="password" name="password" type="password" placeholder="Escribir Contraseña" class="form-control" required />
                </div>
<!--                  <div class="form-group">
                  <label for="exampleInputPassword1">C.P. *</label>
                  <input id="zip_code" name="zip_code" type="text" placeholder="Escribir C.P." class="form-control" required />
                </div>-->
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Celular</label>
                  <input id="phone" name="phone" type="text" placeholder="Escribir Numero" class="form-control" />
                </div>
                 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Turnos Laborales</h3>
  </div>
  <div class="panel-body">
               <div class="form-group">
                  <div class="row">
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Lunes</label>
                                <select id="time_shift" name="mon_shift[]" class="form-control" multiple="" />
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
                                <select id="time_shift" name="tue_shift[]" class="form-control" multiple="" />
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
                                <select id="time_shift" name="wed_shift[]" class="form-control" multiple=""  />
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
                                <select id="time_shift" name="thru_shift[]" class="form-control" multiple=""  />
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
                                <select id="time_shift" name="fri_shift[]" class="form-control" multiple=""  />
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
                                <select id="time_shift" name="sat_shift[]" class="form-control" multiple=""  />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}' >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Domingo</label>
                                <select id="time_shift" name="sun_shift[]" class="form-control" multiple="" />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}'  >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                  </div>
                  
                </div>
                 </div></div>
                 
<!--                  <div class="form-group">
                  <label for="exampleInputPassword1">Direccion *</label>
                  <textarea id="address" name="address" type="text" class="form-control" /></textarea>
                </div>-->
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagen</label>
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" multiple />
					
                </div>
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Crear</button>
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
