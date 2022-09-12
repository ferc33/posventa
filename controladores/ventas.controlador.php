<?php

// use Mike42\Escpos\Printer;
// use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\FilePrintConnector;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				echo'<script>

				swal({
					type: "error",
					title: "La venta no se ha ejecuta si no hay productos",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {

							window.location = "ventas";

						}
						})

						</script>';

						return;
					}


					$listaProductos = json_decode($_POST["listaProductos"], true);

					$totalProductosComprados = array();

					foreach ($listaProductos as $key => $value) {

						array_push($totalProductosComprados, $value["cantidad"]);

						$tablaProductos = "productos";

						$item = "id";
						$valor = $value["id"];
						$orden = "id";

						$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

						$item1a = "ventas";
						$valor1a = $value["cantidad"] + $traerProducto["ventas"];

						$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

						$item1b = "stock";
						$valor1b = $value["stock"];

						$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

					}

					$tablaClientes = "clientes";

					$item = "id";
					$valor = $_POST["seleccionarCliente"];

					$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

					$item1a = "compras";

					$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

					$item1b = "ultima_compra";

					date_default_timezone_set('America/Mexico_City');

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');
					$valor1b = $fecha.' '.$hora;

					$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
				"id_cliente"=>$_POST["seleccionarCliente"],
				"codigo"=>$_POST["nuevaVenta"],
				"productos"=>$_POST["listaProductos"],
				"impuesto"=>$_POST["nuevoPrecioImpuesto"],
				"neto"=>$_POST["nuevoPrecioNeto"],
				"total"=>$_POST["totalVenta"],
				"metodo_pago"=>$_POST["listaMetodoPago"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				/* // $impresora = "epson20";
				// $conector = new WindowsPrintConnector($impresora);
				// $imprimir = new Printer($conector);
				// $imprimir -> text("Hola Mundo"."\n");
				// $imprimir -> cut();
				// $imprimir -> close();
				// $impresora = "epson20";
				// $conector = new WindowsPrintConnector($impresora);
				// $printer = new Printer($conector);
				// $printer -> setJustification(Printer::JUSTIFY_CENTER);
				// $printer -> text(date("Y-m-d H:i:s")."\n");//Fecha de la factura
				// $printer -> feed(1); //Alimentamos el papel 1 vez*/
				// $printer -> text("Inventory System"."\n");//Nombre de la empresa
				// $printer -> text("NIT: 71.759.963-9"."\n");//Nit de la empresa
				// $printer -> text("Dirección: Calle 44B 92-11"."\n");//Dirección de la empresa
				// $printer -> text("Teléfono: 300 786 52 49"."\n");//Teléfono de la empresa
				// $printer -> text("FACTURA N.".$_POST["nuevaVenta"]."\n");//Número de factura
				// $printer -> feed(1); //Alimentamos el papel 1 vez*/
				// $printer -> text("Cliente: ".$traerCliente["nombre"]."\n");//Nombre del cliente
				// $tablaVendedor = "usuarios";
				// $item = "id";
				// $valor = $_POST["idVendedor"];
				// $traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

				// $printer -> text("Vendedor: ".$traerVendedor["nombre"]."\n");//Nombre del vendedor

				// $printer -> feed(1); //Alimentamos el papel 1 vez*/

				// foreach ($listaProductos as $key => $value) {
				// 	$printer->setJustification(Printer::JUSTIFY_LEFT);
				// 	$printer->text($value["descripcion"]."\n");//Nombre del producto
				// 	$printer->setJustification(Printer::JUSTIFY_RIGHT);
				// 	$printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".number_format($value["total"],2)."\n");
				// }

				// $printer -> feed(1); //Alimentamos el papel 1 vez*/			
				// $printer->text("NETO: $ ".number_format($_POST["nuevoPrecioNeto"],2)."\n"); //ahora va el neto
				// $printer->text("IMPUESTO: $ ".number_format($_POST["nuevoPrecioImpuesto"],2)."\n"); //ahora va el impuesto
				// $printer->text("--------\n");
				// $printer->text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n"); //ahora va el total
				// $printer -> feed(1); //Alimentamos el papel 1 vez*/	
				// $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página
				// $printer -> feed(3); //Alimentamos el papel 3 veces*/
				// $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción
				// $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder
				// $printer -> close(); */

				echo'<script>
				localStorage.removeItem("rango");
				swal({
					type: "success",
					title: "La venta ha sido guardada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {

							window.location = "ventas";

						}
						})

						</script>';

					}

				}

			}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);		

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";

				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Mexico_City');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
				"id_cliente"=>$_POST["seleccionarCliente"],
				"codigo"=>$_POST["editarVenta"],
				"productos"=>$listaProductos,
				"impuesto"=>$_POST["nuevoPrecioImpuesto"],
				"neto"=>$_POST["nuevoPrecioNeto"],
				"total"=>$_POST["totalVenta"],
				"metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					type: "success",
					title: "La venta ha sido editada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then((result) => {
						if (result.value) {

							window.location = "ventas";

						}
						})

						</script>';

					}

				}

			}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					type: "success",
					title: "La venta ha sido borrada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {

							window.location = "ventas";

						}
						})

						</script>';

					}		
				}

			}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	static public function ctrVentasGrafico( $fechaInicial, $fechaFinal ){
		$respuesta = ModeloVentas::mldVentasGrafico( $fechaInicial, $fechaFinal );
		return $respuesta;
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='1'> 

				<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
				<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
				<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
				<td style='font-weight:bold; border:1px solid #eee;'>IVA</td>				
				<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
				<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
				<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
				</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

				echo utf8_decode("<tr>
					<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
					<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
					<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
					<td style='border:1px solid #eee;'>");

				$productos =  json_decode($item["productos"], true);

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["cantidad"]."<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["descripcion"]."<br>");

				}

				echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
					</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/*=============================================
	DESCARGAR XML
	=============================================*/

	static public function ctrDescargarXML(){

		if(isset($_GET["xml"])){


			$tabla = "ventas";
			$item = "codigo";
			$valor = $_GET["xml"];

			$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			//var_dump($ventas);

			// PRODUCTOS

			$listaProductos = json_decode($ventas["productos"], true);

			// CLIENTE

			$tablaClientes = "clientes";
			$item = "id";
			$valor = $ventas["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			// VENDEDOR

			$tablaVendedor = "usuarios";
			$item = "id";
			$valor = $ventas["id_vendedor"];

			$traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

			//http://php.net/manual/es/book.xmlwriter.php

			$objetoXML = new XMLWriter();

			$objetoXML->openURI($_GET["xml"].".xml"); //Creación del archivo XML

			$objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

			$objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

			$objetoXML->startDocument('1.0', 'utf-8');// Inicio del documento

			//Factura formato colombia
			//$objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');			

			$objetoXML->writeRaw('
				<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Serie="A" Folio="167ABC" Fecha="'.$ventas["fecha"].'" Sello="kqFJelLV1B99l8DunR98pn5k8uCwi94k+PhZJ2crw5Et2+qSkoROBlOWsoXrv93j5UUPBkxTmlStwTGBHSHWiQr1ewA4/fzseNIaWokVbIr8iFwrZETgZWp6Q+dErqLntDPISWYHmXfnvXi/Om7hCtklZC/msv3ZmmojcZEkjJb0Rk+sVDh+qm3sRbx40k1xKX1xtgLnX4/P/DwZlv+mj31YE4MEpy48xMjBA7dPNE4dF9UL3mTAQhwMV40MCrLpjTn95ov8mnL0ftaxuqzGXhqqNcDk1YF5OtBXuGFKwWAfY53bNxz1GeVY1+/8xZsmUmuukwA5uvIa7ghGt/4twA==" NoCertificado="20001000000300022817" Certificado="MIIGBzCCA++gAwIBAgIUMjAwMDEwMDAwMDAzMDAwMjI4MTcwDQYJKoZIhvcNAQELBQAwggFmMSAw HgYDVQQDDBdBLkMuIDIgZGUgcHJ1ZWJhcyg0MDk2KTEvMC0GA1UECgwmU2VydmljaW8gZGUgQWRt aW5pc3RyYWNpw7NuIFRyaWJ1dGFyaWExODA2BgNVBAsML0FkbWluaXN0cmFjacOzbiBkZSBTZWd1 cmlkYWQgZGUgbGEgSW5mb3JtYWNpw7NuMSkwJwYJKoZIhvcNAQkBFhphc2lzbmV0QHBydWViYXMu c2F0LmdvYi5teDEmMCQGA1UECQwdQXYuIEhpZGFsZ28gNzcsIENvbC4gR3VlcnJlcm8xDjAMBgNV BBEMBTA2MzAwMQswCQYDVQQGEwJNWDEZMBcGA1UECAwQRGlzdHJpdG8gRmVkZXJhbDESMBAGA1UE BwwJQ295b2Fjw6FuMRUwEwYDVQQtEwxTQVQ5NzA3MDFOTjMxITAfBgkqhkiG9w0BCQIMElJlc3Bv bnNhYmxlOiBBQ0RNQTAeFw0xNjEwMjUyMTU3NTZaFw0yMDEwMjUyMTU3NTZaMIHzMTAwLgYDVQQD EydSQURJT0dSQUZJQVMgSU5EVVNUUklBTEVTIERFTCBDRU5UUk8gQUMxMDAuBgNVBCkTJ1JBRElP R1JBRklBUyBJTkRVU1RSSUFMRVMgREVMIENFTlRSTyBBQzEwMC4GA1UEChMnUkFESU9HUkFGSUFT IElORFVTVFJJQUxFUyBERUwgQ0VOVFJPIEFDMSUwIwYDVQQtExxWT0M5OTAxMjlJMjYgLyBGVUFC NzcwMTE3QlhBMR4wHAYDVQQFExUgLyBGVUFCNzcwMTE3TURGUk5OMDkxFDASBgNVBAsUC1BydWVi YV9DRkRJMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlO2ox7F9hB1xqkVlkonG1ZLv xh9d1tW/fEHu4vssixClDB/QhAYjQwXZY33IYGOs2Cfhzm/ApqsXJUp+Kp2Xu8TEW744+LCIIt12 RoHl4UBLuWyUafPsgMO3bsLIDMpAGU7b7+qAShN8gQiePD8aCy/86wzPoInhLfZ2r59/ozn4TzcA MAqX2e/M8o3jSuLxlgNyVqQLSjNy8rddB89oVn51APDt/CWuha5f9BJ47X6sVqr3ZRXicuwbAnoZ VovX1XoLt8YEP2sm10Jm4+OO+rHGLM/OBqA6AZvIfPe3Z32cijkrRRz9+nmRTSrZQkjJpYKglEZR DgV+wpt9cYYiAQIDAQABox0wGzAMBgNVHRMBAf8EAjAAMAsGA1UdDwQEAwIGwDANBgkqhkiG9w0B AQsFAAOCAgEAVlOG4eH705Rl3BKjvKqs1+JJAzJbRD738gp5d1nQk6sfGYqer0AGpK0VXqmteThR Nr/KrtJg73iwr0dfvSYzZ+Krzf6PMHGzENIDdcVzcfOw3Q5v7Pj/9KEqVJGMQQXOPjoJ2fe4E8A7 TKh0zkQRZezNGmZwL7SMQPQwtgfYxUMh1jBdbCLMBzurg9thOsJyrBn49k1HjwB3HBMgZktdm5Kd g1ypCRjQcFTpKog2aWIl38nZCpWs5eheeOJgn28U6kX0TW0JqSEUwHpO6y8pWnffTL9/rKc6CxQw QRarV4qmiJrdeFq3cgk79sRgQA0fltYDB8DLF7Hkdji74glUZtrMD2XKoGMOSJrhlDJU7kphIOaw Vk1zbEON2rz3vt+NX02ovZct9Wg9lsI8FpQUcufa03vBkY3CUONPY9QUIDKw+y4Ng4+WijByUMsh YBWiZRKSZF6o4fJdj1kVUTktYZvUdB+CarxRWKt+Ga+xwztYCVfzWJSrxvD9jcynqWPKNy4m3IgJ RZ4oCiwVAsSinMRG0INUMJaSYAqa5dhyzXlg/1s0cjb4rewaypxV+S4pmW7CVci2ZWZG6QICsh+2 MeX9DaW2SYl0JFlCDmSiRIE8yvryw3S2v7MRN0ltqMNPnOmlUc8qPEVZ9OfClm39abKIe1PWI7TZ /1rM+dE4ucU=" SubTotal="'.number_format($ventas["neto"],2).'" Moneda="MXN" Total="'.number_format($ventas["total"],2).'" TipoDeComprobante="I" FormaPago="01" MetodoPago="PUE" CondicionesDePago="CONDICIONES" Descuento="0.00" TipoCambio="1" LugarExpedicion="45079">
				');
			$objetoXML->writeRaw('<cfdi:CfdiRelacionados TipoRelacion="01">');
				$objetoXML->writeRaw('<cfdi:CfdiRelacionado UUID="A39DA66B-52CA-49E3-879B-5C05185B0EF7" />');
			$objetoXML->writeRaw('</cfdi:CfdiRelacionados>');
			/* $objetoXML->writeRaw('
				<cfdi:Emisor Rfc="LAHH850905BZ4" Nombre="HORACIO LLANOS" RegimenFiscal="608" />
				    <cfdi:Receptor Rfc="HEPR930322977" Nombre="RAFAEL ALEJANDRO HERNÁNDEZ PALACIOS" UsoCFDI="G01" />
				    <cfdi:Conceptos>
				        <cfdi:Concepto ClaveProdServ="01010101" ClaveUnidad="F52" NoIdentificacion="00001" Cantidad="1.5" Unidad="TONELADA" Descripcion="ACERO" ValorUnitario="1500000" Importe="2250000">
				            <cfdi:Impuestos>
				                <cfdi:Traslados>
				                    <cfdi:Traslado Base="2250000" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="360000" />
				                </cfdi:Traslados>
				                <cfdi:Retenciones>
				                    <cfdi:Retencion Base="2250000" Impuesto="003" TipoFactor="Tasa" TasaOCuota="0.530000" Importe="1192500" />
				                </cfdi:Retenciones>
				            </cfdi:Impuestos>
				            <cfdi:CuentaPredial Numero="51888" />
				        </cfdi:Concepto>
				        <cfdi:Concepto ClaveProdServ="01010101" ClaveUnidad="F52" NoIdentificacion="00002" Cantidad="1.6" Unidad="TONELADA" Descripcion="ALUMINIO" ValorUnitario="1500" Importe="2400">
				            <cfdi:Impuestos>
				                <cfdi:Traslados>
				                    <cfdi:Traslado Base="2400" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="384" />
				                </cfdi:Traslados>
				                <cfdi:Retenciones>
				                    <cfdi:Retencion Base="2400" Impuesto="003" TipoFactor="Tasa" TasaOCuota="0.530000" Importe="1272" />
				                </cfdi:Retenciones>
				            </cfdi:Impuestos>
				            <cfdi:InformacionAduanera NumeroPedimento="15  48  3009  0001234" />
				        </cfdi:Concepto>
				        <cfdi:Concepto ClaveProdServ="01010101" ClaveUnidad="F52" NoIdentificacion="00003" Cantidad="1.7" Unidad="TONELADA" Descripcion="ZAMAC" ValorUnitario="10000" Importe="17000">
				            <cfdi:Impuestos>
				                <cfdi:Traslados>
				                    <cfdi:Traslado Base="17000" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="2720" />
				                </cfdi:Traslados>
				                <cfdi:Retenciones>
				                    <cfdi:Retencion Base="17000" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="2720" />
				                </cfdi:Retenciones>
				            </cfdi:Impuestos>
				            <cfdi:Parte ClaveProdServ="01010101" NoIdentificacion="055155" Cantidad="1.0" Descripcion="PARTE EJEMPLO" Unidad="UNIDAD" ValorUnitario="1.00" Importe="1.00">
				                <cfdi:InformacionAduanera NumeroPedimento="15  48  3009  0002777" />
				            </cfdi:Parte>
				        </cfdi:Concepto>
				    </cfdi:Conceptos>
				    <cfdi:Impuestos TotalImpuestosRetenidos="1196492" TotalImpuestosTrasladados="363104">
				        <cfdi:Retenciones>
				            <cfdi:Retencion Impuesto="002" Importe="2720" />
				            <cfdi:Retencion Impuesto="003" Importe="1193772" />
				        </cfdi:Retenciones>
				        <cfdi:Traslados>
				            <cfdi:Traslado Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="363104" />
				        </cfdi:Traslados>
				    </cfdi:Impuestos>
				 
				    <cfdi:Complemento>
				        <tfd:TimbreFiscalDigital xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xsi:schemaLocation="http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/cfd/TimbreFiscalDigital/TimbreFiscalDigitalv11.xsd" Version="1.1" UUID="5CB8D806-7BDF-4D24-AC4C-4C469EB4F57A" FechaTimbrado="2017-10-31T17:39:42" RfcProvCertif="SFE0807172W7" SelloCFD="kqFJelLV1B99l8DunR98pn5k8uCwi94k+PhZJ2crw5Et2+qSkoROBlOWsoXrv93j5UUPBkxTmlStwTGBHSHWiQr1ewA4/fzseNIaWokVbIr8iFwrZETgZWp6Q+dErqLntDPISWYHmXfnvXi/Om7hCtklZC/msv3ZmmojcZEkjJb0Rk+sVDh+qm3sRbx40k1xKX1xtgLnX4/P/DwZlv+mj31YE4MEpy48xMjBA7dPNE4dF9UL3mTAQhwMV40MCrLpjTn95ov8mnL0ftaxuqzGXhqqNcDk1YF5OtBXuGFKwWAfY53bNxz1GeVY1+/8xZsmUmuukwA5uvIa7ghGt/4twA==" NoCertificadoSAT="20001000000300022779" SelloSAT="tUH6OL8H4V/Pcsjjjhvscme19OU1aRx03RKXRVsGUbtiZCQAxkWwzVKOjrXxJR0rVHHChhDpG6Yg/fIZaVwwVJXy9xLE2O6WUdeY+iEUJGrVp4Kv4PyfSz/KCqJp/dnpAGvdl2BpY1ZvpRi4a2/MJ7UvokEU2malSiGoB0mPrPeYo/nXkFUDfrisQ9pZDKgpowkw4mi4sYZOPl5JCPaF8X5LuSLDNcO3FPeslDvjqtM0Jlmu3tk5/O2opjhKDv7L+327JFU+efbExqifTR43Anthnu0mXv+zSviDlLbxJcRF+bXXvPHlYi3gENazzOxHlnlXa+qfCU3eNRd+uih3gA==" />
				    </cfdi:Complemento>
				');

			// $objetoXML->writeRaw('<ext:UBLExtensions>');

			// foreach ($listaProductos as $key => $value) {
				
			// 	$objetoXML->text($value["descripcion"].", ");

			// }

			// $objetoXML->writeRaw('</ext:UBLExtensions>'); */

			$objetoXML->writeRaw('</cfdi:Comprobante>');

			$objetoXML->endDocument(); // Final del documento

			return true;	
		}

	}

	static public function ctrSellsBySeller(){
		$respuesta = ModeloVentas::mdlSellsBySeller();
		return $respuesta;		
	}

	static public function ctrSellsByCustomer(){
		$respuesta = ModeloVentas::mdlSellsByCustomer();
		return $respuesta;
	}

}