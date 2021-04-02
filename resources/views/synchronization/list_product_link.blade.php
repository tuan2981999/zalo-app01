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
            @php
              $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
              while(! feof($file)) {
                  $token = fgets($file);
                }
              $rUrl = 'https://openapi.zalo.me/v2.0/store/category/getcategoryofoa?access_token='. $token.'&offset=0&limit=10';
              $data = json_decode(file_get_contents($rUrl), true);    
              $category_product = $data['data']['categories'];
            @endphp

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Kiểm tra sản phẩm</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>Hình ảnh</th>
                      <th>Mã SP</th>
                      <th>Tên sản phẩm</th>
                      <th>Giá(Vnđ)</th>
                      <th>Danh mục</th>
                  </tr>
                </thead>
                <tbody>
                        <?php $i=0 ?>
                        @foreach($product as $data)
                        <?php $i++ ?>
                        @if($i <= $quantity)
                            <tr>
                                <td><img src="{{$data['images'][0]}}" width="70px" height="70px"/></td>
                                <td>{{ $data['code'] }}</td>
                                <td>{{ $data['name'] }}</td>
                                <td>{{number_format($data['basePrice'])}}</td>
                                @foreach($category_product as $cate)
                                  @if($cate['id'] == $category_id)
                                  <td>{{ $cate['name'] }}</td>
                                  @endif
                                @endforeach
                            </tr>
                        @else
                            @break;
                        @endif     
                        @endforeach
                            <tr>
                                <td colspan="6">
                                    <form class="form" action="{{URL::to('/save-link-product/'.$category_id)}}" method="post" enctype="multipart/form-data" id="add_form">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary mr-2" onclick="return confirm('Xác nhận đồng bộ')">Đồng bộ vào ZaloShop</button>
                                        <button type="button" class="btn btn-light">Hủy</button>
                                    </form>
                                </td>
                            </tr>
                </tbody>    
              </table>
            </div>
          </div>
        </div> 
      </div>
    </div>
</div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('backend/js/file-upload.js')}}"></script>
  <script src="{{asset('backend/js/typeahead.js')}}"></script>
  <script src="{{asset('backend/js/select2.js')}}"></script>
  
@endsection