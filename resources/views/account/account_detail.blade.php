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
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <h4>Ảnh đại diện: </h4>
                    <h4> <img src="{{$account_detail['picture']['data']['url']}}" width="150px" height="150px"/></h4></br>
                    <h4>Tên người dùng: <span style="color: blue">{{$account_detail['name']}}</span></h4></br>
                    <h4>Ngày sinh: <span style="color: blue">{{$account_detail['birthday']}}</span></h4></br>
                    <h4>Giới tính: <span style="color: blue">{{$account_detail['gender']}}</span></h4>
                </div>
            </div>                 
        </div> 
    </div>   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('backend/js/file-upload.js')}}"></script>
<script src="{{asset('backend/js/typeahead.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>
@endsection