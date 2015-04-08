//aqui manejamos los datos enviados por el formulario y a su ves los enviamos a subir_archivo.php que se encarga de subir y guardar registro en ls bd, ademas aqui se controla la barra de progreso de subida
function _(el){ return document.getElementById(el); }
            function uploadFileA(idUsuario,nombreRegistro){

                var usuario=idUsuario;
                var nombreR=nombreRegistro;

                //verificamos la extension de los archivos
                var file = _("archivoA").files[0];
                var extensionesValidas = ["bmp", "gif", "png", "jpg", "jpeg", "doc", "docx", "xls", "xlsx", "rar", "zip", "txt", "pdf"];
                var filePath = file.value;
                //var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
                
                
                //verificamos el tamanio
                if(file.size <= 5242880)
                {
                var formdata = new FormData();
                formdata.append("archivoA", file);
                formdata.append("nombreUsuarioG",usuario);
                formdata.append("nombreRegistro",nombreR);
                var ajax = new XMLHttpRequest();
                
                ajax.upload.addEventListener("progress", progressHandler, false);
                
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST","subir_archivo.php");
                ajax.send(formdata);
                }
                else
                {
                    alert('El tamanio del archivo excede los 5 Mb');
                }
            }
            
            
                
            
                
            
            
            function progressHandler(event){
                _("loaded_n_total").innerHTML = "Cargado "+event.loaded+" bytes de: "+event.total;
                var percent = (event.loaded / event.total) * 100;
                _("progressBar").value = Math.round(percent);
                _("status").innerHTML = Math.round(percent)+"% Subiendo... por favor espere";
            }
            
            function completeHandler(event){
                _("status").innerHTML = event.target.responseText;
                _("progressBar").value = 0;
            }
            
            function errorHandler(event){
                _("status").innerHTML = "Carga Fallada";
            }
            
            function abortHandler(event){
                _("status").innerHTML = "Carga Abortada";
            }
            