<?php
require_once '../Conexion.php';


class Categoria
{
	
  protected $_idCategoria;
  protected $_contenidoCat;
  protected $_idEstadoCat;
  // getters y setters 
  

 public function getIdCategoria() {
    return $this->_idCategoria;
  }

 public function setIdCategoria($id){
    $this->_idCategoria = $id;
  }

public function getContenidoCategoria()
{
      return $this->_contenidoCat;
}
public function setContenidoCategoria($cat)
{
       $this->_contenidoCat = $cat;
}  
  
public function getIdEstadoCategoria()
{
      return $this->_idEstadoCat;
}
public function setIdEstadoCategoria($id)
{
       $this->_idEstadoCat = $id;
}  



  
  function __construct($idcat,$contenidocat,$idestadocat)
  {
	$this->setIdCategoria($idcat);
	$this->setContenidoCategoria($contenidocat);
	$this->setIdEstadoCategoria($idestadocat);	
  }
  
  static function buildFromBD($userBD)
  {
  	return new Categoria($userBD['idcategoria'],$userBD['contenido_cat'],$userBD['idestadocat']);
  }
 
	public static function existeCategoria($contenidoCat)
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT * FROM categoria WHERE contenido_cat=:contenidocategoria AND idestadocat=1');
	$res->bindParam(':contenidocategoria', $contenidoCat);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=Categoria::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
  
public static function altaCategoria($categoria)
	{
	$db=conectaDb();
	
	
	
	if (!(Categoria::existeCategoria($categoria->getContenidoCategoria()))){
		
		
							
		
		
		$res = $db->prepare('INSERT INTO `grupo10`.`categoria` (`idcategoria`, `contenido_cat`, `idestadocat`) VALUES (NULL, :con , 1)');
	
         $res->bindParam(':con', $categoria->getContenidoCategoria());

		  
            $res->execute();	
			$db=null;
			return $categoria;
		}
		else{
			return null;
			$mensaje="categoria existente";
			exit;
	}
	}

	
	//eliminar Categoria , es una baja logica, se hace un update , actualiza el valor de idestadosub=2 . estadosub en 2 significa que esta eliminada//
	public static function eliminarCategoria($idCategoria){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE categoria SET idestadocat=2 WHERE (idcategoria=:id)');
		 $res->bindParam(':id', $idCategoria);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	
	
	public static function recuperarCategoriasActivas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from categoria where idestadocat=1 order by contenido_cat');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Categoria::buildFromBD($row);
				  $objArrayConsult[$i] = $objConsult; 
				  $i = $i + 1;
				}while(($row = $res->fetch()));
			}
			else{
			return null;
			}
		$db=null;
		return $objArrayConsult;
		}
		
  public static function recuperarCategoriasTodas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from categoria INNER JOIN estado_categoria ON estado_categoria.idestadocat=categoria.idestadocat');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Categoria::buildFromBD($row);
				  $objArrayConsult[$i] = $objConsult; 
				  $i = $i + 1;
				}while(($row = $res->fetch()));
			}
			else{
			return null;
			}
		$db=null;
		return $objArrayConsult;
		}	
		
		
		
		
		
//	public static function modificarSubasta($id,$descripcion){
//	$db=conectaDb();

//	$res = $db->prepare('UPDATE alimento SET idsubasta=:id, descripcion=:descripcion WHERE (idsubasta=:id2)');
//	$res->bindParam(':id', $codigo);
//	$res->bindParam(':id2', $id);
//	$res->bindParam(':descripcion', $descripcion);
//	$res->execute();	
//	$db=null;
//	return $res;
//           }

		
		
     public static function recuperarCategoria($id)
	{
	$db=conectaDb();
	$res = $db->prepare('select * from categoria where (idcategoria=:id)');
	$res->bindParam(':id',$id);
	$res->execute();
		if (($row = $res->fetch())){
			$a=Categoria::buildFromBD($row);
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}


 public static function modificarCategoria($con, $idcategoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare('UPDATE grupo10.categoria SET contenido_cat = :con WHERE categoria.idcategoria = :id and categoria.idestadocat=1;');
	$res->bindParam(':con',$con);
	$res->bindParam(':id',$idcategoria);
	
	
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}

	public static function TieneSubasta($id)
	{
	$db=conectaDb();

	$res = $db->prepare('select COUNT(c.idcategoria)
from categoria c , subasta s 
where c.idcategoria = s.idcategoriasub and s.idestadosub=1 and c.idcategoria=:id
group by c.idcategoria');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=$row[0];
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		
			return $a;
		
		
	} 

}
?>
	
