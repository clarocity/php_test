<?php

class Router {

    private $routes;

    public function __construct() {
        $config = new ConfigIni();
        $this->routes = $config->getConfigSection('routes');
    }

    public function getControllerAction($action) {
        if (isset($this->routes[$action])) {
            return $this->routes[$action];
        }
        return 'indexPage';
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
