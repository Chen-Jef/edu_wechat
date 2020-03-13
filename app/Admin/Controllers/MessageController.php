<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '留言管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message);

        $grid->column('nickname', __('Nickname'));
        $grid->column('content', __('Content'))->width(300)->display(function ($content) {
            return "<span style='display:block;/*内联对象需加*/   
								 width:25em;  
                                 word-break:keep-all;/* 不换行 */   
                                 white-space:nowrap;/* 不换行 */  
                                 overflow:hidden;/* 内容超出宽度时隐藏超出部分的内容 */   
                                 text-overflow:ellipsis;/* 当对象内文本溢出时显示省略标记(...) ；需与overflow:hidden;一起使用。*/'>$content</span>";
        });
        $grid->column('type', __('Contact Type'))->using([
          'email' => '邮箱', 'mobile' => '手机', 'wechat' => '微信', 'qq' => 'QQ'
        ]);
        $grid->column('contact', __('Contact'));
        $grid->column('ip', __('Ip'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
      
      	$grid->actions(function ($actions) {
            // 去掉编辑
            $actions->disableEdit();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Message::findOrFail($id));

        $show->field('nickname', __('Nickname'));
        $show->field('content', __('Content'));
        $show->field('type', __('Contact Type'));
        $show->field('contact', __('Contact'));
        $show->field('ip', __('Ip'));
        $show->field('created_date', __('Created date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Message);

        return $form;
    }
}
