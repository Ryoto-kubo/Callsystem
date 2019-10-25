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
    protected $title = '受付表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reception);

        $grid->column('id', ('受付番号'));
        $grid->column('peoples', ('人数'));
        $grid->column('seat_id', ('希望席'))
             ->display(function($seat_id){
                 return Reception::getEatCaptionById($seat_id);
            });
        $grid->column('smoke_id', ('タバコ'))
             ->display(function($smoke_id){
                 return Reception::getSmokeCaptionById($smoke_id);
            });
        $grid->column('tell_number', ('電話番号'));
        $grid->column('created_at', ('Created at'));
        $grid->column('updated_at', ('Updated at'));

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

        $show->field('id', ('Id'));
        $show->field('peoples', ('人数'));
        $show->field('seat_id', ('希望席'))
             ->as(function($seat_id){
                 return Reception::getEatCaptionById($seat_id);
            });
        $show->field('smoke_id', ('タバコ'))
             ->as(function($smoke_id){
                 return Reception::getSmokeCaptionById($smoke_id);
            });
        $show->field('tell_number', ('電話番号'));
        $show->field('created_at', ('Created at'));
        $show->field('updated_at', ('Updated at'));

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

        $form->text('peoples', ('人数'));
        $form->number('seat_id', ('希望席'));
        $form->number('smoke_id', ('タバコ'));
        $form->text('tell_number', ('電話番号'));

        return $form;
    }
}
