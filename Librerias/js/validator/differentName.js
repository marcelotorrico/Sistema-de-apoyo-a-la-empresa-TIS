(function($) {
    $.fn.bootstrapValidator.validators.differentName = {
        html5Attributes: {
        	field: 'field',
            message: 'message'
        },

        validate: function(validator, $field, options) {
        	/*
        	var x = $('#div').data('frutas');
        	//var x = "apple,banana,orange";
        	//var x = validator.getFieldElements(options.field);
        	var y = x.split(",");
*/

			var activities = $('#tableToActivities').data('activities').split(',');

        	//var fruits = ["Banana", "Orange", "Apple", "Mango"];
            var value = $field.val();

            if (value == '') {
            	return true;
            } 

            var flag = activities.indexOf(value);
            //var flag = y.indexOf(value);
            if (flag >= 0) {
            	return false;
            } else {
            	return true;
            }
        }
    };
}(window.jQuery));
