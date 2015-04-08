//verificar que el porcentaje de aceptacion es entero y mayor o igual a 60 y menor o igual a 100

(function($) {
    $.fn.bootstrapValidator.validators.porcentajeAc = {

        validate: function(validator, $field, options) {
            var number = parseInt($field.val());
            var min = parseInt("60");
            var max = parseInt("100");

                
                if(number >= 60 && number<=100){
                  return true;
                }
                else{
                    return false;
                }
        }
    };
}(window.jQuery));


