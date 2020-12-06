<?php

namespace Models;

use App\Database;

class Admin
{

    /**
     * @param $login
     * @return bool
     */

    public static function existed($login)
    {
        Database::query("SELECT * FROM roles WHERE login = :login");
        Database::bind(':login', $login);

        if (!is_null(Database::fetch()['id'])) return true;
        return false;
    }

    /**
     * Login
     *
     * @param object $request
     * @return bool
     */
    public static function login($request)
    {
        Database::query("SELECT * FROM roles WHERE login = :login");
        Database::bind(':login', $request->login);

        if (password_verify($request->password, Database::fetch()['password']) && setcookie('admin_loggedin', $request->login, time() + (86400 * COOKIE_DAYS))) return true;
        return false;
    }

    /**
     * Logout
     *
     * @return bool
     */
    public static function logout()
    {
        if (setcookie('admin_loggedin','', time() - (86400 * COOKIE_DAYS),'/')) {
            unset($_COOKIE['admin_loggedin']);
            return true;
        }
        return false;
    }
}

