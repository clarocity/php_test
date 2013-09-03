<?php

/**
 * Simple class for processing INI files
 */
class ConfigIni {

    private $config;

    public function __construct() {
        if (file_exists(APP_PATH . '/config.ini')) {
            $this->config = parse_ini_file(APP_PATH . '/config.ini', true);
        } else {
            throw new InvalidArgumentException('Config file not found, cannot proceed.', 500);
        }
    }

    public function getConfigSection($section) {
        if (isset($this->config[$section])) {
            return $this->config[$section];
        }
        return NULL;
    }
    
    public function getConfigItem($item, $section = null) {
        if (isset($section) && isset($this->config[$section]) && isset($this->config[$section][$item])) {
            return $this->config[$section][$item];
        }
        if (!isset($section) &&  isset($this->config[$item])) {
            return $this->config[$item];
        }
        return NULL;
    }
}

?>
