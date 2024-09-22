@extends('admin.layout.layout')
@section('title','Medical')
@section('content')

  <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Medical</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Detail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Medical Detail Level Two</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Child Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4" style="font-size:18px;font-style:bold;padding-top:25px">
           Medication</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Medication Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->medication_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Resion for Taking</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_reason_for_taking}}</div>    
           </div>

      
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Dose</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_dose}}</div>    
          </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Frequency</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_frequency}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Start date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_start_date}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">End date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_end_date}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Doctor Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_doctor_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Note</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_note}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Doctor Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->me_doctor_name}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4" style="font-size:18px;font-style:bold;padding-top:25px">
           Surgery</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Surgery/Procidure</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->surgery_or_procedure}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->sr_date}}</div>    
           </div>



           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Physican</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->sr_physician}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Hospital</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->sr_hospital}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Notes</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->sr_note}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4" style="font-size:18px;font-style:bold;padding-top:25px">
           Major Illness</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Illness</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->illness}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Start Date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->illness_start}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">End Date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->illness_end_date}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Notes</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->illness_treatment_note}}</div>    
           </div>

           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      