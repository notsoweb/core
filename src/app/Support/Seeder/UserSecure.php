<?php namespace Notsoweb\Core\Support\Seeder;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

 /**
 * Crea usuarios seguros
 * 
 * Permite crear usuarios en el seeder para que no queden guardadas contraseñas en el
 * git o en alguna parte del código.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class UserSecure
{
    /**
     * Canal donde se guarda el registro
     */
    const LOG_CHANNEL = 'notsoweb-users';

    /**
     * Genera una contraseña random para un usuario determinado y lo registra en el log.
     * 
     * Permite generar una contraseña para cualquier usuario, pero registra la contraseña en un log.
     * 
     * Esto tiene la finalidad de que las contraseñas generadas en los proyectos sean unicas y que
     * no queden plasmadas en el código.
     * 
     * @param string $email Correo
     * 
     * @return array
     */
    public static function new($email) : Array
    {
        $password = Str::random(8);
 
        Log::channel(self::LOG_CHANNEL)->info("Usuario {$email} sembrado con la contraseña {$password}");

        $hash = Hash::make($password);

        echo "\n  The mail: {$email}";
        echo "\n  The password: {$password}";
        echo "\n\n";

        return [$email, $hash];
    }
}
