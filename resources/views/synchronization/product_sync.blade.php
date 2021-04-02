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
        <h4 class="card-title">Đồng bộ sản phẩm</h4>
        <form class="form" action="{{URL::to('/save-sync')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="slCategory_product" class="col-sm-3 col-form-label">Chọn danh mục</label>
            <div class="col-sm-9">
              <select id="txtCategories" name="txtCategories" class="form-control col-sm-5 form-control-lg">
                    @foreach ($category_product as $cate)
                        <option value="{{$cate['id']}}">{{$cate['name']}}</option>
                    @endforeach
              </select>
            </div>
          </div> 

          <div class="form-group row">
            <label for="slCategory_product" class="col-sm-3 col-form-label">Chọn đầu vào</label>
            <div class="col-sm-9">
              <select id="txtInput" name="txtInput" class="form-control col-sm-5 form-control-lg">
                        <option value="link">Đồng bộ sản phẩm từ Link</option>
                        <option value="file">Đồng bộ sản phẩm từ File XML</option>
              </select>
            </div>
          </div> 

          <button type="submit" class="btn btn-primary mr-2">Kiểm tra sản phẩm</button>
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