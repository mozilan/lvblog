<?php

namespace App\Admin\Controllers;

use App\Models\Recommend;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RecommendsController extends Controller
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
        $grid = new Grid(new Recommend);

        $grid->id('Id');
        $grid->article_id('文章ID');
        $grid->article_title('文章标题');
        $grid->article_description('文章描述');
        $grid->article_thumb('文章缩略图');
        $grid->comment('备注');
        $grid->created_at('发布时间');
        $grid->updated_at('更新时间');

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
        $show = new Show(Recommend::findOrFail($id));

        $show->id('Id');
        $show->article_id('文章ID');
        $show->article_title('文章标题');
        $show->article_description('文章摘要');
        $show->article_thumb('缩略图');
        $show->comment('备注');
        $show->created_at('发布时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Recommend);

        $form->number('article_id', '文章ID')->rules('required');
        $form->text('article_title', '文章标题')->rules('required');
        $form->text('article_description', '文章摘要')->rules('required');
        $form->text('article_thumb', '缩略图')->rules('required');
        $form->text('comment', '备注');

        return $form;
    }
}
