@extends('admin_layout')
@section('admin_content')


<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Đối tượng gửi Broadcast</h4>
            <form class="forms-sample" method="post" action="{{URL::to('/sent-to-broadcast/'.$detail_article['id'])}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-4"> 
                    <img src="{{$detail_article['cover']['photo_url']}}" width="290px"/>
                    <b><span style="font-size: 16px"> </br>{{$detail_article['title']}}</span></b>
                    </div>      

                    <div class="col-sm-8">
                        <div class="form-group">
                            <b><label for="txtName">Độ tuổi</label></b>
                            <label class="container">
                                <input type="checkbox" name="ages[]" id="ages" value="1" checked="checked">
                                <span class="checkmark"> Dưới 18 </span>
                                                                                  
                                <input type="checkbox" name="ages[]" id="ages" value="2" checked="checked">
                                <span class="checkmark" style="color:#04B76B">18-24</span>
                                                       
                                <input type="checkbox" name="ages[]" id="ages" value="3" checked="checked">
                                <span class="checkmark">25-34</span>
                               
                                <input type="checkbox" name="ages[]" id="ages" value="4" checked="checked">
                                <span class="checkmark" style="color: #04B76B">35-44</span>
                                                                                  
                                <input type="checkbox" name="ages[]" id="ages" value="5" checked="checked">
                                <span class="checkmark">45-54</span>
                                                       
                                <input type="checkbox" name="ages[]" id="ages" value="6" checked="checked">
                                <span class="checkmark" style="color: #04B76B">55-64</span>
                                
                                <input type="checkbox" name="ages[]" id="ages" value="7" checked="checked">
                                <span class="checkmark">Trên 64</span>        
                                
                            </label>  
                        </div>
                        <div class="form-group">
                            <b><label for="txtName">Giới tính</label></b>
                            <label class="container">
                                <input type="radio" name="gender" id="gender" value="0" checked="checked">
                                <span class="checkmark"> Tất cả</span>
                               
                                <input type="radio" name="gender" id="gender" value="1">
                                <span class="checkmark"> Nam</span>
                              
                                <input type="radio" name="gender" id="gender" value="2">
                                <span class="checkmark">Nữ</span>
                                
                              </label>
                        </div>
                        <div class="form-group">
                            <b><label for="txtName">Nền tảng thiết bị</label></b>
                            <label class="container">
                                <input type="checkbox" name="platforms[]" id="platforms" value="1" checked="checked">
                                <span class="checkmark">Android</span>
                                
                                <input type="checkbox" name="platforms[]" id="platforms" value="2" checked="checked">
                                <span class="checkmark">IOS </span>
                                                   
                                <input type="checkbox" name="platforms[]" id="platforms" value="3" checked="checked">
                                <span class="checkmark">Nền tảng khác</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <b><label for="txtName">Vị trí</label></b>
                            <label class="container">
                                <input type="checkbox" name="locations[]" id="locations" value="0" checked="checked">
                                <span class="checkmark">Miền Bắc </span>
                                
                                <input type="checkbox" name="locations[]" id="locations" value="1" checked="checked">
                                <span class="checkmark">Miền Trung </span>
                                                   
                                <input type="checkbox" name="locations[]" id="locations" value="2" checked="checked">
                                <span class="checkmark">Miền Nam </span>
                            </label>
                        </div>
                            
                        <div> 
                            <button type="submit" class="btn btn-primary mr-2" name="btnUpdate">Gửi Broadcast</button>
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