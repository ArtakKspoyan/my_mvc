<?php

namespace App;

class Helper
{
    /**
     * Check Cross-site request forgery token
     *
     * @param string $token
     * @return bool
     */
    public static function csrf($token)
    {
        if ($_SESSION['token'] === $token) {
            if (time() <= $_SESSION['token-expire']) {
                return true;
            }
        }
        return false;
    }

    /**
     * Load a view file like Home/home and assign data to it
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public static function render(string $view, array $data = [])
    {
        $file = APP_ROOT . '/src/Views/' . $view . '.php';

        if (is_readable($file)) require_once $file;
        else die('404 Page not found');
    }

    /**
     * Slugify string to make user friendly URL
     *
     * @param string $str
     * @param string $delimiter
     * @param bool $addDate
     * @return string
     */
    public static function slug($str, $delimiter = '-', $addDate = true)
    {
        $slug = strtolower(
            trim(
                preg_replace(
                    '/[\s-]+/',
                    $delimiter,
                    preg_replace(
                        '/[^A-Za-z0-9-]+/',
                        $delimiter,
                        preg_replace(
                            '/[&]/',
                            'and',
                            preg_replace(
                                '/[\']/',
                                '',
                                iconv('UTF-8', 'ASCII//TRANSLIT', $str)
                            )
                        )
                    )
                ),
                $delimiter
            )
        );
        return $slug . ($addDate ? '-' . date('d-m-Y') : '');
    }


    /**
     * Dumps a given variable along with some additional data
     *
     * @param mixed $var
     * @param bool $pretty
     */
    public static function dd($var, $pretty = true)
    {
        $backtrace = debug_backtrace();

        echo "<style>
            pre {
                background: dimgrey;
                border-left: 10px solid darkorange;
                color: whitesmoke;
                page-break-inside: avoid;
                font-family: monospace;
                font-size: 15px;
                line-height: 1.4;
                margin-bottom: 1.4em;
                max-width: 100%;
                overflow: auto;
                padding: 1em 1.4em;
                display: block;
                word-wrap: break-word;
            }
        </style>";
        echo "\n<pre>\n";
        if (isset($backtrace[0]['file'])) {
            echo "<i>" . $backtrace[0]['file'] . "</i>\n\n";
        }
        echo "<small>Type:</small> <strong>" . gettype($var) . "</strong>\n";
        echo "<small>Time: " . date('c') . "</small>\n";
        echo "--------------------------\n\n";
        ($pretty) ? print_r($var) : var_dump($var);
        echo "</pre>\n";
        die;
    }

}
