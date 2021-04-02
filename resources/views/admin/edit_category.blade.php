@extends('admin_layout')
@section('admin_content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cập nhập thông tin danh mục</h4>      
            <form class="forms-sample" method="post" action="{{URL::to('/update-category')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-4"> 
                        <img src="{{Crypt::decrypt($photo_link)}}" width="250px"/>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" name="txtId" id="txtId" value="{{$category}}" hidden/>
                            <input type="text" name="txtIdphoto" id="txtIdphoto" value="{{$photo}}" hidden/>
                            <label for="txtName">Tên danh mục</label>
                            <input type="text" class="form-control" id="txtName" name="txtName" placeholder=""
                            value="{{$name}}">
                        </div>

                        <div class="form-group">
                          <label for="slCategory">Trạng thái</label>
                          <select class="form-control" id="Status" name="Status">
                                    @if($status == 'show')
                                        <option value="show" selected>Hiển thị</option>
                                        <option value="hide">Ẩn</option>
                                    @else
                                        <option value="hide" selected>Ẩn</option>
                                        <option value="show">Hiển thị</option>
                                    @endif
                          </select>
                      </div>
        
                        <div class="form-group">
                            <label for="txtName">Mô tả</label>
                            <input type="text" class="form-control" id="txtDesc2" name="txtDesc2" placeholder=""
                            value="{{$desc}}">
                        </div>

                        <div class="form-group">
                            <label for="txtImage">Hình ảnh</label>
                              <input type="file" name="txtImage" id="txtImage" class="file-upload-default">
                              <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="{{Crypt::decrypt($photo_link)}}">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div>
                        </div>

                        <div> 
                            <button type="submit" class="btn btn-primary mr-2" name="btnUpdate">Cập nhập danh mục</button>
                            <button type="button" class="btn btn-light" name="btnCancel" onclick="return cancel()">Hủy</button>
                        </div>
                    </div>
                </div>
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