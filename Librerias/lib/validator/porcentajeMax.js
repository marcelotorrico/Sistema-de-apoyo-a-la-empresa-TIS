(function($) {
    $.fn.bootstrapValidator.validators.porcentajeMax = {
        html5Attributes: {
            message: 'message'
        },

        validate: function(validator, $field, options) {
            var value = parseFloat($field.val());
            var max = parseFloat($('#registroPlanPagos').data('max'));
            var res = true;
            if (value > max) {
                res = false;
            }
            return res;
        }
    };
}(window.jQuery));
