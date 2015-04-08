/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validarLetras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; // backspace
    if (tecla==32) return true; // espacio
    if (e.ctrlKey && tecla==86) { return true;} //Ctrl v
    if (e.ctrlKey && tecla==67) { return true;} //Ctrl c
    if (e.ctrlKey && tecla==88) { return true;} //Ctrl x
 
    patron = /[a-zA-Z.0-9]/; //patron
 
    te = String.fromCharCode(tecla);
    return patron.test(te); // prueba de patron
  } 
  
function validarNumeros(e)
{

    teclaNumero = (document.all) ? e.keyCode : e.which;
    if (teclaNumero==8) return true;
    
    patronNumeros= /[0-9]/;
    te2 = String.fromCharCode(teclaNumero);
    return patronNumeros.test(te2);
}
  
function validarCampos(formulario) {
        
        
        //Controlar campos vacios y caracteres invalidos del nombre largo de la empresa
        if(formulario.textfield1.value.length==0) {  
            formulario.textfield1.focus();    
            alert('Por favor, ingrese la puntuación del Cumplimiento de especificaciones del proponente (sobre 15 puntos)');  
        return false;  
        }
        
        if(formulario.textfield2.value.length==0) {  
            formulario.textfield2.focus();    
            alert('Por favor, ingrese la puntuación de la Claridad en la organización de la empresa proponente (sobre 10 puntos)');  
        return false;  
        }
        
        if(formulario.textfield3.value.length==0) {  
            formulario.textfield3.focus();    
            alert('Por favor, ingrese la puntuación del Cumplimiento de especificaciones técnicas (sobre 30 puntos)');  
        return false;  
        }
        
        if(formulario.textfield4.value.length==0) {  
            formulario.textfield4.focus();    
            alert('Por favor, ingrese la puntuación de la Claridad en el proceso de desarrollo (sobre 10 puntos)');  
        return false;  
        }
        
        if(formulario.textfield5.value.length==0) {  
            formulario.textfield5.focus();    
            alert('Por favor, ingrese la puntuación del Plazo de ejecución (sobre 10 puntos)');  
        return false;  
        }
        
        if(formulario.textfield6.value.length==0) {  
            formulario.textfield6.focus();    
            alert('Por favor, ingrese la puntuación del Precio total (sobre 15 puntos)');  
        return false;  
        }
        
        if(formulario.textfield7.value.length==0) {  
            formulario.textfield7.focus();    
            alert('Por favor, ingrese la puntuación del Uso de herramientas en el proceso de desarrollo (sobre 10 puntos)');  
        return false;  
        }
        if(formulario.fecha.value.length===0) {  
            formulario.textfield7.focus();    
            alert('Por favor, ingrese la fecha para la reuni\u00f3n');  
        return false;  
        }
        if(formulario.hora.value.length===0) {  
            formulario.textfield7.focus();    
            alert('Por favor, ingrese la hora para la reuni\u00f3n');  
        return false;  
        }
        
        //controlamos que la calificacion no sea mayor de lo que se estipula

        if(formulario.textfield1.value > 15) {
            formulario.textfield1.focus();
            alert('La puntuación del Cumplimiento de especificaciones del proponente es sobre 15 puntos');
        return false;
        }
        
        if(formulario.textfield2.value > 10) {
            formulario.textfield2.focus();
            alert('La puntuación de la Claridad en la organización de la empresa proponente es sobre 10 puntos');
        return false;
        }
        
        if(formulario.textfield3.value > 30) {
            formulario.textfield3.focus();
            alert('La puntuación del Cumplimiento de especificaciones técnicas es sobre 30 puntos');
        return false;
        }
        
        if(formulario.textfield4.value > 10) {
            formulario.textfield4.focus();
            alert('La puntuación de la Claridad en el proceso de desarrollo es sobre 10 puntos');
        return false;
        }
        
        if(formulario.textfield5.value > 10) {
            formulario.textfield5.focus();
            alert('La puntuación del Plazo de ejecución es sobre 10 puntos');
        return false;
        }
        
        if(formulario.textfield6.value > 15) {
            formulario.textfield6.focus();
            alert('La puntuación del Precio total es sobre 15 puntos');
        return false;
        }
        
        if(formulario.textfield7.value > 10) {
            formulario.textfield7.focus();
            alert('La puntuación del Uso de herramientas en el proceso de desarrollo es sobre 10 puntos');
        return false;
        }
        
        //controlar espacio en blanco calificacion 1
        var calificacionUno=formulario.textfield1.value;
        var contadorUno=0;
        for (var i=0;i<calificacionUno.length;i++)
        {
            var caracterUno=calificacionUno.substring(i,i+1);
            if(caracterUno == ' ')
            {
                contadorUno++;
            }
        }
        
        if(contadorUno == calificacionUno.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlar espacio en blanco calificacion 2
        var calificacionDos=formulario.textfield2.value;
        var contadorDos=0;
        for (var i=0;i<calificacionDos.length;i++)
        {
            var caracterDos=calificacionDos.substring(i,i+1);
            if(caracterDos == ' ')
            {
                contadorDos++;
            }
        }
        
        if(contadorDos == calificacionDos.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlar espacio en blanco calificacion 3
        var calificacionTres=formulario.textfield3.value;
        var contadorTres=0;
        for (var i=0;i<calificacionTres.length;i++)
        {
            var caracterTres=calificacionTres.substring(i,i+1);
            if(caracterTres == ' ')
            {
                contadorTres++;
            }
        }
        
        if(contadorTres == calificacionTres.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlar espacio en blanco calificacion 4
        var calificacionCuatro=formulario.textfield4.value;
        var contadorCuatro=0;
        for (var i=0;i<calificacionCuatro.length;i++)
        {
            var caracterCuatro=calificacionCuatro.substring(i,i+1);
            if(caracterCuatro == ' ')
            {
                contadorCuatro++;
            }
        }
        
        if(contadorCuatro == calificacionCuatro.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlar espacio en blanco calificacion 5
        var calificacionCinco=formulario.textfield5.value;
        var contadorCinco=0;
        for (var i=0;i<calificacionCinco.length;i++)
        {
            var caracterCinco=calificacionCinco.substring(i,i+1);
            if(caracterCinco == ' ')
            {
                contadorCinco++;
            }
        }
        
        if(contadorCinco == calificacionCinco.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlar espacio en blanco calificacion 6
        var calificacionSeis=formulario.textfield6.value;
        var contadorSeis=0;
        for (var i=0;i<calificacionSeis.length;i++)
        {
            var caracterSeis=calificacionSeis.substring(i,i+1);
            if(caracterSeis == ' ')
            {
                contadorSeis++;
            }
        }
        
        if(contadorSeis == calificacionSeis.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlar espacio en blanco calificacion 7
        var calificacionSiete=formulario.textfield7.value;
        var contadorSiete=0;
        for (var i=0;i<calificacionSiete.length;i++)
        {
            var caracterSiete=calificacionSiete.substring(i,i+1);
            if(caracterSiete == ' ')
            {
                contadorSiete++;
            }
        }
        
        if(contadorSiete == calificacionSiete.length)
        {
            alert('Campo de calificación requerido');
            return false;
        }
        
        //controlamos el espacio del lugar
        var lugar=formulario.lugar.value;
        var contadorOcho=0;
        for (var i=0;i<lugar.length;i++)
        {
            var caracterOcho=lugar.substring(i,i+1);
            if(caracterOcho == ' ')
            {
                contadorOcho++;
            }
        }
        
        if(contadorOcho == lugar.length)
        {
            alert('Por favor, ingrese el lugar de la reunion');
            return false;
        }
        
        //controlamos que se introduzca el lugar
        if(oc.lugar.value.length==0) {  
            oc.lugar.focus();    
            alert('Por favor, ingrese el lugar de la reunión');  
        return false;  
        }
        
        return true; 

      

  
}


 
    
 
