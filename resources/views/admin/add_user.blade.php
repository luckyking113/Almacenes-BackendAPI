@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Embajadores
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Embajador Nuevo</li>
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
              <h3 class="box-title">Crear Nuevo Embajador</h3>
            </div>
           
                <form role="form"  method="POST" action="{{asset('admin/post_user')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Ubicacion</label>
                   <select name="group" id="Ubicacion" class="form-control" required>
                                                            <option value="">Selecciona una Ubicacion</option>
                                                           @foreach($groups as $group)
                                                             <option value="{{$group->id}}" @if($selected_group == $group->id) selected @endif>{{$group->name}}</option>
                                                           @endforeach
                                                       </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="first_name" name="first_name" type="text" placeholder="Escribir Nombre" class="form-control" required="" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Apellido *</label>
                  <input id="last_name" name="last_name" type="text" placeholder="Escribir Apellido" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Correo *</label>
                  <input id="email" name="email" type="text" placeholder="Escribir Correo" class="form-control" required />
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña *</label>
                  <input id="password" name="password" type="password" autocomplete = 'new-password' placeholder="Escribir Contraseña" class="form-control" required />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Numero</label>
                  <input id="text" name="phone" type="text" placeholder="Escribir Celular" class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Tienes empleo?</label>
                   <select name="job" id="job" class="form-control" required>
                                                            <option value="Yes">Si</option>
                                                            <option value="No">No</option>
                                                       </select>
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Facebook URL</label>
                  <input id="facebook" name="facebook" type="text" placeholder="Escribe tu link de Facebook" class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Instagram URL</label>
                  <input id="instagram" name="instagram" type="text" placeholder="Escribe tu link de Instragram" class="form-control" />
                </div>
                  
                  <div class="form-group">
                      <label for="exampleInputPassword1">Image <i style="font-weight: normal;color:red">(Imagen debe ser menor a 215 pixeles)</i></label>
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" />
	    </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
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

