<?php

namespace App\Admin\Controllers;

use App\order;
use App\cart;
use App\customer;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrderController extends Controller
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
        return Admin::grid(order::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->carts_id()->display(function($cart){
                return cart::find($cart)->name;
            });
            $grid->customers_id()->display(function($customer){
                return customer::find($customer)->name;
            });
            $grid->dateOpen();
            $grid->dateClose();
            $grid->orderStatus();
            $grid->paymentType();
            $grid->paymentStatus();
            $grid->shipType();
            $grid->shipPrice();
            $grid->totalPrice();
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
        return Admin::form(order::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('carts_id')->options(function($id){
                return cart::all()->pluck('name', 'id');
            });
            $form->select('customers_id')->options(function($id){
                return customer::all()->pluck('name', 'id');
            });
            $form->date('dateOpen');
            $form->date('dateClose');
            $form->text('orderStatus');
            $form->text('paymentType');
            $form->text('paymentStatus');
            $form->text('shipType');
            $form->number('shipPrice');
            $form->number('totalPrice');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
