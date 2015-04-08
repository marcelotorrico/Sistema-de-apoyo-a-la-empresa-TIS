$(document).on('ready',function(){
    $('#fechaInicioE').datetimepicker({
            yearOffset:0,
            lang:'es',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y/m/d',
            minDate:'-1970/01/01', // fecha actual es el minimo de seleccion en fechas
            maxDate:'+1970/04/01' // and tommorow is maximum date calendar
    });
    $('#fechaFinalE').datetimepicker({
            yearOffset:0,
            lang:'es',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y/m/d',
            minDate:'-1970/01/01', // fecha actual es el minimo de seleccion en fechas
            maxDate:'+1970/04/01' // and tommorow is maximum date calendar
    });
    $('#horaInicioE').datetimepicker({
            datepicker:false,
            format:'H:i',

            step:5

    });
    $('#horaFinalE').datetimepicker({
            datepicker:false,
            format:'H:i',

            step:5
    }); 
     $('#documentoRequerido').on('change',function(e){
         
        e.preventDefault(); 
        //alert($('#documentoRequerido').val());
        $('#fechaInicioE').prop('disabled',false);
        $('#horaInicioE').prop('disabled',false);
        $('#fechaFinalE').prop('disabled',false);
        $('#horaFinalE').prop('disabled',false);
        
       /** $('#fechaInicioE').val(txtFecIni);
        $('#horaInicioE').val(txtHorIni);
        $('#fechaFinalE').val(txtFecFin);
        $('#horaFinalE').val(txtHorFin);
        **/
        $.ajax({
              url:"recargarFechas.php",
              type: "POST",
              data:"sel=" + $("#documentoRequerido").val(),
              success: function(datos){
                var fe1= datos.substring(0,10); 
                var ho1=datos.substring(10,18);
                var fe2=datos.substring(18,28);
                var ho2=datos.substring(28,36);
                $('#fechaInicioE').val(fe1);
                $('#horaInicioE').val(ho1);
                $('#fechaFinalE').val(fe2);
                $('#horaFinalE').val(ho2);
              }
            })
    });
    
     
}); 
