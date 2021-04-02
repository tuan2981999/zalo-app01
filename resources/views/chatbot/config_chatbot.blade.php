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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
      $(document).ready(function(){
        var a = new Date();

        $("#total_now").text('Updated: '+a.toLocaleString());
        $("#customer_now").text('Updated: '+a.toLocaleString());
      });
        
    </script>
      
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cấu hình kịch bản</h4>
        <form class="form" action="{{URL::to('/save-chatbot')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Ý định</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" id="txtIntent" name="txtIntent" placeholder="" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Trả lời</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="txtReply" name="txtReply" placeholder="" value="">
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary mr-2">Thêm kịch bản</button>
          <button type="button" class="btn btn-light">Hủy</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Danh sách kịch bản</h4>

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>#</th>
                      <th style="width: 20%">Ý định</th>
                      <th style="width: 60%">Câu trả lời</th>
                      <th>Thao tác</th>
                  </tr>
                </thead>
                <?php $i=0 ?>
                <tbody>
                    @foreach($script as $script)
                      <tr>
                        <td><?php echo $i++?></td>
                        <td>{{$script->script_intent}}</td>
                        <td contenteditable class="save_chatbot" data-script_id="{{$script->id}}">
                          {{$script->script_reply}}
                        </td>
                        
                        <td>
                          <a style="font-size: 20px; margin-right: 20px; color: red"
                            data-toggle="tooltip" data-placement="bottom" title="Xóa kịch bản" href="{{URL::to('/delete-chatbot/'.$script->id)}}">
                              <i class="fas fa-trash"></i>
                          </a>
                      </td>
                      </tr>
                    @endforeach
                </tbody>
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
  <script src="{{asset('public/backend/js/data-table.js')}}"></script>
  
  <script>
    $(document).on('blur', '.save_chatbot', function(){
      var script_id = $(this).data('script_id');
      var script_intent = $(this).text();
  
      $.ajax({
          type: "get",
          url: "https://tay.thuctapoptimus.xyz/public/update-chatbot",
          data: {
            script_id: script_id,
            script_intent: script_intent
          }, 
          success: function (response) {
          }
      }); 
      
    });
  </script>

@endsection 