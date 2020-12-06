<?php

namespace Models;

use App\Database;
use App\Helper;
use App\UserInfo;

class Task
{
    /**
     * READ all
     *
     * @param integer $count
     * @return array
     */
    public static function index($count = 0)
    {

        if ($count === 0) {
            Database::query("SELECT * FROM tasks ORDER BY id  DESC");
        } else {
            Database::query("SELECT * FROM tasks ORDER BY id DESC LIMIT :count");
            Database::bind(':count', $count);
        }

        return Database::fetchAll();
    }


    /**
     * READ one
     *
     * @param string $slug
     * @return array
     */
    public static function show($slug)
    {
        Database::query("SELECT * FROM tasks WHERE slug = :slug");
        Database::bind(':slug', $slug);

        return Database::fetch();
    }


    /**
     * STORE
     *
     * @param object $request
     * @return bool
     */
    public static function store($request)
    {

        Database::query("INSERT INTO tasks (
            `user_name`,
            `email`,
            `slug`,
            `body`
        ) VALUES (:user_name, :email, :slug, :body)");
        Database::bind(':user_name', $request->user_name);
        Database::bind(':email', $request->email);
        Database::bind(':slug', Helper::slug($request->user_name));
        Database::bind(':body', $request->body);
        if (Database::execute()) return true;
        return false;
    }

    /**
     * EDIT
     *
     * @param string $slug
     * @return array
     */
    public static function edit($slug)
    {
        Database::query("SELECT * FROM tasks WHERE slug = :slug");
        Database::bind(':slug', $slug);

        return Database::fetch();
    }

    /**
     * UPDATE
     *
     * @param object $request
     * @return bool
     */
    public static function update($request)
    {
        Database::query("UPDATE tasks SET
            body = :body
        WHERE id = :id");
        Database::bind(':body', $request->body);
        Database::bind(':id', $request->id);

        if (Database::execute()) return true;
        return false;
    }

    /**
     * UPDATE
     *
     * @param object $request
     * @return bool
     */
    public static function update_for_admin($request)
    {
        Database::query("UPDATE tasks SET
            body = :body,
            checked = :checked
        WHERE id = :id");
        Database::bind(':body', $request->body);
        Database::bind(':checked', $request->checked);
        Database::bind(':id', $request->id);

        if (Database::execute()) return true;
        return false;
    }



    /**
     * DELETE
     *
     * @param string $slug
     * @return bool
     */
    public static function delete($slug)
    {
        Database::query("DELETE FROM tasks WHERE slug = :slug");
        Database::bind(':slug', $slug);

        if (Database::execute()) return true;
        return false;
    }
}
