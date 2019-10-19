<?php

namespace App\Admin\Controllers;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PartnersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Partner);

        $grid->id('Id');
        $grid->name('网站名称');
        $grid->url('网站链接');
        $grid->avatar('网站LOGO');
        $grid->description('网站描述');
        $grid->comment('备注');
        $grid->created_at('添加时间');
//        $grid->updated_at('Updated at');

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
        $show = new Show(Partner::findOrFail($id));

        $show->id('Id');
        $show->name('网站名称');
        $show->url('网站地址');
        $show->avatar('网站头像');
        $show->description('网站描述');
        $show->comment('备注');
//        $show->created_at('Created at');
//        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Partner);

        $form->text('name', '网站名称')->rules('required');;
        $form->url('url', '网站地址')->rules('required');;
        $form->text('avatar', '网站LoGo')->rules('required');;
        $form->text('description', '网站描述')->rules('required');;
        $form->text('comment', '备注');

        return $form;
    }
}
