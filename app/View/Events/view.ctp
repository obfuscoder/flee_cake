<?php $this->set("title_for_layout", "Statistiken für " . $event['Event']['name']) ?>
<?php echo $this->Html->script('canvasjs.min.js') ?>
<div id="categoryChart" style="height: 400px; width: 600px"></div>
<script type="text/javascript">
var categoryChart = new CanvasJS.Chart("categoryChart",
{
  creditText: "",
  title:{
    text: "Anzahl Artikel pro Kategorie",
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
   <?php foreach($items_per_category as $category): ?>
   {  y: <?php echo $category[0]["count"] ?>, name: "<?php echo $category["Category"]["name"] ?>", indexLabel: "<?php echo $category["Category"]["name"] ?>" },
   <?php endforeach ?>
   ]
 }
 ]
});
categoryChart.render();
</script>

<div id="sellerChart" style="height: 400px; width: 600px"></div>
<script type="text/javascript">
var sellerChart = new CanvasJS.Chart("sellerChart",
{
  creditText: "",
  title:{
    text: "Top 10 nach Anzahl verkaufter Artikel",
    fontSize: 30
  },
  axisY: {
    title: "verkaufte Artikel",
    titleFontSize: 20
  },
  axisX: {
    title: "Verkäufernummer",
    titleFontSize: 20
  },
  legend: {
    verticalAlign: "bottom",
    horizontalAlign: "center"
  },
  data: [

  {        
    type: "column",  
    showInLegend: false,
    legendMarkerColor: "grey",
    dataPoints: [
	<?php foreach($items_per_seller as $seller): ?>
    {y: <?php echo $seller[0]["count"] ?>, label: "<?php echo $seller['Reservation']['number'] ?>"},
	<?php endforeach ?>
    ]
  }   
  ]
});

sellerChart.render();
</script>

<div id="moneyChart" style="height: 400px; width: 600px"></div>
<script type="text/javascript">
var moneyChart = new CanvasJS.Chart("moneyChart",
{
  creditText: "",
  title:{
    text: "Top 10 nach Preissumme verkaufter Artikel",
    fontSize: 30
  },
  axisY: {
    title: "Gesamtpreis verkaufter Artikel",
    titleFontSize: 20,
    valueFormatString: "# €"
  },
  axisX: {
    title: "Verkäufernummer",
    titleFontSize: 20
  },
  legend: {
    verticalAlign: "bottom",
    horizontalAlign: "center"
  },
  data: [

  {
    type: "column",  
    showInLegend: false,
    toolTipContent: "<span style='\"'color: {color};'\"'>{label}</span>: <strong>{y} €</strong>",
    dataPoints: [
	<?php foreach($sum_per_seller as $seller): ?>
    {y: <?php echo $seller[0]["sum"] ?>, label: "<?php echo $seller['Reservation']['number'] ?>"},
	<?php endforeach ?>
    ]
  }   
  ]
});

moneyChart.render();
</script>