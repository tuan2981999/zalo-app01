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
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <form class="form" action="{{URL::to('/save-category')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <h4>{{$detail_article['title']}}</h4>
          <p style="color:green">{{$detail_article['description']}}<p>

            @if ($detail_article['status'] == 'show')
                <p>Trạng thái:<span style="color:orange"> Hiển thị</span></p>
            @elseif($detail_article['status'] == 'show')
                <p>Trạng thái:<span style="color:Red"> Ẩn</span></p>                
            @endif

            @foreach($body_article as $body)
                @if($body['type'] == 'text')
                    <p><?php echo htmlspecialchars_decode($body['content']);?></p>
                @elseif($body['type']=='image')
                    <img src="{{$body['url']}}">
                @endif
            @endforeach
        </form>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('backend/js/file-upload.js')}}"></script>
  <script src="{{asset('backend/js/typeahead.js')}}"></script>
  <script src="{{asset('backend/js/select2.js')}}"></script>

@endsection