@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Status de Semana Por Pagar</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Status de Semana por Pagar</li>
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
                  <select name='warehouse' id='warehouse' class='form-control' onchange="filterUser(this)">
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
                     <option value="">Seleccionar una Posicion</option>
                      @foreach($user_types as $type)
                    <option value="{{$type->id}}" @if($selected_user_type == $type->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                 </select>
                  </div>
           </div>
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Año</label>
                  <?php
                  $year = date("Y");
                  ?>
                  <select name='year' id='year' class='form-control' onchange="filterUser(this)">
                   @for($i = $year; $i >= 2017; $i--)
                     <option value="{{$i}}" @if($selected_year == $i) selected @endif >{{$i}}</option>
                    @endfor
                  </select>
                  </div>
           </div>
<div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Semana</label>
                 
                  <select name='week' id='week' class='form-control' onchange="filterUser(this)">
                   @foreach($week_arr as $key=>$week)
                     <option value="{{$key}}" @if($selected_week == $key) selected @endif>{{$key}} ({{$week}})</option>
                    @endforeach
                  </select>
                  </div>
           </div>
               
           </div> 
            <hr style="margin-top: 0px">
             <form id="productForm" method="POST" action='{{asset('admin/post_payment')}}' enctype="multipart/form-data" onsubmit="return validateUser()" >
                                     {{ csrf_field() }}
                                     
              <table class="table table-bordered " id="payday">
                                <thead>
                                    <tr class="filters">
                                        <th></th>
                                        <th>Fecha</th>
                                        <th style="width:80px">Imagen</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Turnos Laborales</th>
                                        <th>Pago Total</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $total_amount = 0; ?>
                                    @foreach ($users as $customer)
                                     <?php
                                     
                                     $time1 = strtotime($customer->from_time);
                                     $time2 = strtotime($customer->to_time);
                                     $total_hours = $customer->total_hours;
                                     $amount = 0;
                                     
                                     
                                     if($customer->type->name == 'Manager')
                                         $amount = $total_hours * $setting->manager_rate;
                                     if($customer->type->name == 'Worker')
                                         $amount = $total_hours * $setting->worker_rate;
                                     if($customer->type->name == 'Delivery Man')
                                         $amount = $total_hours * $setting->deliveryman_rate;
                                     
                                     $total_amount = $total_amount + $amount;  
                                     ?>
                                        <tr>
                                            <td><input type="checkbox" name="user_id[]" class="users" value="{{$customer->id}}"></td>
                                            <td>
                                               {{date("m/d/Y", strtotime($customer->created_at))}}
                                            </td>
                                             <td style="width:80px">
                                                @if($customer->image)
                                                  <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$customer->image}}" style="width:80px;height:50px">
                                                @endif
                                            </td>
                                            <td>
                                               {{$customer->name}} 
                                            </td>
                                            <td>
                                               {{$customer->email}}
                                            </td>
                                           
                                            <td>
                                               {{$total_hours}}
                                            </td>
                                             <td>
                                               ${{number_format($amount,2)}}
                                            </td>
                                            <td>@if($customer->payment_status == 1) Paid @else Due @endif</td>
                                           
                                            <td>    
                                                
                                                @if($customer->payment_status != 1)
                                                 <div class="col-md-2" style="width:90px;padding-left: 5px;padding-right: 0px">
                                                     <a href="{{asset('admin/pay_payment')}}/{{$customer->employee_id}}" title="Suspend this customer" >Pagar</a> | 
                                                     <a href="{{asset('admin/pay_reject')}}/{{$customer->id}}" title="Suspend this customer" >Rechazar</a>
                                                 </div>
                                                  @endif  
                                                 
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td colspan="6"><strong>Pago Total</strong></td>
                                            <td colspan="3" style="font-size: 20px"><strong>${{number_format($total_amount,2)}}</strong></td>
                                            
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                                     <div style="text-align: center">
                              <button type="submit" class="btn btn-success" style="margin-bottom: 1%" >Pagar</button>
                              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
      </div>
      <!-- /.row (main row) -->
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
            <label style="font-size: 22px">Propinas</label>
             <hr style="margin-top: 0px">
          <form id="productForm" method="POST" action='{{asset('admin/post_tips_payment')}}' enctype="multipart/form-data" onsubmit="return validateTips()" >
                                     {{ csrf_field() }}
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>&nbsp;</th>
                                        <th>Fecha</th>
                                        <th>Orden</th>
                                        <th>Empleado</th>
                                        <th>Propinas</th>
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0;?>
                                    @foreach ($orders as $order)
                                     <?php 
                                     $tips = $order->tips*(100 - $setting->tax_rate) / 100;
                                     $total = $total+$tips;
                                     ?>
                                        <tr>
                                      <td><input type="checkbox" name="order_id[]" class="orders" value="{{$order->order_id}}"></td>
                                           <td>
                                               {{date("m/d/Y H:ia", strtotime($order->created_at))}}
                                               </td>
                                            <td>
                                               {{$order->order_id}}
                                               </td>
                                             <td>
                                                {{$order->user->name}}
                                            </td>
                                            <td>
                                                {{$order->tips}}
                                            </td>
                                            <td>
                                                {{$setting->tax_rate}}%
                                            </td>
                                            <td>
                                                ${{number_format($tips,2)}}
                                            </td>
                                            <td>@if($order->payment_status == 1) Paid @else Due @endif</td>
                                           
                                        </tr>
                                    @endforeach
                                     <tfoot>
                                        <tr>
                                            <td colspan="6" style="font-size: 15px"><strong>Total de Propinas</strong></td>
                                            <td style="font-size: 20px" colspan="2"><strong>${{number_format($total,2)}}</strong></td>
                                            
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
              
              </table>
               <div style="text-align: center">
                     <button type="submit" class="btn btn-success" >Pagar</button>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
     <script>
           function validateUser()
         {
             

if ($('input.users').is(':checked')) {
 return true;
}
else
{
    alert('Please select an employee');

return false;
}


         }
         
          function validateTips()
         {
             

if ($('input.orders').is(':checked')) {
 return true;
}
else
{
    alert('Please select an order');

return false;
}
         }
         function filterUser(obj)
         {
            var warehouse = $('#warehouse').val();
            var user_type = $('#user_type').val();
            var week = $('#week').val();
            var year = $('#year').val();
            
            if(warehouse == '')
                warehouse = 0;
            if(user_type == '')
                user_type = 0;
            if(week == '')
                week = 0;
             if(year == '')
                year = 0;
            
            window.location.href="<?php echo asset('admin/paydays').'/'.$selected_employee;?>/"+warehouse+'/'+user_type+'/'+year+'/'+week;
         }
         
         $(document).ready(function() {
$('#payday').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "bAutoWidth": false });
});
 
</script>
     @endsection
