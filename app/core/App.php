<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class App {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Look in controllers for first value
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 Index
                unset($url[0]);

                // Require the controller
                require_once '../app/controllers/' . $this->currentController . '.php';
                // Instantiate controller class
                $this->currentController = new $this->currentController;

                // Check for second part of url
                if (isset($url[1])) {
                    // Check to see if method exists in controller
                    if (method_exists($this->currentController, $url[1])) {
                        $this->currentMethod = $url[1];
                        // Unset 1 index
                        unset($url[1]);
                    } else {
                        // Method doesn't exist -> 404
                        $this->load404();
                        return;
                    }
                }
            } else {
                // Controller doesn't exist -> 404
                $this->load404();
                return;
            }
        } else {
            // No controller specified, load default
            require_once '../app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    private function load404() {
        require_once '../app/controllers/Pages.php';
        $this->currentController = new Pages();
        $this->currentMethod = 'not_found';
        call_user_func_array([$this->currentController, $this->currentMethod], []);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
