

<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos
{

	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/

	public function mostrarTablaProductos()
	{

		$item = null;
		$valor = null;
		$orden = "id";

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		if (count($productos) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($productos); $i++) {

			/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/

			$imagen = "<img src='" . $productos[$i]["imagen"] . "' width='40px'>";

			/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/

<<<<<<< HEAD
 	 		$item = "id_categoria"; 
 	 		$valor = $productos[$i]["id_categoria"];
=======
			$item = "id";
			$valor = $productos[$i]["id_categoria"];
>>>>>>> 8d4dceb

			$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

<<<<<<< HEAD
		
		  	/*=============================================
=======
			/*=============================================
>>>>>>> 8d4dceb
 	 		STOCK
  			=============================================*/

			if ($productos[$i]["stock"] <= 10) {

<<<<<<< HEAD
 	 			$stock = "<button class='btn btn-danger'>".$productos[$i]["sotck"]."</button>";
=======
				$stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
			} else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {
>>>>>>> 8d4dceb

				$stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
			} else {

				$stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
			}

			/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/

			if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {

				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>";
			} else {

<<<<<<< HEAD
 	 		}else{

 	 			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' cod_producto='".$productos[$i]["cod_producto"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

 	 		}

 	 		
 	 		$datosJson .='[
 	 		"'.($i+1).'",
 	 		"'.$imagen.'",
 	 		"'.$productos[$i]["cod_producto"].'",
 	 		"'.$productos[$i]["descripcion"].'",
 	 		"'.$categorias["categoria"].'",
 	 		"'.$stock.'",
 	 		"'.$productos[$i]["precio_lista"].'",
 	 		"'.$productos[$i]["precio_venta"].'",
 	 		"'.$productos[$i]["fecha"].'",
 	 		"'.$botones.'"
 	 	],';

 	 }

 	 $datosJson = substr($datosJson, 0, -1);

 	 $datosJson .=   '] 

 	}';
 	
 	echo $datosJson;
=======
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["codigo"] . "' imagen='" . $productos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";
			}
>>>>>>> 8d4dceb


			$datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $imagen . '",
			      "' . $productos[$i]["codigo"] . '",
			      "' . $productos[$i]["descripcion"] . '",
			      "' . $categorias["categoria"] . '",
			      "' . $stock . '",
			      "' . $productos[$i]["precio_compra"] . '",
			      "' . $productos[$i]["precio_venta"] . '",
			      "' . $productos[$i]["fecha"] . '",
			      "' . $botones . '"
			    ],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   '] 
		 }';

		echo $datosJson;
	}
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
