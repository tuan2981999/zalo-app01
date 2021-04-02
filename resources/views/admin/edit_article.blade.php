@extends('admin_layout')
@section('admin_content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cập nhập thông tin bài viết</h4>      
            <form class="forms-sample" method="post" action="{{URL::to('/update-article')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-4">
                        <label for="txtName">Ảnh đại diện</label> 
                        <img src="{{$detail_article['cover']['photo_url']}}" width="250px"/>
                        <div class="form-group">
                            <label for="txtImage">Hình ảnh</label>
                            <input type="file" name="txtImage" id="txtImage" class="file-upload-default">
                            <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="{{$detail_article['cover']['photo_url']}}">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div> 
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" name="txtId" id="txtId" value="{{$detail_article['id']}}" hidden/>
                            <input type="text" name="txtPhoto" id="txtPhoto" value="{{$detail_article['cover']['photo_url']}}" hidden/>
                            <input type="text" name="txtPhoto2" id="txtPhoto2" value="
                            @if(isset($body_article['url']))
                            @foreach($body_article as $art)
                                {{$art['url']}}
                            @endforeach
                                @else {{('NULL')}}
                             @endif
                            " hidden/>
                            <label for="txtName">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder=""
                            value="{{$detail_article['title']}}">
                        </div>

                        <div class="form-group">
                            <label for="txtName">Trích dẫn</label>
                            <input type="text" class="form-control" id="txtDescription" name="txtDescription" placeholder=""
                            value="{{$detail_article['description']}}">
                        </div>

                        <div class="form-group">
                            <label for="txtName">Tác giả</label>
                            <input type="text" class="form-control" id="txtAuthor" name="txtAuthor" placeholder=""
                            value="{{$detail_article['author']}}">
                        </div>

                        <div class="form-group row">
                            <label for="slCategory_product" class="col-sm-3 col-form-label">Trạng thái</label>
                            <div class="col-sm-9">
                              <select id="txtStatus" name="txtStatus" class="form-control col-sm-5 form-control-lg">
                                        @if($detail_article['status'] == 'show')
                                            <option value="show">Hiển thị</option>
                                            <option value="hide">Ẩn</option>
                                        @elseif($detail_article['status'] == 'hide')
                                            <option value="hide">Ẩn</option>
                                            <option value="show">Hiển thị</option>
                                        @endif                           
                              </select>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="txtName">Nội dung</label>
                            <textarea class="form-control" id="txtDesc2" name="txtDesc2" rows="15">{{$body_article[0]['content']}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="txtName">Ảnh cuối bài viết</label>
                            <img src="
                            @if(isset($body_article['url']))
                            @foreach($body_article as $art)
                                {{$art['url']}}
                            @endforeach
                                @else {{('NULL')}}
                             @endif
                             " width="250px"/>
                        </div>

                        <div class="form-group">
                            <label for="txtImage">Hình ảnh</label>
                            <input type="file" name="txtImage2" id="txtImage2" class="file-upload-default">
                            <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="
                            @if(isset($body_article['url']))
                            @foreach($body_article as $art)
                                {{$art['url']}}
                            @endforeach
                                @else {{('NULL')}}
                             @endif">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div>
                        </div>

                        <div> 
                            <button type="submit" class="btn btn-primary mr-2" name="btnUpdate">Cập nhập bài viết</button>
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