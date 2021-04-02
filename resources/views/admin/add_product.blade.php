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
        <h4 class="card-title">Thêm sản phẩm mới</h4>
        <form class="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data" id="add_form">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Tên sản phẩm</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="txtName" name="txtName" placeholder=""
              data-validation="length" 
              data-validation-length="3-200" 
              data-validation-error-msg="Tên sản phẩm từ 3-200 ký tự">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="txtPrice" class="col-sm-3 col-form-label">Giá sản phẩm(0:Liên hệ)</label>
            <div class="input-group col-sm-9">
              <div class="input-group-prepend">
                <span class="input-group-text bg-primary text-white">$</span>
              </div>
              <input type="text" id="txtPrice" name="txtPrice" class="form-control" aria-label="Amount (to the nearest dollar)"
              ><div class="input-group-append">
                <span class="input-group-text">VNĐ</span>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="code" class="col-sm-3 col-form-label">Mã sản phẩm</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="txtCode" name="txtCode" placeholder=""
              data-validation="length alphanumeric" 
              data-validation-length="3-12" 
              data-validation-error-msg="Mã sản phẩm từ 3-30 ký tự">
            </div>
          </div>

          <div class="form-group row">
            <label for="code" class="col-sm-3 col-form-label">Số lượng</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder=""
              data-validation="number length" 
              data-validation-length="1-10" 
              data-validation-error-msg="Số lượng không được để trống">
            </div>
          </div>

          <div class="form-group row">
            <label for="txtWeight" class="col-sm-3 col-form-label">Cân nặng</label>
            <div class="input-group col-sm-9">
              <div class="input-group-prepend">
                <span class="input-group-text bg-primary text-white"></span>
              </div>
              <input type="text" id="txtWeight" name="txtWeight" class="form-control" aria-label="Amount (to the nearest dollar)"
              data-validation="number length" 
              data-validation-length="1-3" 
              data-validation-error-msg="Cân nặng từ 1-100 Kg">
              <div class="input-group-append">
                <span class="input-group-text">Kg</span>
              </div>
            </div>
            </div>

          <div class="form-group row">
            <label for="slCategory_product" class="col-sm-3 col-form-label">Danh mục sản phẩm</label>
            <div class="col-sm-9">
              <select id="Categories" name="Categories" class="form-control col-sm-5 form-control-lg">
                    @foreach ($category_product as $cate)
                        <option value="{{$cate['id']}}">{{$cate['name']}}</option>
                    @endforeach
              </select>
            </div>
          </div> 

          <div class="form-group row">
            <label for="slCategory_product" class="col-sm-3 col-form-label">Loại sản phẩm</label>
            <div class="col-sm-6">
              <select id="industry3" name="industry3" class="form-control col-sm-12 form-control-lg">
                    @foreach ($industry as $industrylv3)
                        <option value="{{$industrylv3['id']}}">{{$industrylv3['name']}}</option>
                    @endforeach
              </select>
            </div>
          </div> 

          <div class="form-group row">
            <label for="txtDesc" class="col-sm-3 col-form-label">Mô tả</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="txtDesc" name="txtDesc" rows="4"></textarea>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="txtImage" class="col-sm-3 col-form-label">Hình đại diện</label>
            <div class="col-sm-9">
              <input type="file" name="txtImage" id="txtImage" class="file-upload-default"
              data-validation="required"
              data-validation-error-msg="Vui lòng chọn hình ảnh">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary mr-2">Thêm sản phẩm</button>
          <button type="button" class="btn btn-light">Hủy</button>
        </form>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('backend/js/file-upload.js')}}"></script>
  <script src="{{asset('backend/js/typeahead.js')}}"></script>
  <script src="{{asset('backend/js/select2.js')}}"></script>

  @endsection