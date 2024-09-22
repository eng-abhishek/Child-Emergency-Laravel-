@extends('admin.layout.layout')
@section('title','Edit About Detail')
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
            <small>Edit About Detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Edit</li>
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
                  <h3 class="box-title">Edit About Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-about-details')}}" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                    <label for="user_id">Select Child</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select child--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}" @if($all_user->id==$editData->child_id) selected @else @endif >{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('child_id')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>

                  
                     <div class="form-group">
                      <label for="likes_to_be_called">Likes to be called</label>
                      <input type="text" class="form-control" value="{{$editData->likes_to_be_called}}" name="likes_to_be_called" id="likes_to_be_called">
                      @error('likes_to_be_called')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                    @csrf
                      <div class="form-group">
                      <label for="personality">Personality</label>
                      <input type="text" class="form-control" value="{{$editData->personality}}" name="personality" id="personality">
                      @error('personality')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="likes">Likes</label>
                      <input type="text" class="form-control" value="{{$editData->likes}}" name="likes" id="likes">
                      @error('likes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="dislikes">Dislikes</label>
                      <input type="text" class="form-control" value="{{$editData->dislikes}}" name="dislikes" id="dislikes">
                      @error('dislikes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                  
                      <div class="form-group">
                      <label for="favorite_food">Favourite Foods</label>
                      <input type="text" class="form-control" value="{{$editData->favorite_food}}" name="favorite_food" id="favorite_food">
                      @error('favorite_food')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="good_at">Good At</label>
                      <input type="text" class="form-control" value="{{$editData->good_at}}" name="good_at" id="good_at">
                      @error('good_at')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="learns_best_by">Learns Best Way</label>
                      <input type="text" class="form-control" value="{{$editData->learns_best_by}}" name="learns_best_by" id="learns_best_by">
                      @error('learns_best_by')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="bedtime_routine">Bedtime Routine</label>
                      <input type="text" class="form-control" value="{{$editData->bedtime_routine}}" name="bedtime_routine" id="bedtime_routine">
                      @error('bedtime_routine')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="phone_no">Frightened By</label>
                      <input type="text" class="form-control" value="{{$editData->frightened_by}}" name="frightened_by" id="frightened_by">
                      @error('frightened_by')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editData->id}}"> 
          
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary edit-btn-foodCat">Submit</button>
                  </div>
                </form>
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



      