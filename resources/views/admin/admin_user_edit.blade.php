@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cuentas Admin
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Editar Usuario</li>
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
              <h3 class="box-title">Editar Usuario</h3>
            </div>
           
                <form role="form"  method="POST" action="{{asset('admin/save_edit_admin_user')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$user->id}}">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre</label>
                  <input id="first_name" name="first_name" type="text" placeholder="Escribir Nombre" value="{{$user->first_name}}" class="form-control" required="" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Apellido</label>
                  <input id="last_name" name="last_name" type="text" placeholder="Escribir Apellido" value="{{$user->last_name}}" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Correo *</label>
                  <input id="email" name="email" type="email" placeholder="Escribir Correo" value="{{$user->email}}" class="form-control" required />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Celular</label>
                  <input id="text" name="phone" type="text" placeholder="Escribir Numero" value="{{$user->phone}}" class="form-control" />
                </div>
                   
                  <div class="form-group">
                  <label for="exampleInputPassword1">Imagen <i style="font-weight: normal;color:red">(Imagen no debe pasar de 215 pixeles)</i></label>
                  <br>
                   @if($user->image)
                      <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$user->image}}" style="width:100px;height:80px">
                   @endif
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" />
				
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

