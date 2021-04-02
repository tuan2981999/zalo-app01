@extends('admin_layout')
@section('admin_content')

@php
        $rUrl1 = 'https://openapi.zalo.me/v2.0/store/getindustry?access_token='.$token.'';
        $data1 = json_decode(file_get_contents($rUrl1), true);
        $industrylv1 = $data1['data']['industries'];

        $rUrl = 'https://openapi.zalo.me/v2.0/store/category/getcategoryofoa?access_token='. $token.'&offset=0&limit=10';
        $data = json_decode(file_get_contents($rUrl), true);
        $category_product = $data['data']['categories'];
@endphp

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cập nhập thông tin sản phẩm</h4>
            <form class="forms-sample" method="post" action="{{URL::to('/update-product')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-4"> 
                        <img src="{{$detail_product['photo_links'][0]}}" width="250px"/>
                        <div class="form-group">
                            <label for="txtImage">Hình đại diện</label>
                              <input type="file" name="txtImage" id="txtImage" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div>
                        </div>
                    </div>      

                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" name="txtId" id="txtId" value="{{$detail_product['id']}}" hidden/>
                            <input type="text" name="txtIdphoto" id="txtIdphoto" value="{{$detail_product['photos'][0]}}" hidden/>
                            <label for="txtName">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="txtName" name="txtName" placeholder=""
                            value="{{$detail_product['name']}}">
                        </div>

                        <div class="form-group">
                            <label for="txtPrice">Giá sản phẩm(Giá liên hệ nếu bằng 0)</label>
                            <div class="input-group col-sm-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                              </div>
                              <input type="text" id="txtPrice" name="txtPrice" class="form-control" aria-label="Amount (to the nearest dollar)"
                                value="{{$detail_product['price']}}">
                              <div class="input-group-append">
                                <span class="input-group-text">VNĐ</span>
                              </div>
                            </div>
                          </div>

                        <div class="form-group">
                            <label for="txtName">Mã sản phẩm</label>
                            <input type="text" class="form-control" id="txtCode" name="txtCode" placeholder=""
                            value="{{$detail_product['code']}}">
                        </div>

                        <div class="form-group">
                            <label for="txtName">Số lượng</label>
                            <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder=""
                            value="{{$detail_product['quantity']}}">
                        </div>

                        <div class="form-group">
                            <label for="slCategory_product">Danh mục sản phẩm</label>
                              <select id="txtCategories" name="txtCategories" class="form-control">
                                    @foreach($category_product as $cate ){
                                        @if($cate['id'] == $detail_product['categories'][0])
                                            <option value={{$cate['id']}} selected>{{$cate['name']}}</option>
                                        @else
                                            <option value={{$cate['id']}}>{{$cate['name']}}</option>
                                        @endif
                                    }
                                    @endforeach
                              </select>
                        </div> 

                        <div class="form-group">
                            <label for="txtIndustry">Loại sản phẩm</label>
                            <select class="form-control" id="txtIndustry" name="txtIndustry">
                                @foreach($industrylv1 as $value ){
                                        @if($value['id'] == $detail_product['industry'])
                                            <option value={{$value['id']}} selected>{{$value['name']}}</option>
                                        @else
                                            <option value={{$value['id']}}>{{$value['name']}}</option>
                                        @endif
                                }
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txtStatus">Trạng thái</label>
                            <select class="form-control" id="txtStatus" name="txtStatus">
                                @if($detail_product['status'] == 'hide')
                                    <option value=hide selected>Ẩn</option>
                                    <option value=show>Hiển thị</option>
                                @elseif($detail_product['status'] == 'show')
                                    <option value=show selected>Hiển thị</option>
                                    <option value=hide>Ẩn</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txtWeight">Khối lượng(Kg)</label>
                            <input type="text" class="form-control" id="txtWeight" name="txtWeight" placeholder=""
                            value="{{$detail_product['package_size']['weight']}}">
                        </div>

                        <div class="form-group">
                            <label for="txtDesc">Mô tả</label>
                            <textarea class="form-control" id="txtDesc" name="txtDesc" rows="4">{{$detail_product['description']}}</textarea>
                        </div>
                        <div> 
                            <button type="submit" class="btn btn-primary mr-2" name="btnUpdate">Cập nhập sản phẩm</button>
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