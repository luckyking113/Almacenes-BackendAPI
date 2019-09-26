
@extends('admin.template.container')

@section('content')
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

              <h3 class="box-title">Employee Performance chart</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                <div class="row">
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Warehouse</label>
                  <select name='second_sub_category' id='second_sub_category' class='form-control' onchange="filterWarehouse(this)">
                      <option value="">Filter by warehouse</option> 
                      <option value="">All</option> 
                      @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                  @endforeach
                      
                 </select>
                  </div>
           </div>
               
            <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Employee</label>
                  <select name='employee' id='employee' class='form-control' onchange="filterEmployee(this)">
                      <option value="">Filter by employee</option> 
                      <option value="">All</option> 
                      @foreach($users as $user)
                      <option value='{{$user->id}}' @if($selected_user == $user->id) selected @endif>{{$user->name}}</option>
                  @endforeach
                      
                 </select>
                  </div>
           </div>   
               <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Department</label>
                  <select name='department' id='department' class='form-control' onchange="filterDepartment(this)">
                      <option value="">Filter by department</option> 
                      <option value="">All</option> 
                      @foreach($user_types as $user_type)
                      <option value='{{$user_type->id}}' @if($selected_type == $user_type->id) selected @endif>{{$user_type->name}}</option>
                  @endforeach
                      
                 </select>
                  </div>
           </div>  
               
           </div> 
                <hr />
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <div class="chart">
                 
                    <canvas id="areaChart" style="height:250px"></canvas>
                      
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

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
       labels  : [<?php echo implode(',',$chart_label);?>],
      datasets: [
       
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo implode(',',$chart_value);?>]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

  });
  
  
   function filterWarehouse(obj)
   {
      var warehouse = $('#second_sub_category').val();
      window.location.href="<?php echo asset('admin/employee_dashboard');?>/warehouse/"+warehouse;
   }
   function filterEmployee(obj)
   {
      var employee = $('#employee').val();
      window.location.href="<?php echo asset('admin/employee_dashboard');?>/employee/"+employee;
   }
    function filterDepartment(obj)
   {
      var department = $('#department').val();
      window.location.href="<?php echo asset('admin/employee_dashboard');?>/department/"+department;
   }
</script>
@endsection