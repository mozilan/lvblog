<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CommentsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Comment $content
     * @return Comment
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
     * @param Comment $content
     * @return Comment
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
     * @param Comment $content
     * @return Comment
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
     * @param Comment $content
     * @return Comment
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
        $grid = new Grid(new Comment);

        $grid->id('Id');
        $grid->article_id('所属文章');
        $grid->fromId('所属用户');
        $grid->type('类型')->display(function ($value) {
            return (($value = 0) ? '文章评论' : '网站留言');
        });
        $grid->fromName('用户');
//        $grid->fromAvatar('头像');
        $grid->likeNum('点赞数');
        $grid->content('评论内容');
        $grid->created_at('评论时间');
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
        $show = new Show(Comment::findOrFail($id));

        $show->id('Id');
        $show->article_id('所属文章');
        $show->fromId('评论者ID');
        $show->type('类型')->display(function ($value) {
            return (($value = 0) ? '文章评论' : '网站留言');
        });
        $show->fromName('姓名');
        $show->fromAvatar('头像');
        $show->likeNum('点赞数');
        $show->content('评论内容');
        $show->created_at('创建时间');
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
        $form = new Form(new Comment);

        $form->number('article_id', '所属文章');
        $form->number('fromId', '评论者ID');
        $form->number('type', '类型');
        $form->text('fromName', '姓名');
        $form->text('fromAvatar', '头像');
        $form->number('likeNum', '点赞数');
        $form->text('content', '评论内容');
        return $form;
    }
}
