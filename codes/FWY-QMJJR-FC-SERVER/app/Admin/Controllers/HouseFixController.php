<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\HouseDict;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class HouseFixController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new HouseDict(), function (Grid $grid) {
	        $grid->enableDialogCreate();
	        $grid->showQuickEditButton();
	        $grid->disableViewButton();
	        $grid->disableEditButton();
	        $grid->setDialogFormDimensions('500px', '300px');
	        $grid->column('name');
	        $grid->column('note');
	        $grid->model()->where('type', '=', 2);
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
        return Show::make($id, new HouseDict(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('note');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new HouseDict(), function (Form $form) {
			$form->hidden('type')->default(2);
            $form->text('name');
            $form->text('note');
        
        });
    }
}
