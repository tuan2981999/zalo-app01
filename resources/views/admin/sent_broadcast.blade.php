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
        <h4 class="card-title">Chọn bài viết gửi broadcast</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th style="width: 5%">#</th>
                      <th>Ngày xuất bản</th> 
                      <th>Ảnh đại diện</th>
                      <th style="width: 130px">Tên bài viết</th>
                      <th>Lượt xem</th>
                      <th>Trạng thái</th>
                      <th style="width: 13%">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach($all_article as $all_article)
                        @php
                          $rUrl = 'https://openapi.zalo.me/v2.0/article/getdetail?access_token='. $token.'&offset=0&limit=10&type=normal&id='.$all_article['id'].'';
                          $data = json_decode(file_get_contents($rUrl), true);
                          $detail_article = $data['data'];
                          $body_article = $data['data']['body'];
                        @endphp
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <?php $part1 = substr($all_article['create_date'], 0 , -3);?>  
                            <td>{{gmdate('d/m/y', $part1)}}</td>
                            <td><img src="{{$all_article['thumb']}}" width="70px" height="70px"/></td>
                            <td>{{$all_article['title']}}</td>
                            <td>{{$all_article['total_view']}}</td>

                            <td>
                              @if($all_article['status'] == 'hide')
                                <p class="badge badge-danger">Ẩn</p>
                              @elseif($all_article['status'] == 'show')
                                <p class="badge badge-success" >Hiển thị</p>
                              @endif
                            </td>

                            <td>
                              @if($all_article['status'] == 'hide')
                                <p>Không được gửi</p>
                              @elseif($all_article['status'] == 'show')
                                <a style="margin-right: 20px; font-size: 20px; color: black"
                                data-toggle="tooltip" data-placement="bottom" title="Gửi"
                                href="{{URL::to('/detail-broadcast/'.$all_article['id'])}}">
                                <i class="fa fa-envelope"></i>
                                </a>
                              @endif                                 
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