<?php
	require_once '../conexionPDO.php';

	class Usuario {
            var $conexion;
	    private $nombre;
	    private $password;
	    private $telefono;
	    private $correoElectronico;
	    private $estado;
	    private $rol;

	    function __construct() {
	        $nargs = func_num_args();
	        $args = func_get_args();
	        $this->conexion = new Conexion();
	        if ($nargs == 0) {
	            $this->nombre = "";
	            $this->password = "";
	            $this->telefono = "";
	            $this->correoElectronico = "";
	            $this->estado = "";
	            $this->rol = "asesor";
	        } else {
	            if ($nargs == 1) {
	                $this->constructor($args[0]);
	            } else {
	                $this->nombre = $args[0];
	                $this->password = $args[1];
	                $this->telefono = $args[2];
	                $this->correoElectronico = $args[3];
	                $this->estado = $args[4];
	                $this->rol = $args[5];
	            }
	        }
	    }

	    function constructor($nombre) {	        
	        $usuarios = $this->conexion->consultarArreglo("SELECT nombre_u
	                     				FROM usuario;");
	        if (in_array($nombre, $usuarios)) {
	            $datosUsuario = $this->conexion->consultarTabla("SELECT u.nombre_u, u.password_u, u.telefono_u, u.correo_electronico_u, u.estado_e, ur.rol_r
                                                                    FROM usuario u, usuario_rol ur
                                                                    WHERE u.nombre_u = ur.nombre_u AND u.nombre_u = '$nombre';");
	            $this->nombre = $datosUsuario[0][0];
	            $this->password = $datosUsuario[0][1];
	            $this->telefono = $datosUsuario[0][2];
	            $this->correoElectronico = $datosUsuario[0][3];
	            $this->estado = $datosUsuario[0][4];
	            $this->rol = $datosUsuario[0][5];
	        } else {
	            echo "el usuario no existe";
	        }	        
	    }

	    public function validarAccesoVista($vista) {
	        $res = false;	        
	        $vistaRol = $this->conexion->consultarArreglo("SELECT nombre_a 
                                                            FROM rol_aplicacion 
                                                            WHERE rol_r = '$this->rol';");
	        if (in_array($vista, $vistaRol)) {
	            $res = true;
	        }
	        return $res;
	    }

	    function insertarBD() {	        
	        $this->conexion->query("INSERT INTO usuario(nombre_u,estado_e,password_u,telefono_u,correo_electronico_u)
	        							VALUES('$this->nombre','$this->estado','$this->password','$this->telefono','$this->correoElectronico');");
	        $this->conexion->query("INSERT INTO usuario_rol (nombre_u,rol_r) 
		     							VALUES('$this->nombre','$this->rol');");	        
	    }

	    public function modificarBD() {	        
	        $this->conexion->query("UPDATE usuario 
	        			SET password_u='$this->password',estado_e='$this->estado',telefono_u='$this->telefono',correo_electronico_u='$this->correoElectronico' 
	        			WHERE nombre_u = '$this->nombre';");	        
	    }

	    public static function verificarUsuario($nombre, $password) {
	        $existe = false;	        
	        $valido = $this->conexion->consultaUnDato("SELECT nombre_u 
							FROM usuario 
							WHERE nombre_u = '$nombre' AND password_u = '$password';");
	        if ($valido != -1) {
	            $existe = true;
	        }	        
	        return $existe;
	    }

	    public static function tieneCuenta($nombre) {
	    	$existe = false;	        
	        $res = $this->conexion->consultaUnDato("SELECT nombre_u 
	        				FROM usuario
	        				WHERE nombre_u = '$nombre';");
	        if ($res > -1) {
	            $existe = true;
	        }	        
	        return $existe;
	    }

	    public static function listaUsuarios() {
	        $usuarios = $this->conexion->consultarArreglo("SELECT nombre_u 
	        						FROM usuario");	        
	        return $usuarios;
	    }

	    public static function listaRoles() {
	        $roles = $this->conexion->consultarArreglo("SELECT rol_r 
	        					FROM rol");	        
	        return $roles;
	    }

	    public function getNombre() {
	        return $this->nombre;
	    }

	    public function getPassword() {
	        return $this->password;
	    }

	    public function getTelefono() {
	        return $this->telefono;
	    }

	    public function getCorreoElectronico() {
	        return $this->correoElectronico;
	    }

	    public function getEstado() {
	        return $this->estado;
	    }

	    public function getRol() {
	        return $this->rol;
	    }

	    public function setNombre($nombre) {
	        $this->nombre = $nombre;
	    }

	    public function setPassword($password) {
	        $this->password = $password;
	    }

	    public function setTelefono($telefono) {
	        $this->telefono = $telefono;
	    }

	    public function setCorreoElectronico($correoElectronico) {
	        $this->correoElectronico = $correoElectronico;
	    }

	    public function setEstado($estado) {
	        $this->estado = $estado;
	    }

	    public function setRol($rol) {
	        $this->rol = $rol;
	    }
	}
?>
