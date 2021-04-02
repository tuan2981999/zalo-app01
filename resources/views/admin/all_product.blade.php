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
        <h4 class="card-title">Danh sách sản phẩm</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>Hình ảnh</th>
                      <th>Mã SP</th>
                      <th style="width: 25%">Tên sản phẩm</th>
                      <th>Giá(Vnđ)</th>
                      <th>Số lượng</th>
                      <th>Trạng thái</th>
                      <th>Tình trạng duyệt</th>
                      <th style="width: 16%">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($product as $data)
                        <tr>
                            <td><img src="{{$data['photo_links'][0]}}" width="70px" height="70px"/></td>
                            <td>{{ $data['code'] }}</td>
                            <td>{{ $data['name'] }}</td>
                            <td>
                                @php  
                                    if($data['price']>0){
                                      echo(number_format($data['price']));
                                    }else {
                                      echo"Liên hệ";
                                    }
                                @endphp
                            </td>
                            <td>{{ $data['quantity'] }}</td>
                            <td>
                                @if($data['status'] == 'hide')
                                  <p class="badge badge-danger">Ẩn</p>
                                @elseif($data['status'] == 'show')
                                  <p class="badge badge-success" >Hiển thị</p>
                                @endif
                            </td>
                            <td>
                              <?php
                                  if($data['review_status']=='approve'){?>
                                    <span style="color:Blue">Duyệt</span>
                                  <?php }elseif($data['review_status']=='review'){?>
                                    <span style="color:black">Chờ duyệt</span>   
                                  <?php   }
                                    else {?>
                                    <span style="color:red">Từ chối duyệt</span>
                               <?php }?>
                            </td>
                            <td>
                                <a style="margin-right: 20px; font-size: 20px; color: black"
                                  data-toggle="tooltip" data-placement="bottom" title="Chỉnh sửa sản phẩm"
                                  href="{{URL::to('/edit-product/'.$data['id'])}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
   
                                <a style="font-size: 20px; margin-right: 20px; color: red" onclick="del()" 
                                  data-toggle="tooltip" data-placement="bottom" title="Xóa sản phẩm">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <input type="text" name="txtId" id="txtId" value="{{$data['id']}}" hidden/>

                                <script language="javascript">
                                  function del(){
                                    if (confirm("Bạn có chắc chắn xóa!")) {
                                      var data = {
                                        "id":document.getElementById('txtId').value
                                       }
                                      // console.log(data);
                                      var obj={};
                                      var myJSON = JSON.stringify(data);
                                      // console.log(myJSON);
                   
                                      $.ajax({
                                          type: "post",
                                          url: "https://openapi.zalo.me/v2.0/store/product/remove?access_token=K3mHI4XUvH1IE1r4H5tc7rqn4aTTCfeQ1XSr81W0dIvlUMCSAchSDczoPdOL4z1CS1DpHsmnsKClFo10O5crP7jLCL0lLvbGHqqYTpXTWYClFduMSmNa7YeYMKitGkOLNNiO54OQkq4T01npOnMuSomN6YvMB9GcBnivAKbxXJS-JZbiVrx3KYSpK51dKwflEb45QdKyep826YeK6NlG4sHSSaaiPjziOteWJ0DeW4uK2tXHLMlhMICI7r9q4vaF3pGt860tYHqX9Ga6NqYZCmDvDIT2RubxHYvKp6rDHkeN",
                                          data: myJSON,
                                          dataType : "json",
                                          contentType: "application/json; charset=utf-8",

                                          success: function (jqXHR, response) {
                                              console.log(jqXHR);
                                              window.location.reload();
                                          },
                                      }); 
                                      } else {
                                        alert("Đã hủy lựa chọn!");
                                        }
                                  }
                                </script>
                                <a style="font-size: 20px; color: rgb(9, 9, 95)" 
                                  data-toggle="tooltip" data-placement="bottom" title="Sao chép sản phẩm"
                                  href="{{URL::to('/copy-product/'.$data['id'])}}">
                                    <i class="fa fa-clone"></i>
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