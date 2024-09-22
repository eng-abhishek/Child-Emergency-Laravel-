@extends('admin.layout.layout')
@section('title','School Level One Details')
@section('content')

  <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Child Emergency Plan</small>
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
                  <h3 class="box-title">School Level One Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Child Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod"><b>Child`s School</b></div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">School Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->school_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">School Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->school_addreass}}
           </div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Offic Contact No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->office_phone}}</div>    
          </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Start Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->start_time}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">End Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->end_time}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Website</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><a href="{{$order[0]->website}}" target="_blank">{{$order[0]->website}}</a></div>    
           </div>
           
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Principal`s Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->principal_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod"><b>Child`s Transportation</b></div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Bus No`s</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_bus_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Bus Stop Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_bus_stop_location}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Bus Pickup Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_bus_pickup_time}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Bus Drop-off Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_bus_drop_time}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Special Transportations Arrangement</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_special_trans_arrangement}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Transportations Phone No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_transportation_phone_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod"><b>Student Information</b></div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Grade</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->stu_grade}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Student ID No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->stu_id_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Lunch Pin</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->stu_lunch_pin}}</div>    
           </div>

           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      