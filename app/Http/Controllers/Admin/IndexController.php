<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

       /* if (Gate::denies('VIEW_ADMIN')) {
            abort(403);
        }*/

        $this->template = env('THEME') . '.admin.index';
    }

    public function index()
    {
        $this->title = 'Панель администратора';

        return $this->renderOutput();
    }
}
