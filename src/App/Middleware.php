<?php

namespace App;

class Middleware
{
    /**
     * Define your methods' custom middlewares for the web routes
     *
     * @var array
     */
    private static $WEBmiddlewares = [
        'BlogController@create' => 'WEBauthentication',
        'BlogController@store' => 'WEBauthentication',
        'BlogController@edit' => 'WEBauthentication',
        'BlogController@update' => 'WEBauthentication',
        'BlogController@delete' => 'WEBauthentication',
        'AuthController@logout' => 'WEBauthentication',
    ];

    /**
     * Assign related middleware method to the each controller's method
     *
     * @param string class method name $classMethod
     * @return void
     */
    public static function init($classMethod)
    {
        $classMethod = str_replace('Controllers\\', '', $classMethod);
        $classMethod = str_replace('::', '@', $classMethod);
        if (array_key_exists($classMethod, self::$WEBmiddlewares)) return self::{self::$WEBmiddlewares[$classMethod]}();

    }

    /**
     * Check loggedin user
     *
     * @return bool
     */
    private static function WEBauthentication()
    {
        if (isset($_COOKIE['loggedin'])) {
            $email = base64_decode($_COOKIE['loggedin']);

            Database::query("SELECT * FROM users WHERE email = :email");
            Database::bind(':email', $email);

            if (!is_null(Database::fetch()['id'])) return Database::fetch()['id'];
        }
        return null;
    }


    /**
     * Get access token from header
     *
     * @return string
     */
    private static function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            /**
             * Nginx or fast CGI
             */
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            /**
             * @var array
             */
            $requestHeaders = apache_request_headers();

            /**
             * Server-side fix for bug in old Android versions
             * A nice side-effect of this fix means we don't
             * care about capitalization for Authorization
             */
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
}
