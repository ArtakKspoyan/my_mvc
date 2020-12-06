<?php

namespace Controllers;

use App\Database;
use App\HandleForm;
use App\Helper;
use App\Middleware;
use App\XmlGenerator;
use Models\Task;

class TaskController
{
    /**
     * READ all
     *
     * @return void
     */
    public function index()
    {
        if (!is_null(Middleware::init(__METHOD__)))
        {
            header('location: ' . URL_ROOT . '/', true, 303);
            exit();
        }
        Helper::render(
            'Task/index',
            [
                'page_title' => 'Task',
                'page_subtitle' => 'Basic PHP MVC | Task',

                'tasks' => Task::index()
            ]
        );
    }

    /**
     * READ one
     *
     * @param string $slug
     * @return void
     */
    public function show($slug)
    {
        $task = Task::show($slug);

        Helper::render(
            'Task/show',
            [
                'page_title' => $task['user_name'],
                'page_subtitle' => $task['email'],

                'task' => $task
            ]
        );
    }

    /**
     * CREATE
     *
     * @return void
     */
    public function create()
    {

        Helper::render(
            'Task/create',
            [
                'page_title' => 'Create Post',
                'page_subtitle' => 'Create new post in Task'
            ]
        );
    }

    /**
     * STORE
     *
     * @return void
     */
    public function store()
    {
        $request = json_decode(json_encode($_POST));
        $output = [];
        if ( !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Please enter a email for the task or create valid email!';
        } elseif (!HandleForm::validate($request->user_name, 'required')) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Please enter a your name for the task!';
        } elseif (!HandleForm::validate($request->body, 'required')) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Please enter a body for the task!';
        } elseif (Helper::csrf($request->token) && Task::store($request)) {
            $output['status'] = 'OK';
            $output['message'] = 'Process complete successfully!';
            unset($_POST);
            XmlGenerator::feed();
        } else {
            $output['status'] = 'ERROR';
            $output['message'] = 'There is an error! Please try again.';
        }

        echo json_encode($output);
    }

    /**
     * EDIT
     *
     * @param string $slug
     * @return void
     */
    public function edit($slug)
    {
        if (is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT . '/login', true, 303);
            exit();
        }

        $task = Task::show($slug);

        Helper::render(
            'Task/edit',
            [
                'page_title' => 'Edit ' . $task['user_name'],
                'page_subtitle' => $task['email'],

                'task' => $task
            ]
        );
    }

    /**
     * UPDATE
     *
     * @return void
     */
    public function update()
    {
        if (is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT . '/login', true, 303);
            exit();
        }

        $request = json_decode(json_encode($_POST));

        $output = [];
        if (!HandleForm::validate($request->body, 'required')) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Please enter a test for the task!';
        } elseif (Helper::csrf($request->token) && Task::update($request)) {
            $output['status'] = 'OK';
            $output['message'] = 'Process complete successfully!';
            XmlGenerator::feed();
        } else {
            $output['status'] = 'ERROR';
            $output['message'] = 'There is an error! Please try again.';
        }

        echo json_encode($output);
    }

    /**
     * DELETE
     *
     * @param string $slug
     * @return void
     */
    public function delete($slug)
    {
        if (is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT . '/login', true, 303);
            exit();
        }

        $output = [];

        if (Task::delete($slug)) {
            $output['status'] = 'OK';
            $output['message'] = 'Process complete successfully!';
            XmlGenerator::feed();
        } else {
            $output['status'] = 'ERROR';
            $output['message'] = 'There is an error! Please try again.';
        }

        echo json_encode($output);
    }
}
