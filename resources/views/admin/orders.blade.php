
@extends('admin.template.container')
@section('css') 
<link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick.css')}}">

 <link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick-theme.css')}}">
<style type="text/css">
    
    .slick-track{
         float: left !important;
    }
    .slider {
        width: 100%;
        margin-top: 10px ;
    }

    

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .5;
    }

    .slick-active {
      opacity: 1;
    }

    .slick-current {
      opacity: 1;
    }
    
    .checked {
  color: orange;
}
  </style>
@endsection
@section('content')
<?php $order_status = array('1'=>'Pendiente','2'=>'Procesando','3'=>'En Recolección','4'=>'Recolectada','5'=>'En Camino','6'=>'Entregado','7'=>'Completed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">


                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title">Orders</h3>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->

                        <div class="row">

                            <div class="col-md-12">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Warehouse</label>
                                        <select name='warehouse' id='warehouse' class='form-control' onchange="filterUser(this)">
                                            <option value="">All</option>  
                                            @foreach($warehouses as $warehouse)
                                            <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Sort</label>
                                        <select id="account" name="account" class="form-control" onchange="filterUser(this)" />
                                        <option value='high' @if(@$selected_account == 'high') selected @endif>Newer to Older</option>
                                        <option value='low' @if(@$selected_account == 'low') selected @endif>Older to Newer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Rating</label>
                                        <select id="rating" name="rating" class="form-control" onchange="filterUser(this)" />
                                        <option value='' >Select customer rating</option>
                                        <option value='1' @if(@$selected_rating == 1) selected @endif>1</option>
                                        <option value='2' @if(@$selected_rating == 2) selected @endif>2</option>
                                        <option value='3' @if(@$selected_rating == 3) selected @endif>3</option>
                                        <option value='4' @if(@$selected_rating == 4) selected @endif>4</option>
                                        <option value='5' @if(@$selected_rating == 5) selected @endif>5</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                        </div> 
                        <hr style="margin-top: 0px">
                       
                           
                        <?php $total_time = $setting->accept_order + $setting->collect_items + $setting->hand_to_driver + $setting->collect_from_warehouse + $setting->arrive_to_destination + $setting->taken_to_deliver; ?>
                        @foreach ($orders as $order)

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
                        if ($order->collect_warehouse_time) {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            //$collect_warehouse_rate = number_format(($diff_in_mins / $setting->collect_from_warehouse) / 100, 2);
                            $collect_warehouse_rate = $diff_in_mins;
                        }

                        if ($order->arrival_destination_time) {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            //$arrive_destination_rate = number_format(($diff_in_mins / $setting->arrive_to_destination) / 100, 2);
                            $arrive_destination_rate = $diff_in_mins;
                        }

                        if ($order->final_deliver_order_time) {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->final_deliver_order_time);
                            $diff_in_mins = $to->diffInMinutes($from);
                            //$taken_deliver_rate = number_format(($diff_in_mins / $setting->taken_to_deliver) / 100, 2);
                            $taken_deliver_rate = $diff_in_mins;
                        }
                        
                        $total_taken_time = $accept_rate + $collect_rate + $deliver_rate + $collect_warehouse_rate + $arrive_destination_rate + $taken_deliver_rate;
                        $performnace_time = number_format(($total_taken_time / $total_time) * 100, 2);
                        ?>
                        
                        <div class="box box-default box-solid">
                            <div class="box-header with-border">
                                <h4 style="font-size: 15px" class="box-title">Order Placed - <span class="product-description">{{date("M d, Y H:ia", strtotime($order->order_time))}}</span></h4>
                                @if($order->status == 7)
                                <h4 style="font-size: 15px;margin-left: 3%" class="box-title" >Total Time Spent - <span class="product-description">{{$total_taken_time}} mins</span></h4>
                                @endif
                                <h4 style="font-size: 15px;margin-left: 3%" class="box-title" >{{$order->warehouse_name}}</h4>
                                <h4 style="font-size: 15px;margin-left: 3%" class="box-title" > @if($order->status == 6)<strong>Delivered</strong> {{date('M d, Y', strtotime($order->final_deliver_order_time))}} @else <strong>{{$order_status[$order->status]}}</strong> @endif</h4>
                                @if($order->status == 7 && $order->rating)
                                <h4 style="font-size: 15px;margin-left: 3%" class="box-title" > 
                                    @for($i = 1;$i<=5; $i++)
                                <span class="fa fa-star @if($order->rating >= $i) checked @endif"></span>

