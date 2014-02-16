<?php $this->set("title_for_layout", "Ergebnisse " . $event['Event']['name']) ?>
<?php echo $this->Html->script('canvasjs.min.js') ?>
<h3><?php echo CakeTime::format($event["Event"]["date"], "%A, %e. %B %Y") ?></h3>
<p>Insgesamt wurden <strong><?php echo $item_count ?></strong> Artikel auf dem Flohmarkt angeboten. Hier eine Aufstellung der Artikel-Kategorien.</p>
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
<p>Von den <strong><?php echo $item_count ?></strong> angebotenen Artikeln wurden <strong><?php echo $sold_item_count ?></strong> Artikel verkauft. Damit wurden <strong><?php echo number_format($sold_item_count/$item_count*100) ?>%</strong> aller Artikel verkauft.</p>
<p>Die Verkäufer kamen aus den folgenden Ortschaften:</p>
<div id="sellerZipChart" style="height: 400px; width: 600px"></div>
<script type="text/javascript">
var sellerZipChart = new CanvasJS.Chart("sellerZipChart",
{
  creditText: "",
  title:{
    text: "Anzahl Verkäufer pro Region",
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
   <?php foreach($sellers_per_city as $city): ?>
   {  y: <?php echo $city[0]["count"] ?>, name: "<?php echo $city["ZipCode"]["city"] ?>", indexLabel: "<?php echo $city["ZipCode"]["city"] ?>" },
   <?php endforeach ?>
   ]
 }
 ]
});
sellerZipChart.render();
</script>
<p>Hier die Top10 der Verkäufer:</p>
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
<p>Wir haben beim Verkauf die Postleitzahlen der Käufer erfragt. Hier eine Aufstellung der Käufer:</p>
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
   <?php foreach($customers_per_city as $city): ?>
   {  y: <?php echo $city[0]["count"] ?>, name: "<?php echo $city["ZipCode"]["city"] ?>", indexLabel: "<?php echo $city["ZipCode"]["city"] ?>" },
   <?php endforeach ?>
   ]
 }
 ]
});
customerChart.render();
</script>
