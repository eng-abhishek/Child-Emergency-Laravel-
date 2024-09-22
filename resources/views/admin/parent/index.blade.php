@extends('admin.layout.layout')
@section('title','Parent')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Parent Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Parent</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Parent Management</h3>
                 <a href="{{url('add-parent')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Parent</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Name</th>                  
                        <th>Contact No</th>
                        <th>Email Id</th>
                        <th>Child Name</th>
                        <th>User Name</th>
                        <th>Image</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($allUser as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->name}}</td>
                   <td>{{$orderDetails->phone_no}}</td> 
                   <td>
                   {{$orderDetails->email}}
                    </td>
                    <td>{{$orderDetails->child_name}}</td>
                    <td>{{$orderDetails->user_name}}</td>
                    <td>
                    @if($orderDetails->profile_img)
<img src="{{$orderDetails->profile_img}}" width="50px">                   
                    @else
<img src="{{asset('public/assets/front-end/img/default-img.png')}}" width="50px">
                    @endif 
                    </td>
<td>                  
                        <a href="{{url("update-parent/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-parent/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>                
</td>

                     </tr>
                      @endforeach
                    </tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
