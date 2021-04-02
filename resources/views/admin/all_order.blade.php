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
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Quản lý đơn hàng</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>#</th>
                      <th>Đơn hàng</th>
                      <th>Tổng giá trị SP</th>
                      <th>Phí vận chuyển</th>
                      <th>Khách hàng</th>
                      <th>Trạng thái ĐH</th>
                      <th>Trạng thái TT</th>
                      <th style="width: 10%">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1?>
                  @foreach ($product_order as $tran)
                      <tr>
                        <td><?php echo $i++ ?></td>
                        <td><span style="color:red">{{$tran['code']}}</span>
                          <?php $part1 = substr($tran['created_time'], 0 , -3);?>  
                            {{gmdate('d/m/y H:i:s', $part1)}}
                        </td>
                        <td>{{number_format($tran['total_amount'])}}</td>
                        <td>------</td>
                        <td>{{$tran['customer']['name']}}/
                            {{$tran['customer']['phone']}}
                        </td>
                        <td>
                          @if($tran['status'] == 1)
                            <span style="color:rgb(0, 255, 13)">Đơn hàng mới</span>
                          @elseif($tran['status'] == 2)
                            <span style="color:rgb(229, 255, 0) ">Đang xử lý</span>
                          @elseif($tran['status'] == 3)
                            <span style="color:rgb(125, 189, 201) ">Đã xác nhận</span>
                          @elseif($tran['status'] == 4)
                            <span style="color:rgb(84, 85, 7) ">Đang giao hàng</span>
                          @elseif($tran['status'] == 5)
                            <span style="color:blue ">Đã giao hàng</span>
                          @elseif($tran['status'] == 6)
                            <span style="color:rgb(243, 39, 39) ">Đã bị hủy</span>
                          @elseif($tran['status'] == 7)
                            <span style="colorr: Red ">Giao thất bại</span>
                          @endif
                        </td>
                        <td>
                          @if($tran['payment']['method'] == 1)
                          Thanh toán khi nhận hàng
                          @elseif($tran['payment']['status'] == 0)
                          Khác
                          @endif
                        </td>
                        <td>
                          <a class="btn btn-light" href="{{URL::to('/order-detail/'.$tran['id'])}}">
                            <i class="fa fa-eye text-primary"></i>Chi tiết
                          </a>

                          <a class="btn btn-light" href="{{URL::to('/edit-order/'.$tran['id'])}}"
                            onclick="return confirm('Bạn có chắc muốn cập nhật hoặc hủy đơn này?')">
                            <i class="fa fa-times text-danger"></i>Trả lời/or  Hủy
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
</div>  

  <script src="{{asset('backend/js/data-table.js')}}"></script>

@endsection