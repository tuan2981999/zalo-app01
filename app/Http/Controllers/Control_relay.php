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
use Kreait\Firebase\Database;

session_start();
class Control_relay extends Controller
{   
   
    public function taypost(Request $rq){
        return response('Hello Worládád', 200);
        
    }

    //config question chatbot
    public function webhook(Request $request, $username){
        $file = fopen(storage_path("app/public/TOKEN.txt"), 'r');
        while(! feof($file)) {
            $token = fgets($file);
          }

        //begin chat
        if($request->input('message.text') == 'help'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Vui lòng chọn chức năng!'],
               
            ]);

            
        $firebase->update([
            'key_1/key_1_1' => 'value_1_1',
            'key_2/key_2_2' => 'value_2_2',
        ], 'my/data');
            return response()->json(200);
        }
        elseif($request->input('all') == 'Trạng thái các relay:'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Bạn muốn mua sản phẩm gì? Vui lòng gõ mua hàng hoặc chọn sản phẩm từ shop.'],
               
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'on1'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Đã bật relay1'],
               
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'tôi muốn trả hàng'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Vui lòng gọi 19001010 để được hỗ trợ nhanh nhất!'],
               
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'tôi không biết mua hàng'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Vui lòng gõ #muahang để mua hàng một cách nhanh nhất!'],
               
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'tôi không thể đặt hàng'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Vui lòng nhập #dathang hoặc liên hệ trực tiếp với chúng tôi qua số điện thoại: 0123123123'],
               
            ]);
            return response()->json(200);
        }
        else{
            return response()->json(200);
        }
        //endchat
    }

   

}    