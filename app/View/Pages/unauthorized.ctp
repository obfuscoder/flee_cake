<?php $this->set("title_for_layout", "Anmeldung fehlgeschlagen") ?>
<p>Die Anmeldung ist fehlgeschlagen. Dies kann folgende Gründe haben:</p>
<p>
	<ul>
		<li>Sie haben den Link aus der eMail nicht vollständig in Ihren Browser kopiert. Bitte prüfen Sie die Vollständigkeit des Links</li>
		<li>Ihre Registrierung wurde in der Zwischenzeit gelöscht. Dies geschah entweder durch Sie selbt oder automatisch, da die Registrierung schon zu lange zurückliegt. In diesem Fall müssen Sie sich neu registrieren.</li>
	</ul>
</p>
<p><?php echo $this->Html->link("Zurück zur Hauptseite", "/") ?></p>
