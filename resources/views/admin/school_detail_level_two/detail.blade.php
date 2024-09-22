@extends('admin.layout.layout')
@section('title','School Level Two Details')
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
                  <h3 class="box-title">School Level Two Detail</h3>
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
           <div class="col-sm-4 detailsBlod"><b>Child`s Teacher</b></div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Teacher Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tr_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Class Room No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           {{$order[0]->classroom_no}}
           </div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod"><b>Child`s Tutors</b></div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
          </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Tutor`s Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->tutors_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Details about subject, days, and time for tutoring</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->details_about_sub_day_time}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod"><b>Individual Education Plan</b></div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Explane Child`s Developement Challenges</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->ind_edu_plan_child_dev_challange}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Date of last meeting</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->ind_edu_plan_date_last_meeting}}</div>    
           </div>

            <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Special services or accommodation provided at school</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->ind_edu_plan_special_service}}</div>    
           </div>

            <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Does the child receive SSI ?</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->ind_edu_plan_child_receive_ssi}}</div>    
           </div>

            <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">SSI Amount</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->ind_edu_plan_ssi_amount}}</div>    
           </div>

            <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Add Information or Instructions</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->ind_edu_plan_add_information}}</div>    
           </div>


           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      