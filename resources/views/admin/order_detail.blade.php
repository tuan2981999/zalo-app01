@extends('admin_layout')
@section('admin_content')

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Chi tiết đơn hàng: <span style="color:red">{{$custumer['code']}}</span> - {{number_format($custumer['total_amount'])}}đ</h4>
                  @if($custumer['status'] == '6')
                      <span style="color:green">Đã bị hủy - {{$custumer['cancel_reason']}}</span>
                  @else
                      <span style="color:blue">Đang xử lý </span>                          
                  @endif   
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr class="bg-primary text-white">
                        <th>Hình ảnh</th>
                        <th style="width:45%">Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order_detail as $order)
                        <tr>
                            <td><img src="{{$order['image']}}" width="70px" height="70px"/></td>
                            <td>{{$order['name']}}</td>
                            <td>{{number_format($order['price'])}}</td>
                            <td>{{$order['quantity']}}</td>
                            <td>{{number_format($order['quantity']*$order['price'])}}</td>
                        </tr>
                    @endforeach
                  </tbody> 
                </table>

                <table id="order-listing" class="table">
                  <thead>
                    <tr class="bg-primary text-white">
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th style="width:30%">Địa chỉ</th>
                        <th>Quận</th>
                        <th>Thành phố</th>
                    </tr>
                  </thead>
                  <tbody>
                        <tr>
                            <td>{{$custumer['customer']['name']}}</td>
                            <td>{{$custumer['customer']['phone']}}</td>
                            <td>{{$custumer['customer']['address']}}</td>
                            <td>{{$custumer['customer']['district_name']}}</td>
                            <td>{{$custumer['customer']['city_name']}}</td>
                        </tr>
                  </tbody> 
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
 
  <script src="{{asset('backend/js/data-table.js')}}"></script>

@endsection