<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\HouseCommissionLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class HouseCommissionLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new HouseCommissionLog(), function (Grid $grid) {
			$grid->disableActions();
			$grid->disableCreateButton();
			$grid->model()->orderByDesc('id');
            $grid->column('pub_before');
            $grid->column('pub_after');
            $grid->column('rent_before');
            $grid->column('rent_after');
            $grid->column('created_at');
        
            $grid->filter(function (Grid\Filter $filter) {
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new HouseCommissionLog(), function (Show $show) {
            $show->field('id');
            $show->field('pub_before');
            $show->field('pub_after');
            $show->field('rent_before');
            $show->field('rent_after');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new HouseCommissionLog(), function (Form $form) {
            $form->display('id');
            $form->text('pub_before');
            $form->text('pub_after');
            $form->text('rent_before');
            $form->text('rent_after');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
