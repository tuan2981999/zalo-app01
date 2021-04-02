@extends('admin_layout')
@section('admin_content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cập nhập đơn hàng</h4>      
            <form class="forms-sample" method="post" action="{{URL::to('/update-order')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row" style="margin-bottom: 10px">
                
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" name="txtId" id="txtId" value="{{$custumer['id']}}" hidden/>
        
                            <label for="txtName">Đơn hàng</label>
                            <input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="" readonly
                            value="{{$custumer['code']}}">
                        </div>

                        <div class="form-group">
                          <label for="slCategory">Chọn trạng thái đơn hàng</label>
                          <select class="form-control" id="txtStatus" name="txtStatus">
                                    @if($custumer['status'] == '6')
                                        <option value="6" selected>Hủy đơn</option>
                                        <option value="2">Đang xử lý</option>    
                                    @else
                                        <option value="2" selected>Đang xử lý</option>
                                        <option value="6">Hủy đơn</option>                                       
                                    @endif
                          </select>
                        </div>
        
                        <div class="form-group">
                            <label for="txtName">Vui lòng nhập lý do hủy /Hoặc yêu cầu cập nhật thông tin</label>
                            <input type="text" class="form-control" id="txtReason" name="txtReason" placeholder=""
                            value="">
                        </div>
                        
                        <div> 
                            <button type="submit" class="btn btn-primary mr-2" name="btnUpdate">Gửi yêu cầu</button>
                            <button type="button" class="btn btn-light" name="btnCancel" onclick="return cancel()">Hủy</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('backend/js/file-upload.js')}}"></script>
  <script src="{{asset('backend/js/typeahead.js')}}"></script>
  <script src="{{asset('backend/js/select2.js')}}"></script>
  
  <script language="javascript">
      function cancel(){
          document.getElementById('txtName').value = "";
          document.getElementById('txtDesc').value = "";
      }
  </script>
@endsection