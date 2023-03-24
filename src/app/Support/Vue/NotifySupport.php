<?php namespace Notsoweb\Core\Support\Vue;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

 /**
 * Permite mandar notificaciones
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class NotifySupport
{
    /**
     * Notifica un error
     * 
     * Se genera un error voluntariamente para que inertia lo pueda interpretar mandando
     * un notificación tipo toast. 
     *
     * El error se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
     * onError: (e) => Notify.fromBack(e),
     * 
     * La variable puede variar si se desea.
     * 
     * Importante: No usar junto a los formularios.
     * 
     * @param string $message Mensaje de error
     * @param string $varName Variable que se recibirá en el front para el error
     */
    public static function error($message) : void
    {
        throw new ValidationException(Validator::make([], [
            'errorMessage' => 'required',
            'type' => 'required'
        ], [
            'errorMessage' => $message,
            'type' => 'error'
        ]));
    }

    /**
     * Notifica una advertencia
     * 
     * Se genera un error voluntariamente para que inertia lo pueda interpretar mandando
     * un notificación tipo toast. 
     *
     * La advertencia se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
     * onError: (e) => Notify.fromBack(e),
     * 
     * La variable puede variar si se desea.
     * 
     * Importante: No usar junto a los formularios.
     * 
     * @param string $message Mensaje de advertencia
     * @param string $varName Variable que se recibirá en el front para el error
     */
    public static function warning($message) : void
    {
        throw new ValidationException(Validator::make([], [
            'errorMessage' => 'required',
            'type' => 'required'
        ], [
            'errorMessage' => $message,
            'type' => 'warning'
        ]));
    }
}
