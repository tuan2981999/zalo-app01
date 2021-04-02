@extends('admin_layout')
@section('admin_content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style> 
    .search_custom{
      width: 130px;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      background-color: white;
      background-image: url('searchicon.png');
      background-position: 10px 10px; 
      background-repeat: no-repeat;
      padding: 12px 20px 12px 40px;
      -webkit-transition: width 0.4s ease-in-out;
      transition: width 0.4s ease-in-out;
    }
    
    .search_custom:focus {
      width: 120%;
    }
</style>

<style>
    .dropbtn {
      background-color:   rgb(58, 63, 80);
      color: white;
      padding: 19px;
      font-size: 20px;
      border: 1px solid wheat;
      width: 80px;
      height: 160px;
    }
    
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {background-color: #ddd;}
    
    .dropdown:hover .dropdown-content {display: block;}
    
    .dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>

<style>
    
    .modal-confirm {		
        color: #636363;
        width: 325px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px; 
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }	
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }	
    .modal-confirm .icon-box {
        color: #fff;		
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm .icon-box i {
        font-size: 58px;
        position: relative;
        top: 3px;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }
}
</style>

<style>
  
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
      $(document).ready(function(){
        var a = new Date();

        $("#total_now").text('Updated: '+a.toLocaleString());
        $("#customer_now").text('Updated: '+a.toLocaleString());
      });
        
    </script>

    <div class="row">
      <div class="col-lg-1 col-md-5">
        <div class="filter__sort">
            <div class="dropdown">
                <button class="dropbtn">Thời gian</button>
                    <div class="dropdown-content">
                        <a href="{{URL::to('/7-days-shop')}}">7 Ngày</a>
                        <a href="{{URL::to('/30-days-shop')}}">30 Ngày</a>
                        <a href="{{URL::to('/365-days-shop')}}">1 Năm</a>
                        <a href="{{URL::to('/all-days-shop')}}">Tất cả</a>
                    </div>
            </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin">
          <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Tổng giao dịch</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">
                              
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small id="total_now" class="ml-1 mb-0"></small>
                            </div>
                        </div>

                        ----------
                        {{-- <small class="text-gray">Tổng đơn hàng: {{number_format($total->total_transaction)}}</small> --}}
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-shopping-cart text-danger icon-lg"></i>                                    
                    </div>
                </div>
            </div>
          </div>
      </div>

      <div class="col-md-5 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">khách hàng</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">
                              <?php $i=0 ?>
                              @foreach($product_order as $customer)
                                <?php $i++ ?>
                              @endforeach 
                              <?php echo $i ?>
                            </h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small id="customer_now" class=" ml-1 mb-0"></small>
                            </div>
                        </div>
                        <small class="text-gray">----</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fa fa-user text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Khách hàng</h4>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr class="bg-primary text-white">
                          <th>#</th>
                          <th style = "width: 20%">Tên</th>
                          <th>Điện thoại</th>
                          <th style = "width: 40%">Địa chỉ</th>
                          <th>Tổng tiền</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i=1   
                        ?>
                      @foreach($product_order as $customer)
                          <tr>
                            <td><?php echo $i++ ?></td>
                            <td>{{ $customer['customer']['name'] }}</td>
                            <td>{{ $customer['customer']['phone'] }}</td>
                            <td>{{ $customer['customer']['district_name'] }}
                               - {{ $customer['customer']['city_name'] }}</td>
                            <td>{{ number_format($customer['total_amount']) }}</td>
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
    </div>

    <script src="{{asset('public/backend/js/data-table.js')}}"></script>

@endsection