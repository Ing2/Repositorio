<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once '../categoria/categoria.php';
require_once '../subasta/subasta.php';
require_once '../usuario/usuario.php';
require_once '../oferta/oferta.php';
require_once '../sesion/sesion.php';
require_once '../comentario/comentario.php';
require_once '../comentario/respuesta.php';


if (!(isset($_SESSION['UserLogged'])))
   {
	$iniciarsesion='Iniciar Sesión';
	$registrarse='Registrarse';
	$sobrebestnid='Sobre Bestnid';
	$contacto='Contacto';
	$nombre=null;
	$apellido=null;
	$cerrarsesion=null;
	$micuenta=null;
	$bienvenido=null;
	$tipo=null;
	}
else
	{
	$tipo=$_SESSION['Tipo'];
	$nombre=$_SESSION['Nombre'];
	$apellido=$_SESSION['Apellido'];
	$cerrarsesion='Cerrar Sesion';
	$micuenta='Mi Cuenta';
	$bienvenido='Bienvenido:';
	$contacto='Contacto';
	$iniciarsesion=null;
	$registrarse=null;
	$sobrebestnid=null;
}




$id=$_SESSION['Id'];

$usuario= $_POST['id'];



	//$dardebaja=Usuario::eliminarUsuario($subasta);
	//$mensaje="El usuario fue borrada exitosamente";




$dardebaja=Usuario::eliminarUsuario($usuario);
$dardebaja1=Oferta::eliminarUsuarioOferta($usuario);
$dardebaja2=Oferta::eliminarUsuarioSubastaOferta($usuario);
$dardebaja3=Subasta::eliminarUsuarioSubasta($usuario);
$comentarios=Comentario::recuperarComentariosParaUsuario($usuario);
$dardebaja4=Comentario::eliminarComentarioUsuario($usuario);
$dardebaja7=Comentario::eliminarComentarioSubastaUsuario($usuario);
if (is_array($comentarios) || is_object($comentarios))
{
foreach ( $comentarios as $comentario){
	
	$dardebaja6=Respuesta::eliminarRespuestaSubasta($comentario->getIdComentario());
	


}
}
$dardebaja5=Respuesta::eliminarRespuestaUsuario($usuario);
	



if ($dardebaja != null){
	$informar="Se elimino correctamente el usuario";
}

$subastas=Usuario::recuperarUsuariosTodos();



//$elimino="El Usuario se elimino con exito!!!";




Twig_Autoloader::register();
$template = $twig->loadTemplate("ListadoUsuarios.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' =>$iniciarsesion,'MiCuenta' => 'Mi Cuenta',
'Registrarse' =>$registrarse,'Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','Ayuda' => 'Ayuda','subastas'=>$subastas,
'Categoria'=>'Categorias',
'nombre'=>$nombre,'apellido'=>$apellido,'CerrarSesion'=>$cerrarsesion,'MiCuenta'=>$micuenta,
'sobrebestnid'=>$sobrebestnid,'contacto'=>$contacto,
'ordenar'=>'Si lo desea puede ordenar nuestras subastas por alguno de los siguientes criterios:','tipo'=>$tipo,'Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'Subastas' => 'Subastas','SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'MapaDelSitio' => 'Mapa Del Sitio','IniciarSesion' => 'Iniciar Sesion','MiCuenta' => 'Mi Cuenta',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad','subastas'=>$subastas,'informar'=>$informar,

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','Acciones' => 'Acciones',
'Admin' => 'Admin','ModificarDatos' => 'Modificar Datos Propios','ManejoUsuario' => 'Gestion De Usuarios',
'ManejoCategoria' => 'Gestion de Categorias','VerComentarios' => 'Listado de Comentarios',
'VerOfertas' => 'Listado de Ofertas','VerSubastas' => 'Ver Subastas',
'AgregarAdmin' => 'Gestion de Administradores','Contacto'=>$contacto,


));

?>










