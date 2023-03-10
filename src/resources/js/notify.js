import toastr from 'toastr';
import { router } from '@inertiajs/vue3';

class Notify {
  constructor() {}

  /**
   * Envia notificaciones de cualquier tipo
   * 
   * @param {String} title Mensaje
   * @param {String} type Tipo de notificación (success, error, warning, info)
   */
  flash(title = 'Successful registration', type = 'success') {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[type](title);
  }

  /**
   * Notificación de éxito
   * 
   * @param {String} title Mensaje
   */
  success(title) {
    this.flash(title);
  }

  /**
   * Notificación de error
   * 
   * @param {String} title Mensaje
   */
  error(title) {
    this.flash(title, 'error');
  }
  
  /**
   * Notificación informativa
   * 
   * @param {String} title Mensaje
   */
  info(title) {
    this.flash(title, 'info');
  }

  /**
   * Notificación de advertencia
   * 
   * @param {String} title Mensaje
   */
  warning(title) {
    this.flash(title, 'warning');
  }

  /**
   * Recibe los errores y advertencias enviados desde el backend
   * 
   * @param {String} err Contenedor
   */
  fromBack = (e) => {
    this.flash(e.errorMessage, e.type);
  }

  /**
   * Verificación de mensajes
   */
  verifyLaravelNotifyFlash() {
    if(router.page.props.flash) {
        router.page.props.flash.forEach(element => {
            Notify.flash(element.message, element.type);
        });
    }
  
    if (router.page.props.jetstream.flash.length != 0) {
        router.page.props.jetstream.flash.forEach(element => {
            Notify.flash(element.message, element.type);
        });
    }
  }
}

export default Notify;
