<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/20
 * Time: 17:05
 */

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    /**
     * 首页 - 获取小程序功能模块
     * @return array
     */
    public function index(){
        $cate = Cache::remember('indexCategoryList', 600,function () {
            return Category::getIndexCategory();
        });
      

        return $this->success($cate);
    }
}