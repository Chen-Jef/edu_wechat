<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/28
 * Time: 17:08
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\Diary\AddAlbumRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\DelAlbumRequest;
use App\Http\Requests\Diary\SaveAlbumRequest;
use App\Models\Album;
use Illuminate\Support\Facades\DB;


class AlbumController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Album();
    }

    public function addAlbum(AddAlbumRequest $request){
        $data = $request->input();

        DB::beginTransaction();
        try {
            $this->model::addAlbum($data);

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

            $this->model::delAlbum($id);

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
            $this->model::saveAlbum($id,$data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([],300,$e->getMessage());
        }

        return $this->success();
    }
}