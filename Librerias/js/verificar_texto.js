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
 
    patron = /[a-zA-Z]/; //patron
 
    te = String.fromCharCode(tecla);
    return patron.test(te); // prueba de patron
  } 