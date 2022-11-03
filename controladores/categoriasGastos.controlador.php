<?php

class ControladorCategoriasGastos
{

         /*=============================================
	CREAR CATEGORIAS DE GASTOS
	=============================================*/

         static public function ctrCrearCategoriaGasto()
         {

                  if (isset($_POST["nuevaCategoria"])) {

                           if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {

                                    $tabla = "categoria_gasto";

                                    $datos = $_POST["nuevaCategoria"];

                                    $respuesta = ModeloCategoriasGastos::mdlIngresarCategoriaGasto($tabla, $datos);

                                    if ($respuesta == "ok") {

                                             echo '<script>

					swal({
						type: "success",
						title: "La categoría ha sido guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

								window.location = "categoria_gasto";

							}
							})

							</script>';
                                    }
                           } else {

                                    echo '<script>

						swal({
							type: "error",
							title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
								if (result.value) {

									window.location = "categoria_gasto";

								}
								})

								</script>';
                           }
                  }
         }

         /*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

         static public function ctrMostrarCategoriasGastos($item, $valor)
         {

                  $tabla = "categoria_gasto";

                  $respuesta = ModeloCategoriasGastos::mdlMostrarCategoriasGastos($tabla, $item, $valor);

                  return $respuesta;
         }

         /*=============================================
	EDITAR CATEGORIA
	=============================================*/

         static public function ctrEditarCategoriaGasto()
         {

                  if (isset($_POST["editarCategoria"])) {

                           if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {

                                    $tabla = "categoria_gasto";

                                    $datos = array('categoria' => $_POST["editarCategoria"], 'id' => $_POST["idCategoriaGasto"]);

                                    $respuesta = ModeloCategoriasGastos::mdlEditarCategoriaGasto($tabla, $datos);

                                    if ($respuesta == "ok") {

                                             echo '<script>

					swal({
						type: "success",
						title: "La categoría ha sido cambiada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

								window.location = "categoria_gasto";

							}
							})

							</script>';
                                    }
                           } else {

                                    echo '<script>

						swal({
							type: "error",
							title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
								if (result.value) {

									window.location = "categoria";

								}
								})

								</script>';
                           }
                  }
         }

         /*=============================================
	BORRAR CATEGORIA
	=============================================*/

         static public function ctrBorrarCategoriaGasto()
         {

                  if (isset($_GET["idCategoriaGasto"])) {

                           $tabla = "categoria_gasto";
                           $datos = $_GET["idCategoriaGasto"];

                           $respuesta = ModeloCategoriasGastos::mdlBorrarCategoriaGasto($tabla, $datos);

                           if ($respuesta == "ok") {

                                    echo '<script>

				swal({
					type: "success",
					title: "La categoría ha sido borrada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {

							window.location = "categoria_gasto";

						}
						})

						</script>';
                           }
                  }
         }
}
