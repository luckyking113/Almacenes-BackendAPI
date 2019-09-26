
@extends('admin.template.container')

@section('content')
<?php
                        $accept_rate = 0;
                        $collect_rate = 0;
                        $deliver_rate = 0;
                        $collect_warehouse_rate = 0;
                        $arrive_destination_rate = 0;
                        $taken_deliver_rate = 0;
if($order->accept_order_time){
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_time);
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                        $diff_in_mins = $to->diffInMinutes($from);
                        //$accept_rate = number_format(($diff_in_mins / $setting->accept_order) / 100, 2);
                        $accept_rate = $diff_in_mins;
                        $total_secs = $to->diffInSeconds($from);
                        $accept_hours = floor($total_secs / 3600);
                        $accept_minutes = floor(($total_secs / 60 ) % 60);
                        $accept_seconds = $total_secs % 60;
}

if($order->collect_order_time){

                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                        $diff_in_mins = $to->diffInMinutes($from);
                        //$collect_rate = number_format(($diff_in_mins / $setting->collect_items) / 100, 2);
                        $collect_rate = $diff_in_mins;
                        $total_collec_secs = $to->diffInSeconds($from);
                        $collect_hours = floor($total_collec_secs / 3600);
                        $collect_minutes = floor(($total_collec_secs / 60 ) % 60);
                        $collect_seconds = $total_collec_secs % 60;
}
if($order->deliver_order_time){
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                        $diff_in_mins = $to->diffInMinutes($from);
                        //$deliver_rate = number_format(($diff_in_mins / $setting->hand_to_driver) / 100, 2);
                      $deliver_rate = $diff_in_mins; 
                      $total_secs = $to->diffInSeconds($from);
                      $deliver_hours = floor($total_secs / 3600);
                      $deliver_minutes = floor(($total_secs / 60 ) % 60);
                      $deliver_seconds = $total_secs % 60;
}
                        if ($order->collect_warehouse_time) {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            //$collect_warehouse_rate = number_format(($diff_in_mins / $setting->collect_from_warehouse) / 100, 2);
                            $collect_warehouse_rate = $diff_in_mins;
                            $total_secs = $to->diffInSeconds($from);
                            $collect_warehouse_hours = floor($total_secs / 3600);
                            $collect_warehouse_minutes = floor(($total_secs / 60 ) % 60);
                            $collect_warehouse_seconds = $total_secs % 60;
                        }

                        if ($order->arrival_destination_time) {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            //$arrive_destination_rate = number_format(($diff_in_mins / $setting->arrive_to_destination) / 100, 2);
                            $arrive_destination_rate = $diff_in_mins;
                            $total_secs = $to->diffInSeconds($from);
                            $arrive_destination_hours = floor($total_secs / 3600);
                            $arrive_destination_minutes = floor(($total_secs / 60 ) % 60);
                            $arrive_destination_seconds = $total_secs % 60;
                        }

                        if ($order->final_deliver_order_time) {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->final_deliver_order_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            //$taken_deliver_rate = number_format(($diff_in_mins / $setting->taken_to_deliver) / 100, 2);
                            $taken_deliver_rate = $diff_in_mins;
                            $total_secs = $to->diffInSeconds($from);
                            $taken_deliver_hours = floor($total_secs / 3600);
                            $taken_deliver_minutes = floor(($total_secs / 60 ) % 60);
                            $taken_deliver_seconds = $total_secs % 60;
                        }

                        ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Order Time Completion</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order Time</li>
      </ol>
    <b>Order #{{$order->order_id}}</b><br>
            
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
           <h4>Time Completion chart</h3>
           <hr>
           <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Accept Order</li>
                    <li><i class="fa fa-circle-o text-green"></i> Collected items from warehouse</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> Handover to delivery man</li>
                    <li><i class="fa fa-circle-o text-aqua"></i> Collect order</li>
                    <li><i class="fa fa-circle-o text-light-blue"></i> Arrive to destination</li>
                    <li><i class="fa fa-circle-o text-gray"></i> Deliver items</li>
                  </ul>
                   <br>
                   <strong>Warehouse User :</strong> @if(isset($order->user)){{$order->user->name}} @endif
                   @if(isset($order->deliverman))
                   <br>
                   <strong>Delivery Man :</strong> {{$order->deliverman->name}}
                   @endif
                </div>
                <!-- /.col -->
              </div>
           <br>
           <h4>Time Completion analysis table</h3>
           <hr>
           <div class="row">
               <div class="table-responsive">
                                                      <table class="table table-bordered ">
                                                                        <thead>
                                                                            <tr >
                                                                                <th style="text-align: center">Accept order</th>
                                                                                <th style="text-align: center">Collected items from warehouse</th>
                                                                                <th style="text-align: center">HandOver to delivery man</th>
                                                                                <th style="text-align: center">Collect order</th>
                                                                                <th style="text-align: center">Arrive to destination</th>
                                                                                <th style="text-align: center">Deliver items</th>
                                                                               
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <td style="text-align: center">
                                                                            <?php
                                                                           // echo $accept_rate." minutes<br>";
                                                                            if($accept_hours)
                                                                                echo $accept_hours." Hours ";
                                                                            if($accept_minutes)
                                                                                echo $accept_minutes." Mins ";
                                                                            if($accept_seconds)
                                                                                echo $accept_seconds." Secs ";
                                                                            echo "<br>";
                                                                            if($accept_rate > $setting->accept_order)
                                                                                echo "Exceeded by ". ($accept_rate - $setting->accept_order)." mins";
                                                                            elseif($accept_rate < $setting->accept_order)
                                                                                echo "Under ". ( $setting->accept_order - $accept_rate)." mins";
                                                                            elseif($accept_rate == $setting->accept_order)
                                                                                echo "On Time";
                                                                            ?>
                                                                            
                                                                        </td>
                                                                         <td style="text-align: center">
                                                                            <?php
                                                                            if($collect_hours)
                                                                                echo $collect_hours." Hours ";
                                                                            if($collect_minutes)
                                                                                echo $collect_minutes." Mins ";
                                                                            if($collect_seconds)
                                                                                echo $collect_seconds." Secs ";
                                                                            echo "<br>";
                                                                            if($collect_rate > $setting->collect_items)
                                                                                echo "Exceeded by ". ($collect_rate - $setting->collect_items)." mins";
                                                                             elseif($collect_rate < $setting->collect_items)
                                                                                echo "Under ". ( $setting->collect_items - $collect_rate)." mins";
                                                                            elseif($collect_rate == $setting->collect_items)
                                                                                echo "On Time";
                                                                            ?>
                                                                            
                                                                        </td>
                                                                         <td style="text-align: center">
                                                                            <?php
                                                                           
                                                                            if($deliver_hours)
                                                                                echo $deliver_hours." Hours ";
                                                                            if($deliver_minutes)
                                                                                echo $deliver_minutes." Mins ";
                                                                            if($deliver_seconds)
                                                                                echo $deliver_seconds." Secs ";
                                                                            echo "<br>";
                                                                            if($deliver_rate > $setting->hand_to_driver)
                                                                                echo "Exceeded by ". ($deliver_rate - $setting->hand_to_driver)." mins";
                                                                            elseif($deliver_rate < $setting->hand_to_driver)
                                                                                echo "Under ". ( $setting->hand_to_driver - $deliver_rate)." mins";
                                                                            elseif($deliver_rate == $setting->hand_to_driver)
                                                                                echo "On Time";
                                                                            ?>
                                                                            
                                                                        </td>
                                                                         <td style="text-align: center">
                                                                            <?php
                                                                           // echo $collect_warehouse_rate." minutes<br>";
                                                                            if($collect_warehouse_hours)
                                                                                echo $collect_warehouse_hours." Hours ";
                                                                            if($collect_warehouse_minutes)
                                                                                echo $collect_warehouse_minutes." Mins ";
                                                                            if($collect_warehouse_seconds)
                                                                                echo $collect_warehouse_seconds." Secs ";
                                                                            echo "<br>";
                                                                            if($collect_warehouse_rate > $setting->collect_from_warehouse)
                                                                                echo "Exceeded by ". ($collect_warehouse_rate - $setting->collect_from_warehouse)." mins";
                                                                            elseif($collect_warehouse_rate < $setting->collect_from_warehouse)
                                                                                echo "Under ". ( $setting->collect_from_warehouse - $collect_warehouse_rate)." mins";
                                                                            elseif($collect_warehouse_rate == $setting->collect_from_warehouse)
                                                                                echo "On Time";
                                                                            ?>
                                                                            
                                                                        </td>
                                                                          <td style="text-align: center">
                                                                            <?php
                                                                           // echo $arrive_destination_rate." minutes<br>";
                                                                            if($arrive_destination_hours)
                                                                                echo $arrive_destination_hours." Hours ";
                                                                            if($arrive_destination_minutes)
                                                                                echo $arrive_destination_minutes." Mins ";
                                                                            if($arrive_destination_seconds)
                                                                                echo $arrive_destination_seconds." Secs ";
                                                                            echo "<br>";
                                                                            if($arrive_destination_rate > $setting->arrive_to_destination)
                                                                                echo "Exceeded by ". ($arrive_destination_rate - $setting->arrive_to_destination)." mins";
                                                                            elseif($arrive_destination_rate < $setting->arrive_to_destination)
                                                                                echo "Under ". ( $setting->arrive_to_destination - $arrive_destination_rate)." mins";
                                                                            elseif($arrive_destination_rate == $setting->arrive_to_destination)
                                                                                echo "On Time";
                                                                            ?>
                                                                            
                                                                        </td>
                                                                         <td style="text-align: center">
                                                                            <?php
                                                                          //  echo $taken_deliver_rate." minutes<br>";
                                                                            if($taken_deliver_hours)
                                                                                echo $taken_deliver_hours." Hours ";
                                                                            if($taken_deliver_minutes)
                                                                                echo $taken_deliver_minutes." Mins ";
                                                                            if($taken_deliver_seconds)
                                                                                echo $taken_deliver_seconds." Secs ";
                                                                            echo "<br>";
                                                                            if($taken_deliver_rate > $setting->taken_to_deliver)
                                                                                echo "Exceeded by ". ($taken_deliver_rate - $setting->taken_to_deliver )." mins";
                                                                            elseif($taken_deliver_rate < $setting->taken_to_deliver)
                                                                                echo "Under ". ( $setting->taken_to_deliver - $taken_deliver_rate)." mins";
                                                                            elseif($taken_deliver_rate == $setting->taken_to_deliver)
                                                                                echo "On Time";
                                                                            ?>
                                                                            
                                                                        </td>
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
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

   

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : <?php echo $accept_rate;?>,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Accept Order'
      },
      {
        value    : <?php echo $collect_rate;?>,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Collect Order'
      },
      {
        value    : <?php echo $deliver_rate;?>,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'HandOver to delivery man'
      },
      {
        value    : <?php echo $collect_warehouse_rate;?>,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Collect items from warehouse'
      },
      {
        value    : <?php echo $arrive_destination_rate;?>,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Arrive to destination'
      },
      {
        value    : <?php echo $taken_deliver_rate;?>,
        color    : '#d2d6de',
        highlight: '#d2d6de',
        label    : 'Deliver items'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      
     }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

    
  })
</script>
     @endsection
