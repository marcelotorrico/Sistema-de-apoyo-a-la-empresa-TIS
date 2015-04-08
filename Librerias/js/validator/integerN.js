//verificar que el porcentaje de aceptacion es entero y mayor o igual a 60 y menor o igual a 100

(function($) {
    $.fn.bootstrapValidator.validators.integerN = {

        validate: function(validator, $field, options) {
            var value = $field.val();
            var min = parseInt("60");
            var max = parseInt("100");
            if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
                var number = parseInt($field.val());
                if(number >= 60){
                  return true;
                }
                else{
                    return false;
                }
            } else { 
                return false;
            } 
        }
    };
}(window.jQuery));


