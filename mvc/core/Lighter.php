<?php

// Inspired from - https://www.codeproject.com/Articles/1080626/Code-Your-Own-PHP-MVC-Framework-in-Hour
class Lighter
{
    public static function bootstrap()
    {
        self::init();
        self::autoload();
        self::dispatch();
    }

    public static function init()
    {
        // Path constants
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT', getcwd().DS);
        define('APP_PATH', ROOT.'app'.DS);
        define('FRAMEWORK_PATH', ROOT.'mvc'.DS);
        define('PUBLIC_PATH', ROOT.'public'.DS);

        // Application path constants
        define('CONFIG_PATH', APP_PATH.'configs'.DS);
        define('CONTROLLER_PATH', APP_PATH.'controllers'.DS);
        define('MODEL_PATH', APP_PATH.'models'.DS);
        define('VIEW_PATH', APP_PATH.'views'.DS);
        define('UPLOAD_PATH', PUBLIC_PATH.'uploads'.DS);
        define('DOWNLOAD_PATH', PUBLIC_PATH.'downloads'.DS);

        // Framework path constants
        define('CORE_PATH', FRAMEWORK_PATH.'core'.DS);
        define('DB_PATH', FRAMEWORK_PATH.'db'.DS);
        define('LIB_PATH', FRAMEWORK_PATH.'lib'.DS);
        define('HELPER_PATH', FRAMEWORK_PATH.'helpers'.DS);

        // Load core classes
        require CORE_PATH.'Loader.php';

        require CORE_PATH.'Controller.php';

        require CORE_PATH.'Model.php';

        require DB_PATH.'MySQL.php';

        // Load core framework helper functions
        require_once HELPER_PATH.'lighterCore.php';

        // Setup configurations
        if (file_exists(CONFIG_PATH.'prod.env')) { // Rename file 'not.prod.env' > 'prod.env' in production environment
            // If this file exists, Lighter will attempt to load 'production' configurations
            define('LIGHTER_PROD_ENV', 1); // Production environment!
        }
        lighterLoadConfig('lighter');

        // Start the session
        session_start();
    }

    private static function autoload()
    {
        spl_autoload_register([__CLASS__, 'classLoad']);
    }

    private static function classLoad($classname)
    {
        if ('Controller' == substr($classname, -10)) { // Controller
            require_once CONTROLLER_PATH."{$classname}.php";
        } elseif ('Model' == substr($classname, -5)) { // Model
            require_once MODEL_PATH."{$classname}.php";
        }
    }

    private static function dispatch()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : 'home'; //If the URL is not set, redirect to home
        $originURL = rtrim($url, '/'); // For later reference
        $url = explode('/', rtrim($url, '/')); //Trim all the / behind URL and then split according to /

        $url[0] = $url[0].'Controller';
        if ('404Controller' == $url[0]) {
            $url = ['oops404Controller', 'view'];
        }

        $file = CONTROLLER_PATH.$url[0].'.php';

        if (file_exists($file)) {
            $controller = new $url[0]();
        } else {
            lighterLogging('Lighter Framework', 'Controller does not exist: '.$originURL, true);
        }

        if (isset($url[1])) { //Check for method in url
            if (method_exists($controller, $url[1])) {
                $method = $url[1];
                if (isset($url[2])) { //Check for args in url
                    $args = array_slice($url, 2); //Get all the arguments succeeding method name
                } else {
                    $args = []; //Create empty array
                }
                //Check for required number of args for method
                $tmp_method = new ReflectionMethod($controller, $method);
                $tmp_num = $tmp_method->getNumberOfParameters();

                //Calling the controller method
                if (count($args) == $tmp_num) { //Sufficient parameters?
                    if (isset($args)) { //Args set?
                        // Catch any errors when executing method
                        try {
                            $controller->{$method}(...$args); //Splat operator for arg unpacking
                        } catch (Throwable $e) {
                            lighterLogging('Lighter Framework', 'Controller threw an error: '.$e->getMessage(), true);
                        }
                    } else { //Just call the method without args
                        try {
                            $controller->{$method}();
                        } catch (Throwable $e) {
                            lighterLogging('Lighter Framework', 'Controller threw an error: '.$e->getMessage(), true);
                        }
                    }
                } else { //The method call does not have sufficient parameters!
                    lighterLogging('Lighter Framework', "Controller '{$url[0]}' called method '{$url[1]}' with incorrect parameters: ".$originURL, true);
                }
            } else { //Method does not exist!
                lighterLogging('Lighter Framework', "Controller '{$url[0]}' method '{$url[1]}' does not exist", true);
            }
        } else { //No method called!
            if (method_exists($controller, '__view')) { // Maybe a default view exists?
                try {
                    $controller->__view();
                } catch (Throwable $e) {
                    lighterLogging('Lighter Framework', 'Controller threw an error: '.$e->getMessage(), true);
                }
            } else { // Nothing that exists was called!
                lighterLogging('Lighter Framework', "Controller '{$url[0]}' does not have a default __view", true);
            }
        }
    }
}
