<?php
require_once '../Conexion.php';
require_once '../twig.php';
require_once 'sesion.php';

if (!(isset($_SESSION['UserLogged'])))
   {
	$iniciarsesion='Iniciar Sesión';
	$registrarse='Registrarse';
	$sobrebestnid='Sobre Bestnid';
	$contacto='Contacto';

	}
else
	{
header('Location: ../templates/index.php');
}




Twig_Autoloader::register();
$template = $twig->loadTemplate("InicioSesion.html.twig");
$template->display(array('Bestnid' => 'Bestnid','Buscar' => 'Buscar','Home' => 'Home'
,'SobreBestnid' => 'Sobre Bestnid','ComoSubastar' => 'Como Subastar',
'IniciarSesion' => 'Iniciar Sesion',
'Registrarse' => 'Registrarse','Derechos' => 'Bestnid © Todos los derechos reservados ',
'Terminos' => 'Terminos de uso','Privacidad' => 'Privacidad', 'Ayuda' => 'Ayuda',

'Ingresenombre' => 'Ingrese su nombre de usuario','Ingresecontraseña' => 'Ingrese su contraseña',
'NombreUsuario' => 'Nombre de usuario','Contraseña' => 'Contraseña','sobrebestnid'=>$sobrebestnid, 'Contacto'=>$contacto,
));
?>