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
<style> 
    .search_custom{
      width: 130px;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      background-color: white;
      background-image: url('searchicon.png');
      background-position: 10px 10px; 
      background-repeat: no-repeat;
      padding: 12px 20px 12px 40px;
      -webkit-transition: width 0.4s ease-in-out;
      transition: width 0.4s ease-in-out;
    }
    
    .search_custom:focus {
      width: 120%;
    }
</style>

<style>
    .dropbtn {
      background-color:   rgb(58, 63, 80);
      color: white;
      padding: 1px;
      font-size: 20px;
      border: 1px solid wheat;
      width: 230px;
      height: 40px;
    }
    
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {background-color: #ddd;}
    
    .dropdown:hover .dropdown-content {display: block;}
    
    .dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>

<style>
    
    .modal-confirm {		
        color: #636363;
        width: 325px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px; 
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }	
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }	
    .modal-confirm .icon-box {
        color: #fff;		
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm .icon-box i {
        font-size: 58px;
        position: relative;
        top: 3px;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }
}
</style>

<style>
  
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
      $(document).ready(function(){
        var a = new Date();

        $("#total_now").text('Updated: '+a.toLocaleString());
        $("#customer_now").text('Updated: '+a.toLocaleString());
      });   
    </script>

    <div class="row">
      <div class="col-lg-1 col-md-5">
        <div class="filter__sort">
            <div class="dropdown">
                <button class="dropbtn">Tùy chọn cấu hình</button>
                    <div class="dropdown-content">
                        <a href="{{URL::to('/link-sync')}}">Đồng bộ từ Link</a>
                        <a href="{{URL::to('/file-sync')}}">Đồng bộ từ File XML</a>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Đồng bộ từ file xml</h4>
            <form class="form" action="{{URL::to('/save-file')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="txtXml" class="col-sm-3 col-form-label">File xml</label>
                <div class="col-sm-9">
                <input type="file" name="txtXml" id="txtXml" class="file-upload-default"
                data-validation="required"
                data-validation-error-msg="Vui lòng chọn file xml">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Vui lòng chọn file xml">
                    <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                </div>
                </div>
            </div>
          
            <div class="form-group row">
                <label for="txtDesc" class="col-sm-3 col-form-label">File hiện tại</label>
                <div class="col-sm-9">
                <textarea class="form-control" id="txtDesc2" name="txtDesc2" rows="13" readonly>
                    @php
                        $file = fopen(storage_path("app/public/file_config/product.xml"), "r");
                        while(! feof($file))
                        {
                        echo fgets($file);
                        }
                    @endphp
                </textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Lưu cấu hình kết nối</button>
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