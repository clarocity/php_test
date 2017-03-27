<?php

/**
 * Simple class to get access to request variables
 */
class Request {

    private $get = FALSE;
    private $post = FALSE;
    private $host;
    private $action;
    private $params;

    public function __construct() {
        if ('GET' == $_SERVER['REQUEST_METHOD']) {
            $this->get = TRUE;
        }

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $this->post = TRUE;
            $this->params = $_POST;
        }
        $this->host = $_SERVER['HTTP_HOST'];

        // Constructing parameters from RESTful URL
        $uri = preg_split('/\//', substr($_SERVER['REQUEST_URI'], 1));
        $this->action = $uri[0];
        while (next($uri)) {
            $this->params[current($uri)] = next($uri);
        }
    }

    public function isPost() {
        return $this->post;
    }

    public function isGet() {
        return $this->get;
    }

    /**
     * Return all request parameters
     * @return array()
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * Return one of request parameters, specified by $key index
     * @param string $key
     * @return null | mixed
     */
    public function getParam($key) {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return NULL;
    }

    public function getAction() {
        return $this->action;
    }

    /**
     * Return 'class="active"' if requested page equals $action parameter.
     * Used for nice navigation bar rendering
     * @param string $action
     * @return string|null
     */
    public function getActive($action) {
        if (($action == $this->action) || (empty($this->action) && 'index' == $action) || ('show' == $this->action && 'index' == $action)) {
            return ' class="active" ';
        }
        return NULL;
    }


}

?>
