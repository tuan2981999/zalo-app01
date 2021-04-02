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
        <h4 class="card-title">Thêm bài viết mới</h4>
        <form class="form" action="{{URL::to('/save-article')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Tiêu đề</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="">
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Trích dẫn</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="txtDescription" name="txtDescription" placeholder="">
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Tác giả</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="txtAuthor" name="txtAuthor" placeholder="">
            </div>
          </div>

          <div class="form-group row">
            <label for="slCategory_product" class="col-sm-3 col-form-label">Trạng thái</label>
            <div class="col-sm-9">
              <select id="txtStatus" name="txtStatus" class="form-control col-sm-5 form-control-lg">
                <option value="hide">Ẩn</option>    
                <option value="show">Hiển thị</option>           
              </select>
            </div> 
          </div>

          <div class="form-group row">
            <label for="txtDesc" class="col-sm-3 col-form-label">Nội dung</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="txtDesc2" name="txtDesc2" rows="10"></textarea>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="txtImage" class="col-sm-3 col-form-label">Hình ảnh đại diện</label>

            <div class="col-sm-9">
              <input type="file" name="txtImage" id="txtImage" class="file-upload-default"
              data-validation="required"
              data-validation-error-msg="Vui lòng chọn hình ảnh">
              
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Ảnh đại diện bài viết">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="txtImage" class="col-sm-3 col-form-label">Hình ảnh cuối bài viết</label>

            <div class="col-sm-9">
              <input type="file" name="txtImage2" id="txtImage2" class="file-upload-default"
              data-validation="required"
              data-validation-error-msg="Vui lòng chọn hình ảnh">
              
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Ảnh nằm cuối bài">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary mr-2">Xuất bản</button>
          <button type="button" class="btn btn-light">Hủy</button>
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
      document.getElementById('txtName').value = "";
      document.getElementById('txtDesc').value = "";
    }
   
  </script>
  @endsection