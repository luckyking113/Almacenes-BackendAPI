
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px"> Detalles de {{$customer->first_name}}&nbsp;{{$customer->last_name}}</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Clientes</a></li>
        <li class="active">Detalles de {{$customer->first_name}}&nbsp;{{$customer->last_name}}</li>
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
            
              <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Foto</label>

                    <div class="col-sm-10">
                        @if($customer->image)
                                                  <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$customer->image}}" style="width:200px;height:150px">
                                                @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->first_name}}&nbsp;{{$customer->last_name}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Correo</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->email}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Celular</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->phone}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="@if($customer->status == 1) Active @else Inactive @endif" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">C.P.</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->zip_code}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion de Entrega 1</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->shipping_address_1}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion de Entrega 2</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->shipping_address_2}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion de Entrega 3</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->shipping_address_3}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion de Entrega 4</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->shipping_address_4}}" disabled="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tipo de Cuenta</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value="{{$customer->account_type}}" disabled="">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <a href="{{asset('admin/customer_list')}}" class="btn btn-danger">Back</a>
                    </div>
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
