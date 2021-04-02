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
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Quản lý mã token</h4>
        <form class="form" action="{{URL::to('/save-token')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="txtDesc" class="col-sm-3 col-form-label">Mã Token hiện tại</label>
            <div class="col-sm-9">
            <textarea class="form-control" id="txtToken1" name="txtToken1" rows="5" readonly>{{$token}}</textarea>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Nhập mã Token mới</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="txtToken2" name="txtToken2" rows="5"
                data-validation="length" 
                data-validation-length="10-2000" 
                data-validation-error-msg="Mã token không hợp lệ"></textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary mr-2">Thay đỗi mã token</button>
          <button type="button" onclick="cancel()" class="btn btn-light">Hủy</button>
        </form>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('backend/js/file-upload.js')}}"></script>
  <script src="{{asset('backend/js/typeahead.js')}}"></script>
  <script src="{{asset('backend/js/select2.js')}}"></script>

  <script language="javascript">
    function cancel(){
      document.getElementById('txtToken2').value = "";
    }
  </script>  
  
  @endsection