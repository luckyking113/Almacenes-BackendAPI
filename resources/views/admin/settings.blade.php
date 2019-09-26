
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escala de Evaluacion
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ajustes de Escala de Evaluacion</li>
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
              <h3 class="box-title">Ajustes de Escala de Evaluacion</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_settings')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                     <input type="hidden" name="id" value="{{$setting->id}}">
              <div class="box-body">
                
<!--                <div class="form-group">
                  <label for="exampleInputPassword1">Picking Scale(minutes) *</label>
                  <input id="picking" name="picking" type="text" placeholder="Enter Picking Scale" value="{{$setting->picking_scale}}" class="form-control " required />
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Delivery Scale(minutes) *</label>
                  <input id="delivery" name="delivery" type="text" placeholder="Enter Delivery Scale" value="{{$setting->delivery_scale}}" class="form-control " required />
                </div>-->
                  <div class="form-group" style="width:50%" >
                  <label for="exampleInputPassword1">Tiempo para Aceptar la Orden (Orden Aceptada)*</label>
                  <div class="input-group">
                        <input id="accept_order"  name="accept_order" type="text"  value="{{$setting->accept_order}}" class="form-control"  required />
                       <div class="input-group-addon">Minutos</div>
                  </div
                  
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tiempo para Recolectar los Productos (Pedido en Proceso) *</label>
                  <div class="input-group">
                        <input id="collect_items" name="collect_items" type="text"  value="{{$setting->collect_items}}" class="form-control "  required />
                       <div class="input-group-addon">Minutos</div>
                  </div
                  
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tiempo para Entregar a Repartidor (Lista para Entrega)*</label>
                  <div class="input-group">
                        <input id="hand_to_driver" name="hand_to_driver" type="text"  value="{{$setting->hand_to_driver}}" class="form-control "  required />
                       <div class="input-group-addon">Minutos</div>
                  </div
                  
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tiempo para Recolectar la Orden (Orden Recolectada)*</label>
                  <div class="input-group">
                       <input id="collect_from_warehouse" name="collect_from_warehouse" type="text"  value="{{$setting->collect_from_warehouse}}" class="form-control "  required />
                       <div class="input-group-addon">Minutos</div>
                  </div
                  
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tiempo para Llegar al Destino (Entregando)*</label>
                  <div class="input-group">
                       <input id="arrive_to_destination" name="arrive_to_destination" type="text"  value="{{$setting->arrive_to_destination}}" class="form-control "  required />
                       <div class="input-group-addon">Minutos</div>
                  </div
                  
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Tiempo para Entregar la Orden (Entregado)*</label>
                   <div class="input-group">
                       <input id="taken_to_deliver" name="taken_to_deliver" type="text"  value="{{$setting->taken_to_deliver}}" class="form-control "  required />
                       <div class="input-group-addon">Minutos</div>
                  </div
                  
                </div>
<!--                 <div class="form-group">
                  <label for="exampleInputPassword1">Impuesto*</label>
                  <div class="input-group">
                       <input id="tax_rate" name="tax_rate" type="text"  value="{{$setting->tax_rate}}" class="form-control "  required />
                       <div class="input-group-addon">%</div>
                  </div
                  
                </div>-->
                   @foreach($user_types as $type)
                  <div class="form-group">
                  <label for="exampleInputPassword1">{{$type->name}} Sueldo*</label>
                  
                  <div class="input-group">
                      <input id="manager" name="user_type_{{$type->id}}" type="text" value="{{$type->rate}}" class="form-control "  required />
                       <div class="input-group-addon">%</div>
                  </div
                  </div>
                   @endforeach
                  
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
