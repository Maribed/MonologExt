<?php

namespace MonologExt\ClassLoader;

abstract class AbstractClassLoader
{

    abstract function getDefaultMethod();

    public function getNewClass($params) {
        $method = $params['class'];
        if (!$method || !method_exists($this, $method)) {
            $method = $this->getDefaultMethod();
            $params = [];
        }

        return $this->{$method}($params);
    }
}
