<?php
	class BarraNavegacion {
	    private $rol;

	    function __construct($rol) {
	        $this->rol = $rol;
	    }

	    function obtenerBarraNavegacion() {
	        $res = '';
	        switch ($this->rol) {
	            case 'anonimo':
	                $res = $this->barraNavegacionAnonimo();
	                break;
	            case 'grupo-empresa':
	                $res = $this->barraNavegacionGrupoEmpresa();
	                break;
	            case 'asesor':
	                $res = $this->barraNavegacionAsesor();
	                break;
	            case 'administrador':
	                $res = $this->barraNavegacionAdministrador();
	                break;
	        }
	        return $res;
	    }

	    function barraNavegacionAnonimo() {
	        $barra = '<div class="navbar navbar-inverse navbar-static-top" role="banner">
					      <div class="container-fluid">	
						      <div class="navbar-header">
						    	  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
						         	  <span class="sr-only">Toggle navigation</span>
						        	  <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
						      	  </button>
						      	  <a href="#" class="navbar-brand">SAETIS v1.0</a>
						      </div>
						      <div class="collapse navbar-collapse" id="navbar-collapse">
						      	  <ul class="nav navbar-nav navbar-left">
						        	  <li><a href="#" data-toggle="pill">INICIO</a></li>
					      			  <li><a href="#" data-toggle="pill">PROYECTOS</a></li>
						        	  <li><a href="#" data-toggle="pill">MANUAL DE USUARIO</a></li>
						        	  <li><a href="#" data-toggle="pill">REGISTRO</a></li>
						        	  <li><a href="#" data-toggle="pill">INGRESAR</a></li>
						      	  </ul>
						      </div>
					      </div>
					  </div>';
	        return $barra;
	    }

	    function barraNavegacionGrupoEmpresa() {
	        $barra = '<div class="navbar navbar-inverse navbar-static-top" role="banner">
					      <div class="container-fluid">	
						      <div class="navbar-header">
						    	  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
						         	  <span class="sr-only">Toggle navigation</span>
						        	  <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
						      	  </button>
						      	  <a href="#" class="navbar-brand">SAETIS</a>
						      </div>
						      <div class="collapse navbar-collapse" id="navbar-collapse">
						      	  <ul class="nav navbar-nav navbar-left">
						        	  <li class="active"><a href="#" data-toggle="pill">Inicio Grupo-Empresa</a></li>
						        	  <li class="dropdown">	
						          		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Herramientas Grupo-Empresa<b class="caret"></b></a>
					          			  <ul class="dropdown-menu">
					        				  <li><a href="#" data-toggle="pill">Calendario Grupo-Empresa</a></li>
					        				  <li><a href="#" data-toggle="pill">Gestionar Grupo-Empresa Grupo-Empresa</a></li>
						          		  </ul>
						        	  </li>
					      			  <li><a href="#" data-toggle="pill">Proyectos Grupo-Empresa</a></li>
						        	  <li><a href="#" data-toggle="pill">Configuracion Grupo-Empresa</a></li>
						      	  </ul>
						      </div>
					      </div>
					  </div>';
	        return $barra;
	    }

	    function barraNavegacionAsesor() {
	        $barra = '<div class="navbar navbar-inverse navbar-static-top" role="banner">
					      <div class="container-fluid">	
						      <div class="navbar-header">
						    	  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
						         	  <span class="sr-only">Toggle navigation</span>
						        	  <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
						      	  </button>
						      	  <a href="#" class="navbar-brand">SAETIS</a>
						      </div>
						      <div class="collapse navbar-collapse" id="navbar-collapse">
						      	  <ul class="nav navbar-nav navbar-left">
						        	  <li class="active"><a href="#" data-toggle="pill">Inicio Asesor</a></li>
						        	  <li class="dropdown">	
						          		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Herramientas Asesor<b class="caret"></b></a>
					          			  <ul class="dropdown-menu">
					        				  <li><a href="#" data-toggle="pill">Calendario Asesor</a></li>
					        				  <li><a href="#" data-toggle="pill">Gestionar Grupo-Empresa Asesor</a></li>
						          		  </ul>
						        	  </li>
					      			  <li><a href="#" data-toggle="pill">Proyectos Asesor</a></li>
						        	  <li><a href="#" data-toggle="pill">Configuracion Asesor</a></li>
						      	  </ul>
						      </div>
					      </div>
					  </div>';
	        return $barra;
	    }

	    function barraNavegacionAdministrador() {
	        $barra = '<div class="navbar navbar-inverse navbar-static-top" role="banner">
					      <div class="container-fluid">	
						      <div class="navbar-header">
						    	  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
						         	  <span class="sr-only">Toggle navigation</span>
						        	  <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
							          <span class="icon-bar"></span>
						      	  </button>
						      	  <a href="#" class="navbar-brand">SAETIS</a>
						      </div>
						      <div class="collapse navbar-collapse" id="navbar-collapse">
						      	  <ul class="nav navbar-nav navbar-left">
						        	  <li class="active"><a href="#" data-toggle="pill">Inicio Administrador</a></li>
						        	  <li class="dropdown">	
						          		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Herramientas Administrador<b class="caret"></b></a>
					          			  <ul class="dropdown-menu">
					        				  <li><a href="#" data-toggle="pill">Calendario Administrador</a></li>
					        				  <li><a href="#" data-toggle="pill">Gestionar Grupo-Empresa Administrador</a></li>
						          		  </ul>
						        	  </li>
					      			  <li><a href="#" data-toggle="pill">Proyectos Administrador</a></li>
						        	  <li><a href="#" data-toggle="pill">Configuracion Administrador</a></li>
						      	  </ul>
						      </div>
					      </div>
					  </div>';
	        return $barra;
	    }
	}
?>
