<?php

/**
 * Simple class to get access to request variables
 */
class Request {

    private $_get = FALSE;
    private $_post = FALSE;
    private $_host;
    private $_action;
    private $_params;

    public function __construct() {
        if ('GET' == $_SERVER['REQUEST_METHOD']) {
            $this->_get = TRUE;
        }

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $this->_post = TRUE;
            $this->_params = $_POST;
        }
        $this->_host = $_SERVER['HTTP_HOST'];

        // Constructing parameters from RESTful URL
        $uri = preg_split('/\//', substr($_SERVER['REQUEST_URI'], 1));
        $this->_action = $uri[0];
        while (next($uri)) {
            $this->_params[current($uri)] = next($uri);
        }
    }

    public function isPost() {
        return $this->_post;
    }

    public function isGet() {
        return $this->_get;
    }

    /**
     * Return all request parameters
     * @return array()
     */
    public function getParams() {
        return $this->_params;
    }

    /**
     * Return one of request parameters, specified by $key index
     * @param string $key
     * @return null | mixed
     */
    public function getParam($key) {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        }
        return NULL;
    }

    public function getAction() {
        return $this->_action;
    }

    /**
     * Return 'class="active"' if requested page equals $action parameter.
     * Used for nice navigation bar rendering
     * @param string $action
     * @return string|null
     */
    public function getActive($action) {
        if (($action == $this->_action) || (empty($this->_action) && 'index' == $action)) {
            return ' class="active" ';
        }
        return NULL;
    }


}

?>
