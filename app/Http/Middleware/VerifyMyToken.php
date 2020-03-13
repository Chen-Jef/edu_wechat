<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/26
 * Time: 18:02
 */

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;

class VerifyMyToken
{
    public function handle($request, Closure $next){
        $data = array();
       	$token = $request->header('api-token');
      	$user_id = $request->input('user_id');
      	if(!$user_id){
          	return response()->json(['code'=>300,'msg'=>'缺少用户ID参数','data'=>[]]);
        }
 		
      	$model = new Member;
      	
      	$ass_token = $model->where('id',$user_id)->value('access_token');
      	if(!$ass_token){
        	return response()->json(['code'=>301,'msg'=>'用户不存在','data'=>[]]);
        }
      	if( $token != md5('author:jef'.md5($ass_token)) ){
        	return response()->json(['code'=>302,'msg'=>'token校验失败','data'=>[]]);
       	}
        
        return $next($request);
    }
}
