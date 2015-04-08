

function validar(formulario)
{  
    if( formulario.contrasena1.value != formulario.contrasena2.value)
    {  
        formulario.contrasena1.focus();
        formulario.contrasena2.focus();
        alert('Las contraseñas no coinciden');  
        return false;  
    }

    return true; 
} 