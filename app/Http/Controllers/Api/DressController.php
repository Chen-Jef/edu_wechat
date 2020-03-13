<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/21
 * Time: 14:46
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * 换装模块
 * Class DressController
 * @package App\Http\Controllers\Api
 */
class DressController extends Controller
{
    public function index(){

        return ['code'=>1,'msg'=>'success','data'=>''];
    }
}