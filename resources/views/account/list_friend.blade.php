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
        <h4 class="card-title">Danh sách bạn bè</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr class="bg-primary text-white">
                        <th>#</th>
                        <th>Ảnh đại diện</th> 
                        <th>Tên</th>
                        <th style="width: 130px">Giới tính</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $i=1 ?>
                      @foreach($list_friend as $list_friend)
                      <tr>
                          <td><?php echo $i++ ?></td>
                          <td><img src="{{$list_friend['picture']['data']['url']}}" width="70px" height="70px"/></td>
                          <td>{{ $list_friend['name'] }}</td>
                          <td>{{ $list_friend['gender'] }}</td>
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