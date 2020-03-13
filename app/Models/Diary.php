<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    //表名
    protected $table = "diaries";
    //主键
    protected $primaryKey= 'id';
    //允许自动更新时间
    public $timestamps = true;
    //允许修改的参数
    protected $fillable = ['user_id','title','content'];

 	public static function getUserDiaryPageList($where = [],$field='*',$page = 10){
        $list = self::where($where)->select($field)
            ->latest()->paginate($page);
        return $list;
    }

    public static function addDiary($data){
        $add = self::create($data);
        return $add;
    }

    public static function delDiary($id){
 	    $del = self::where('id',$id)->delete();
 	    return $del;
    }

    public static function saveDiary($id,$data){
 	    $save = self::where('id',$id)->update($data);
 	    return $save;
    }
}
