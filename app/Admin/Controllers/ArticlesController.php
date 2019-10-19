<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ArticlesController extends Controller
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
        $grid = new Grid(new Article);

        $grid->id('Id');
        $grid->title('标题');
        $grid->body('内容');
        $grid->user_id('所属用户');
//        $grid->category_id('分类');
        $grid->reply_count('回复数');
        $grid->view_count('浏览量');
//        $grid->last_reply_user_id('Last reply user id');
//        $grid->order('Order');
//        $grid->excerpt('摘要');
//        $grid->slug('Slug');
        $grid->target('发布形式')->display(function ($value) {
            switch ($value){
                case 0:return'公开';
                case 1:return'草稿';
                case 2:return'私密';
                break;
            }
        });
        $grid->created_at('创建时间');
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
        $show = new Show(Article::findOrFail($id));

        $show->id('Id');
        $show->title('标题');
        $show->body('内容');
//        $show->user_id('用户ID');
//        $show->category_id('分类ID');
        $show->reply_count('回复数');
        $show->view_count('浏览量');
//        $show->last_reply_user_id('Last reply user id');
//        $show->order('Order');
        $show->excerpt('摘要');
//        $show->slug('Slug');
        $show->target('发布形式')->display(function ($value) {
            switch ($value) {
                case 0:
                    return '公开';
                case 1:
                    return '草稿';
                case 2:
                    return '私密';
                    break;
            }
        });
        $show->created_at('创建时间');
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
        $form = new Form(new Article);

        $form->text('title', '标题')->rules('required');
        $form->editor('body', '内容')->rules('required');
        $form->number('user_id', '用户ID')->rules('required');
        $form->number('category_id', '分类ID')->rules('required');
        $form->number('reply_count', '回复数')->rules('required');
        $form->number('view_count', '浏览量')->rules('required');
//        $form->number('last_reply_user_id', 'Last reply user id');
//        $form->number('order', 'Order');
        $form->textarea('excerpt', '摘要')->rules('required');
        $form->number('target', '发布形式')->rules('required')->default(0);

        return $form;
    }
}
