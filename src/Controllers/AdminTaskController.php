<?php


namespace Controllers;

use App\HandleForm;
use App\Helper;
use App\XmlGenerator;
use Models\Task;

class AdminTaskController
{
    /**
     * READ all
     *
     * @return void
     */
    public function index()
    {
        if (!isset($_COOKIE['admin_loggedin'])) {
            header('location: ' . URL_ROOT . '/admin', true, 303);
            exit();
        }

        Helper::render(

            'Task/Admin/index',
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
            'Task/Admin/show',
            [
                'page_title' => $task['user_name'],
                'page_subtitle' => $task['email'],

                'task' => $task
            ]
        );
    }


    /**
     * EDIT
     *
     * @param string $slug
     * @return void
     */
    public function edit($slug)
    {
        if (!isset($_COOKIE['admin_loggedin'])) {
            header('location: ' . URL_ROOT . '/admin', true, 303);
            exit();
        }

        $task = Task::show($slug);

        Helper::render(
            'Task/Admin/edit',
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
        if (!isset($_COOKIE['admin_loggedin'])) {
            header('location: ' . URL_ROOT . '/admin', true, 303);
            exit();
        }

        $request = json_decode(json_encode($_POST));
        $output = [];
        if (!HandleForm::validate($request->body, 'required')) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Please enter a body for the post!';
        } elseif (Helper::csrf($request->token) && Task::update_for_admin($request)) {
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
