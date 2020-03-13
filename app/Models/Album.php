<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    //表名
    protected $table = "album";
    //主键
    protected $primaryKey= 'id';
    //允许自动更新时间
    public $timestamps = true;
    //允许修改的参数
    protected $fillable = ['user_id','name','cover'];
    //使用软删除
    use SoftDeletes;

    public function belongsToUser()
    {
        return $this->belongsTo('Member', 'user_id', 'id');
    }

    public static function addAlbum($data){
        $add = self::create($data);
        return $add;
    }

    public static function delAlbum($id){
        $del = self::where('id',$id)->delete();
        return $del;
    }

    public static function saveAlbum($id,$data){
        $save = self::where('id',$id)->update($data);
        return $save;
    }
}
