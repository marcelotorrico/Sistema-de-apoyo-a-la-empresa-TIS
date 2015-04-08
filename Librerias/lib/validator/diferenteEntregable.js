(function($) {
    $.fn.bootstrapValidator.validators.diferenteEntregable = {
        html5Attributes: {
            message: 'message'
        },

        validate: function(validator, $field, options) {
            
			var entregables = $('#registroEntregables').data('entregables').split(',');

            var value = ($field.val()).trim();

            if (value == '') {
            	return true;
            } 

            var flag = entregables.indexOf(value);
            if (flag >= 0) {
            	return false;
            } else {
            	return true;
            }
        }
    };
}(window.jQuery));
