<?php

if (!function_exists('arrayToObject')) {
    /**
     * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
     */
    function arrayToObject(array $array)
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('isEnvironment')) {
    /**
     * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
     */
    function isEnvironment(string|array $environment)
    {
        return app()->environment($environment);
    }
}