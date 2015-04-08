$(document).ready(function() {

     $('#todos').on('click', '#pruebaEliminar', function(event) {
         
         $(this).parent().parent().remove();
     });


    $('#btn-guardar').on('click', function(event) {

        if($("form")[0].checkValidity()) 
        {
            var url = "../Vista/guardarFormulario.php"

            $.ajax({
                url: url,
                type: 'POST',
                data: $('#criteriosEscogidos').serialize(),

                success: function(data){

                $('#panelResultado').html(data)

                }

            });

            return false;

        }
    });

    $('#btn-probar').on('click', function(event) {

        var url = "AgregarPreguntas.php"

        $.ajax({
            url: url,
            type: 'POST',
            data: $('#criteriosEscogidos').serialize(),

            success: function(data){

                $('#todos').append(data)

            }

        });

        //return false;   
    });
});