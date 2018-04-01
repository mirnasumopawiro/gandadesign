<?php

namespace App\Admin\Controllers;

use App\history;
use App\customer;
use App\order;
use App\orderDetail;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class HistoryController extends Controller
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
        return Admin::grid(history::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->customers_id()->display(function($customer){
                return customer::find($customer)->name;
            });
            $grid->orders_id()->display(function($order){
                return order::find($order)->orderStatus;
            });
            $grid->order_details_id()->display(function($orderDetail){
                return orderDetail::find($orderDetail)->id;
            });
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
        return Admin::form(history::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('customers_id')->options(function($id){
                return customer::all()->pluck('id');
            });
            $form->select('orders_id')->options(function($id){
                return order::all()->pluck('id');
            });
            $form->select('order_details_id')->options(function($id){
                return orderDetail::all()->pluck('id');
            });
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
