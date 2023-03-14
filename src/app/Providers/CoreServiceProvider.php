<?php namespace Notsoweb\Core\Providers;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\ServiceProvider;

/**
 * Proveedor de servicio del núcleo
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->config();
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Fusiona las configuraciones
     */
    private function config()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/logging/channels.php', 'logging.channels'
        );
    }
}
