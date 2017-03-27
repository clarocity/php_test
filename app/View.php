<?php

/**
 * Implements simple view class for manipulating output
 */
class View {

    private $layout;
    private $content;
    private $view;
    private $layoutEnabled = TRUE;
    private $vars = array();
    private $doRender = TRUE;

    public function __construct($action) {
        $this->setViewName($action);
    }

    /**
     * All vars are stored in $vars array
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __get($name) {
        if (isset($this->vars[$name])) {
            return $this->vars[$name];
        }
        return NULL;
    }

    /**
     * Checker
     * @param string $name
     * @return bool
     */
    public function __isset($name) {
        return isset($this->vars[$name]);
    }

    /**
     *  Convert camelCaseFileNames to camel-case-file-name.php
     * If file doesnt exist, do nothing - no view will be rendered at the end
     * @param string $action Controller's action for which view file should be set.
     */
    private function setViewName($action) {
        $view = strtolower(preg_replace('/[A-Z]/', strtolower('-$0'), $action));
        if (file_exists(APP_PATH . '/views/' . $view . '.php')) {
            $this->view = APP_PATH . '/views/' . $view . '.php';
        }
    }

    /**
     * Set view file directly, if file doesn't exist - view is not changed.
     * @param string $view filename in 'views' directory
     * @return TRUE | FALSE 
     */
    public function setView($view) {
        if (file_exists(APP_PATH . '/views/' . $view)) {
            $this->view = APP_PATH . '/views/' . $view;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Set a layout
     * @param string $layout Layout filename in views dir
     * @return TRUE | FALSE
     */
    public function setLayout($layout) {
        if (file_exists(APP_PATH . '/views/' . $layout)) {
            $this->layout = APP_PATH . '/views/' . $layout;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Enables or disables layout for this view
     * @param bool $enable
     */
    public function enableLayout($enable) {
        $this->layoutEnabled = (bool) $enable;
    }

    public function setDoRender($doRender) {
        $this->doRender = (bool) $doRender;
    }

    /**
     * Sends JSON array to browser
     * @param mixed $json Input string |array to be converted in JSON
     */
    public function json($json) {
        header('Content-type: application/json');
        echo json_encode($json);
        exit;
    }

    /**
     * Assembles view and layout together and outputs it to browser
     * @param bool $output Deffines if render outputs generated view to browser.
     *             If set to FALSE content will be available in $this->content.
     */
    public function render($output = TRUE) {
        ob_start();
        if (isset($this->view)) {
            include $this->view;
        }
        $this->content = ob_get_contents();
        ob_clean();
        if ($this->layoutEnabled && !empty($this->layout)) {
            include $this->layout;
            $this->content = ob_get_contents();
        }
        ob_end_clean();
        if ($output && $this->doRender) {
            echo $this->content;
        }
    }

    public function highlightText($haystack, $needles, $format = '') {
        if (!empty($needles)) {
            foreach ($needles as $needle) {
                $haystack = preg_replace("/\b($needle)\b/i", "<span style='background-color: yellow'>\${1}</span>", $haystack);
            }
        }
        return $haystack;
    }

}

?>
