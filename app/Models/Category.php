<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelTree, AdminBuilder;
    //
    protected $fillable = ['name','description','order','parent_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('order');
        $this->setTitleColumn('name');
    }

    /**
     * 获取小程序功能模块
     */
    public static function getIndexCategory(){
        return self::select('id','name','image','url')->where([
            'parent_id'=>8,
            'switch'=>1,
        ])->orderBy('order')->get();
    }
}
