@extends('admin.layout.layout')
@section('title','Medical')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Medical Level Two Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Medical</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Medical Level Two Management</h3>
                 <a href="{{url('add-medical-level-two')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Medical Level Two</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Child Name</th>                  
                        <th>Medication Name</th>
                        <th>Resion For Taking</th>
                        <th>Does</th>
                        <th>Frequency</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($allUser as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->name}}</td>
                   <td>{{$orderDetails->medication_name}}</td> 
                   <td>
                   {{$orderDetails->me_reason_for_taking}}
                    </td>
                    <td>{{$orderDetails->me_dose}}</td>
                    <td>{{$orderDetails->me_frequency}}</td>
                    <td>{{$orderDetails->me_start_date}}</td>
                    <td>{{$orderDetails->me_end_date}}</td>
                              
<td>                  
                        <a href="{{url("update-medical-level-two/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-medical-level-two/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                        <a href="{{url('medical-level-two-detail/'.$orderDetails->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>                    
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
