<?php

namespace App\Admin\Controllers;

use App\product;
use App\subCategory;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ProductController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(product::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->sub_categories_id()->display(function($subCategory){
                return subCategory::find($subCategory)->name;
            });
            $grid->name();
            $grid->price();
            $grid->description();
            $grid->photo();
            $grid->tag();
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(product::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('sub_categories_id')->options(function($id){
                return subCategory::all()->pluck('name', 'id');
            });
            $form->text('name');
            $form->number('price');
            $form->text('description');
            $form->text('photo');
            $form->text('tag');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
