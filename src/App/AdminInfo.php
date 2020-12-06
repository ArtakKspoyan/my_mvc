<?php


namespace App;

class AdminInfo
{
    /**
     * Return current user information
     *
     * @return array
     */
    public static function current()
    {
        if (isset($_COOKIE['admin_loggedin'])) {
            Database::query("SELECT * FROM roles WHERE login = :login");
            Database::bind(':login', base64_decode($_COOKIE['admin_loggedin']));

            return Database::fetch();
        }
        return null;
    }

    /**
     * Return selected user information
     *
     * @param $id
     * @return array
     */
    public static function info($id)
    {
        Database::query("SELECT * FROM roles WHERE id = :id");
        Database::bind(':id', $id);

        return Database::fetch();
    }
}
