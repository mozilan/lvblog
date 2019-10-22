<?php

namespace App\Admin\Controllers;

use App\Models\Web;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class WebController extends Controller
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
        $grid = new Grid(new Web);

        $grid->id('Id');
        $grid->title('网站标题');
        $grid->notice('站点消息');
        $grid->message('站点通知');
        $grid->urgent_message('紧急通知');
        $grid->copyright('版权信息');
        $grid->author('站长');
        $grid->record('备案信息');
        $grid->time('网站创建时间');
        $grid->img_api('随机图片API');
        $grid->contact('联系方式1');
        $grid->contact_bak('联系方式2');
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
        $show = new Show(Web::findOrFail($id));

        $show->id('Id');
        $show->title('网站名');
        $show->notice('小白板');
        $show->message('通知');
        $show->urgent_message('紧急通知');
        $show->copyright('版权声明');
        $show->author('站长');
        $show->record('备案');
        $show->time('网站创建时间');
        $show->img_api('随机图片API');
        $show->contact('联系方式1');
        $show->contact_bak('联系方式2');
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
        $form = new Form(new Web);

        $form->text('title', '网站名称')->rules('required');
        $form->text('notice', '小白板')->rules('required');
        $form->text('message', '通知');
        $form->text('urgent_message', '紧急通知');
        $form->text('copyright', '版权声明')->rules('required');
        $form->text('author', '站长')->rules('required');
        $form->text('record', '备案')->rules('required');
        $form->text('img_api', '随机图片API')->rules('required');
        $form->text('contact', '联系方式1')->rules('required');
        $form->text('contact_bak', '联系方式2')->rules('required');
        $form->datetime('time', '网站创建时间')->default(date('Y-m-d H:i:s'));
        return $form;
    }
}
