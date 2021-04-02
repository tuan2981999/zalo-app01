@extends('admin_layout')
@section('admin_content')


<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('backend/js/chat.js')}}"></script>

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
        <link rel="stylesheet" href="{{asset('backend/css/chat.css')}}">
	</head>
	
	<body>
			<div class="row justify-content-center h-100">
				<div class="col-md-3 col-xl-3 chat">
					<div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-body contacts_body">
						<ui class="contacts"> 
						@foreach($id_customer as $id_customer)
							@php
									$file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
									while(! feof($file)) {
										$token2 = fgets($file);
									}
									$rUrl = 'https://openapi.zalo.me/v2.0/oa/getprofile?access_token='.$token2.'&data={"user_id":"'.$id_customer['user_id'].'"}';
									$data = json_decode(file_get_contents($rUrl), true);
									$customer2 = $data['data'];  
							@endphp
						
							@if(empty($messenger_id))
								<li>
									<a href="{{URL::to('/messenger-detail/'.$id_customer['user_id'])}}">
									<div class="d-flex bd-highlight">
										<div class="img_cont">
											<img src="{{$customer2['avatar']}}" class="rounded-circle user_img">
											<span class="online_icon"></span>
										</div>
										<div class="user_info">
											<span>{{$customer2['display_name']}}</span>
											<p>{{$customer2['display_name']}} is online</p>
										</div>
									</div>
								</a>
								</li>
							@elseif($messenger_id == $id_customer['user_id'])
								<li class="active">
									<a href="{{URL::to('/messenger-detail/'.$id_customer['user_id'])}}">
									<div class="d-flex bd-highlight">
										<div class="img_cont">
											<img src="{{$customer2['avatar']}}" class="rounded-circle user_img">
											<span class="online_icon"></span>
										</div>
										<div class="user_info">
											<span>{{$customer2['display_name']}}</span>
											<p>{{$customer2['display_name']}} is online</p>
										</div>
									</div>
								</a>
								</li> 	 
							@else
								<li>
									<a href="{{URL::to('/messenger-detail/'.$id_customer['user_id'])}}">
									<div class="d-flex bd-highlight">
										<div class="img_cont">
											<img src="{{$customer2['avatar']}}" class="rounded-circle user_img">
											<span class="online_icon"></span>
										</div>
										<div class="user_info">
											<span>{{$customer2['display_name']}}</span>
											<p>{{$customer2['display_name']}} is online</p>
										</div>
									</div>
								</a>
								</li>
							@endif
						@endforeach
						</ui>
					</div>
					<div class="card-footer"></div>
						</div></div>
						<div class="col-md-9 col-xl-9 chat">
					<section class="card">
						@yield('messenger_detail')
					</section>
				</div>
			</div>
	</body>
</html>

@endsection