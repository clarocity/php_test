<?php

/**
 * Simple class for processing INI files
 */
class ConfigIni {

    private $_config;

    public function __construct() {
        if (file_exists(APP_PATH . '/config.ini')) {
            $this->_config = parse_ini_file(APP_PATH . '/config.ini', true);
        } else {
            throw new InvalidArgumentException('Config file not found, cannot proceed.', 500);
        }
    }

    public function getConfigSection($section) {
        if (isset($this->_config[$section])) {
            return $this->_config[$section];
        }
        return NULL;
    }
    
    public function getConfigItem($item, $section = null) {
        if (isset($section) && isset($this->_config[$section]) && isset($this->_config[$section][$item])) {
            return $this->_config[$section][$item];
        }
        if (!isset($section) &&  isset($this->_config[$item])) {
            return $this->_config[$item];
        }
        return NULL;
    }
}

?>
