<?php $this->set("title_for_layout", "Verkaufsstatistiken") ?>
<?php echo $this->Html->script('canvasjs.min.js') ?>
<div id="customerChart" style="height: 400px; width: 600px"></div>
<script type="text/javascript">
var customerChart = new CanvasJS.Chart("customerChart",
{
  creditText: "",
  title:{
    text: "Anzahl Kunden pro Region",
    fontSize: 30
  },
  legend:{
    verticalAlign: "bottom",
    horizontalAlign: "center"
  },
  data: [
  {        
   indexLabelFontSize: 14,
   indexLabelFontFamily: "Verdana",       
   indexLabelPlacement: "outside",
   type: "pie",       
   dataPoints: [
   <?php foreach($customers_per_region as $region): ?>
   {  y: <?php echo $region[0]["count"] ?>, name: "<?php echo $region["ZipCode"]["city"] ?>", indexLabel: "<?php echo $region["ZipCode"]["city"] ?>" },
   <?php endforeach ?>
   ]
 }
 ]
});
customerChart.render();
</script>
