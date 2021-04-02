@extends('admin.messenger')
@section('messenger_detail')

<div class="card">
	<div class="card-header msg_head">
		<div class="d-flex bd-highlight">
			<div class="img_cont">
			<img src="{{$detail['avatar']}}" class="rounded-circle user_img">
				<span class="online_icon"></span>
			</div>
			<div class="user_info">
			<span>{{$detail['display_name']}}</span>
				<p>1767 Messages</p>
			</div>
			<div class="video_cam">
				<span><i class="fas fa-video"></i></span>
				<span><i class="fas fa-phone"></i></span>
			</div>
		</div>
		<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
		<div class="action_menu">
			<ul>
				<li><i class="fas fa-user-circle"></i> View profile</li>
				<li><i class="fas fa-users"></i> Add to close friends</li>
				<li><i class="fas fa-plus"></i> Add to group</li>
				<li><i class="fas fa-ban"></i> Block</li>
			</ul>
		</div>
	</div>
		@php
			$file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        	while(! feof($file)) {
            	$token = fgets($file);
          	}
			$rUrl = 'https://openapi.zalo.me/v2.0/oa/conversation?access_token='.$token.'&data={"user_id":'.$detail['user_id'].',"offset":0,"count":10}';
			$data = json_decode(file_get_contents($rUrl), true);
			$messenger = $data['data']; 

			$messenger = collect($messenger)->sortBy('count')->reverse()->toArray();
		@endphp

		<div class="card-body msg_card_body">
		@foreach($messenger as $key=>$messenger)
			@if($messenger['from_id'] == $detail['user_id'])
				<div class="d-flex justify-content-start mb-4">
						<div class="img_cont_msg">
							<img src="{{$messenger['from_avatar']}}" class="rounded-circle user_img_msg">
						</div>
						<div class="msg_cotainer">
							@if($messenger['type']=='text')
								{{$messenger['message']}}
							@elseif($messenger['type'] == 'photo')
							<img src="{{$messenger['thumb']}}">
							@endif
							<?php $part1 = substr($messenger['time'], 0 , -3);?>  
								<span class="msg_time">{{gmdate('d/m/y', $part1)}}</span>
						</div>
					</div>
				@elseif($messenger['from_id'] != $detail['user_id'])
					<div class="d-flex justify-content-end mb-4">
					<div class="msg_cotainer_send">
						@if($messenger['type']=='text')
							{{$messenger['message']}}
						@elseif($messenger['type'] == 'photo')
							<img src="{{$messenger['thumb']}}">
						@endif
					<?php $part1 = substr($messenger['time'], 0 , -3);?>
						<span class="msg_time_send">{{gmdate('d/m/y', $part1)}}</span>
				</div>
					<div class="img_cont_msg">
				<img src="{{$messenger['from_avatar']}}" class="rounded-circle user_img_msg">
					</div>
					</div>
			@endif
		@endforeach 
    </div>
        <div class="card-footer">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                </div>
                <textarea name="txtContent" id="txtContent" class="form-control type_msg" placeholder="Type your message..."></textarea>
                <div class="input-group-append">
                    <button onclick="sent_messenger1()" class="input-group-text send_btn"> <i class="fas fa-location-arrow"></i></span> </button>
                </div>
            </div>
        </div>
</div>
<input type="text" name="txtId" id="txtId" value="{{$detail['user_id']}}" hidden/>

<script language="javascript">

    function sent_messenger1(){
        var user_id = document.getElementById('txtId').value;
		var text = document.getElementById('txtContent').value;
        var data = {
            "recipient": {
                "user_id": user_id
            },
            "message": {
                "text": text
  		}
        }

        var obj={};
        var myJSON = JSON.stringify(data);
        // console.log(myJSON);
                   
        $.ajax({
            type: "post",
            url: "https://openapi.zalo.me/v2.0/oa/message?access_token=8OuW0XjapLKZYYmE5sVEMYo38mqEQwO4Szu3DpX6u3X4yq8V3XZ1EcU3Go0cFEuWQvPKB2aU-tnSkcbS8LMF2cNv2W0z7RGBSf0HF30Wh6vgfZv493IJ51wSSGK_TieUNSneIsOeoqGUjN1rK039N2-KSNbqVUXM2DLmO6anucGyeGzkNKceMnEZ70fm5faAAxyY7c4bfIGtZIaNSYIqEH2ME2nG1eWR1PmQ4LOMgW8Oh3adMqYpApZm1IKCIg9tSlWJG5CHi547XnTcO1hsRWMgKrnH3DpLOXvymb8",
            data: myJSON,
            dataType : "json",
            contentType: "application/json; charset=utf-8",

            success: function (jqXHR, response) {
                console.log(jqXHR);
                window.location.reload();
            },
        });
    }
    $("div").scrollTop(1000);
  </script>
  
@endsection