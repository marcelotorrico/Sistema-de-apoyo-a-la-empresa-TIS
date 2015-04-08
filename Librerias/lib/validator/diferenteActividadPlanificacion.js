(function($) {
    $.fn.bootstrapValidator.validators.diferenteActividadPlanificacion = {
        html5Attributes: {
            message: 'message'
        },

        validate: function(validator, $field, options) {
            var actividadesPlanificacion = $('#registroPlanificacion').data('actividades').split(',');

            var value = ($field.val()).trim();

            if (value == '') {
            	return true;
            } 

            var flag = actividadesPlanificacion.indexOf(value);
            if (flag >= 0) {
            	return false;
            } else {
            	return true;
            }
        }
    };
}(window.jQuery));
