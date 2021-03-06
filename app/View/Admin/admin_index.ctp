<?php $this->set("title_for_layout", "Adminbereich") ?>
<h3>Verkäufer</h3>
<p>
<ul>
	<li>gesamt: <?php echo $seller_count ?></li>
	<li>aktiviert: <?php echo $active_seller_count ?></li>
	<li>wartend: <?php echo $waiting_seller_count ?></li>
</ul>
</p>
<h3>Artikel</h3>
<p>
<ul>
	<li>gesamt: <?php echo $item_count ?></li>
	<li>von Reservierungen: <?php echo $item_count_for_reservations ?></li>
	<li>Etiketten: <?php echo $reserved_item_count ?></li>
</ul>
</p>
<h3>Bewertungen</h3>
<p>
<ul>
  <li>gesamt: <?php echo $review_count ?></li>
</ul>
</p>
<?php echo $this->Html->script('canvasjs.min.js') ?>
<div id="categoryChart" style="height: 400px; width: 500px"></div>
<script type="text/javascript">
var categoryChart = new CanvasJS.Chart("categoryChart",
{
  title:{
    text: "Artikel pro Kategorie"
  },
  legend:{
    verticalAlign: "bottom",
    horizontalAlign: "center"
  },
  data: [
  {        
   indexLabelFontSize: 20,
   indexLabelFontFamily: "Monospace",       
   indexLabelFontColor: "darkgrey", 
   indexLabelLineColor: "darkgrey",        
   indexLabelPlacement: "outside",
   type: "pie",       
   showInLegend: true,
   dataPoints: [
   <?php foreach($items_per_category as $category): ?>
   {  y: <?php echo $category[0]["count"] ?>, legendText:"<?php echo $category["Category"]["name"] ?>", indexLabel: "<?php echo $category["Category"]["name"] ?>" },
   <?php endforeach ?>
   ]
 }
 ]
});

categoryChart.render();

</script>
<div id="sellerChart" style="height: 400px; width: 500px"></div>
<script type="text/javascript">
var sellerChart = new CanvasJS.Chart("sellerChart",
{
  title:{
    text: "Top 10 Verkäufer"    
  },
  axisY: {
    title: "Artikel"
  },
  legend: {
    verticalAlign: "bottom",
    horizontalAlign: "center"
  },
  theme: "theme2",
  data: [

  {        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Anzahl verkaufter Artikel",
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
<div id="totalsChart" style="height: 400px; width: 500px"></div>
<script type="text/javascript">
var totalsChart = new CanvasJS.Chart("totalsChart",
{
  title:{
    text: "Top 10 Verkaufswert Verkäufer"    
  },
  axisY: {
    title: "Summe (€)"
  },
  legend: {
    verticalAlign: "bottom",
    horizontalAlign: "center"
  },
  theme: "theme2",
  data: [

  {        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Summe verkaufter Artikel in €",
    dataPoints: [
	<?php foreach($totals_per_seller as $seller): ?>
    {y: <?php echo $seller[0]["total"] ?>, label: "<?php echo $seller['Reservation']['number'] ?>"},
	<?php endforeach ?>
    ]
  }   
  ]
});

totalsChart.render();
</script>
<div id="itemChart" style="height: 400px; width: 800px"></div>
<script type="text/javascript">
var itemChart = new CanvasJS.Chart("itemChart",
{
  theme: "theme2",
  title:{
    text: "Angelegte Artikel pro Tag"
  },
  axisX: {
    valueFormatString: "DD.MMM",
    interval:4,
    intervalType: "day"
    
  },
  axisY:{
    includeZero: false
    
  },
  data: [
  {        
    type: "column",
    dataPoints: [
    <?php foreach($items_per_day as $day) : ?>
    { x: new Date("<?php echo $this->Time->format($day[0]["date"], "%Y-%m-%d") ?>"), y: <?php echo $day[0]["count"] ?> },
    <?php endforeach; ?>
    ]
  }
  ]
});
itemChart.render();
</script>
