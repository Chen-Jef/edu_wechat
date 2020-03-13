<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/21
 * Time: 14:14
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\Diary\DelAlbumRequest;
use App\Http\Requests\Diary\DiaryRequest;
use App\Http\Requests\Diary\AddDiaryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\SaveAlbumRequest;
use App\Models\Diary;
use Illuminate\Support\Facades\DB;

/**
 * 日记模块
 * Class DiaryController
 * @package App\Http\Controllers\Api
 */
class DiaryController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Diary();
    }
    /**
     * 获取用户的日记列表
     * @return array
     */
    public function getUserDiaryPageList(DiaryRequest $request){
        $user_id = $request->input('user_id');
        
      	$where = ['user_id' => $user_id];
      	$field = ['id','title','created_at'];
      	
        $res = $this->model::getUserDiaryPageList($where , $field);
        return $this->success($res);
    }

    public function addDiary(AddDiaryRequest $request){
        $data = $request->input();

        DB::beginTransaction();
        try {
            
            $this->model::addDiary($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([],300,$e->getMessage());
        }

        return $this->success();
    }

    public function delDiary(DelAlbumRequest $request){
        $id = $request->input('id');

        DB::beginTransaction();
        try {
            
            $this->model::delDiary($id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([],300,$e->getMessage());
        }

        return $this->success();
    }

    public function saveDiary(SaveAlbumRequest $request){
        $data = $request->input();

        DB::beginTransaction();
        try {
            
            $id = $data['id'];
            unset($data['id']);
            $this->model::saveDiary($id,$data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([],300,$e->getMessage());
        }

        return $this->success();
    }
}