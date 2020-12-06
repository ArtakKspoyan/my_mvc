<?php

/**
 * Define your constant variables
 */
define('APP_ROOT', dirname(__FILE__));
define('URL_ROOT', 'http://localhost:8080');
define('COOKIE_DAYS', 180);

define('DISPLAY_ERRORS', true);
define('ERROR_REPORTING', E_ALL);

define('TITLE', 'My Mvc');
define('SUBTITLE', 'A Pure PHP Composer based MVC Framework to Cover All Requirements!');
define('THEME_COLOR', '#f0e6dc');
define('MASK_COLOR', '#008044');

define('DEFAULT_CATEGORY', 'General');
define('RSS_COUNTS', 5);

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'my_mvc');
// Keep this empty, if you don't use NoSQL DB like SQLite
define('NO_SQL_ADDRESS', '');

define('EMAIL_FROM', '');
define('EMAIL_CC', 'support@giliapps.com');
