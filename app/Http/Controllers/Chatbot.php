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
class Chatbot extends Controller
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
        $script = DB::table('tbl_script')->get();
        $intent = DB::table('tbl_intent')->get();   
        //config question chatbot
        foreach($intent as $intent)
        {
            if(strtolower($intent->list_question) == strtolower($request->input('message.text'))){
                $intent_rep = $intent->intent;
                foreach($script as $script)
                {
                    if(strtolower($script->script_intent) == strtolower($intent_rep)){
                        $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                            'recipient'=> ['user_id'=>$request->input('sender.id')],
                            'message' => ['text'=>$script->script_reply],
                        ]);
                        return response()->json(200);
                    }
                }
            }elseif(strtolower($intent->list_question) != strtolower($request->input('message.text'))){
                foreach($script as $script2){
                    similar_text($script2->script_intent,$request->input('message.text'),$percent);
                    if($percent > 60){
                        $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                            'recipient'=> ['user_id'=>$request->input('sender.id')],
                            'message' => ['text'=>$script2->script_reply],
                        ]);
                        return response()->json(200);
                    }
                }
            }
        }

        //begin chat
        if(strtolower($request->input('message.text')) == 'chao'){
            $response3 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
            'recipient'=> [
                'user_id'=> $request->input('sender.id')
            ],
              "message"=> [
                "attachment"=> [
                    "type"=> "template",
                    "payload"=> [
                        "template_type"=> "list",
                        "elements"=> [[
                            "title"=> "Botchat",
                            "subtitle"=> "Xin chào, tôi có thể giúp gì cho bạn?",
                            "image_url"=> "https://image.optcdn.me/6ce5da8fa6e8f755ee957163dec6b83b-50570ebbb9ada07d9adc78e45cd59497-z1756910912608-aff18a6cda2f9a47b6a2feaf37cb6fd3.jpg",
                            "default_action"=> [
                                "type"=> "oa.open.url",
                                "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                            ]
                            ],
                        [
                            "title"=> "Liên hệ",
                            "subtitle"=> "Liên hệ",
                            "image_url"=> "https://capnuocbenthanh.com/images/dtlienhe_1.jpg",
                            "default_action"=> [
                                "type"=> "oa.open.url",
                                "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                ]
                        ],      
                        [
                            "title"=> "Xem thêm",
                            "subtitle"=> "Liên hệ",
                            "image_url"=> "https://i.pinimg.com/originals/44/5e/e8/445ee8895ef81f2c02b38147e8ad6ae6.jpg",
                            "default_action"=> [
                                "type"=> "oa.open.url",
                                "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                            ]
                        ]]
                    ]
                ]
              ]
            ]);
            return response()->json(200); 
        }
        elseif(strtolower($request->input('message.text')) == 'chào'){
            $response3 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> [
                    'user_id'=> $request->input('sender.id')
                ],
                  "message"=> [
                    "attachment"=> [
                        "type"=> "template",
                        "payload"=> [
                            "template_type"=> "list",
                            "elements"=> [[
                                "title"=> "Botchat",
                                "subtitle"=> "Xin chào, tôi có thể giúp gì cho bạn?",
                                "image_url"=> "https://image.optcdn.me/6ce5da8fa6e8f755ee957163dec6b83b-50570ebbb9ada07d9adc78e45cd59497-z1756910912608-aff18a6cda2f9a47b6a2feaf37cb6fd3.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                ]
                                ],
                            [
                                "title"=> "Liên hệ",
                                "subtitle"=> "Liên hệ",
                                "image_url"=> "https://capnuocbenthanh.com/images/dtlienhe_1.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                    ]
                            ],
                            [
                                "title"=> "Xem thêm",
                                "subtitle"=> "Liên hệ",
                                "image_url"=> "https://i.pinimg.com/originals/44/5e/e8/445ee8895ef81f2c02b38147e8ad6ae6.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                ]
                            ]]
                        ]
                    ]
                  ]
                ]);
            return response()->json(200);
        }
        elseif(strtolower($request->input('message.text')) == '#muahang'){
            $response3 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> [
                    'user_id'=> $request->input('sender.id')
                ],
                  "message"=> [
                    "attachment"=> [
                        "type"=> "template",
                        "payload"=> [
                            "template_type"=> "list",
                            "elements"=> [[
                                "title"=> "Dưới đây là các sản phẩm phổ biến của shop:",
                                "subtitle"=> "Click vào để xem chi tiết",
                                "image_url"=> "https://image.optcdn.me/6ce5da8fa6e8f755ee957163dec6b83b-50570ebbb9ada07d9adc78e45cd59497-z1756910912608-aff18a6cda2f9a47b6a2feaf37cb6fd3.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                ]
                                ],
                            [
                                "title"=> "Nhớt Lubrex Race 4T Nano Plus 15W-40",
                                "subtitle"=> "Nhớt Lubrex Race 4T Nano Plus 15W-40",
                                "image_url"=> "https://store-photo-s.zdn.vn/8/eda09eb61af6f3a8aae7.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "http://shop.zalo.me/store/productdetail?productId=605726587a1d9343ca0c&pageId=293390739528823350"
                                    ]
                            ],
                            [
                                "title"=> "Nhớt Lubrex Race 4T Nano XP",
                                "subtitle"=> "Nhớt Lubrex Race 4T Nano XP",
                                "image_url"=> "https://store-photo-s.zdn.vn/8/b05e2348a7084e561719.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "http://shop.zalo.me/store/productdetail?productId=3c0702085e4db713ee5c&pageId=293390739528823350"
                                ]
                                ],
                            [
                                "title"=> "Nhông sên dĩa LPD YAMAHA TAURUS",
                                "subtitle"=> "Nhông sên dĩa LPD YAMAHA TAURUS",
                                "image_url"=> "https://store-photo-s.zdn.vn/8/de305326d7663e386777.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "http://shop.zalo.me/store/productdetail?productId=b12d8122dd6734396d76&pageId=293390739528823350"
                                ]
                            ]]
                        ]
                    ]
                  ]
                ]);
            return response()->json(200);
        }
        elseif(strtolower($request->input('message.text')) == '#dathang'){
            $response3 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> [
                    'user_id'=> $request->input('sender.id')
                ],
                  "message"=> [
                    "attachment"=> [
                        "type"=> "template",
                        "payload"=> [
                            "template_type"=> "list",
                            "elements"=> [[
                                "title"=> "Vui lòng chọn sản phẩm cần mua",
                                "subtitle"=> "Click vào sản phẩm để tiến hành đặt hàng",
                                "image_url"=> "https://image.optcdn.me/6ce5da8fa6e8f755ee957163dec6b83b-50570ebbb9ada07d9adc78e45cd59497-z1756910912608-aff18a6cda2f9a47b6a2feaf37cb6fd3.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                ]
                                ],
                            [
                                "title"=> "Nhớt Lubrex Race 4T Nano Plus 15W-40",
                                "subtitle"=> "Nhớt Lubrex Race 4T Nano Plus 15W-40",
                                "image_url"=> "https://store-photo-s.zdn.vn/8/eda09eb61af6f3a8aae7.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "http://shop.zalo.me/store/productdetail?productId=605726587a1d9343ca0c&pageId=293390739528823350"
                                    ]
                            ],
                            [
                                "title"=> "Nhớt Lubrex Race 4T Nano XP",
                                "subtitle"=> "Nhớt Lubrex Race 4T Nano XP",
                                "image_url"=> "https://store-photo-s.zdn.vn/8/b05e2348a7084e561719.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "http://shop.zalo.me/store/productdetail?productId=3c0702085e4db713ee5c&pageId=293390739528823350"
                                ]
                                ],
                            [
                                "title"=> "Nhông sên dĩa LPD YAMAHA TAURUS",
                                "subtitle"=> "Nhông sên dĩa LPD YAMAHA TAURUS",
                                "image_url"=> "https://store-photo-s.zdn.vn/8/de305326d7663e386777.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "http://shop.zalo.me/store/productdetail?productId=b12d8122dd6734396d76&pageId=293390739528823350"
                                ]
                                ],
                            [
                                "title"=> "Xem thêm",
                                "subtitle"=> "Xem thêm",
                                "image_url"=> "https://i.pinimg.com/originals/44/5e/e8/445ee8895ef81f2c02b38147e8ad6ae6.jpg",
                                "default_action"=> [
                                    "type"=> "oa.open.url",
                                    "url"=> "https://shop.zalo.me/store?id=5b267e2073749a2ac365"
                                ]
                                ],
                            ]
                        ]
                    ]
                  ]
                ]);
            return response()->json(200);
        }
        elseif(strtolower($request->input('message.text')) == '#khuyenmai'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Xin lỗi, Hiện tại chưa có chương trình khuyến mãi nào đang diễn ra.'],
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'tôi cần mua hàng'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Bạn muốn mua sản phẩm gì? Vui lòng gõ #muahang hoặc chọn sản phẩm từ shop.'],
               
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'tôi cần muốn mua hàng'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Bạn muốn mua sản phẩm gì? Vui lòng gõ mua hàng hoặc chọn sản phẩm từ shop.'],
               
            ]);
            return response()->json(200);
        }
        elseif($request->input('message.text') == 'tôi cần giúp đỡ'){
            $response2 = Http::post('https://openapi.zalo.me/v2.0/oa/message?access_token='. $token.'', [
                'recipient'=> ['user_id'=>$request->input('sender.id')],
                'message' => ['text'=>'Tôi có thể giúp gì cho bạn? Vui lòng nhập #muahang,#dathang,#khuyenmai,... để được hỗ trợ nhanh nhất!'],
               
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

    //config chatbot
    public function config_chatbot(){
        $script = DB::table('tbl_script')->get();

        return view('chatbot.config_chatbot', ['script'=>$script]);
    }

    //save script chatbot
    public function save_chatbot(Request $rq){
        $data = [];
        $data['script_intent'] = $rq->txtIntent;
        $data['script_reply'] = $rq->txtReply;

        $csript = DB::table('tbl_script')->insertGetId($data);
        Session::put('message', 'Thêm kịch bản thành công');

        return Redirect::to('config-chatbot-script');
    }

    //delete script chatbot
    public function delete_chatbot($script_id){
        DB::table('tbl_script')->where('id', $script_id)->delete();
        Session::put('message', 'Xóa kịch bản thành công');

        return Redirect::to('config-chatbot-script');
    }

    //update script chatbot
    public function update_chatbot(Request $rq){
        DB::table('tbl_script')->where('id', $rq->script_id)
        ->update(['script_reply' => $rq->script_intent]);
    }

    //config chatbot more
    public function config_chatbot_more(){
        $script = DB::table('tbl_script')->get();
        $list_intent = DB::table('tbl_intent')->get();

        return view('chatbot.config_chatbot_more', ['script'=>$script], ['list_intent'=>$list_intent]);
    }

    //save chat bot more
    public function save_chatbot_more(Request $rq){
        $data = [];
        $data['intent'] = $rq->txtScriptIntent;
        $data2['list_question'] = $rq->txtListQuestion;
        
        $list_question = $data2['list_question'];

        foreach($list_question as $list){
            $data['list_question'] = $list;
            $csript = DB::table('tbl_intent')->insertGetId($data);
        }
        Session::put('message', 'Thêm thư viện so sánh thành công');
        return Redirect::to('config-chatbot-more');
    }

    //update chatbot more
    public function update_chatbot_more(Request $rq){
        
        DB::table('tbl_intent')->where('id', $rq->intent_id)
        ->update(['list_question' => $rq->list_question]);
    }

    //delete chatbot more
    public function delete_chatbot_more($script_id){
        DB::table('tbl_intent')->where('id', $script_id)->delete();
        Session::put('message', 'Xóa ý định thành công');

        return Redirect::to('config-chatbot-more');
    }

    //config chatbot time
    public function config_chatbot_time(){
        $time = DB::table('tbl_time')
        ->where('id', '1')->get()->first();

        return view('chatbot.config_chatbot_time', ['time'=>$time]);
    }

    //save chatbot time
    public function save_chatbot_time(Request $rq){
        $data = [];
        $data['time_tmp'] = $rq->time_tmp;
        $data['time_end_from'] = $rq->time_end_from;
        $data['time_end_to'] = $rq->time_end_to;
        $data['content_end'] = $rq->content_end;
        $data['time_begin_from'] = $rq->time_begin_from;
        $data['time_begin_to'] = $rq->time_begin_to;
        $data['content_begin'] = $rq->content_begin;

        DB::table('tbl_time')->where('id', '1')->update($data);
        Session::put('message', 'Cấu hình thành công');
        return Redirect::to('config-chatbot-time');
    }


}    