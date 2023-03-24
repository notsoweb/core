<?php namespace Notsoweb\Core\Support;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Extensión de archivo de soporte para códigos
 * 
 * Clase base para aquellos soportes basados en una matriz de traducciones basadas en
 * constantes.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
abstract class CodeExtendSupport
{
    /**
     * Permite consultar la traducción de un tipo por medio de su identificador
     * 
     * @return mixed
     */
    public static function find($code) : string {
        $status = static::all();
  
        if(key_exists($code,$status))
            return $status[$code];
        
        return '0';
      }
  
    /**
     * Retorna la matriz de traducciones
     * 
     * Ejemplo: return [self::CONSTANTE => 'Traducción];
     * 
     * @return array
     */
    abstract public static function all() : array;

    /**
     * Invierte las llaves y los valores
     * 
     * @return array
     */
    public static function invertAll() : array
    {
        return array_flip(static::all());
    }
}