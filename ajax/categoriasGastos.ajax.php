<?php

require_once "../controladores/categoriasGastos.controlador.php";
require_once "../modelos/categoriasGasto.modelo.php";

class AjaxCategoriasGastos
{

         /*=============================================
	EDITAR CATEGORÍA GASTO
	=============================================*/

         public $idCategoria;

         public function ajaxEditarCategoriaGasto()
         {

                  $item = "id";
                  $valor = $this->idCategoriaGasto;

                  $respuesta = ControladorCategoriasGastos::ctrMostrarCategoriasGastos($item, $valor);

                  echo json_encode($respuesta);
         }
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if (isset($_POST["idCategoriaGasto"])) {

         $categoria = new AjaxCategoriasGastos();
         $categoria->idCategoria = $_POST["idCategoriaGasto"];
         $categoria->ajaxEditarCategoriaGasto();
}
