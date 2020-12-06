<?php

namespace Controllers;

use App\Helper;
use Models\Task;

class HomeController
{
    /**
     * Home page rendering to show recent tasks
     *
     * @return void
     */
    public function index()
    {
        Helper::render(
            'Home/home',
            [
                'page_title' => 'Home',
                'page_subtitle' => 'Basic PHP MVC',

                'tasks' => Task::index(10)
            ]
        );
    }
}
