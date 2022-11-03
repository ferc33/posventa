/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCategoriaGasto", function () {
  var idCategoriaGasto = $(this).attr("idCategoriaGasto");

  var datos = new FormData();
  datos.append("idCategoriaGasto", idCategoriaGasto);

  $.ajax({
    url: "ajax/categoriasGastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarCategoria").val(respuesta["categoria"]);
      $("#idCategoriaGasto").val(respuesta["id"]);
    },
  });
});

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoriaGasto", function () {
  var idCategoria = $(this).attr("idCategoriaGasto");

  swal({
    title: "¿Está seguro de borrar la categoría?",
    text: "¡Si no lo está puede cancelar la acción!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar categoría!",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?ruta=categoria_gasto&idCategoriaGasto=" + idCategoriaGasto;
    }
  });
});
