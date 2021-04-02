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
class Synchronization extends Controller
{   
   
    //config product sync
    public function product_sync(){
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
                $category_product = $data['data']['categories'];
                $rUrl = 'https://openapi.zalo.me/v2.0/store/getindustry?access_token='.$token.'';
                $data2 = json_decode(file_get_contents($rUrl), true);
                $industry = $data2['data']['industries'];
   
                return view('synchronization.product_sync', ['category_product'=>$category_product], ['industry'=>$industry]); 
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/list-token');
            }     
    }

    //read file xml print product
    public function link_sync(){
        $xml=simplexml_load_file(storage_path("app/public/link_config/data.xml")) or die("Error: Cannot create object");
        $link = $xml->link->data;
        $quantity = $xml->quantity->data;
        $name = $xml->data12->name;
        $code = $xml->data12->code;
        $price = $xml->data12->price;
        $qatt = $xml->data12->qatt;
        $weight = $xml->data12->weight;
        $category = $xml->data12->category;
        $industry = $xml->data12->industry;
        $description = $xml->data12->description;
        $image = $xml->data12->image;

        return view('synchronization.link_sync', ['link'=>$link, 'quantity'=>$quantity, 'name'=>$name, 'code'=>$code, 'price'=>$price, 'qatt'=>$qatt, 'weight'=>$weight, 'category'=>$category, 'industry'=>$industry, 'image'=>$image, 'description'=>$description] );
    }

    public function file_sync(){
       
        return view('synchronization.file_sync');
    }

    //save link config to xml
    public function save_link(Request $rq){
        $file = fopen(storage_path("app/public/link_config/data.xml"), "w");
        $xml2 = "   
                    <data>
                        <link>
                        <data>$rq->txtLink</data>
                        </link>

                        <quantity>
                        <data>$rq->txtQuantity</data>
                        </quantity>

                        <data12>
                            <name>$rq->txtName</name>
                            <code>$rq->txtCode</code>
                            <price>$rq->txtPrice</price>
                            <qatt>$rq->txtQatt</qatt>
                            <weight>$rq->txtWeight</weight>
                            <category>$rq->txtCategory</category>
                            <industry>$rq->txtIndustry</industry>
                            <description>$rq->txtDescription</description>
                            <image>$rq->txtImage</image>
                        </data12>
                    </data>
                ";
        fwrite($file, $xml2);
        fclose($file);

        return Redirect::to('/link-sync');
    }

    //save file cofig in xml
    public function save_file(Request $rq){
        $get_file = $rq->file('txtXml');

        if($get_file){  
            $fullname_xml = $get_file->getClientOriginalName();
        }
        $file_Name = $fullname_xml;
        $path = $rq ->file('txtXml')->move(storage_path("app/public"), $file_Name);
        $a='http://tay.thuctapoptimus.xyz/storage/app/public/'.$fullname_xml.'';
       
        $filer = fopen($a, 'r');
        $filew = fopen(storage_path("app/public/file_config/product.xml"), "w");
        while(! feof($filer)) {
            $xml2 = fgets($filer);
            fwrite($filew, $xml2);
          }
        fclose($filew);
        fclose($filer);

        Session::put('message', 'Lưu cấu hình thành công');
        return Redirect::to('/file-sync');
    }

    //save cofig
    public function save_sync(Request $rq){
        if($rq->txtInput == 'link'){
            $xml=simplexml_load_file(storage_path("app/public/link_config/data.xml")) or die("Error: Cannot create object");
            $link = $xml->link->data;
            $quantity = $xml->quantity->data;
            
            $category_id = $rq->txtCategories;
            $rUrl = $link;
            $data = json_decode(file_get_contents($rUrl), true);
            $product = $data['data'];

            return view('synchronization.list_product_link',['product'=>$product], ['category_id'=>$category_id, 'quantity'=>$quantity]);
        }elseif($rq->txtInput == 'file'){
            $category_id = $rq->txtCategories;

            return view('synchronization.list_product_file', ['category_id'=>$category_id]);
        }
    }

    //save link to zalo
    public function save_link_product($category_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }
        $xml=simplexml_load_file(storage_path("app/public/link_config/data.xml")) or die("Error: Cannot create object");
        $link = $xml->link->data;
        $quantity = $xml->quantity->data;
        $rUrl = $link;
        $data = json_decode(file_get_contents($rUrl), true);
        $product = $data['data'];
        $i=0;
        foreach($product as $pro){
            $i++;
            if($i <= $quantity){
                $photo = fopen($pro['images'][0], 'r');
                $response = Http::attach(
                    'file', $photo
                )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=product');
                    
                $data = json_decode($response, true);
                $image_id = $data['data']['id'];

                $response2 = Http::post('https://openapi.zalo.me/v2.0/store/product/create?access_token='. $token.'', [
                    'name'=> $pro['name'],
                    'code' =>  $pro['code'].$pro['code'],
                    'price' => $pro['basePrice'],
                    'quantity' => '100',
                    'industry' => '132',
                    'description' => 'Không có mô tả',
                    'photos' => [$image_id],
                    'package_size' => ['weight'=>'1'],
                    'categories' => [$category_id]
                    
                ]);
            }else{
                break;
            }
        }
        $message = json_decode($response2, true);
        $ms = $message['error'];
        $ms_content = $message['message'];
        $j=$i-1;
        if($ms == 0)
            {
                Session::put('message', 'Đồng bộ '.$j.' sản phẩm thành công');
                return Redirect::to('/all-product');
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/product-sync');
            }
    }

    //save file config
    public function save_file_product($category_id){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }
        $xml=simplexml_load_file(storage_path("app/public/file_config/product.xml")) or die("Error: Cannot create object");
        $i=0;
        foreach($xml->children() as $all_product){
            $i++;
            $photo = fopen($all_product->photo_links, 'r');
            $response = Http::attach(
                'file', $photo
            )->post('https://openapi.zalo.me/v2.0/store/upload/photo?access_token='. $token.'&upload_type=product');
                
            $data = json_decode($response, true);
            $image_id = $data['data']['id'];

            $response2 = Http::post('https://openapi.zalo.me/v2.0/store/product/create?access_token='. $token.'', [
                'name'=> (string)$all_product->name,
                'code' =>  (string)$all_product->code,
                'price' => (int)$all_product->price,
                'quantity' => (int)$all_product->quantity,
                'industry' => '132',
                'description' => (string)$all_product->description,
                'photos' => [$image_id],
                'package_size' => ['weight'=>(int)$all_product->weight],
                'categories' => [$category_id]
            ]);
        }
        $message = json_decode($response2, true);
        $ms = $message['error'];
        $ms_content = $message['message'];
        
        if($ms == 0)
            {
                Session::put('message', 'Đồng bộ '.$i.' sản phẩm thành công');
                return Redirect::to('/all-product');
            }
        else
            {
                Session::put('message', $ms_content);
                return Redirect::to('/product-sync');
            }
    }

}
