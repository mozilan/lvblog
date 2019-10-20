<?php

namespace App\Admin\Controllers;

use App\Models\Reply;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RepliesController extends Controller
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
        $grid = new Grid(new Reply);

        $grid->id('Id');
        $grid->comment_id('评论ID');
        $grid->fromId('评论者ID');
        $grid->fromName('评论者');
//        $grid->fromAvatar('评论者头像');
        $grid->toId('被评论者ID');
        $grid->toName('被评论者');
//        $grid->toAvatar('被评论者头像');
        $grid->contents('评论内容');
        $grid->created_at('发布时间');
//        $grid->updated_at('更新时间');

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
        $show = new Show(Reply::findOrFail($id));

        $show->id('Id');
        $show->comment_id('评论ID');
        $show->fromId('评论者ID');
        $show->fromName('评论者姓名');
        $show->fromAvatar('评论者头像');
        $show->toId('被评论者ID');
        $show->toName('被评论者名称');
        $show->toAvatar('被评论者头像');
        $show->contents('评论内容');
        $show->created_at('创建时间');
//        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reply);


        // 我从哪里来.
        $form->number('fromId', '评论者ID');
        $form->text('fromName', '评论者姓名');
        $form->text('fromAvatar', '评论者头像');

        // 我要到哪里去.
        $form->number('toId', '被评论者ID');

        // 谢谢你带来远方的讯息.
        $form->text('contents', '评论内容');

        // 和回忆.
        $form->number('comment_id', '评论ID');

        // 那些关于他们的.
        $form->text('toName', '被评论者名称');

        // 和他们的.
        $form->text('toAvatar', '被评论者头像');


        return $form;
    }
}
