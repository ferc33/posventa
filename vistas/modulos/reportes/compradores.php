<?php
  $ventasPorCliente = ControladorVentas::ctrSellsByCustomer();

  //var_dump($ventasPorCliente);
?>

<!--=====================================
COMPRADORES
======================================-->

<div class="box box-primary">
	
	<div class="box-header with-border">
    
   <h3 class="box-title">Compradores TOP 10</h3>
   
 </div>

 <div class="box-body">
  
  <div class="chart-responsive">
   
   <div class="chart" id="bar-chart2" style="height: 300px;"></div>

 </div>

</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [
  <?php
  
    foreach ($ventasPorCliente as $key => $ventas) {
      echo "{y: '".$ventas["nombre"]."', a: '".$ventas["totalVentas"]."'},";
    }

  ?>
  ],
  barColors: ['#f6a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>