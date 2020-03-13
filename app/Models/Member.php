<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //表名
  	protected $table = 'member';
    //主键
    protected $primaryKey= 'id';
    //允许自动更新时间
    public $timestamps = true;

    public function hasManyAlbum()
    {
        return $this->hasMany('Album', 'user_id', 'id');
    }

    public function hasManyDiary(){
        return $this->hasMany('Diary', 'user_id', 'id');
    }
}
