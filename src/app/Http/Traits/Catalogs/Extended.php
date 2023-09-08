<?php namespace Notsoweb\Core\App\Http\Traits\Catalogs;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Extensión de los enums
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
trait Extended
{
    /**
     * Obtener todos los registros en un array
     * 
     * Regresa los registros de la forma valor descripción. Requiere de la existencia de la función
     * description() con el match de las descripciones.
     */
    public static function all()
    {
        $cases = static::cases();
        $items = [];

        foreach ($cases as $case) {
            $items[$case->value] = $case->description();
        }

        return $items;
    }
}