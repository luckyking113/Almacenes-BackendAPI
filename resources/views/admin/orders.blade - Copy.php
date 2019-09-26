
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Orders</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
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
           
          
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>S.No</th>
                                        <th>Order Id</th>
                                        <th>User Name</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>OrderTime</th>
                                        <th>AssignTime</th>
                                        <th>PickTime</th>
                                        <th>DeliverTime</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                           
                                            <td>
                                               {{$order->order_id}}
                                               </td>
                                            <td>
                                                {{$order->user->name}}
                                            </td>
                                            <td>
                                                {{$order->customer_name}}
                                            </td>
                                            <td>
                                                {{$order->amount}}
                                            </td>
                                            <td>
                                                {{$order->order_time}}
                                            </td>
                                            <td>
                                                {{$order->assign_time}}
                                            </td>
                                            <td>
                                                {{$order->picked_time}}
                                            </td>
                                            <td>
                                                {{$order->delivery_time}}
                                            </td>
                                            <td>
                                                {{$order->status}}
                                            </td>
                                             <td>
                                                
                                             <div class="col-md-1" style="width:20px;padding-left: 0px;padding-right: 0px"><a href="{{asset('admin/order_edit')}}/{{$order->id}}"><i class=" fa fa-edit"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/order_delete')}}/{{$order->id}}" ><i class="fa fa-trash-o"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/order_reviews')}}/{{$order->id}}" title="View sub category"><i class="fa fa-list"></i></a></div>
                                             <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="javascript:void()" onclick="showMap('{{$order->user->latitude}}','{{$order->user->longitude}}')" title="View sub category"><i class="fa fa-map-marker" aria-hidden="true"></i>
</a></div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
      </div>
      <!-- /.row (main row) -->
<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 modal_body_content">
              <p>Some contents...</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 modal_body_map">
              <div class="location-map" id="location-map">
                <div style="width: 600px; height: 400px;" id="map_canvas"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 modal_body_end">
              <p>Else...</p>
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
<script src="//maps.googleapis.com/maps/api/js"></script>
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
  
  
  // Code goes here

$(document).ready(function() {
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
  $('#myModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    initializeGMap(button.data('lat'), button.data('lng'));
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
  });

  // Trigger map resize event after modal shown
  $('#myModal').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    map.setCenter(myLatlng);
  });
});
</script>
     @endsection
