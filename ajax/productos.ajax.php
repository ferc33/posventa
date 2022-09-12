<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID PROVEEDOR
  =============================================*/
  public $idProveedor;

  public function ajaxCrearCodigoProductoProveedor(){

  	$item = "id_proveedor";
  	$valor = $this->idProveedor;
    $orden = "id";

    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

    echo json_encode($respuesta);

  }

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProducto(){

  	$item = "id_categoria";
  	$valor = $this->idCategoria;
    $orden = "id";

    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

    echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcion";
      $valor = $this->nombreProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}
/*=============================================
GENERAR CÓDIGO A PARTIR DE ID PROVEEDOR
=============================================*/	

if(isset($_POST["idProveedor"])){

	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idProveedor = $_POST["idProveedor"];
	$codigoProducto -> ajaxCrearCodigoProducto();

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["idCategoria"])){

	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> ajaxCrearCodigoProducto();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 
/* Comprobando si la variable nombreProducto está configurada. Si es así, crea un nuevo objeto
AjaxProductos y establece la propiedad nombreProducto en el valor de la variable nombreProducto.
Luego llama al método ajaxEditarProducto. */

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}






