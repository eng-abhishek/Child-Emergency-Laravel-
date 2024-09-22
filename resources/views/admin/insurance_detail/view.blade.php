@extends('admin.layout.layout')
@section('title','Add Insurance Detail')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
          @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Add</li>
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
                  <h3 class="box-title">Add New Insurance Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="salse-man-store" action="{{url('post-add-insurance-details')}}">                 
                  <div class="box-body">
                    
                    <div class="form-group">
                    <label for="user_id">Select Child</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select child--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}">{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('child_id')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>
                  
                     <div class="form-group">
                      <label for="type_of_insurance">Type of insurance</label>
                      <input type="text" class="form-control" name="type_of_insurance" id="type_of_insurance">
                      @error('type_of_insurance')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                    @csrf
                      <div class="form-group">
                      <label for="insurance_cmp_name">Insurance company name</label>
                      <input type="text" class="form-control" name="insurance_cmp_name" id="insurance_cmp_name">
                      @error('insurance_cmp_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="plan_type">Plan type</label>
                      <input type="text" class="form-control" name="plan_type" id="plan_type">
                      @error('plan_type')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="subscribe">Subscribe</label>
                      <input type="text" class="form-control" name="subscribe" id="subscribe">
                      @error('subscribe')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                  
                      <div class="form-group">
                      <label for="member_no">Member No</label>
                      <input type="text" class="form-control" name="member_no" id="member_no">
                      @error('member_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="group_no">Group No</label>
                      <input type="text" class="form-control" name="group_no" id="group_no">
                      @error('group_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="agent">Agent</label>
                      <input type="text" class="form-control" name="agent" id="agent">
                      @error('agent')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="phone_no">Phone No</label>
                      <input type="text" class="form-control" name="phone_no" id="phone_no">
                      @error('bedtime_routine')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="website">Website</label>
                      <input type="text" class="form-control" name="website" id="website">
                      @error('website')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="co_pay_deductible">Co-pay deductible</label>
                      <input type="text" class="form-control" name="co_pay_deductible" id="co_pay_deductible">
                      @error('co_pay_deductible')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="notes">Notes</label>
                      <input type="text" class="form-control" name="notes" id="notes">
                      @error('notes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                     </div>                  
                     <div class="box-footer">
                     <button type="submit" class="btn btn-primary btn-proCat">Submit</button>
                     </div>
                </form>
               </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
@section('script')
<script>

function getChild(id){

//alert(id);
$.ajax({
url:'{{url("getChild")}}',
method:'POST',
data:{id:id,'_token':"{{csrf_token()}}"},
success:function(data){
console.log(data);
$('#child_id').html(data);
}
});

}


$(function(){
$('salse-man-store').validate({
 rules:{
  name:{
   required:true,
   minlength:3,
   maxlength:20,   
  },
  email:{
  required:true,
  email:true,  
  },
 contact_no:{
  required:true,
  number:true, 
  maxlength:10,
  minlength:10,  
 },
 img:{
  required:true,
 },
 address:{
  required:true, 
  maxlength:80,
  minlength:10, 
 },
 zip_code:{
 required:true,
 maxlength:30,
 minlength:3, 
          },
 country:{
 required:true,
 maxlength:30,
 minlength:3, 
  },
 password:{
 required:true,
 maxlength:15,
 minlength:8,
  }        
 },
 messages:{
   name:{
   required:'*Please Enter Name', 
   },
  email:{
  required:'Please Enter Email Id',
  email:'Please Enter validate Email Id',  
  },
  contact_no:{
  required:'Please Enter Contact No',  
 },
  img:{
  required:'Please Enter Image',
 },
 address:{
  required:'Please Enter Address', 
 },
 zip_code:{
 required:'Please Enter Zip Code',
 },
 country:{
 required:'Please Enter Country',
  },
 password:{
 required:'Please Enter Password', 
 } 
 } 
});
});
</script>
@stop


      