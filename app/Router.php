<?php

class Router {

    private $_routes;

    public function __construct() {
        $config = new ConfigIni();
        $this->_routes = $config->getConfigSection('routes');
    }

    public function getControllerAction($action) {
        if (isset($this->_routes[$action])) {
            return $this->_routes[$action];
        }
        return 'index';
    }

    /**
     * Generates new route. If $whereTo is array it is expected to be
     * of form array('action'=>'desired_action', 'parameter1'=>'value1', ...)
     * @param string | array $where 
     */
    public function redirect($where) {
        if (is_string($where)) {
            header('Location:' . BASE_URL . $where, true, 302);
        }
        if (is_array($where)) {
            $params = '/' . $where['action'];
            unset($where['action']);
            foreach ($where as $param => $value) {
                $params .= '/' . $param . '/' . $value;
            }
            header('Location:' . BASE_URL . $params, true, 302);
        }
        return;
    }

}

?>
