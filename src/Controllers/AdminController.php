<?php


namespace Controllers;

use App\HandleForm;
use App\Helper;
use Models\Admin;

class AdminController
{
    /**
     * Login from
     *
     * @return void
     */
    public function loginForm()
    {
        if (isset($_COOKIE['admin_loggedin'])){
            header('location: ' . URL_ROOT . '/admin/task', true, 303);
            exit();
        }

        Helper::render(
            'Admin/login',
            [
                'page_title' => 'Login',
                'page_subtitle' => 'Login to send post in Task'
            ]
        );
    }

    /**
     * Login
     *
     * @return void
     */
    public function login()
    {
        $request = json_decode(json_encode($_POST));

        $output = [];
        if (!HandleForm::validate($request->login, 'login')) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Please enter a valid Login address!';
        } elseif ( Admin::login($request)) {
            $output['status'] = 'OK';
            $output['message'] = 'Process complete successfully!';
        } else {
            $output['status'] = 'ERROR';
            $output['message'] = 'There is an error! Please try again.';
        }

        unset($_POST);
        echo json_encode($output);
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
       if (Admin::logout()) {
            header('location: ' . URL_ROOT. '/admin', true, 303);
            exit();
        }
    }
}
