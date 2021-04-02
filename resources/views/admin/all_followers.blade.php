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
        <h4 class="card-title">Danh sách người quan tâm</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>#</th>
                      <th>Ảnh đại diện</th>
                      <th>Tên hiển thị</th>
                      <th style="width: 70px">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach($id_customer as $id_customer)
                        <tr>
                            @php
                                $rUrl = 'https://openapi.zalo.me/v2.0/oa/getprofile?access_token='. $token.'&data={"user_id":"'.$id_customer['user_id'].'"}';
                                $data = json_decode(file_get_contents($rUrl), true);
                                $customer2 = $data['data'];
                            @endphp
                            <td><?php echo $i++ ?></td>
                            <td><img src="{{$customer2['avatar']}}" width="70px" height="70px"/></td>
                            <td>{{ $customer2['display_name'] }}</td>
                            <td>
                                <a style="margin-right: 20px; font-size: 20px; color: black"
                                  data-toggle="tooltip" data-placement="bottom" title="Nhắn tin"
                                  href="{{URL::to('/edit-product/'.$customer2['user_id'])}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <a style="font-size: 20px; margin-right: 20px; color: red" onclick="del()" 
                                  data-toggle="tooltip" data-placement="bottom" title="Xóa quan tâm">
                                    <i class="fas fa-trash"></i>
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