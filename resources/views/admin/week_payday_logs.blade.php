@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Status de Nomina del {{$year}}</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Manejo de Empleados</a></li>
        <li class="active">Status de Nomina</li>
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
                                       
                                         <th>Nombre</th>
                                         <th>Horas Trabajadas</th>
                                         <th>Propinas</th>
                                         <th>Pago Total</th>
                                      
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
                                            
                                            <td>
                                              <a href="{{asset('admin/employee_payment_log')}}/{{$year}}/{{$selected_week}}/{{$customer->employee_id}}"> {{$customer->name}} </a>
                                            </td>
                                           
                                            <td>
                                               {{$total_hours}}
                                            </td>
                                             <td>
                                               ${{number_format(@$tips[$customer->employee_id],2)}}
                                            </td>
                                             <td>
                                               ${{number_format($amount,2)}}
                                            </td>
                                           
                                        </tr>
                                        
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"><strong>Pago Total</strong></td>
                                            <td style="font-size: 20px"><strong>${{number_format($total_amount,2)}}</strong></td>
                                            
                                        </tr>
                                    </tfoot>
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
