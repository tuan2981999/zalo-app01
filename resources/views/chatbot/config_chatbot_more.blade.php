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
        <h4 class="card-title">Thư viện ý định</h4>
        <form class="form" action="{{URL::to('/save-chatbot-more')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Ý định chính</label>
            <div class="col-sm-9">
              <select id="txtScriptIntent" name="txtScriptIntent" class="form-control col-sm-5 form-control-lg">
                  @foreach($script as $script)
                    <option value="{{$script->script_intent}}">{{$script->script_intent}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Thư viện so sánh</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" id="txtListQuestion[]" name="txtListQuestion[]" placeholder="" value=""
              data-validation="length" 
              data-validation-length="1-200" 
              data-validation-error-msg="Không được để trống">
            <input type="text" class="form-control" id="txtListQuestion[]" name="txtListQuestion[]" placeholder="" value=""
              data-validation="length" 
              data-validation-length="1-200" 
              data-validation-error-msg="Không được để trống">
            <input type="text" class="form-control" id="txtListQuestion[]" name="txtListQuestion[]" placeholder="" value=""
              data-validation="length" 
              data-validation-length="1-200" 
              data-validation-error-msg="Không được để trống">
            <input type="text" class="form-control" id="txtListQuestion[]" name="txtListQuestion[]" placeholder="" value=""
              data-validation="length" 
              data-validation-length="1-200" 
              data-validation-error-msg="Không được để trống">
            </div>
          </div>
      
          <button type="submit" class="btn btn-primary mr-2">Thêm thư viện so sánh</button>
          <button type="button" class="btn btn-light">Hủy</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Danh sách thư viện ý định</h4>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                      <th>#</th>
                      <th>Ý định chính</th>
                      <th>Thư viện so sánh</th>
                      <th>Thao tác</th>
                  </tr>
                </thead>
                <?php $i=0 ?>
                <tbody>
                  @foreach($list_intent as $list_intent)
                      <tr>
                        <td><?php echo $i++?></td>
                        <td>{{$list_intent->intent}}</td>
                        <td contenteditable class="save_chatbot_more" data-intent_id="{{$list_intent->id}}">
                          {{$list_intent->list_question}}</td>
                        <td>
                          <a style="font-size: 20px; margin-right: 20px; color: red"
                            data-toggle="tooltip" data-placement="bottom" title="Xóa ý định" href="{{URL::to('/delete-chatbot-more/'.$list_intent->id)}}">
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
    $(document).on('blur', '.save_chatbot_more', function(){
      var intent_id = $(this).data('intent_id');
      var list_question = $(this).text();
      
      $.ajax({
          type: "get",
          url: "https://tay.thuctapoptimus.xyz/public/update-chatbot-more",
          data: {
            intent_id: intent_id,
            list_question: list_question
          }, 
          success: function (response) {
          }
      });
    });
  </script>

@endsection