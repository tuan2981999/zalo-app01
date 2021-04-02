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
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Danh sách danh mục</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>Hình ảnh</th>
                      <th>Tên danh mục</th>
                      <th>Trạng thái</th>
                      <th style="width: 30%">Mô tả</th>
                      <th style="width: 7%">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($category as $data)
                        <tr>
                            <td><img src="{{$data['photo_link']}}" width="70px" height="70px"/></td>
                            <td>{{ $data['name'] }}</td>
                            <td>
                              @if($data['status'] == 'hide')
                                <p class="badge badge-danger">Ẩn</p>
                              @elseif($data['status'] == 'show')
                                <p class="badge badge-success" >Hiển thị</p>
                              @endif
                            </td>
                            <td>{{ $data['description'] }}</td>
                            <td>
                                <a style="margin-right: 20px; font-size: 20px; color: black"
                                  data-toggle="tooltip" data-placement="bottom" title="Chỉnh sửa danh mục"
                                  href="{{URL::to('/edit-category/'.$data['id']).'/'.$data['name'].'/'.$data['description'].'/'.Crypt::encrypt($data['photo_link']).'/'.$data['status'].'/'.$data['photo']}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                            </tr> 
                    @endforeach
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