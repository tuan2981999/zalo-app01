<?php

namespace App\Http\Controllers;
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
use Visualweber\Zalo\ZaloServiceProvider;

session_start();

class Home extends Controller 
{
   
    public function user_social(){
         
        return view('account_detail');
    }

    // login zalo
    public function login_zalo(){

        return redirect('https://oauth.zaloapp.com/v3/permission?app_id=119611120980630055&redirect_uri=https://tuancuong.thuctap.com/tay/public/login-home&state=tuan');
    }

    //login to home
    public function login_home(Request $rq){
        $file = fopen(storage_path("app/public/login_zalo/login.xml"), "w");
        $xml2 = "   
                <data>
                    <uid>
                        <data>$rq->uid</data>
                    </uid>

                    <code>
                        <data>$rq->code</data>
                    </code>

                    <state>
                        <data>$rq->state</data>
                    </state>

                    <scope>
                        <data>$rq->scope</data>
                    </scope>
                </data>
                ";
        fwrite($file, $xml2);
        fclose($file);

        Session::put('message', 'Đăng nhập thành công');
        return Redirect::to('dashboard');    
    }

    //logout zalo
    public function logout_zalo(){
        $file = fopen(storage_path("app/public/login_zalo/login.xml"), "w");
        $xml2 = "   
                <data>
                    <uid>
                        <data>1</data>
                    </uid>

                    <code>
                        <data>1</data>
                    </code>

                    <state>
                        <data>1</data>
                    </state>

                    <scope>
                        <data>1</data>
                    </scope>
                </data>
                ";
        fwrite($file, $xml2);
        fclose($file);
    
        Session::put('message', 'Đăng xuất thành công');
        return Redirect::to('dashboard');
    }

    //list status zalo
    public function list_status(){
        $xml=simplexml_load_file(storage_path("app/public/login_zalo/login.xml")) or die("Error: Cannot create object");
        $uid = $xml->uid->data;
        $code = $xml->code->data;
        $state = $xml->state->data;
        $scope = $xml->scope->data;

        if($uid != 1){
            $rUrl = 'https://oauth.zaloapp.com/v3/access_token?app_id=119611120980630055&app_secret=Fm2o0RLAX95pSX36oPV6&code='.$code;
            $data = json_decode(file_get_contents($rUrl), true);
            $access_token=$data['access_token'];
            return view('account.list_status');
        }else{
            Session::put('message', 'Vui lòng đăng nhập zalo để sử dụng chức năng này');
            return Redirect::to('dashboard');
        }
    }

    //list friend zalo
    public function list_friend(){
        $xml=simplexml_load_file(storage_path("app/public/login_zalo/login.xml")) or die("Error: Cannot create object");
        $uid = $xml->uid->data;
        $code = $xml->code->data;
        $state = $xml->state->data;
        $scope = $xml->scope->data;

        if($uid != 1){
            $rUrl = 'https://oauth.zaloapp.com/v3/access_token?app_id=119611120980630055&app_secret=Fm2o0RLAX95pSX36oPV6&code='.$code;
            $data = json_decode(file_get_contents($rUrl), true);
            $access_token=$data['access_token'];
            
            $rUrl2 = 'https://graph.zalo.me/v2.0/me/invitable_friends?access_token='.$access_token.'&from=0&limit=200&fields=id,name,gender,picture';
            $data2 = json_decode(file_get_contents($rUrl2), true);
            $list_friend = $data2['data'];
            
            return view('account.list_friend', ['list_friend'=>$list_friend]);
        }else{
            Session::put('message', 'Vui lòng đăng nhập zalo để sử dụng chức năng này');
            return Redirect::to('dashboard');
        }
    }

    //detail account zalo
    public function account_detail(){
        $xml=simplexml_load_file(storage_path("app/public/login_zalo/login.xml")) or die("Error: Cannot create object");
        $uid = $xml->uid->data;
        $code = $xml->code->data;
        $state = $xml->state->data;
        $scope = $xml->scope->data;

        if($uid != 1){
            $rUrl = 'https://oauth.zaloapp.com/v3/access_token?app_id=119611120980630055&app_secret=Fm2o0RLAX95pSX36oPV6&code='.$code;
            $data = json_decode(file_get_contents($rUrl), true);
            $access_token=$data['access_token'];
            
            $rUrl2 = 'https://graph.zalo.me/v2.0/me?access_token='.$access_token.'&fields=id,birthday,name,gender,picture';
            $data2 = json_decode(file_get_contents($rUrl2), true);
            $account_detail = $data2;

            return view('account.account_detail', ['account_detail'=>$account_detail]);
        }else{
            Session::put('message', 'Vui lòng đăng nhập zalo để sử dụng chức năng này');
            return Redirect::to('dashboard');
        }
    }
}
