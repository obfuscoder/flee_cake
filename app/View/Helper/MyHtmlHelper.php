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

	public function buttonLink($title = null, $url = null, $options = array()) {
		$buttonClass = "btn btn-primary";
		$options["class"] = $buttonClass;
		return parent::link($title, $url, $options);
	}

	public function iconLink($icon, $title = null, $url = null, $options = array()) {
		$text = "<span class='glyphicon glyphicon-" . $icon . "'></span> " . $title;
		$options["escape"] = false;
		return $this->buttonLink($text, $url, $options);
	}

}
