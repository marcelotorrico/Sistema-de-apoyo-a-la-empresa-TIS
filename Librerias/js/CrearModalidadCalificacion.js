$(document).ready(function(){        

           $('#btn-eliminarBD').click(function(event) {

                var url2 = "EliminarCriterioBD.php"

                $.ajax({
                    url: url2,
                    type: 'POST',
                    data: $('#EliminarBD').serialize(),

                    success: function(data){

                    $('#panelResultado').html(data)

                    }
                });

            return false;
            });
            

           $('#tipo_criterio').on('change', function() {

                var valor = $(this).val()

                if (valor == 1) {

                    $('#Textos').empty();

                    $('#Textos').append('<div><div class="form-group" id="primero">Indicador:&nbsp<input type="text" name="Indicador[]" required>&nbspPuntaje:&nbsp<input type="text" name="ValorNumerico[]" pattern="^[0-9]{1,3}" required>&nbsp<button type="button" class="eliminarBox"> <span class="glyphicon glyphicon-minus"></span> </button></div></div>   <div class="form-group"><button type="button" class="btnIndicador"><span class="glyphicon glyphicon-plus"></span> Agregar</button></div>');
                    $('#Textos').append('<div class="form-group"><button type="submit" class="btn btn-default" id="btn-guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button></div>')
                }

                if(valor == 2)
                {
                    $('#Textos').empty()

    
                    $('#Textos').append('<div class="form-group"><input type="hidden" name="Indicador[]" value="Verdadero"></div>')
                    $('#Textos').append('<div class="form-group">Verdadero:&nbsp<input type="text" name="ValorNumerico[]" placeholder="Puntaje: 70,80,90" pattern="^[1-9]{1}[0-9]{1,2}" required></div>')
                    

                    $('#Textos').append('<div class="form-group"><input type="hidden" name="Indicador[]" value="Falso"></div>')
                    $('#Textos').append('<div class="form-group">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFalso:&nbsp<input type="text" name="ValorNumerico[]" placeholder="Puntaje: 10,20,30" pattern="^[0-9]{1,3}" required></div>')
                   

                    $('#Textos').append('<div class="form-group"><button type="submit" class="btn btn-default" id="btn-guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button></div>')

                }

                if(valor == 3)
                {
                    $('#Textos').empty()

    
                    $('#Textos').append('<div class="form-group"><input type="hidden" name="Indicador[]" value="Si"></div>')
                    $('#Textos').append('<div class="form-group">&nbspSi:&nbsp<input type="text" name="ValorNumerico[]" placeholder="Puntaje: 70,80,90" pattern="^[1-9]{1}[0-9]{1,2}" required></div>')
                    

                    $('#Textos').append('<div class="form-group"><input type="hidden" name="Indicador[]" value="No"></div>')
                    $('#Textos').append('<div class="form-group">No:&nbsp<input type="text" name="ValorNumerico[]" placeholder="Puntaje: 10,20,30" pattern="^[0-9]{1,3}" required></div>')
                   

                    $('#Textos').append('<div class="form-group"><button type="submit" class="btn btn-default" id="btn-guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button></div>')

                }

                $('.eliminarBox').on('click', function(event) {

                        $(this).parent().parent().remove();
                    });       


                $('.btnIndicador').on('click', function(event) {

                    $(this).parent().before('<div class="form-group">Indicador:&nbsp<input type="text" name="Indicador[]" required>&nbspPuntaje:&nbsp<input type="text" name="ValorNumerico[]" required>&nbsp<button type="button" class="eliminarBox"><span class="glyphicon glyphicon-minus"></span></button></div>');

                    $('.eliminarBox').on('click', function(event) {

                    $(this).parent().remove();

                    });       
                });
                
                $('#btn-guardar').click(function() {
 
                    if($("form")[0].checkValidity()) 
                    {
         
                        var url = "GuardarCriterios.php"

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: $('#form-textos').serialize(),

                            success: function(data){

                            $('#panelResultado').html(data)

                            }

                        });

                        return false;
                    }
                });

                    
            });

});