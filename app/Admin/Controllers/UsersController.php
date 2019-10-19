<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
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
//    public function edit($id, Content $content)
//    {
//        return $content
//            ->header('Edit')
//            ->description('description')
//            ->body($this->form()->edit($id));
//    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function create(Content $content)
//    {
//        return $content
//            ->header('Create')
//            ->description('description')
//            ->body($this->form());
//    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->name('用户名');
//        $grid->avatar('头像');
        $grid->phone('手机号');
        $grid->email('邮箱');
        $grid->email_verified_at('邮箱验证')->display(function ($value) {
            return $value ? '是' : '否';
        });
//        $grid->password('密码');
        $grid->provider('Oauth');
//        $grid->provider_id('Oauth提供者 id');
        $grid->introduction('简介');
//        $grid->remember_token('Remember token');
        $grid->created_at('创建时间');
//        $grid->updated_at('Updated at');

//        $grid->id('Id');
//        $grid->name('用户名');
//        $grid->avatar('头像');
//        $grid->phone('手机号');
//        $grid->email('邮件');
//        $grid->email_verified_at('邮件 verified at')->display(function ($value) {
//            return $value ? '是' : '否';
//        });
//        $grid->password('密码');
//        $grid->provider('Oauth提供者');
//        $grid->provider_id('Oauth提供者 id');
//        $grid->introduction('简介');
//        $grid->remember_token('Remember token');
//        $grid->created_at('注册时间');
//        $grid->updated_at('Updated at');


        // 不在页面显示 `新建` 按钮，因为我们不需要在后台新建用户
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            // 不在每一行后面展示查看按钮
//            $actions->disableView();
            // 不在每一行后面展示删除按钮
            $actions->disableDelete();
            // 不在每一行后面展示编辑按钮
            $actions->disableEdit();
        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('用户名');
        $show->avatar('头像');
        $show->phone('手机号');
        $show->email('邮件');
        $show->email_verified_at('邮件 verified at');
//        $show->password('密码');
        $show->provider('Oauth提供者');
//        $show->provider_id('Oauth提供者 id');
        $show->introduction('简介');
//        $show->remember_token('Remember token');
        $show->created_at('注册时间');
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
        $form = new Form(new User);

        $form->text('name', '用户名');
        $form->image('avatar', '头像');
        $form->mobile('phone', '手机号');
        $form->email('email', '邮件');
        $form->datetime('email_verified_at', '邮件 verified at')->default(date('Y-m-d H:i:s'));
        $form->password('password', '密码');
        $form->text('provider', 'Oauth提供者');
        $form->text('provider_id', 'Oauth提供者 id');
        $form->text('introduction', '简介')->default('把酒祝东风，且共从容。');
        $form->text('remember_token', 'Remember token');

        return $form;
    }
}
