<?php

  $ventasPorVendedor = ControladorVentas::ctrSellsBySeller();

?>


<!--=====================================
VENDEDORES
======================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
    
   <h3 class="box-title">Vendedores TOP 5</h3>
   
 </div>

 <div class="box-body">
  
  <div class="chart-responsive">
   
   <div class="chart" id="bar-chart1" style="height: 300px;"></div>

 </div>

</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php

    foreach ($ventasPorVendedor as $key => $ventas) {
      echo "{y: '".$ventas["nombre"]."', a: '".$ventas["totalVentas"]."'},";
    }
  
  ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>