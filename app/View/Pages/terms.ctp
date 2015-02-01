<?php $this->set("title_for_layout", "Teilnahmebedingungen für den Kommissionsflohmarkt") ?>
<?php echo Configure::read('Brand.terms') ?>
<?php
	if (isset($this->request->query['accept'])) {
		echo $this->Form->create(null, array("type" => "get", "url" => "/sellers/register"));
		echo $this->Form->end("Teilnahmebedingungen akzeptieren");
	}
?>