@endfor
                                </h4>
                                @endif
                                <div class="box-tools pull-right">
                                    
                                    @if($order->status == 5)   <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" data-lat='{{$order->customer_shipping->address_lat}}' data-lng='{{$order->customer_shipping->address_lng}}'>Track Order</a> | @endif <a href="{{asset('admin/order_details')}}/{{$order->id}}">Order Details</a> | <a href="{{asset('admin/order_time')}}/{{$order->id}}">Time Completion</a> | <a href="">Invoice</a>

                                </div>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                             
                              
                                <section class="regular2 slider">
                              
                                       <?php
                                       
               $product_ids = collect(explode(",", $order->product_ids));
                foreach($order->order_products as $key => $order_product) {
              // foreach ($product_ids as $key => $id) {
                    $id = $order_product->product_id;
                   $product = \App\Product::find($id);
               ?> 
                                 <div class="col-md-4 col-sm-6 col-xs-12">
                                        <ul class="products-list product-list-in-box">
                                                <?php
//                                               
//                                                foreach ($chunk as $key => $id) {
//                                                    $product = \App\Product::find($id);
                                                    ?>   
                                                <li class="item">
                                                    <div class="product-img">
                                                        <img src="{{asset('public/uploads/product/thumbnail')}}/{{$order_product->product_image}}" style="width:80px;height:80px;margin-right: 5px" alt="Product Image">
                                                    </div>
                                                    <div class="product-info" >
                                                        <a href="javascript:void(0)" class="product-title">{{$order_product->product_name}}
                                                            </a>
                                                        <span class="product-description">
                                                           Sold by: {{$order_product->warehouse_name}}
                                                        </span>
                                                        <span class="product-description">
                                                           Quantity:  {{$order_product->quantity}}
                                                        </span>
                                                        <span class="product-description">
                                                           Price:  <span class="label label-warning ">${{$order_product->amount}}</span>
                                                        </span>
                                                    </div>
                                                </li>
                                            <?php //} ?>
                                            <!-- /.item -->
                                        </ul>
                                     </div>
               <?php } ?>
                               
                                </section>
                                        </div>

                                        </div>
                              
                                        @endforeach
                               <div class="row pull-right"><div class="col-md-12">{{$orders->links()}}</div></div>        
                                        
                        </div>
                                        <!-- /.box-body -->

                                        </div>



                                        </section>
                                        <!-- /.Left col -->
                                        <!-- right col (We are only adding the ID to make the widgets sortable)-->

                                        <!-- right col -->
                                        </div>
        
                                        <!-- /.row (main row) -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Shipping Location</h4>
        </div>
        <div class="modal-body">
          
          <div class="row">
            <div class="col-md-12 modal_body_map">
              <div class="location-map" id="location-map">
                <div style="width: 600px; height: 400px;" id="map_canvas"></div>
              </div>
            </div>
          </div>
          
        </div>
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
                                            function filterUser(obj)
                                            {
                                                var warehouse = $('#warehouse').val();
                                                if (warehouse == '')
                                                    warehouse = 0;
                                                var account = $('#account').val();
                                                var rating = $('#rating').val();

                                                window.location.href = "<?php echo asset('admin/orders'); ?>/" + warehouse + '/' + account+'/'+rating;
                                            }

                                        </script>

                                        <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc97yS9oO4uXFriKHhIIGPGbXoP6akgFw&callback=initMap">
    </script>
                                        <script>
                                            $(function () {
                                              
                                                $('#table3').DataTable({
                                                    'paging': true,
                                                    'lengthChange': false,
                                                    'searching': false,
                                                    'ordering': false,
                                                    'info': false,
                                                    'autoWidth': false
                                                })
                                            })


                                            // Code goes here

                                            $(document).ready(function () {
                                                var map = null;
                                                var myMarker;
                                                var myLatlng;

                                                function initializeGMap(lat, lng) {
                                                    myLatlng = new google.maps.LatLng(lat, lng);

                                                    var myOptions = {
                                                        zoom: 12,
                                                        zoomControl: true,
                                                        center: myLatlng,
                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                    };

                                                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                                    myMarker = new google.maps.Marker({
                                                        position: myLatlng
                                                    });
                                                    myMarker.setMap(map);
                                                }

                                                // Re-init map before show modal
                                                $('#myModal').on('show.bs.modal', function (event) {
                                                    var button = $(event.relatedTarget);
                                                    initializeGMap(button.data('lat'), button.data('lng'));
                                                    $("#location-map").css("width", "100%");
                                                    $("#map_canvas").css("width", "100%");
                                                });

                                                // Trigger map resize event after modal shown
                                                $('#myModal').on('shown.bs.modal', function () {
                                                    google.maps.event.trigger(map, "resize");
                                                    map.setCenter(myLatlng);
                                                });
                                            });
                                        </script>
                                        @endsection