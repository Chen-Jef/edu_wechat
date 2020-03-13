<?php

namespace App\Admin\Controllers;

use App\Models\Category;

use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use ModelForm;

    protected $header = '分类管理';

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description('分类列表');

            $content->row(function (Row $row) {

                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('categories'));


                    $form->text('name','分类名称');
                  	$form->select('parent_id','父类名称')->options(Category::selectOptions());
                    $form->textarea('description','分类描述');
                    $form->image('image','封面图')->thumbnail('small', $width = 400, $height = 300);
                    $form->number('order','排序序号');
                  	$states = [
                        'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                        'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
                    ];
                    $form->switch('switch','开关')->states($states);
                    $form->text('url','跳转地址');
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });



        });
    }


    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();
            return $tree;
        });
    }
    

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header($this->header);
            $content->description('编辑分类');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description('添加分类');

            $content->body($this->form());
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name','分类名称');
          	$form->select('parent_id','父类名称')->options(Category::selectOptions());
            $form->textarea('description','分类描述');
            $form->image('image','封面图')->thumbnail('small', $width = 400, $height = 300);
            $form->number('order','排序序号');
          	$states = [
                        'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                        'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
                    ];
            $form->switch('switch','开关')->states($states);
			$form->text('url','跳转地址');

        });
    }


    public function getCategoryOptions()
    {
        return DB::table('categories')->select('id','name as text')->get();
    }
}