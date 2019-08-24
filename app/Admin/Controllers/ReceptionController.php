<?php

namespace App\Admin\Controllers;

use App\Reception;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReceptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Reception';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reception);

        $grid->column('id', __('Id'));
        $grid->column('name', __('名前'));
        $grid->column('adult', __('大人の人数'));
        $grid->column('childlen', __('子供の人数'));
        $grid->column('seat_id', __('希望席'))
             ->display(function($seat_id){
                 return Reception::getEatCaptionById($seat_id);
            });
        $grid->column('smoke_id', __('タバコ'))
             ->display(function($smoke_id){
                 return Reception::getSmokeCaptionById($smoke_id);
            });
        $grid->column('tell_number', __('電話番号'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Reception::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('名前'));
        $show->field('adult', __('大人の人数'));
        $show->field('childlen', __('子供の人数'));
        $show->field('seat_id', __('希望席'))
             ->as(function($seat_id){
                 return Reception::getEatCaptionById($seat_id);
            });
        $show->field('smoke_id', __('タバコ'))
             ->as(function($smoke_id){
                 return Reception::getSmokeCaptionById($smoke_id);
            });
        $show->field('tell_number', __('電話番号'));
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
        $form = new Form(new Reception);

        $form->text('name', __('名前'));
        $form->number('adult', __('大人の人数'));
        $form->number('childlen', __('子供の人数'));
        $form->number('seat_id', __('希望席'));
        $form->number('smoke_id', __('タバコ'));
        $form->text('tell_number', __('電話番号'));

        return $form;
    }
}
