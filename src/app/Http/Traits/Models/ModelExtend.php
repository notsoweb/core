<?php namespace Notsoweb\Core\Traits\Models;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Extención de los modelos para funciones adicionales
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.1
 */
trait ModelExtend
{
    /**
     * Retorna en un array con los atributos rellenados en base al atributo fillable del modelo
     * 
     * @return array
     */
    public function fillableToArray() : array
    {
        if(count($this->fillable) > 0) {
            $data = [];
    
            foreach($this->fillable as $fillable) {
                if(!in_array($fillable, $this->hidden)){
                    $data[$fillable] = $this->$fillable;
                }
            }
    
            return $data;
        } else  {
            return $this->toArray();
        }
    }

    /**
     * Retorna los cambios de una actualización separandolos como antes y despues
     * 
     * @since 1.0.1
     * 
     * @return array
     */
    public function getContrastChanges() : array
    {
        $new = $old = [];
        $changes = $this->getChanges();

        foreach (array_keys($changes) as $key) {
            if(!in_array($key, ['updated_at'])) {
                $new[$key] = $changes[$key];
                $old[$key] = $this->getOriginal($key);
            }
        }

        return [
            'new' => $new,
            'old' => $old,
        ];
    }
}