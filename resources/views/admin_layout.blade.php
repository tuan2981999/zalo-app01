<!DOCTYPE html>
<html lang="en">
 

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Zalo Shop Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('backend/vendors/iconfonts/font-awesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('backend/vendors/css/vendor.bundle.addons.css')}}">

  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="http://www.urbanui.com/" />

  <link rel="shortcut icon" href="{{asset('backend/images/zalo.jpg')}}" />

  <style>
      span.help-block.form-error {
          margin-left: 250px;
          color: red;
          font-weight: bold;
      }

      body{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 26px;
      }
  </style>

</head>

@php 
			                    $message = Session::get('message');

			                    if ($message){
                            echo '<script>
                                alert("'.$message.'");
                              </script>';

                              Session::put('message', null);   
			                    }
                        @endphp
                        
<body class="sidebar-dark">
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar navbar-success">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="https://www.thietkewebct.com/contact/"><img src="{{asset('backend/images/optimus.jpg')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="buttpublic/backend/on" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-flex">
            <a class="nav-link" href="#">
              <span class="btn btn-primary">+ Create new</span>
            </a>
          </li>
          <li class="nav-item dropdown d-none d-lg-flex">
            <div class="nav-link">
              <span class="dropdown-toggle btn btn-outline-dark" id="languageDropdown" data-toggle="dropdown">English</span>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item font-weight-medium" href="#">
                  French
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Espanol
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Latin
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Arabic
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="fas fa-bell mx-0"></i>
              <span class="count">16</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 16 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-danger">
                    <i class="fas fa-exclamation-circle mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="fas fa-wrench mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="far fa-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-envelope mx-0"></i>
              <span class="count">25</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="{{URL::to('backend/images/zalo.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="backend/images/zalo.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="backend/images/zalo.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
         
         
          @php
                $xml=simplexml_load_file(storage_path("app/public/login_zalo/login.xml")) or die("Error: Cannot create object");
                $uid = $xml->uid->data;
                $code = $xml->code->data;
                if($uid != 1){
                    $rUrl = 'https://oauth.zaloapp.com/v3/access_token?app_id=119611120980630055&app_secret=Fm2o0RLAX95pSX36oPV6&code='.$code;
                    $data = json_decode(file_get_contents($rUrl), true);
                    $access_token=$data['access_token'];
                    
                    $rUrl2 = 'https://graph.zalo.me/v2.0/me?access_token='.$access_token.'&fields=id,birthday,name,gender,picture';
                    $data2 = json_decode(file_get_contents($rUrl2), true);
                    $account_detail = $data2;
                }
          @endphp
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              @if(!empty($account_detail['picture']['data']['url']))
                <img src="{{$account_detail['picture']['data']['url']}}" alt="profile"/>
              @else
                <img src="{{URL::to('backend/images/zalonull.jpg')}}" alt="profile"/>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              @if(!empty($account_detail['picture']['data']['url']))
                <a class="dropdown-item" href="{{URL::to('/account-detail')}}">
                  <i class="fa fa-user text-primary"></i>
                  {{$account_detail['name']}}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{URL::to('/logout-zalo')}}">
                  <i class="fas fa-power-off text-primary"></i>
                  Đăng xuất
                </a>
              @else
                <a class="dropdown-item" href="{{URL::to('/login-zalo-2')}}">
                  <i class="fa fa-user text-primary"></i>
                  Đăng nhập
                </a>
              @endif
            </div>
          </li>
         
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="fas fa-ellipsis-h"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
              <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="backend/images/zalo.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="backend/images/zalo.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="backend/images/zalo.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="backend/images/zalo.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="backend/images/zalo.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="backend/images/zalo.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{URL::to('backend/images/avatar2.jpg')}}"/>
              </div>
              <div class="profile-name">
                <p class="name">Optimus Cần Thơ
                   <?php echo Session::get('user_name')?>
                </p>
                <p class="designation" style="font-weight: bold; font-size: 14px">
                



                </p>
              </div>
            </div>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/dashboard')}}">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Trang chủ</span>
            </a>
          </li>
             
          <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/messenger')}}">
              <i class="fa fa-comment menu-icon"></i>
              <span class="menu-title">Nhắn tin</span>
            </a>
          </li>

          

          
          

          
        
 
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#inventory" aria-expanded="false" aria-controls="revenue">
              <i class="fa fa-bookmark menu-icon"></i>
              <span class="menu-title">Quản lý bài viết</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="inventory">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/add-article')}}">Thêm bài viết</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/all-article')}}">Danh sách bài viết</a></li>
              </ul>
            </div>
          </li>  

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#custumers" aria-expanded="false" aria-controls="custumers">
              <i class="fa fa-address-card menu-icon"></i>
              <span class="menu-title">Quản lý khách hàng</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="custumers">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/all-followers')}}">Danh sách người quan tâm</a></li>                
              </ul>
            </div>
          </li>  
    
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#broadcast" aria-expanded="false" aria-controls="broadcast">
              <i class="fa fa-paper-plane menu-icon"></i>
              <span class="menu-title">Broadcast</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="broadcast">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/sent-broadcast')}}">Gửi broadcast bài viết</a></li>    
                {{-- <li class="nav-item"> <a class="nav-link" href="{{URL::to('/add-shipping-fee')}}">Thêm phí vận chuyển</a></li>             --}}
              </ul>
            </div>
        </li>    

        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="broadcast">
            <i class="fa fa-hourglass-end menu-icon"></i>
            <span class="menu-title">Đồng bộ sản phẩm</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="setting">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('/link-sync')}}">Cấu hình đồng bộ</a></li>    
              <!-- <li class="nav-item"> <a class="nav-link" href="{{URL::to('/product-sync')}}">Đồng bộ sản phẩm</a></li>             -->
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#chatbot" aria-expanded="false" aria-controls="broadcast">
            <i class="fa fa-reply-all menu-icon"></i>
            <span class="menu-title">Chatbot</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="chatbot">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('/config-chatbot-script')}}">Cấu hình kịch bản</a></li>    
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('/config-chatbot-more')}}">Thư viện ý định</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('/config-chatbot-time')}}">Cấu hình thời gian trả lời</a></li>            
            </ul>
          </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#token" aria-expanded="false" aria-controls="token">
              <i class="fa fa-cog menu-icon"></i>
              <span class="menu-title">Cài đặt</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="token">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-token')}}">Quản lý mã Token</a></li>    
                {{-- <li class="nav-item"> <a class="nav-link" href="{{URL::to('/add-shipping-fee')}}">Thêm phí vận chuyển</a></li>             --}}
              </ul>
            </div>
          </li>  

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="token">
              <i class="fa fa-user menu-icon"></i>
              <span class="menu-title">Tường nhà</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="account">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-status')}}">Danh sách Status</a></li>    
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-friend')}}">Danh sách bạn bè</a></li>            
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('/account-detail')}}">Thông tin cá nhân</a></li> 
              </ul>
            </div>
          </li>

 
        </ul>
      </nav>
      <!-- partial -->
          <section class="main-panel">
              <section class="content-wrapper">
                  @yield('admin_content')
              </section>
              {{-- <section class="content-wrapper">
                @yield('messenger_detail')
            </section> --}}
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
          </div>

        </footer>
        <!-- partial -->
        </section>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('backend/vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('backend/js/off-canvas.js')}}"></script>
  <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('backend/js/misc.js')}}"></script>
  <script src="{{asset('backend/js/settings.js')}}"></script>
  <script src="{{asset('backend/js/todolist.js')}}"></script>
  <script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>

  <script>
    CKEDITOR.replace('txtDesc');
  </script>

  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('backend/js/dashboard.js')}}"></script>
  
  <!-- End custom js for this page-->

  <script src="{{asset('backend/js/tooltips.js')}}"></script>
  <script src="{{asset('backend/js/popover.js')}}"></script>
  <script src="{{asset('backend/js/data-table.js')}}"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <script src="{{asset('backend/js/jquery.form-validator.min.js')}}"></script>
  
  <script>
    $.validate({
      //modules : 'location, date, security, file'
    });
  </script>
  
</body>
</html>
