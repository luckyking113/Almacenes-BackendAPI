
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ordenes
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ordenes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
<!--      <div class="row">
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
      </div>-->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
        

          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">User Orders</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <div class="table-responsive">
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr >
                                        <th>Serie</th>
                                        <th>Orden</th>
                                        <th>Almacen</th>
                                        <th>Cliente</th>
                                        <th>Cantidad</th>
                                        <th>Hora Ordenada</th>
                                        <th>Hora de Entrega</th>     
                                        <th>Orden Aceptada</th>
                                        <th>En Proceso</th>
                                        <th>Lista para Entrega</th>
                                        <th>Orden Recolectada</th>
                                        <th>Entregando</th>
                                        <th>Entregado</th>
                                        <th>Duracion de Orden</th>
                                        <th>Status</th>
                                        <th>Calificacion</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <?php
                                         
                                         $accept_rate = 0;$collect_rate = 0; $deliver_rate = 0; $collect_warehouse_rate = 0;
                                         $arrive_destination_rate = 0; $taken_deliver_rate = 0;
                                         if($order->accept_order_time){
                                         $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_time);
                                         $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                                         $diff_in_mins = $to->diffInMinutes($from);
                                         //$accept_rate = number_format(($diff_in_mins / $setting->accept_order) / 100, 2);
                                         $accept_rate = $diff_in_mins;
                                         }
                                         if($order->collect_order_time){
                                         $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                                         $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                                         $diff_in_mins = $to->diffInMinutes($from);
                                         //$collect_rate = number_format(($diff_in_mins / $setting->collect_items) / 100, 2);
                                         $collect_rate = $diff_in_mins;
                                         }
                                         if($order->deliver_order_time){
                                         $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                                         $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                                         $diff_in_mins = $to->diffInMinutes($from);
                                         //$deliver_rate = number_format(($diff_in_mins / $setting->hand_to_driver) / 100, 2);
                                         $deliver_rate = $diff_in_mins;
                                         }
                                         if($order->collect_warehouse_time )
                                         { 
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            //$collect_warehouse_rate = number_format(($diff_in_mins / $setting->collect_from_warehouse) / 100, 2);
                                            $collect_warehouse_rate = $diff_in_mins;
                                         }
                                         
                                         if($order->arrival_destination_time)
                                         {
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            //$arrive_destination_rate = number_format(($diff_in_mins / $setting->arrive_to_destination) / 100, 2);
                                            $arrive_destination_rate = $diff_in_mins;
                                        }
                                         
                                        if($order->final_deliver_order_time) 
                                        {
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->final_deliver_order_time);
                                            $diff_in_mins = $to->diffInMinutes($from);
                                            //$taken_deliver_rate = number_format(($diff_in_mins / $setting->taken_to_deliver) / 100, 2);
                                            $taken_deliver_rate = $diff_in_mins;
                                        }
                                         
                                        $total_deliver_time = $accept_rate + $collect_rate + $deliver_rate + $collect_warehouse_rate + $arrive_destination_rate + $taken_deliver_rate;
                                    ?>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                           
                                            <td>
                                               {{$order->order_id}}
                                            </td>
                                            <td>
                                                @if($order->warehouse) {{$order->warehouse->name}} @endif
                                            </td>
                                            <td>
                                                {{$order->customer->first_name}}&nbsp;{{$order->customer->last_name}}
                                            </td>
                                            <td>
                                                {{$order->amount}}
                                            </td>
                                            <td>
                                                {{date("m/d/Y h:ia", strtotime($order->order_time))}}
                                            </td>
                                             <td>
                                                {{date("m/d/Y h:ia", strtotime($order->final_deliver_order_time))}}     <!--Should be updated with Delivered time like 10:32 am -->
                                            </td>
                                            <td>
                                              @if($accept_rate) {{$accept_rate}} mins @endif
                                            </td>
                                            <td>
                                              @if($collect_rate) {{$collect_rate}} mins @endif
                                            </td>
                                            <td>
                                              @if($deliver_rate) {{$deliver_rate}} mins @endif
                                            </td>
                                            <td>
                                               @if($collect_warehouse_rate) {{$collect_warehouse_rate}} mins @endif
                                            </td>
                                            <td>
                                               @if($arrive_destination_rate) {{$arrive_destination_rate}} mins @endif
                                            </td>
                                            <td>
                                               @if($taken_deliver_rate) {{$taken_deliver_rate}} mins @endif
                                            </td>
                                             <td>
                                               @if($total_deliver_time) {{$total_deliver_time}} mins @endif      <!--should be shown sum times of each step times--> 
                                            </td>
                                            <td>
                                                {{$order->status}}
                                            </td>
                                            <td>
                                                {{$order->rating}}
                                            </td>
                                             
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                  </div>
            </div>
            <!-- /.box-body -->
            
          </div>
          
          

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection