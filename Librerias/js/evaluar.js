
$(document).ready(function() {
    
    $('#btn-nuevo').click(function(){
        
        location.reload();
        
        
    });
    
    $('input[type=checkbox]').on('click', function(){ 

        //alert($(this).parent().parent().attr('id'));
        
        var parent = $(this).parent().parent();
       
        $(parent).find('input[type=checkbox]').prop('checked','');

        $(this).prop('checked', 'true');
    }); 
    
    $('#btn-evaluar').click(function(){
        			    	
        if($("form")[0].checkValidity()) 
	{

            var url = "GenerarNota.php"

            $.ajax({
                url: url,
                type: 'POST',
                data: $('#FormEvaluar').serialize(),

                success: function(data){

                $('#ResultadoNota').html(data)
                }

            });

            return false;
	}
    });
});

