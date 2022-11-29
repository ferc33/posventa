<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
			
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
			
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
			
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=================================================================
	=            Obtener valores para el grafico de ventas            =
	=================================================================*/
	
	static public function mldVentasGrafico( $fechaInicial, $fechaFinal ){
		if( $fechaInicial == null || $fechaFinal == null ){
			$query = "SELECT	MONTH( fecha ) AS mes,YEAR( fecha ) AS anio, SUM( neto ) AS total FROM ventas GROUP BY	mes,anio ORDER BY anio,mes ASC";
			$stmt = Conexion::conectar()->prepare( $query );
			$stmt->execute();

			return $stmt->fetchAll();

		}else if( $fechaInicial == $fechaFinal ){
			$fechaFinal = date_format( date_add( date_create( $fechaFinal ), date_interval_create_from_date_string("1 days") ), "Y-m-d" );
		}
		$query = "SELECT	MONTH( fecha ) AS mes,YEAR( fecha ) AS anio, SUM( neto ) AS total FROM ventas WHERE fecha BETWEEN :fechaInicial AND	:fechaFinal GROUP BY	mes,anio ORDER BY anio,mes ASC";
		
		$stmt = Conexion::conectar()->prepare( $query );
		$stmt -> bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	/*=====  End of Obtener valores para el grafico de ventas  ======*/

	/*==============================================================
	=            OBTENER VALORES DE VENTAS POR VENDEDOR            =
	==============================================================*/
		
	static public function mdlSellsBySeller(){

		$query = "SELECT  nombre, SUM(neto) AS totalVentas FROM ventas LEFT JOIN usuarios ON ventas.id_vendedor = usuarios.id GROUP BY  id_vendedor ORDER BY totalVentas DESC LIMIT 5";

		$stmt = Conexion::conectar()->prepare( $query );

		$stmt->execute();

		return $stmt->fetchAll();
	}	
		
	/*=====  End of OBTENER VALORES DE VENTAS POR VENDEDOR  ======*/

	/*=============================================================
	=            OBTENER VALORES DE VENTAS POR CLIENTE            =
	=============================================================*/
	
	static public function mdlSellsByCustomer(){

		$query = "SELECT nombre, SUM(neto) AS totalVentas FROM	ventas LEFT JOIN clientes ON ventas.id_cliente = clientes.id GROUP BY	id_cliente ORDER BY totalVentas DESC LIMIT 10";

		$stmt = Conexion::conectar()->prepare( $query );

		$stmt->execute();

		return $stmt->fetchAll();
	}
	
	/*=====  End of OBTENER VALORES DE VENTAS POR CLIENTE  ======*/
	
			

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}