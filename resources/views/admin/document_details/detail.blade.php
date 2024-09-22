@extends('admin.layout.layout')
@section('title','Document Details')
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
                  <h3 class="box-title">Document Detail</h3>
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
           <div class="col-sm-4 detailsBlod">Employer</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Employer Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->employee_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Add Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->address}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Phone No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->phone_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Supervisor Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->supervisor_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Relevant Document</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"></div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Birth Certificates Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->birth_certificate_loc}}">Click to view</a></p>
           </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Social Security Cards Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->social_security_card_loc}}">Click to view</a></p>
           </div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Passports Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->passport_loc}}">Click to view</a></p>
           </div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Naturalization Paper Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->naturalization_papers_loc}}">Click to view</a></p>
           </div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Will and Ancillary Document</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->will_and_ancillary_doc}}">Click to view</a></p>
           </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Power of Attorney Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->power_of_attorney_loc}}">Click to view</a></p>
           </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Guardian</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->guardian}}">Click to view</a></p>
           </div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Life Insurance Policy Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->life_insurance_policy_loc}}">Click to view</a></p>
           </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Children`s Life Indurance Policies Locations</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->children_life_insu_policies_loc}}">Click to view</a></p>
           </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Other Location</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->other_loc}}">Click to view</a></p>
           </div>    
           </div>


          

           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      