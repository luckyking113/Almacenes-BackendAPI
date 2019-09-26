
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Almacenes
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Almacen Nuevo</li>
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
              <h3 class="box-title">Crear Almacen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="productForm" method="POST" action='{{asset('admin/post_warehouse')}}' enctype="multipart/form-data" >
                                     {{ csrf_field() }}
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre *</label>
                  <input id="name" name="name" type="text" placeholder="Nombre de Almacen" class="form-control" required />
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputPassword1">Codigo Postal *</label>
                  <input id="zip_code" name="zip_code" type="text" placeholder="C.P. de Almacen" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Latitud</label>
                  <input id="lat" name="lat" type="text" placeholder="Latitud de Almacen" class="form-control" />
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Longitud</label>
                  <input id="lon" name="lon" type="text" placeholder="Longitud de Almacen" class="form-control" />
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Direccion *</label>
                  <textarea id="address" name="address" type="text" class="form-control" /></textarea>
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Meta de Rendimiento</label>
                  <input id="performance" name="performance" type="text" placeholder="Meta de Rendimiento"  class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Meta de Inventario</label>
                  <input id="inventory" name="inventory" type="text" placeholder="Meta de Inventario"  class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Meta de Reportes</label>
                  <input id="report" name="report" type="text" placeholder="Meta de Reportes"  class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Meta de Visitas Web</label>
                  <input id="website" name="website" type="text" placeholder="Meta de Visitas Web"  class="form-control" />
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Delivery Fee</label>
                  <input id="deliver_fee" name="deliver_fee" type="text" placeholder="Meta de Delivery Fee"  class="form-control" />
                </div>
                <br>
                 <h4 class="box-title">Shop Working Time</h4>
                <div class="form-group">
                    <label for="exampleInputPassword1">Monday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_mon_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->mon_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->mon_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->mon_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->mon_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->mon_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->mon_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->mon_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->mon_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->mon_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->mon_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->mon_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->mon_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->mon_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->mon_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->mon_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->mon_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->mon_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->mon_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->mon_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->mon_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->mon_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->mon_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->mon_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->mon_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_mon_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->mon_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->mon_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->mon_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->mon_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->mon_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->mon_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->mon_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->mon_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->mon_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->mon_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->mon_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->mon_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->mon_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->mon_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->mon_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->mon_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->mon_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->mon_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->mon_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->mon_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->mon_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->mon_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->mon_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->mon_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                   
                   
                   <div class="form-group">
                    <label for="exampleInputPassword1">Tuesday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_tue_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->tue_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->tue_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->tue_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->tue_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->tue_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->tue_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->tue_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->tue_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->tue_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->tue_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->tue_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->tue_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->tue_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->tue_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->tue_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->tue_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->tue_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->tue_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->tue_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->tue_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->tue_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->tue_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->tue_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->tue_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_tue_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->tue_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->tue_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->tue_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->tue_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->tue_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->tue_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->tue_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->tue_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->tue_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->tue_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->tue_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->tue_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->tue_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->tue_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->tue_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->tue_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->tue_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->tue_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->tue_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->tue_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->tue_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->tue_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->tue_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->tue_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                   
                   
                   <div class="form-group">
                    <label for="exampleInputPassword1">Wednesday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_wed_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->wed_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->wed_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->wed_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->wed_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->wed_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->wed_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->wed_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->wed_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->wed_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->wed_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->wed_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->wed_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->wed_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->wed_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->wed_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->wed_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->wed_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->wed_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->wed_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->wed_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->wed_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->wed_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->wed_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->wed_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_wed_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->wed_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->wed_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->wed_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->wed_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->wed_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->wed_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->wed_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->wed_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->wed_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->wed_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->wed_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->wed_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->wed_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->wed_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->wed_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->wed_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->wed_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->wed_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->wed_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->wed_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->wed_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->wed_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->wed_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->wed_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                   
                   
                   <div class="form-group">
                    <label for="exampleInputPassword1">Thursday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_thu_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->thu_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->thu_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->thu_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->thu_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->thu_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->thu_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->thu_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->thu_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->thu_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->thu_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->thu_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->thu_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->thu_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->thu_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->thu_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->thu_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->thu_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->thu_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->thu_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->thu_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->thu_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->thu_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->thu_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->thu_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_thu_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->thu_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->thu_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->thu_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->thu_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->thu_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->thu_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->thu_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->thu_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->thu_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->thu_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->thu_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->thu_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->thu_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->thu_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->thu_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->thu_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->thu_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->thu_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->thu_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->thu_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->thu_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->thu_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->thu_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->thu_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputPassword1">Friday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_fri_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->fri_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->fri_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->fri_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->fri_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->fri_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->fri_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->fri_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->fri_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->fri_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->fri_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->fri_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->fri_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->fri_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->fri_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->fri_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->fri_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->fri_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->fri_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->fri_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->fri_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->fri_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->fri_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->fri_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->fri_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_fri_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->fri_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->fri_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->fri_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->fri_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->fri_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->fri_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->fri_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->fri_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->fri_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->fri_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->fri_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->fri_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->fri_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->fri_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->fri_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->fri_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->fri_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->fri_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->fri_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->fri_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->fri_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->fri_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->fri_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->fri_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputPassword1">Saturday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_sat_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->sat_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->sat_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->sat_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->sat_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->sat_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->sat_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->sat_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->sat_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->sat_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->sat_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->sat_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->sat_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->sat_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->sat_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->sat_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->sat_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->sat_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->sat_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->sat_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->sat_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->sat_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->sat_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->sat_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->sat_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_sat_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->sat_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->sat_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->sat_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->sat_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->sat_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->sat_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->sat_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->sat_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->sat_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->sat_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->sat_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->sat_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->sat_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->sat_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->sat_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->sat_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->sat_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->sat_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->sat_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->sat_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->sat_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->sat_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->sat_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->sat_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputPassword1">Sunday</label>
                    <div class='row'>
                        <div class='col-md-6'>
                        <select id="shift_1" name="shift_sun_1"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->sun_working_starttime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->sun_working_starttime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->sun_working_starttime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->sun_working_starttime == '3am') selected @endif>03;00 am</option>
                            <option value='4am' @if($warehouse->sun_working_starttime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->sun_working_starttime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->sun_working_starttime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->sun_working_starttime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->sun_working_starttime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->sun_working_starttime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->sun_working_starttime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->sun_working_starttime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->sun_working_starttime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->sun_working_starttime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->sun_working_starttime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->sun_working_starttime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->mon_working_starttime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->sun_working_starttime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->sun_working_starttime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->sun_working_starttime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->sun_working_starttime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->sun_working_starttime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->sun_working_starttime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->sun_working_starttime == '11pm') selected @endif>11:00 pm</option>
                         </select>
                        </div>
                        <div class='col-md-6'>
                          <select id="shift_2" name="shift_sun_2"class="form-control" required="" />
                            <option value='Non' >Non</option>
                            <option value='12am' @if($warehouse->sun_working_endtime == '12am') selected @endif>12:00 am</option>
                            <option value='1am' @if($warehouse->sun_working_endtime == '1am') selected @endif>01:00 am</option>
                            <option value='2am' @if($warehouse->sun_working_endtime == '2am') selected @endif>02:00 am</option>
                            <option value='3am' @if($warehouse->sun_working_endtime == '3am') selected @endif>03:00 am</option>
                            <option value='4am' @if($warehouse->sun_working_endtime == '4am') selected @endif>04:00 am</option>
                            <option value='5am' @if($warehouse->sun_working_endtime == '5am') selected @endif>05:00 am</option>
                            <option value='6am' @if($warehouse->sun_working_endtime == '6am') selected @endif>06:00 am</option>
                            <option value='7am' @if($warehouse->sun_working_endtime == '7am') selected @endif>07:00 am</option>
                            <option value='8am' @if($warehouse->sun_working_endtime == '8am') selected @endif>08:00 am</option>
                            <option value='9am' @if($warehouse->sun_working_endtime == '9am') selected @endif>09:00 am</option>
                            <option value='10am' @if($warehouse->sun_working_endtime == '10am') selected @endif>10:00 am</option>
                            <option value='11am' @if($warehouse->sun_working_endtime == '11am') selected @endif>11:00 am</option>
                            <option value='12pm' @if($warehouse->sun_working_endtime == '12pm') selected @endif>12:00 pm</option>
                            <option value='1pm' @if($warehouse->sun_working_endtime == '1pm') selected @endif>01:00 pm</option>
                            <option value='2pm' @if($warehouse->sun_working_endtime == '2pm') selected @endif>02:00 pm</option>
                            <option value='3pm' @if($warehouse->sun_working_endtime == '3pm') selected @endif>03:00 pm</option>
                            <option value='4pm' @if($warehouse->sun_working_endtime == '4pm') selected @endif>04:00 pm</option>
                            <option value='5pm' @if($warehouse->sun_working_endtime == '5pm') selected @endif>05:00 pm</option>
                            <option value='6pm' @if($warehouse->sun_working_endtime == '6pm') selected @endif>06:00 pm</option>
                            <option value='7pm' @if($warehouse->sun_working_endtime == '7pm') selected @endif>07:00 pm</option>
                            <option value='8pm' @if($warehouse->sun_working_endtime == '8pm') selected @endif>08:00 pm</option>
                            <option value='9pm' @if($warehouse->sun_working_endtime == '9pm') selected @endif>09:00 pm</option>
                            <option value='10pm' @if($warehouse->sun_working_endtime == '10pm') selected @endif>10:00 pm</option>
                            <option value='11pm' @if($warehouse->sun_working_endtime == '11pm') selected @endif>11:00 pm</option>
                          </select>
                        </div>
                     </div>
                   </div>
                
                
                
                
                  <div class="form-group">
                      <label for="exampleInputPassword1">Imagen </label>
                  <input type="file" name="file" id="file" class="inputfile inputfile-6" />
		 			
                </div>
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Crear Almacen</button>
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
              $('#sub_category').html('<option value="0">Seleccionar Subcategoria</option>'+data);
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
              $('#second_sub_category').html('<option value="0">Seleccionar Segunda Subcategoria</option>'+data);
           }
         });
         }
     </script>
    <script src="{{asset('js/pages/admin/store.js')}}"></script>
     @endsection
