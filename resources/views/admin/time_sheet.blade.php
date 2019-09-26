
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Time Dheet
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Time Sheet</li>
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
              <h3 class="box-title">Manage Time Sheet</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm"  method="POST" action='{{asset('admin/post_timesheet')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
              <div class="box-body">
                @foreach($time_sheets as $key=>$time)
                
                <div class="form-group">
                    <div class='row'>
                    <div class='col-md-6'>
                  <label for="exampleInputPassword1">Shift {{$key+1}}</label>
                  <select id="shift_{{$key+1}}_1" name="shift_{{$key+1}}_1"class="form-control" required="" />
                    <option value='12am' @if($time->time_1 == '12am') selected @endif>12:00 am</option>
                    <option value='1am' @if($time->time_1 == '1am') selected @endif>01:00 am</option>
                    <option value='2am' @if($time->time_1 == '2am') selected @endif>02:00 am</option>
                    <option value='3am' @if($time->time_1 == '3am') selected @endif>03;00 am</option>
                    <option value='4am' @if($time->time_1 == '4am') selected @endif>04:00 am</option>
                    <option value='5am' @if($time->time_1 == '5am') selected @endif>05:00 am</option>
                    <option value='6am' @if($time->time_1 == '6am') selected @endif>06:00 am</option>
                    <option value='7am' @if($time->time_1 == '7am') selected @endif>07:00 am</option>
                    <option value='8am' @if($time->time_1 == '8am') selected @endif>08:00 am</option>
                    <option value='9am' @if($time->time_1 == '9am') selected @endif>09:00 am</option>
                    <option value='10am' @if($time->time_1 == '10am') selected @endif>10:00 am</option>
                    <option value='11am' @if($time->time_1 == '11am') selected @endif>11:00 am</option>
                    <option value='12pm' @if($time->time_1 == '12pm') selected @endif>12:00 pm</option>
                    <option value='1pm' @if($time->time_1 == '12pm') selected @endif>01:00 pm</option>
                    <option value='2pm' @if($time->time_1 == '2pm') selected @endif>02:00 pm</option>
                    <option value='3pm' @if($time->time_1 == '3pm') selected @endif>03:00 pm</option>
                    <option value='4pm' @if($time->time_1 == '4pm') selected @endif>04:00 pm</option>
                    <option value='5pm' @if($time->time_1 == '5pm') selected @endif>05:00 pm</option>
                    <option value='6pm' @if($time->time_1 == '6pm') selected @endif>06:00 pm</option>
                    <option value='7pm' @if($time->time_1 == '7pm') selected @endif>07:00 pm</option>
                    <option value='8pm' @if($time->time_1 == '8pm') selected @endif>08:00 pm</option>
                    <option value='9pm' @if($time->time_1 == '9pm') selected @endif>09:00 pm</option>
                    <option value='10pm' @if($time->time_1 == '10pm') selected @endif>10:00 pm</option>
                    <option value='11pm' @if($time->time_1 == '11pm') selected @endif>11:00 pm</option>
                  </select>
                 </div>
                    <div class='col-md-6'>
                        <label for="exampleInputPassword1">&nbsp;</label>
                  <select id="shift_{{$key+1}}_2" name="shift_{{$key+1}}_2"class="form-control" required="" />
                     <option value='12am' @if($time->time_2 == '12am') selected @endif>12:00 am</option>
                    <option value='1am' @if($time->time_2 == '1am') selected @endif>01:00 am</option>
                    <option value='2am' @if($time->time_2 == '2am') selected @endif>02:00 am</option>
                    <option value='3am' @if($time->time_2 == '3am') selected @endif>03:00 am</option>
                    <option value='4am' @if($time->time_2 == '4am') selected @endif>04:00 am</option>
                    <option value='5am' @if($time->time_2 == '5am') selected @endif>05:00 am</option>
                    <option value='6am' @if($time->time_2 == '6am') selected @endif>06:00 am</option>
                    <option value='7am' @if($time->time_2 == '7am') selected @endif>07:00 am</option>
                    <option value='8am' @if($time->time_2 == '8am') selected @endif>08:00 am</option>
                    <option value='9am' @if($time->time_2 == '9am') selected @endif>09:00 am</option>
                    <option value='10am' @if($time->time_2 == '10am') selected @endif>10:00 am</option>
                    <option value='11am' @if($time->time_2 == '11am') selected @endif>11:00 am</option>
                    <option value='12pm' @if($time->time_2 == '12pm') selected @endif>12:00 pm</option>
                    <option value='1pm' @if($time->time_2 == '12pm') selected @endif>01:00 pm</option>
                    <option value='2pm' @if($time->time_2 == '2pm') selected @endif>02:00 pm</option>
                    <option value='3pm' @if($time->time_2 == '3pm') selected @endif>03:00 pm</option>
                    <option value='4pm' @if($time->time_2 == '4pm') selected @endif>04:00 pm</option>
                    <option value='5pm' @if($time->time_2 == '5pm') selected @endif>05:00 pm</option>
                    <option value='6pm' @if($time->time_2 == '6pm') selected @endif>06:00 pm</option>
                    <option value='7pm' @if($time->time_2 == '7pm') selected @endif>07:00 pm</option>
                    <option value='8pm' @if($time->time_2 == '8pm') selected @endif>08:00 pm</option>
                    <option value='9pm' @if($time->time_2 == '9pm') selected @endif>09:00 pm</option>
                    <option value='10pm' @if($time->time_2 == '10pm') selected @endif>10:00 pm</option>
                    <option value='11pm' @if($time->time_2 == '11pm') selected @endif>11:00 pm</option>
                  </select>
                        </div>
                   </div>
                </div> 
                 @endforeach
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
