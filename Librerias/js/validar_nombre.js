/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validarLetras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla===8) return true; // backspace
    if (tecla===32) return true; // espacio
    if (e.ctrlKey && tecla===86) { return true;} //Ctrl v
    if (e.ctrlKey && tecla===67) { return true;} //Ctrl c
    if (e.ctrlKey && tecla===88) { return true;} //Ctrl x
    
    patron = /[a-zA-Z.0-9áéíóúÁÉÍÓÚñÑ]/; //patron
 
    te = String.fromCharCode(tecla);
    return patron.test(te); // prueba de patron
  } 
  
  
function validarCampos(formulario) {
        //var permitidos = /[a-zA-Z.0-9]/;
        
        //Controlar campos vacios y caracteres invalidos del nombre largo de la empresa
        if(formulario1.nombre.value.length==0) {  
            formulario1.nombre.focus();    
            alert('Por favor, ingresa un nombre largo para su empresa.');  
        return false;  
        }
        if(!formulario1.nombre.value.match(/^[0-9a-zA-Z.áéíóúÁÉÍÓÚñÑ\s/]+$/)) {
            
        alert('Caracteres no validos en el nombre largo.');
        return false;
        }

        if(formulario1.nombre.value.length >= 40) {
            formulario1.nombre.focus();
            alert('Nombre Largo demasiado largo, introduzca un nombre menor a 40 caracteres.')
        return false;
        }
        
        var nombreLargo=formulario1.nombre.value;
        var contador=0;
        var contador4=0;
        for (var i=0;i<nombreLargo.length;i++)
        {
            var caracter=nombreLargo.substring(i,i+1);
            if(caracter == ' ')
            {
                contador++;
            }
        }
        
        for(var k=0;k<nombreLargo.length;k++)
        {
            var caracter3 = nombreLargo.substring(k,k+1);
            if(caracter3 === '.')
            {
                contador4++;
            }
        }
        
        if(contador == nombreLargo.length)
        {
            alert('No puede introducir un nombre largo en blanco');
            return false;
        }
        
        if(contador4 === nombreLargo.length)
        {
            alert('No puede introducir un nombre largo lleno de puntos');
            return false;
        }
        
        
        
        //controlamos campos vacios y caracteres invalidos del nombre corto de la empresa
        if(formulario1.nombreCorto.value.length==0)
        {
            formulario1.nombreCorto.focus();
            alert('Por favor, ingrese un nombre corto para su empresa');
            return false;
        }
        if(!formulario1.nombreCorto.value.match(/^[0-9a-zA-Z.áéíóúÁÉÍÓÚñÑ\s/]+$/))
        {
            alert('Caracteres no validos en el nombre corto');
            return false;
        }
        if(formulario1.nombreCorto.value.length >= 40)
        {
            formulario1.nombreCorto.focus();
            alert('Nombre Corto demasiado largo, introduzca un nombre menor a 40 caracteres.');
            return false;
        }
        
        var nombreCorto=formulario1.nombreCorto.value;
        var contadorDos=0;
        var contador5=0;
        for (var j=0;j<nombreCorto.length;j++)
        {
            var caracterDos=nombreCorto.substring(j,j+1);
            if(caracterDos == ' ')
            {
                contadorDos++;
            }
        }
        
        for (var g=0;g<nombreCorto.length;g++)
        {
            var caracter4=nombreCorto.substring(g,g+1);
            if(caracter4 === '.')
            {
                contador5++;
            }
        }
        
        if(contadorDos === nombreCorto.length)
        {
            alert('No puede introducir un nombre corto en blanco');
            return false;
        }
        
        if(contador5 === nombreCorto.length)
        {
            alert('No puede introducir un nombre corto lleno de puntos');
            return false;
        }
        
        
        
        
        return true; 
    
    }
    
    