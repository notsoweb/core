<?php namespace Notsoweb\Core\Http\Traits\Seeders;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Spatie\Permission\Models\Permission;

 /**
 * Permite facilitar el sembrado de permisos
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
trait RolePermission
{
    /**
     * Permite crear un permiso arbitrario
     * 
     * Requiere el paquete Spatie\Permission
     * 
     * @param string $code Código del permiso que será usado para programar
     * @param string $description Descripción del permiso
     * 
     * @return Permission
     */
    protected function onPermission($code, $description) : Permission
    {
        return Permission::create([
            'name' => $code,
            'description' => $description,
        ]);
    }
    
    /**
     * Permiso para acceder a un area
     * 
     * @param string $code Código del permiso que será usado para programar
     * @param string $section Área, sección de departamento que se usa en la descripción
     * @param string $description Descripción del permiso
     * 
     * @return Permission
     */
    protected function onIndex($code, $section, $description = 'Mostrar datos') : Permission
    {
        return Permission::create([
            'name' => "{$code}.index",
            'description' => "$section: $description",
        ]);
    }
    
    /**
     * Permiso para crear un registro
     * 
     * @param string $code Código del permiso que será usado para programar
     * @param string $section Área, sección de departamento que se usa en la descripción
     * @param string $description Descripción del permiso
     * 
     * @return Permission
     */
    protected function onCreate($code, $section, $description = "Crear registros") : Permission
    {
        return Permission::create([
            'name' => "{$code}.create",
            'description' => "$section: $description",
        ]);
    }
    
    /**
     * Permiso para editar un registro
     * 
     * @param string $code Código del permiso que será usado para programar
     * @param string $section Área, sección de departamento que se usa en la descripción
     * @param string $description Descripción del permiso
     * 
     * @return Permission
     */
    protected function onEdit($code, $section, $description = "Actualizar registro") : Permission
    {
        return Permission::create([
            'name' => "{$code}.edit",
            'description' => "$section: $description",
        ]);
    }
    
    /**
     * Permiso para eliminar un registro
     * 
     * @param string $code Código del permiso que será usado para programar
     * @param string $section Área, sección de departamento que se usa en la descripción
     * @param string $description Descripción del permiso
     * 
     * @return Permission
     */
    protected function onDestroy($code, $section, $description = "Eliminar registro") : Permission
    {
        return Permission::create([
            'name' => "{$code}.destroy",
            'description' => "$section: $description",
        ]);
    }
    
    /**
     * CRUD de permisos
     * 
     * @param string $code Código del permiso que será usado para programar
     * @param string $section Área, sección de departamento que se usa en la descripción
     * 
     * @return array
     */
    protected function onCRUD($code, $section) : array
    {
        return [
            $this->onIndex($code, $section),
            $this->onCreate($code, $section),
            $this->onEdit($code, $section),
            $this->onDestroy($code, $section)
        ];
    }
}
