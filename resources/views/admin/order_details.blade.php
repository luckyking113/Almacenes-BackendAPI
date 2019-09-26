
@extends('admin.template.container')
@section('css')
<style>
    .checked {
  color: orange;
}
</style>
@endsection
<?php
                                         
                                         $accept_rate = 0;$collect_rate = 0; $deliver_rate = 0; $collect_warehouse_rate = 0;
                                         $arrive_destination_rate = 0; $taken_deliver_rate = 0;
                                         if($order->accept_order_time){
                                         $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_time);
                                         $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                                         $diff_in_mins = $to->diffInSeconds($from);
                                         $accept_rate = $diff_in_mins;
                                         }
                                          if($order->collect_order_time){
                                         $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accept_order_time);
                                         $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                                         $diff_in_mins = $to->diffInSeconds($from);
                                          $collect_rate = $diff_in_mins;
                                          }
                                           if($order->deliver_order_time){
                                         $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_order_time);
                                         $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                                         $diff_in_mins = $to->diffInSeconds($from);
                                  $deliver_rate = $diff_in_mins;
                                           }
                                         if($order->collect_warehouse_time )
                                         { 
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->deliver_order_time);
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $diff_in_mins = $to->diffInSeconds($from);
                                            $collect_warehouse_rate = $diff_in_mins;
                                         }
                                         
                                         if($order->arrival_destination_time)
                                         {
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->collect_warehouse_time);
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $diff_in_mins = $to->diffInSeconds($from);
                                            $arrive_destination_rate = $diff_in_mins;
                                        }
                                         
                                        if($order->final_deliver_order_time) 
                                        {
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->arrival_destination_time);
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->final_deliver_order_time);
                                            $diff_in_mins = $to->diffInSeconds($from);
                                            $taken_deliver_rate = $diff_in_mins;
                                        }
                                         
                                        $total_secs = $accept_rate + $collect_rate + $deliver_rate + $collect_warehouse_rate + $arrive_destination_rate + $taken_deliver_rate;
                                     //   $total_secs = $total_time * 60;
                                        $accept_hours = floor($total_secs / 3600);
                                        $accept_minutes = floor(($total_secs / 60 ) % 60);
                                        $accept_seconds = $total_secs % 60;
                                    ?>
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
           <label style="font-size: 22px">Order Details</label>
        </div>
           
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order Details</li>
      </ol>
    <b>Order #{{$order->order_id}}</b><br>
     Date: {{date("m/d/Y", strtotime($order->created_at))}}
    </section>
<?php

                                    $product_ids = explode(",",$order->product_ids);
                                    $subtotal = 0;
                                    $subtax = 0;
//                                    foreach($product_ids as $key=>$id) {
//                                        $product = \App\Product::find($id);
//                                        $subtotal = $subtotal + $product->price;
//                                    }
                                    
                                     foreach($order->order_products as $order_product) {
                                         $subtax  = $subtax + $order_product->product->tax;
                                         $subtotal = $subtotal + $order_product->amount;
                                    }
                                    ?>
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
           <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          
          <address>
              <label style="font-size: 18px">{{$order->customer->first_name}}&nbsp;{{$order->customer->last_name}}</label>
            <br>
            {{$order->customer_shipping->address_name}}<br>
            {{$order->customer_shipping->address_location}}<br>
            Phone: {{$order->customer->phone}}<br>
            Email: {{$order->customer->email}}
          </address>
            
            
            <strong>Date:</strong> {{date("m/d/Y H:ia", strtotime($order->order_time))}}
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          
          <address>
            <label style="font-size: 18px">Payment Method</label><br>
            {{$order->payment_method}} ending in {{substr($order->card_number,-4)}}<br>
           
          </address>
            
          
          <br>
          <address>
            <label style="font-size: 18px">Time Completion</label><br>
         @if($accept_hours) {{$accept_hours}} hours @endif
         @if($accept_minutes) {{$accept_minutes}} mins @endif
         @if($accept_seconds) {{$accept_minutes}} secs @endif
           
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <label style="font-size: 18px">Order Summary</label>
          <table class="table" style="border:none !important">
              <tr style="border:none !important">
                <th style="border:none !important;font-weight: normal !important">Subtotal:</th>
                <td>${{number_format($subtotal,2)}}</td>
              </tr>
              <tr>
                <th style="border:none !important;font-weight: normal">Tax  ({{number_format($subtax / $order->order_products->count(),2)}}%)</th>
                <td style="border:none !important">
                    <?php $tax = ($subtotal * number_format($subtax / $order->order_products->count(),2)) / 100;  ?>
                    ${{number_format($tax, 2)}}</td>
              </tr>
              <tr>
                <th style="border:none !important;font-weight: normal">Shipping:</th>
                <td style="border:none !important">$0.00</td>
              </tr>
               <tr>
                <th style="border:none !important;font-weight: normal">Tips:</th>
                <td style="border:none !important">${{number_format($order->tips,2)}}</td>
              </tr>
              <tr>
                <th style="border:none !important;font-weight: bold">Grand Total:</th>
                <?php $total = $order->tips + $tax + $subtotal; ?>
                <td style="border:none !important;font-weight: bold">${{number_format($total,2)}}</td>
              </tr>
            </table>
        </div>
        <!-- /.col -->
      </div>
           @if($order->status == 7 && $order->order_review)
           <hr>
           <div class="row">
               <div class="col-md-3">
                
                                <h4 style="font-size: 15px;margin-left: 3%" class="box-title" > Rating: 
                                    @for($i = 1;$i<=5; $i++)
                                <span class="fa fa-star @if($order->order_review->rating >= $i) checked @endif"></span>

@endfor
                                </h4>
                              
                     
                      </div>
                @endif
               <div class="col-md-2"></div>
                @if(isset($order->order_review))
               <div class="col-md-7">
                    <strong>Comment</strong>
                    <br /> {{$order->order_review->comments}}
                     
                      </div>
                @endif
           </div>   
                  
          <div class="row">
              <hr>
              <?php
//               $product_ids = collect(explode(",", $order->product_ids));
//               foreach ($product_ids->chunk(1) as $chunk) {
               ?>
        
                                                <?php
                                              foreach($order->order_products as $key => $order_product) {
                                              //  foreach ($chunk as $key => $id) {
                                                    $id = $order_product->product_id;
                                                    $product = \App\Product::find($id);
                                                    ?>   
              <div class="col-xs-4 table-responsive">
          <ul class="products-list product-list-in-box">
                                                <li class="item">
                                                    <div class="product-img">
                                                        <img src="{{asset('public/uploads/product/thumbnail')}}/{{$order_product->product_image}}" style="width:80px;height:80px;margin-right: 5px" alt="Product Image">
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="javascript:void(0)" class="product-title">{{$order_product->product_name}}</a>
                                                        <span class="product-description">
                                                          Sold by:  {{$order_product->warehouse_name}}
                                                        </span>
                                                        <span class="product-description">
                                                           Quantity:  {{$order_product->quantity}}
                                                        </span>
                                                         <span class="product-description">
                                                           Price:  <span class="label label-warning ">${{$order_product->amount}}</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                  </ul>
        </div>
                                            <?php } ?>
                                            <!-- /.item -->
                                      
               <?php// } ?>
        <!-- /.col -->
      </div>
           
           <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
        

          <div class="table-responsive">
            
          </div>
        </div>
        <!-- /.col -->
      </div>
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
