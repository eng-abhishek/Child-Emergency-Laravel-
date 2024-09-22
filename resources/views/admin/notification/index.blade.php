@extends('admin.layout.layout')
@section('title','Notification List')
@section('content')
<?php
use App\User;
?>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Notification List
            <small>Transair</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Notification List</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Notification List</h3>
                <!--   <a href="{{url('sales-man-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Seles Men</button></a>  -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($notificationList as $key=>$categoryval)
                      <?php 
                      $userData=User::find($categoryval->user_id);
                      if(empty($userData->name)){
                       $userName="Admin";
                      }else{
                       $userName=$userData->name;
                      }
                      ?>
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$userName}}</td>
                        <td>{{$categoryval->title}}</td>
                        <td>{{$categoryval->description}}</td>
                        <td>{{date('d/m/yy h:i A',strtotime($categoryval->created_at))}}</td>

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
