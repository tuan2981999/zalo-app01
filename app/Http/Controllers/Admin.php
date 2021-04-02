<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Cart;
use Mail;
use App\Social; 
use Socialite; 
use App\Login;
use Zalo\Zalo;


session_start();

class Admin extends Controller
{   
    public function dashboard(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }
        $rUrl = 'https://openapi.zalo.me/v2.0/store/order/getorderofoa?access_token='. $token.'&offset=0&limit=10';
        $data = json_decode(file_get_contents($rUrl), true);
        $ms = $data['error'];
        $ms_content = $data['message'];
        if($ms == 0)
            {
                $product_order = $data['data']['orders'];
                return view('dashboard', ['product_order'=>$product_order]);
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/list-token');
            } 
    }

    //zalo
    public function login_zalo(){
        
    } 

    public function login_to_admin(){
        return view('admin_layout');        
    }

    //product
    // public function add_product(){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $rUrl = 'https://openapi.zalo.me/v2.0/store/category/getcategoryofoa?access_token='. $token.'&offset=0&limit=10';
    //     $data = json_decode(file_get_contents($rUrl), true);
       
    //     $ms = $data['error'];
    //     $ms_content = $data['message'];
    //     if($ms == 0)
    //         {
    //             $category_product = $data['data']['categories'];
    //             $rUrl = 'https://openapi.zalo.me/v2.0/store/getindustry?access_token='.$token.'';
    //             $data2 = json_decode(file_get_contents($rUrl), true);
    //             $industry = $data2['data']['industries'];
    //             return view('admin.add_product', ['category_product'=>$category_product], ['industry'=>$industry]); 
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/list-token');
    //         }        
    // }

    // public function all_product(){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $rUrl = 'http://openapi.zalo.me/v2.0/store/product/getproductofoa?access_token='. $token.'&offset=0&limit=20';
    //     $data = json_decode(file_get_contents($rUrl), true);
       
    //     $ms = $data['error'];
    //     $ms_content = $data['message'];
    //     if($ms == 0)
    //         {
    //             $product = $data['data']['products'];
    //             return view('admin.all_product', ['product'=>$product]);
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/list-token');
    //         } 
    // }
 
    // public function edit_product($product_id){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $rUrl = 'https://openapi.zalo.me/v2.0/store/product/getproduct?access_token='. $token.'&id='.$product_id.'';
    //     $data = json_decode(file_get_contents($rUrl), true);
    //     $detail_product = $data['data'];
    //     return view('admin.edit_product', ['detail_product'=>$detail_product], ['token'=>$token]);
    // }

    // public function save_product(Request $rq){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }
    //     $get_image = $rq->file('txtImage');  
    //     if($get_image){ 
    //         $file_Name = "test.jpg";
    //         $path = $rq ->file('txtImage')->move(storage_path("app/public"), $file_Name);
    //         $photo_URL = storage_path("app/public/".$file_Name);
    //         $photo = fopen($photo_URL, 'r');
    //         $response = Http::attach(
    //             'file', $photo
    //         )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=product');
            
    //         $data = json_decode($response, true);
    //         $image_id = $data['data']['id'];
    //     }
    //     else{
    //         $photo = fopen($rq->txtIdphoto, 'r');
    //         $response = Http::attach(
    //             'file', $photo
    //         )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=product');
            
    //         $data = json_decode($response, true);
    //         $image_id = $data['data']['id'];
    //     }
    //     $response2 = Http::post('https://openapi.zalo.me/v2.0/store/product/create?access_token='. $token.'', [
    //         'name'=> $rq->txtName,
    //         'code' => $rq->txtCode,
    //         'price' => $rq->txtPrice,
    //         'quantity' => $rq->txtQuantity,
    //         'industry' => $rq->industry3,
    //         'description' => $rq->txtDesc,
    //         'photos' => [$image_id],
    //         'package_size' => ['weight'=>$rq->txtWeight],
    //         'categories' => [$rq->Categories]
            
    //     ]);
    //     $message = json_decode($response2, true);
    //     $ms = $message['error'];
    //     $ms_content = $message['message'];
        
    //     if($ms == 0)
    //         {
    //             Session::put('message', 'Thêm sản phẩm thành công');
    //             return Redirect::to('/all-product');
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/add-product');
    //         }  
    // }
 
    // public function update_product(Request $rq){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $get_image = $rq->file('txtImage');

    //     if($get_image){
    //         $file_Name = "test2.jpg";
    //         $path = $rq ->file('txtImage')->move(storage_path("app/public"), $file_Name);
    //         $photo_URL = storage_path("app/public/".$file_Name);
    //         $photo = fopen($photo_URL, 'r');
    //         $response = Http::attach(
    //             'file', $photo
    //         )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=product');
    //         $data = json_decode($response, true);
    //         $image_id = $data['data']['id'];
    //         $photo_new = $image_id;
    //     }
    //     else{
    //         $photo_new = $rq->txtIdphoto;
    //     }
    //     $response2 = Http::post('https://openapi.zalo.me/v2.0/store/product/update?access_token='. $token.'', [
    //         'id' => $rq->txtId,
    //         'name' => $rq->txtName,
    //         'price' => $rq->txtPrice,
    //         'code' => $rq->txtCode,
    //         'quantity' => $rq->txtQuantity,
    //         'industry' => $rq->txtIndustry,
    //         'status' => $rq->txtStatus,
    //         'package_size' => ['weight'=>$rq->txtWeight],
    //         'description' => $rq->txtDesc,
    //         'photos' => [$photo_new],
    //         'categories' => [$rq->txtCategories]           
    //     ]);

    //     $message = json_decode($response2, true);
    //     $ms = $message['error'];
    //     $ms_content = $message['message'];
        
    //     if($ms == 0)
    //         {
    //             Session::put('message', 'Cập nhật sản phẩm thành công');
    //             return Redirect::to('/all-product');
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/all-product');
    //         }  
    // }
 
    // public function copy_product($product_id){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $rUrl = 'https://openapi.zalo.me/v2.0/store/product/getproduct?access_token='. $token.'&id='.$product_id.'';
    //     $data = json_decode(file_get_contents($rUrl), true);
    //     $detail_product = $data['data'];
    //     return view('admin.copy_product', ['detail_product'=>$detail_product], ['token'=>$token]);
    // }



    //category
    public function all_category(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/store/category/getcategoryofoa?access_token='. $token.'&offset=0&limit=10';

        $data = json_decode(file_get_contents($rUrl), true);
        $ms = $data['error'];
        $ms_content = $data['message'];
        if($ms == 0)
            {
                $category = $data['data']['categories'];
                return view('admin.all_category', ['category'=>$category]);
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/list-token');
            } 
    }

    // public function add_category(){   
    //     return view('admin.add_category');
    // }

    // public function save_category(Request $rq){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $file_Name = "test2.jpg";
    //     $path = $rq ->file('txtImage')->move(storage_path("app/public"), $file_Name);
    //     $photo_URL = storage_path("app/public/".$file_Name);

    //     $photo = fopen($photo_URL, 'r');
    //     $response = Http::attach(
    //         'file', $photo
    //     )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=category');
        
    //     $data = json_decode($response, true);
    //     $image_id = $data['data']['id'];
      
    //     $response2 = Http::post('https://openapi.zalo.me/v2.0/store/category/create?access_token='. $token.'', [
    //         'name'=> $rq->txtName,
    //         'description' => $rq->txtDesc2,
    //         'photo' => $image_id,
    //         'status' => $rq->txtStatus            
    //     ]);
    //     $message = json_decode($response2, true);
    //     $ms = $message['error'];
    //     $ms_content = $message['message'];
        
    //     if($ms == 0)
    //         {
    //             Session::put('message', 'Thêm danh mục thành công');
    //             return Redirect::to('/all-category');
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/add-category');
    //         }  
    // }

    // public function edit_category($category_id, $name, $desc, $photo_link, $status, $photo){
        
    //     return view('admin.edit_category', 
    //     ['category'=>$category_id,
    //     'name'=>$name,
    //     'desc'=>$desc,
    //     'photo_link'=>$photo_link,
    //     'status'=>$status,
    //     'photo'=>$photo
    //     ]);
    // }

    // public function update_category(Request $rq){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $get_image = $rq->file('txtImage');

    //     if($get_image){
    //         $file_Name = "test2.jpg";
    //         $path = $rq ->file('txtImage')->move(storage_path("app/public"), $file_Name);
    //         $photo_URL = storage_path("app/public/".$file_Name);

    //         $photo = fopen($photo_URL, 'r');
    //         $response = Http::attach(
    //             'file', $photo
    //         )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=category');
    //         $data = json_decode($response, true);
    //         $image_id = $data['data']['id'];

    //         $photo_new = $image_id;
    //     }
    //     else{
    //         $photo_new = $rq->txtIdphoto;
    //     }
    //     $response2 = Http::post('https://openapi.zalo.me/v2.0/store/category/update?access_token='. $token.'', [
    //         'id' => $rq->txtId,
    //         'name' => $rq->txtName,
    //         'photo' => $photo_new,
    //         'status' => $rq->Status,
    //         'description' => $rq->txtDesc2           
    //     ]);
    //     $message = json_decode($response2, true);
    //     $ms = $message['error'];
    //     $ms_content = $message['message'];
        
    //     if($ms == 0)
    //         {
    //             Session::put('message', 'Cập nhật danh mục thành công');
    //             return Redirect::to('/all-category');
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/edit-category');
    //         }  
    // }
   
 
    //order
    // public function product_order(){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $rUrl = 'https://openapi.zalo.me/v2.0/store/order/getorderofoa?access_token='. $token.'&offset=0&limit=10';

    //     $data = json_decode(file_get_contents($rUrl), true);
      
    //     $ms = $data['error'];
    //     $ms_content = $data['message'];
    //     if($ms == 0)
    //         {
    //             $product_order = $data['data']['orders'];
    //             return view('admin.all_order', ['product_order'=>$product_order]);
    //         }
    //     else
    //         {
    //             Session::put('message', $ms_content);
    //             return Redirect::to('/list-token');
    //         } 
    // }
    
    // public function order_detail($order_id){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }

    //     $rUrl = 'https://openapi.zalo.me/v2.0/store/order/getorder?access_token='. $token.'&id='.$order_id.'';

    //     $data = json_decode(file_get_contents($rUrl), true);
    //     $order_detail = $data['data']['order_items'];
    //     $custumer = $data['data'];

    //     return view('admin.order_detail', ['order_detail'=>$order_detail], ['custumer'=>$custumer]);
    // }

    // public function edit_order($order_id){
    //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    //     while(! feof($file)) {
    //         $token = fgets($file);
    //       }
    //     $rUrl = 'https://openapi.zalo.me/v2.0/store/order/getorder?access_token='. $token.'&id='.$order_id.'';

    //     $data = json_decode(file_get_contents($rUrl), true);
    //     $order_detail = $data['data']['order_items'];
    //     $custumer = $data['data'];

    //     return view('admin.edit_order', ['order_detail'=>$order_detail], ['custumer'=>$custumer]);
    // }

    // // public function update_order(Request $rq){
    // //     $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
    // //     while(! feof($file)) {
    // //         $token = fgets($file);
    // //       }

    // //     if($rq->txtStatus == 6){
    // //         $response2 = Http::post('https://openapi.zalo.me/v2.0/store/order/update?access_token='. $token.'', [
    // //             'id' => $rq->txtId,
    // //             'status' => $rq->txtStatus,
    // //             'cancel_reason' => $rq->txtReason,
    // //     ]);}else{
    // //         $response2 = Http::post('https://openapi.zalo.me/v2.0/store/order/update?access_token='. $token.'', [
    // //             'id' => $rq->txtId,
    // //             'status' => $rq->txtStatus,
    // //             'edit_reason' => $rq->txtReason           
    // //         ]);
    // //     }
        
    //     if($response2->successful())
    //         {
    //             Session::put('message', 'Gửi yêu cầu thành công');
    //             return Redirect::to('/product-order');
    //         }
    //     else
    //         {
    //             Session::put('message', 'Gửi yêu cầu thất bại');
    //             return Redirect::to('/product-order');
    //         }
    // }

    //followers
    public function all_followers(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/oa/getfollowers?access_token='. $token.'&data={"offset":0,"count":5}';
        $data = json_decode(file_get_contents($rUrl), true);
        
        $ms = $data['error'];
        $ms_content = $data['message'];
        if($ms == 0)
            {
                $id_customer = $data['data']['followers'];
                return view('admin.all_followers', ['id_customer'=>$id_customer], ['token'=>$token]);
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/list-token');
            } 
    }

    //article
    public function all_article(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/article/getslice?access_token='. $token.'&offset=0&limit=10&type=normal';

        $data = json_decode(file_get_contents($rUrl), true);
       
        $ms = $data['error'];
        $ms_content = $data['message'];
        if($ms == 0)
            {
                $all_article = $data['data']['medias'];
                return view('admin.all_article', ['all_article'=>$all_article], ['token'=>$token]);
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/list-token');
            } 
    }

    public function add_article(){
        
        return view('admin.add_article');
    }

    public function detail_article($article_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/article/getdetail?access_token='. $token.'&offset=0&limit=10&type=normal&id='.$article_id.'';

        $data = json_decode(file_get_contents($rUrl), true);
        $detail_article = $data['data'];
        $body_article = $data['data']['body'];
        return view('admin.detail_article', ['detail_article'=>$detail_article], ['body_article'=>$body_article]);
    }
    
    public function save_article(Request $rq){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }
          
        $get_image = $rq->file('txtImage');
        $get_image2 = $rq->file('txtImage2');

        if($get_image){
            $fullname_image = $get_image->getClientOriginalName();
        }
        if($get_image2){
            $fullname_image2 = $get_image2->getClientOriginalName();
        }        
        $file_Name = $fullname_image;
        $path = $rq ->file('txtImage')->move(storage_path("app/public"), $file_Name);

        $file_Name2 = $fullname_image2;
        $path = $rq ->file('txtImage2')->move(storage_path("app/public"), $file_Name2);

        $a='http://tay.thuctapoptimus.xyz/storage/app/public/'.$fullname_image.'';
        $a2='http://tay.thuctapoptimus.xyz/storage/app/public/'.$fullname_image2.'';
        // dd($a);
        $response2 = Http::post('https://openapi.zalo.me/v2.0/article/create?access_token='. $token.'', [
            'type'=> 'normal',
            'title'=> $rq->txtTitle,
            'description'=> $rq->txtDescription,
            'author'=> $rq->txtAuthor,
            'cover'=> ['cover_type'=>'photo', 'photo_url'=>$a, 'status'=>'show' ],
            'body'=> [
                [
                    'type'=>'text',
                    'content'=>$rq->txtDesc2
                ],
                [
                    'type'=>'image',
                    'url'=>$a2
                ]
                ],
            "status"=>$rq->txtStatus,    
                 
        ]);

        $message = json_decode($response2, true);
        $ms = $message['error'];
        $ms_content = $message['message'];
        
        if($ms == 0)
            {
                Session::put('message', 'Bài viết của bạn đang được duyệt');
                return Redirect::to('/all-article');
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/add-article');
            }  
    }

    public function delete_article($article_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $response2 = Http::post('https://openapi.zalo.me/v2.0/article/remove?access_token='. $token.'', [
            'id'=> $article_id
         ]);

        $message = json_decode($response2, true);
        $ms = $message['error'];
        $ms_content = $message['message'];
        
        if($ms == 0)
            {
                Session::put('message', 'Xóa bài viết thành công');
                return Redirect::to('/all-article');
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/all-article');
            }  
    }

    public function edit_article($article_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/article/getdetail?access_token='. $token.'&offset=0&limit=10&type=normal&id='.$article_id.'';

        $data = json_decode(file_get_contents($rUrl), true);
        $detail_article = $data['data'];
        $body_article = $data['data']['body'];
      
        return view('admin.edit_article', ['detail_article'=>$detail_article], ['body_article'=>$body_article]);
    }

    public function update_article(Request $rq){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $get_image = $rq->file('txtImage');
        $get_image2 = $rq->file('txtImage2');
        if($get_image){
            $fullname_image = $get_image->getClientOriginalName();
            $file_Name = $fullname_image;
            $path = $rq ->file('txtImage')->move(storage_path("app/public"), $file_Name);
            $a='http://tay.thuctapoptimus.xyz/storage/app/public/'.$fullname_image.'';
        }
        else
        {
            $a = $rq->txtPhoto;
        }

        if($get_image2){
            $fullname_image2 = $get_image2->getClientOriginalName();
            $file_Name2 = $fullname_image2;
            $path = $rq ->file('txtImage2')->move(storage_path("app/public"), $file_Name2);
            $a2='http://tay.thuctapoptimus.xyz/storage/app/public/'.$fullname_image2.'';
        }
        else
        {
            $a2 = $rq->txtPhoto2;
        }        

        $response2 = Http::post('https://openapi.zalo.me/v2.0/article/update?access_token='. $token.'', [
            'id'=>$rq->txtId,
            'type'=> 'normal',
            'title'=> $rq->txtTitle,
            'description'=> $rq->txtDescription,
            'author'=> $rq->txtAuthor,
            'status' => $rq->txtStatus,
            'cover'=> ['cover_type'=>'photo', 'photo_url'=>$a, 'status'=>'show' ],
            'body'=> [
                [
                    'type'=>'text',
                    'content'=>$rq->txtDesc2
                ],
                [
                    'type'=>'image',
                    'url'=>$a2
                ]
                ], 
                 
        ]);
        // return $response2->json();
        $message = json_decode($response2, true);
        $ms = $message['error'];
        $ms_content = $message['message'];
        
        if($ms == 0)
            {
                Session::put('message', 'Cập nhật bài viết thành công');
                return Redirect::to('/all-article');
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/edit-article');
            }      
    }

    

    //custumers

    //messenger
    public function messenger(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token2 = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/oa/getfollowers?access_token='. $token2.'&data={"offset":0,"count":5}';
        $data = json_decode(file_get_contents($rUrl), true);
        
        $ms = $data['error'];
        $ms_content = $data['message'];
        if($ms == 0)
            {
                $id_customer = $data['data']['followers'];
                return view('admin.messenger', ['id_customer'=>$id_customer]);
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/list-token');
            } 
    }

    public function messenger_detail($messenger_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/oa/getfollowers?access_token='. $token.'&data={"offset":0,"count":5}';
        $data = json_decode(file_get_contents($rUrl), true);
        $id_customer = $data['data']['followers'];
        $rUrl2 = 'https://openapi.zalo.me/v2.0/oa/getprofile?access_token='. $token.'&data={"user_id":'.$messenger_id.'}';
        $data2 = json_decode(file_get_contents($rUrl2), true);
  
        $detail = $data2['data'];

        return view('admin.messenger_detail', ['id_customer'=>$id_customer], ['detail'=>$detail, 'messenger_id'=>$messenger_id]);
    }

    //token
    public function list_token(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        return view('admin.list_token', ['token'=>$token]);
    }

    public function save_token(Request $rq){
        $myfile = fopen(storage_path("app/public/TOKEN.txt"), "w");
        $token = $rq->txtToken2;
        fwrite($myfile, $token);
        fclose($myfile);

        return Redirect::to('/list-token');
    }


    //broadcast
    public function sent_broadcast(){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/article/getslice?access_token='. $token.'&offset=0&limit=10&type=normal';

        $data = json_decode(file_get_contents($rUrl), true);
        $all_article = $data['data']['medias'];

        return view('admin.sent_broadcast', ['all_article'=>$all_article], ['token'=>$token]);
    }

    public function detail_broadcast($article_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        $rUrl = 'https://openapi.zalo.me/v2.0/article/getdetail?access_token='.$token.'&id='.$article_id.'';

        $data = json_decode(file_get_contents($rUrl), true);
        $detail_article = $data['data'];

        return view('admin.detail_broadcast', ['detail_article'=>$detail_article], ['token'=>$token]);
    }

    public function sent_to_broadcast($article_id, Request $rq)
    {
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }
          $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                "recipient"=> [
                  "target"=> [
                    "gender"=> $rq->gender
                  ]
                ],
                "message"=> [
                  "attachment"=> [
                    "type"=> "template",
                    "payload"=> [
                      "template_type"=> "media",
                      "elements"=> [
                        [
                          "media_type"=> "article",
                          "attachment_id"=> $article_id
                        ]
                      ]
                    ]
                  ]
                ]
        ]);

        $message = json_decode($response2, true);
        $ms = $message['error'];
        $ms_content = $message['message'];
        
        if($ms == 0)
            {
                Session::put('message', 'Bài viết sẽ được gửi đi sau khi duyệt thành công (trước 30 phút) ');
                return Redirect::to('/sent-broadcast');
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/sent-broadcast');
            }      
    }

} 