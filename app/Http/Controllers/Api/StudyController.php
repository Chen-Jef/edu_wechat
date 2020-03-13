<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/21
 * Time: 14:14
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * 知识碎片模块
 * Class StudyController
 * @package App\Http\Controllers\Api
 */
class StudyController extends Controller
{
    public function index(){

        return ['code'=>1,'msg'=>'success','data'=>''];
    }
}