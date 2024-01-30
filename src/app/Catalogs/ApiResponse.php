<?php namespace Notsoweb\Core\Catalogs;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Notsoweb\Core\Http\Traits\Catalogs\Extended;

 /**
 * Respuestas estándar para APIs
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
     * Se ha producido un error interno en el servidor.
     */
    case INTERNAL_ERROR = 500;

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
            self::INTERNAL_ERROR => 'Error interno.',
        };
    }

    /**
     * Respuesta simple
     * 
     * Respuesta genérica.
     */
    public function simpleResponse() : array
    {
        return [
            'code' => $this->value,
            'message' => $this->description(),
            'data' => null
        ];
    }

    /**
     * Respuesta con un detalle más especifico
     * 
     * Envía una respuesta más detallada sin necesidad de retornar más datos que el detalle.
     */
    public function detailResponse(string $message = null) : array
    {
        return [
            'code' => $this->value,
            'message' => $this->description(),
            'data' => [
                'detail' => $message
            ]
        ];
    }

    /**
     * Respuesta con datos
     * 
     * Permite retornar recursos variados como respuesta
     */
    public function response(array $data = []) : array
    {
        return [
            'code' => $this->value,
            'message' => $this->description(),
            'data' => $data,
        ];
    }
}