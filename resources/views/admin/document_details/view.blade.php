@extends('admin.layout.layout')
@section('title','Add Document Detail')
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
                  <h3 class="box-title">Add New About Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="salse-man-store" action="{{url('post-add-document-details')}}" enctype="multipart/form-data">                 
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
                      <label for="dislikes"><b>Employer</b></label>
                  
                      </div>
                  
                     <div class="form-group">
                      <label for="employee_name">Employee Name</label>
                      <input type="text" class="form-control" name="employee_name" id="employee_name">
                      @error('employee_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                    @csrf
                      <div class="form-group">
                      <label for="address">Add Address</label>
                      <input type="text" class="form-control" name="address" id="address">
                      @error('address')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="phone_no">Phone No</label>
                      <input type="text" class="form-control" name="phone_no" id="phone_no">
                      @error('phone_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="supervisor_name">Supervisor Name</label>
                      <input type="text" class="form-control" name="supervisor_name" id="supervisor_name">
                      @error('dislikes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="dislik"><b>Relevant Document</b></label>
                      </div>

                      <div class="form-group">
                      <label for="birth_certificate_loc">Birth Certificates Location</label>
                      <input type="file" class="form-control" name="birth_certificate_loc" id="birth_certificate_loc">
                      @error('birth_certificate_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="social_security_card_loc">Social Security Cards Location</label>
                      <input type="file" class="form-control" name="social_security_card_loc" id="social_security_card_loc">
                      @error('social_security_card_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="passport_loc">Passports Location</label>
                      <input type="file" class="form-control" name="passport_loc" id="passport_loc">
                      @error('passport_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="naturalization_papers_loc">Naturalization Paper Location</label>
                      <input type="file" class="form-control" name="naturalization_papers_loc" id="naturalization_papers_loc">
                      @error('naturalization_papers_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="will_and_ancillary_doc">Will and Ancillary Document</label>
                      <input type="file" class="form-control" name="will_and_ancillary_doc" id="will_and_ancillary_doc">
                      @error('will_and_ancillary_doc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="power_of_attorney_loc">Power of Attorney Location</label>
                      <input type="file" class="form-control" name="power_of_attorney_loc" id="power_of_attorney_loc">
                      @error('power_of_attorney_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="guardian">Guardian</label>
                      <input type="file" class="form-control" name="guardian" id="guardian">
                      @error('guardian')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="life_insurance_policy_loc">Life Insurance Policy Location</label>
                      <input type="file" class="form-control" name="life_insurance_policy_loc" id="life_insurance_policy_loc">
                      @error('life_insurance_policy_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="children_life_insu_policies_loc">Children`s Life Indurance Policies Locations</label>
                      <input type="file" class="form-control" name="children_life_insu_policies_loc" id="children_life_insu_policies_loc">
                      @error('children_life_insu_policies_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="other_loc">Other Location</label>
                      <input type="file" class="form-control" name="other_loc" id="other_loc">
                      @error('other_loc')
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


      