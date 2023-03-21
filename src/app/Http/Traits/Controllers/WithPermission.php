<?php namespace Notsoweb\Core\Http\Traits\Controllers;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Permite controlar los permisos de un controlador
 * 
 * Es especialmente util para validar permiso por permiso en los controladores por recursos
 * o todos los por default de una sola vez.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.1
 */
trait WithPermission
{
    /**
     * Nombre del role usado para los permisos
     */
    public $rolePermission = 'default';

    /**
     * Permiso de ver la vista principal
     * 
     * @since 1.0.1
     */
    public function withIndexPermission() : void
    {
        $this->middleware("permission:{$this->rolePermission}.index")->only([
            'index'
        ]);
    }

    /**
     * Permiso de creación
     * 
     * @since 1.0.1
     */
    public function withCreatePermission() : void
    {
        $this->middleware("permission:{$this->rolePermission}.create")->only([
            'create',
            'store'
        ]);
    }

    /**
     * Permiso de edición
     * 
     * @since 1.0.1
     */
    public function withEditPermission() : void
    {
        $this->middleware("permission:{$this->rolePermission}.edit")->only([
            'edit',
            'update'
        ]);

    }

    /**
     * Permiso de eliminar
     * 
     * @since 1.0.1
     */
    public function withDestroyPermission() : void
    {
        $this->middleware("permission:{$this->rolePermission}.destroy")->only([
            'destroy'
        ]);
    }

    /**
     * Un permiso adicional que se sigue extendiendo de rolePermission
     * 
     * @param string $name Nombre del permiso
     * 
     * @since 1.0.1
     */
    public function withPermission($name) : void
    {
        $this->middleware("permission:{$this->rolePermission}.{$name}");
    }

    /**
     * Un permiso arbitrario
     * 
     * @param string $name Nombre del permiso
     * 
     * @since 1.0.1
     */
    public function withOtherPermission($name) : void
    {
        $this->middleware("permission:{$name}");
    }

    /**
     * Solicita los permisos por default de un CRUD
     * 
     * @param string $rolePermission Permiso raíz
     * 
     * @since 1.0.0 Creación
     * @since 1.0.1 Cambio de nombre de withCRUDPermission
     */
    public function withDefaultPermissions($rolePermission = null) : void
    {
        $this->setRolePermission($rolePermission);

        $this->withIndexPermission();
        $this->withCreatePermission();
        $this->withEditPermission();
        $this->withDestroyPermission();
    }

    /**
     * Guarda el role
     * 
     * @since 1.0.1
     */
    public function setRolePermission($rolePermission = null) : void
    {
        if ($rolePermission) {
            $this->rolePermission = $rolePermission;
        }
    }
}