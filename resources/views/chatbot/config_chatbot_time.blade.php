@extends('admin_layout')
@section('admin_content')
<?php 
			                    $message = Session::get('message');

			                    if ($message){
                            echo '<script>
                                alert("'.$message.'");
                              </script>';
                              Session::put('message', null);
			                    }
		                    ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
      $(document).ready(function(){
        var a = new Date();

        $("#total_now").text('Updated: '+a.toLocaleString());
        $("#customer_now").text('Updated: '+a.toLocaleString());
      });
        
    </script>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cấu hình thời gian trả lời</h4>
        <form class="form" action="{{URL::to('/save-chatbot-time')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="txtName">Tự trả lời mặt định sau số phút khách hàng không phản hồi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="time_tmp" name="time_tmp" placeholder=""
            value="">
           
            </div>
          </div>

          <div class="form-group">
            <label for="txtName">Câu trả lời khi khách hàng nhắn tin vào khoản thời gian như sau</label>
            <div class="row">
              <div class="col-sm-2">
                <input type="text" class="form-control" id="time_end_from" name="time_end_from" placeholder="H:I"
              value="">
               
              </div>Đến
              <div class="col-sm-2">
                <input type="text" class="form-control" id="time_end_to" name="time_end_to" placeholder="H:I"
              value="">
              
              </div>
            </div></br>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="content_end" name="content_end" placeholder="END"
              value="">
              
            </div>
             </br>
            <div class="row">
              <div class="col-sm-2">
                <input type="text" class="form-control" id="time_begin_from" name="time_begin_from" placeholder="H:I"
              value="">
             
              </div>Đến
              <div class="col-sm-2">
                <input type="text" class="form-control" id="time_begin_to" name="time_begin_to" placeholder="H:I"
              value="">
             
              </div>
            </div></br>
        
            <div class="col-sm-7">
              <input type="text" class="form-control" id="content_begin" name="content_begin" placeholder="BEGIN"
              value="">
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary mr-2">Lưu cấu hình</button>
          <button type="button" class="btn btn-light">Hủy</button>
        </form>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('backend/js/file-upload.js')}}"></script>
  <script src="{{asset('backend/js/typeahead.js')}}"></script>
  <script src="{{asset('backend/js/select2.js')}}"></script>
  <script src="{{asset('public/backend/js/data-table.js')}}"></script>

@endsection