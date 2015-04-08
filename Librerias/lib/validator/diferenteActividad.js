(function($) {
    $.fn.bootstrapValidator.validators.diferenteActividad = {
        html5Attributes: {
            message: 'message'
        },

        validate: function(validator, $field, options) {

			//var actividades = $('#tablaPlanificacionActividades').data('actividades').split(',');
            var actividades = $('#registroPlanificacion').data('actividades').split(',');

            var value = ($field.val()).trim();

            if (value == '') {
            	return true;
            } 

            var flag = actividades.indexOf(value);
            if (flag >= 0) {
            	return false;
            } else {
            	return true;
            }
        }
    };
}(window.jQuery));
