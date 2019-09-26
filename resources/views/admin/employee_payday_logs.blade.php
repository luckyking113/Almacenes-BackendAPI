@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">{{$employee->name}} Historial de la Semana {{$selected_week}} ({{$date_range}})</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Semana por Pagar</a></li>
        <li class="active">Historial de Pagos</li>
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
             
           
             <form id="productForm" method="POST" action='{{asset('admin/post_payment')}}' enctype="multipart/form-data" onsubmit="return validateUser()" >
                                     {{ csrf_field() }}
                                     
              <table class="table table-bordered " id="payday">
                                <thead>
                                    <tr class="filters">
                                       
                                        
                                         <th>Lunes</th>
                                         <th>Martes</th>
                                         <th>Miercoles</th>
                                         <th>Jueves</th>
                                         <th>Viernes</th>
                                         <th>Sabado</th>
                                         <th>Domingo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $total_amount = 0; ?>
                                    @foreach ($users as $customer)
                                     <?php
                                      $day = date('D',strtotime($customer->created_at));
//                                     
//                                     $time1 = strtotime($customer->from_time);
//                                     $time2 = strtotime($customer->to_time);
//                                     $total_hours = $customer->total_hours;
//                                     $amount = 0;
//                                     
//                                     
//                                     if($customer->type->name == 'Manager')
//                                         $amount = $total_hours * $setting->manager_rate;
//                                     if($customer->type->name == 'Worker')
//                                         $amount = $total_hours * $setting->worker_rate;
//                                     if($customer->type->name == 'Delivery Man')
//                                         $amount = $total_hours * $setting->deliveryman_rate;
//                                     
//                                     $total_amount = $total_amount + $amount;  
                                     ?>
                                        <tr>
                                            
                                          
                                            <td> @if($day == 'Mon') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                            <td> @if($day == 'Tue') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                            <td> @if($day == 'Wed') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                            <td> @if($day == 'Thu') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                            <td> @if($day == 'Fri') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                            <td> @if($day == 'Sat') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                            <td> @if($day == 'Sun') {{date('ha',strtotime($customer->from_time))}}-{{date('ha',strtotime($customer->to_time))}} @else None @endif </td>
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                                     
              </form>
            </div>
            <!-- /.box-body -->
            
            
          </div>
            </div>
      </div>
      <!-- /.row (main row) -->
 
    </section>
    
    <section class="content">
     
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
                 <table class="table table-bordered " id="payday">
                                <thead>
                                    <tr class="filters">
                                       
                                         <th>Ordenes</th>
                                         <th>Fecha</th>
                                         <th>Hora</th>
                                         <th>Propina</th>
                                         <th>Califacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                       <?php $total_tips = 0;?> 
                                    @foreach ($orders as $order)
                                    <?php
                                    $total_tips = $total_tips + $order->tips;
                                    ?>
                                     <tr>
                                            
                                            <td>
                                             <a href="{{asset('admin/order_details')}}/{{$order->id}}"> Orden#&nbsp;{{$order->order_id}}</a>
                                            </td>
                                           
                                            <td>
                                               {{date('m/d/Y', strtotime($order->created_at))}}
                                            </td>
                                             <td>
                                               {{date('ha', strtotime($order->order_time))}}
                                            </td>
                                             <td>
                                               ${{number_format($order->tips,2)}}
                                            </td>
                                           <td>
                                               {{$order->rating}}
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" style="text-align: right;font-size: 17px"><strong>Propinas de la Semana</strong></td>
                                            <td style="font-size: 17px"><strong>${{number_format($total_tips,2)}}</strong></td>
                                            
                                        </tr>
                                    </tfoot>
                                </tbody>
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
           function validateUser()
         {
             

if ($('input.users').is(':checked')) {
 return true;
}
else
{
    alert('Favor de Seleccionar un Empleado');

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
    alert('Favor de Seleccionar una Orden');

return false;
}
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
