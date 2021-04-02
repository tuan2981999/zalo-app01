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
        <h4 class="card-title">Không có API lấy danh sách status, chỉ được đăng Status mới</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    
                  </thead>
                  <tbody>
                      <?php
                      $i=1   
                      ?>
                      

                      
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