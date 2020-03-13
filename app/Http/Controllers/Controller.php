<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $codeMsg = [
        '301'=>'用户不存在',
        '302'=>'token校验失败',
    ];

    public function success($data = [],$code = 200 ,$msg = 'success'){
        return ['code'=>$code ,'msg' =>$msg ,'data'=>$data];
    }

    public function error($data = [],$code = 300 ,$msg = 'error'){
        if($code !== 300){
            $msg = $this->codeMsg[$code];
        }
        return ['code'=>$code ,'msg' =>$msg ,'data'=>$data];
    }
}
