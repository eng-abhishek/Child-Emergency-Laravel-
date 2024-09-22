@extends('admin.layout.layout')
@section('title','Extra Curricular Details')
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
                  <h3 class="box-title">Extra Curricular Detail</h3>
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
           <div class="col-sm-4 detailsBlod">Activity</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->activity}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Days</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->days}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Start Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           {{$order[0]->start_time}}
           </div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">End Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->end_time}}</div>    
          </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->location}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">What the child needs to take coach or leader</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->take_coach_or_leader}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Pontact person`s name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->contact_person_name}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Phone</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->phone}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Email</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->email}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Other Information</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->other_information}}</div>    
           </div>


           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      