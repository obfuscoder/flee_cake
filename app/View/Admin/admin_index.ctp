<?php $this->set("title_for_layout", "Adminbereich") ?>
<p class="actions">
	<?php echo $this->Html->link("Termine", array("controller" => "events", "action" => "index")); ?>
	<?php echo $this->Html->link("Verkäufer", array("controller" => "sellers", "action" => "index")); ?>
	<?php echo $this->Html->link("Kategorien", array("controller" => "categories", "action" => "index")); ?>
	<?php echo $this->Html->link("Mails triggern", "/mails/worker"); ?>
	<?php echo $this->Html->link("DB Dump", array("action" => "dump")); ?>
</p>
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
<h3>Mailqueue</h3>
<p>
<ul>
	<li>gesamt: <?php echo $sent_mails + $unsent_mails ?></li>
	<li>gesendet: <?php echo $sent_mails ?></li>
	<li>in Queue: <?php echo $unsent_mails ?></li>
	<li>zuletzt gesendete Mail: <?php echo $last_sent_mail ?></li>
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
