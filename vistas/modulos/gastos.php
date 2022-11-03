<?php

if ($_SESSION["perfil"] == "Vendedor") {

  echo '<script>

  window.location = "inicio";

  </script>';

  return;
}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar gastos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Gastos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarGasto">

          <i class="fa fa-minus-circle" aria-hidden="true"></i> Gasto

        </button>

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCategoriaGasto">

          <i class="fa fa-tag" aria-hidden="true"></i> Categoria

        </button>


      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Descripcion</th>
              <th>Categoria</th>
              <th>Fecha</th>
              <th style="width:10px">Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $categoria_gasto = ControladorCategoriasGastos::ctrMostrarCategoriasGastos($item, $valor);

            foreach ($categoria_gasto as $key => $value) {

              echo ' 
          <tr>
              <td>' . ($key + 1) . '</td>
              <td class="text-uppercase">' . $value["categoria"] . '</td>
            <td>

              <div class="btn-group">
                <button class="btn btn-warning btnEditarGasto" idCategoriaGasto="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarCategoriaGasto"><i class="fa fa-pencil"></i>
                </button>';

              if ($_SESSION["perfil"] == "Administrador") {

                echo '
                <button class="btn btn-danger btnEliminarGasto" idCategoriaGasto="' . $value["id"] . '"><i class="fa fa-times"></i>
                </button>';
              }

              echo '
              </div>  

            </td>

          </tr>';
            }

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR  GASTO
======================================-->

<div id="modalAgregarGasto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Egreso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CATEGORIA DE GASTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-book"></i></span>

                <select class=" form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>

                  <option value="">Tipo de gasto</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categoria_gasto = ControladorCategoriasGastos::ctrMostrarCategoriasGastos($item, $valor);

                  foreach ($categoria_gasto as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA DESCRIPCION -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-list"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Descripcion de gasto" required>

              </div>

            </div>


            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-money"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Egreso de dinero" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar proveedor</button>

        </div>

        <?php

        $crearProveedor = new ControladorProveedores();
        $crearProveedor->ctrCrearProveedor();

        ?>

      </form>

    </div>

  </div>

</div>


<div id="modalAgregarCategoriaGasto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

        <?php

        $crearCategoria = new ControladorCategorias();
        $crearCategoria->ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarProveedor" id="editarProveedor" required>

                <input type="hidden" name="idProveedor" id="idProveedor" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

        $editarProveedor = new ControladorProveedores();
        $editarProveedor->ctrEditarProveedor();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarProveedor = new ControladorProveedores();
$borrarProveedor->ctrBorrarProveedor();

?>