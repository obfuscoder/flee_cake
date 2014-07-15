<?php

App::uses('FormHelper', 'View/Helper');

class MyFormHelper extends FormHelper {
	public function end($options = null) {
		$submitButtonClass = "btn btn-primary";
		if(is_array($options)) {
			$options["class"] = $submitButtonClass;
			$options["div"] = false;
		} else if($options !== null) {
			$options = array("label" => $options, "class" => $submitButtonClass);
		}
		return parent::end($options);
	}

	public function submit($caption = null, $options = array()) {
		$submitButtonClass = "btn btn-primary";
		$options["class"] = $submitButtonClass;
		$options["div"] = false;
		return parent::submit($caption, $options);
	}

	public function submitButton($title = null, $options = array()) {
		$buttonClass = "btn btn-primary";
		$options["class"] = $buttonClass;
		$options["div"] = false;
		$options["escape"] = false;
		$title = "<span class='glyphicon glyphicon-ok'></span> " . $title;
		return parent::button($title, $options);
	}

	public function create($model = null, $options = array()) {
		$options["role"] = "form";
		$options["novalidate"] = true;
		$options["inputDefaults"] = array(
			"class" => "form-control",
			"div" => array("class" => "form-group"),
			"error" => array("attributes" => array("wrap" => "span", "class" => "help-block")),
			"label" => array("class" => "control-label"),
		);
		return parent::create($model, $options);
	}

	public function input($fieldName, $options = array()) {
		return parent::input($fieldName, $options);
	}
}

?>