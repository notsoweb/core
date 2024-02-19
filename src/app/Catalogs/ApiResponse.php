<?php namespace Notsoweb\Core\Catalogs;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Notsoweb\Core\Http\Traits\Catalogs\Extended;

 /**
 * Respuestas estándar para APIs
 * 
 * Esta basado en el estándar JSend
 * 
 * @see https://github.com/omniti-labs/jsend
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
enum ApiResponse : int
{
    use Extended;

    /**
     * Solicitud aceptada
     * 
     * Código de respuesta general.
     */
    case OK = 200 ;

    /**
     * Creación exitosa
     */
    case CREATED = 201;

    /**
     * Solicitud aceptada
     * 
     * En este caso expresa que no hay nada para devolver.
     */
    case NO_CONTENT = 204;

    /**
     * Solicitud no valida
     * 
     * Este código se devuelve cuando el servidor ha intentado procesar la solicitud,
     * pero algún aspecto de la solicitud no es válido
     */
    case BAD_REQUEST = 400;

    /**
     * No autorizado
     * 
     * Falta información de autorización en la solicitud
     */
    case UNAUTHORIZED = 401;

    /**
     * Indica que el cliente ha intentado acceder a un recurso al que no tiene acceso. 
     */
    case FORBIDDEN = 403;

    /**
     * El recurso o destino no existe
     * 
     * Esto podría deberse a que el URI no está bien formado o a que se ha suprimido el recurso.
     */
    case NOT_FOUND = 404;

    /**
     * Método no permitido
     */
    case METHOD_NOT_ALLOWED = 405;

    /**
     * Formato de solicitud de datos invalido.
     * 
     * Se ha solicitado la devolución de los datos en un determinado formato, pero el servidor
     * no puede devolver datos en ese formato.
     */
    case NOT_ACCEPTABLE = 406;

    /**
     * Actualización de recurso conflictiva.
     * 
     * El intento de actualización puede generar un conflicto con otros datos.
     */
    case CONFLICT = 409;

    /**
     * El recurso de destino no admite el formato de datos del cuerpo de la solicitud especificado
     * en la cabecera de Content-Type.
     */
    case UNSUPPORTED_MEDIA_TYPE = 415;

    /**
     * El recurso de destino no admite el formato de datos del cuerpo de la solicitud especificado
     * en la cabecera de Content-Type.
     */
    case UNPROCESSABLE_CONTENT = 422;

    /**
     * Se ha producido un error interno en el servidor.
     */
    case INTERNAL_ERROR = 500;
    
    /**
     * Estado de éxito
     * 
     * Todo va bien y (normalmente) se devuelve algún datos.
     */
    const SUCCESS = 'success';

    /**
     * Estado de éxito
     * 
     * Ha habido un problema con los datos enviados o no se ha cumplido alguna condición
     * previa de la llamada a la API.
     */
    const FAIL = 'fail';

    /**
     * Estado de éxito
     * 
     * Se ha producido un error al procesar la solicitud, es decir, se ha lanzado una excepción.
     */
    const ERROR = 'error';

    /**
     * Descripción general del tipo de respuesta
     */
    public function description()
    {
        return match($this) {
            self::OK => 'OK',
            self::CREATED => 'Recurso creado',
            self::NO_CONTENT => 'Solicitud aceptada.',
            self::BAD_REQUEST => 'Solicitud invalida.',
            self::UNAUTHORIZED => 'No autorizado.',
            self::FORBIDDEN => 'Recurso no accesible.',
            self::NOT_FOUND => 'Recurso no encontrado.',
            self::METHOD_NOT_ALLOWED => 'Método no permitido',
            self::NOT_ACCEPTABLE => 'Formato de solicitud no valido',
            self::CONFLICT => 'Actualización de recurso conflictiva.',
            self::UNSUPPORTED_MEDIA_TYPE => 'Formato de respuesta solicitado invalido.',
            self::UNPROCESSABLE_CONTENT => 'Contenido no procesable.',
            self::INTERNAL_ERROR => 'Error interno.',
        };
    }

    /**
     * Descripción general del tipo de respuesta
     */
    public function status()
    {
        return match($this) {
            self::OK => self::SUCCESS,
            self::CREATED => self::SUCCESS,
            self::NO_CONTENT => self::SUCCESS,
            self::BAD_REQUEST => self::FAIL,
            self::UNAUTHORIZED => self::FAIL,
            self::FORBIDDEN => self::ERROR,
            self::NOT_FOUND => self::ERROR,
            self::METHOD_NOT_ALLOWED => self::FAIL,
            self::NOT_ACCEPTABLE => self::FAIL,
            self::CONFLICT => self::FAIL,
            self::UNSUPPORTED_MEDIA_TYPE => self::FAIL,
            self::UNPROCESSABLE_CONTENT => self::ERROR,
            self::INTERNAL_ERROR => self::ERROR,
        };
    }

    /**
     * Mensaje en caso de error
     */
    public function onSuccess(array $data = [])
    {
        return response()->json([
            'status' => $this->status(),
            'data' => (!empty($data))
                ? $data
                : null,
        ], $this->value);
    }

    /**
     * Mensaje describiendo porque fallo la solicitud
     */
    public function onFail(array $data = [])
    {
        return response()->json([
            'status' => $this->status(),
            'data' => $data
        ], $this->value);
    }

    /**
     * Mensaje en caso de error
     */
    public function onError(array $data = [])
    {
        return response()->json([
            'status' => $this->status(),
            'message' => $this->description(),
            'errors' => (!empty($data))
                ? $data
                : null,
        ], $this->value);
    }
}