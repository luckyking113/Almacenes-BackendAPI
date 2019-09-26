
@extends('admin.template.container')

@section('content')
<?php
$mon_shift = @explode(",", $user_shift->mon);
$tue_shift = @explode(",", $user_shift->tue);
$wed_shift = @explode(",", $user_shift->wed);
$thru_shift = @explode(",", $user_shift->thru);
$fri_shift = @explode(",", $user_shift->fri);
$sat_shift = @explode(",", $user_shift->sat);
$sun_shift = @explode(",", $user_shift->sun);

//echo "<pre>";
//print_r($mon_shift); exit;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Empleados
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Empleados</a></li>
        <li class="active">Crear Empleado</li>
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
              <h3 class="box-title">Crear Empleado</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/save_edit_warehouse_user')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                     <input type="hidden" name="id" value="{{$user->id}}">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputPassword1">Almacen *</label>
                  <select id="warehouse" name="warehouse"  class="form-control" required  />
                    <option value="">Seleccionar Almacen</option>
                    @foreach($warehouses as $warehouselist)
                      <option value='{{$warehouselist->id}}' @if($warehouselist->id == $user->warehouse_id) selected @endif>{{$warehouselist->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tipo de Usuario *</label>
                  <select id="user_type" name="user_type"  class="form-control" required />
                    <option value="">Seleccionar Tipo de Usuario</option>
                    @foreach($user_types as $type)
                    <option value="{{$type->id}}"  @if($user->user_type == $type->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                     </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" placeholder="Escribir Nombre" value='{{$user->name}}' class="form-control" required />
                </div>
                   <div class="form-group">
                  <label for="exampleInputPassword1">Correo *</label>
                  <input id="email" name="email" type="text" placeholder="Escribir Correo" value='{{$user->email}}' class="form-control" required />
                </div>
                 
<!--                  <div class="form-group">
                  <label for="exampleInputPassword1">C.P. *</label>
                  <input id="zip_code" name="zip_code" type="text" placeholder="Escribir C.P." value='{{$user->zip_code}}' class="form-control" required />
                </div>-->
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Celular</label>
                  <input id="phone" name="phone" type="text" placeholder="Escribir Numero" value='{{$user->phone}}' class="form-control" />
                </div>
                 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Horario</h3>
  </div>
  <div class="panel-body">
               <div class="form-group">
                  <div class="row">
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Lunes </label>
                                <select id="time_shift" name="mon_shift[]" class="form-control" multiple="" />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $mon_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
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
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $tue_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
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
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $wed_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Jueves</label>
                                <select id="time_shift" name="thru_shift[]" class="form-control" multiple="" />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $thru_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
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
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $fri_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
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
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $sat_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                      <div class="col-md-2" style="width:13.5%">
                          <div class="form-group">
                                <label for="exampleInputPassword1">Domingo</label>
                                <select id="time_shift" name="sun_shift[]" class="form-control" multiple=""  />
                                 <option value=''>Libre</option>
                                 @foreach($time_shifts as $time)
                                   <option value='{{$time->id}}' <?php if(in_array($time->id, $sun_shift)){ echo 'selected=""';}?> >{{$time->time_1}} - {{$time->time_2}}</option>
                                 @endforeach
                                </select>
                          </div>      
                      </div>
                  </div>
                  
                </div>
                 </div></div>
<!--                  <div class="form-group">
                  <label for="exampleInputPassword1">Address *</label>
                  <textarea id="address" name="address" type="text" class="form-control" />{{$user->address}}</textarea>
                </div>-->
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagen</label>
                  <br>
                   @if($user->image)
                      <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$user->image}}" style="width:100px;height:80px">
                   @endif
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" multiple />
					
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
