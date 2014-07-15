<?php

App::uses('HtmlHelper', 'View/Helper');

class MyHtmlHelper extends HtmlHelper {

	public function cancelLink($title = null, $url = null, $options = array()) {
		$buttonClass = "btn btn-default";
		$options["class"] = $buttonClass;
		$options["escape"] = false;
		$title = "<span class='glyphicon glyphicon-remove'></span> " . $title;
		return parent::link($title, $url, $options);
	}

}
