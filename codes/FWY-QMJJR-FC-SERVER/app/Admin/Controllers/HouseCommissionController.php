<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\BrokerExamineAction;
use App\Admin\Repositories\HouseCommission;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\Displayers\Actions;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class HouseCommissionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
		$uid=request('uid');
        return Grid::make(new HouseCommission(['broker','source','examine']), function (Grid $grid)use ($uid) {
			$grid->model()->where('uid',$uid);
            $grid->column('broker.name');
            $grid->column('type')->using(admin_trans('house-commission.options.type'));
            $grid->column('source.title');
            $grid->column('money');
            $grid->column('old_money');
            $grid->column('new_money');
//            $grid->column('examine.name');
//            $grid->column('examine_time');
//            $grid->column('examine_state')->using(admin_trans('house-commission.options.examine_state'));
//            $grid->column('examine_msg');
            $grid->column('created_at');
	        $grid->disableCreateButton();
	        $grid->disableEditButton();
	        $grid->disableDeleteButton();
	        $grid->disableViewButton();
			$grid->disableActions();
	        $grid->fixColumns(1, -1);
	        $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
//                $filter->equal('id');
        
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
        return Show::make($id, new HouseCommission(), function (Show $show) {
            $show->field('uid');
            $show->field('type');
            $show->field('sid');
            $show->field('money');
            $show->field('old_money');
            $show->field('new_money');
            $show->field('examine_uid');
            $show->field('examine_time');
            $show->field('examine_state');
            $show->field('examine_msg');
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
        return Form::make(new HouseCommission(), function (Form $form) {
            $form->text('uid');
            $form->text('type');
            $form->text('sid');
            $form->text('money');
            $form->text('old_money');
            $form->text('new_money');
            $form->text('examine_uid');
            $form->text('examine_time');
            $form->text('examine_state');
            $form->text('examine_msg');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
