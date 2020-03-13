<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/21
 * Time: 9:45
 */

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Http\Requests\Login\LoginRequest;
use EasyWeChat\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 登录模块
 * Class LoginController
 * @package App\Http\Controllers\Api
 */
class LoginController extends Controller
{
    public function doLogin(LoginRequest $request){
        //获取请求数据
        $param = $request->all();
		
      	//code换取openid
        $app = Factory::miniProgram(config('wechat.base'));
        $result = $app->auth->session($param['code']);
        
      	$model = new Member;
      	
      	//判断用户是否存在
      	$is_old = $model->where('openid', $result['openid'])->exists();
      	
      	DB::beginTransaction();
        try {
          	
          	//不存在 => 新用户
            if($is_old === false){
              	$token = session_create_id(); //生成唯一ID （原用于生成session_id）
              
                $id = $model->insertGetId([
                    'openid'			=> $result['openid'], 
                    'access_token' 		=> $token,
                    'ip'				=> request()->ip()
                ]);
          	}else{
              	//老用户
            	$member = $model->select('id','access_token')->where('openid', $result['openid'])->first();
              	$id 		= $member['id'];
              	$token 		= $member['access_token'];
            }
          
        	DB::commit();
        } catch(\Exception $exception) {
            DB::rollback();
            return ['code'=>300,'msg'=>$exception->getMessage(),'data'=>[]];
        }

      	$data = [
        	'id'				=> $id,
          	'api_token'		    => md5('author:jef'.md5($token)),
            'session_key'       => $result['session_key']
        ];
      
        return ['code'=>200,'msg'=>'success','data'=>$data];
    }
}