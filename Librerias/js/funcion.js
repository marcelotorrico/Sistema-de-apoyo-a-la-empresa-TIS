$(document).on('ready', function() {
    $.ajaxPrefilter( "json script", function( options ) {
        options.crossDomain = true;
    });
    dtp();
});

function dtp() {
    $('#formToActivity').bootstrapValidator({
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitHandler: function(validator, form, submitButton) {
              // Do nothing
        },
        fields: {
            actividad: {
                validators: {
                    differentName: {
                        field: 'apple,banana,mango,orange',
                        message: 'Este nombre de actividad ya esta siendo usado'
                    },
                    notEmpty: {
                        message: 'El nombre de la actividad es un dato requerido'
                    },
                    stringLength: {
                        max: 20,
                        message: 'El nombre de la actividad debe ser menor o igual a 20 caracteres'
                    }
                }
            },
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'La descripcion de la actividad es un dato requerido'
                    },
                    stringLength: {
                        max: 40,
                        message: 'La descripcion de la actividad debe ser menor o igual a 40 caracteres'
                    }
                }
            },
            fecha: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de la actividad es un dato requerido'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha no es valida'
                    }
                }
            },
            entregables: {
                validators: {
                    callback: {
                        message: 'Los entregables es un dato requerido, seleccione al menos uno',
                        callback: function(value, validator) {
                            var options = validator.getFieldElements('entregables').val();
                            return (options && options.length >= 1);
                        }
                    }
                }
            }
        }
    });

    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd',
        startDate: "2014-05-01",
        endDate: "2014-06-30",
        autoclose: true,
        minView: 2,
        todayBtn: true,
        todayHighlight: true,
        language: 'es'
    });

    $('#cEntregables')
        .multiselect({
            buttonWidth: '156px',
            onChange: function(element, checked) {
                $('#formToActivity')
                    .data('bootstrapValidator')
                    .updateStatus('entregables', 'NOT_VALIDATED')
                    .validateField('entregables');
            }
    })
    .end();
    
    $('.form_datetime').on('changeDate', function(){
        $('#formToActivity')
            .data('bootstrapValidator')
            .updateStatus('fecha', 'NOT_VALIDATED')
            .validateField('fecha');
    });

    $('')
}






