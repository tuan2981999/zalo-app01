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
        <h4 class="card-title">Danh sách khách hàng</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>#</th>
                      <th>Tên khách hàng</th>
                      <th>Số điện thoại</th>
                      <th>Quận/Huyện</th>
                      <th>Tỉnh/Thành phố</th>
                      <th>Đã mua(Vnđ)</th>
                      <th style="width: 70px">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1?>
                    @foreach($product_order as $customer)
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td>{{ $customer['customer']['name'] }}</td>
                            <td>{{ $customer['customer']['phone'] }}</td>
                            <td>{{ $customer['customer']['district_name'] }}</td>
                            <td>{{ $customer['customer']['city_name'] }}</td>
                            <td>{{ number_format($customer['total_amount']) }}</td>
                            <td>
                                <a style="margin-right: 20px; font-size: 20px; color: black"
                                  data-toggle="tooltip" data-placement="bottom" title="Nhắn tin"
                                  href="{{URL::to('/edit-product/'.$customer['id'])}}">
  
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