(function($) {
    $.fn.bootstrapValidator.validators.porcentajeMin = {
        html5Attributes: {
            message: 'message'
        },

        validate: function(validator, $field, options) {
            var value = parseFloat($field.val());
            var min = parseFloat($('#registroPlanPagos').data('min'));
            var res = true;
            if (value <= min) {
                res = false;
            }
            return res;
        }
    };
}(window.jQuery));