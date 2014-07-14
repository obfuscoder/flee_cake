<?php

App::uses('FormHelper', 'View/Helper');

class MyFormHelper extends FormHelper {
	public function end($options = null) {
		$submitButtonClass = "btn btn-primary";
		if(is_array($options)) {
			$options["class"] = $submitButtonClass;
		} else {
			$options = array("label" => $options, "class" => $submitButtonClass);
		}
		return parent::end($options);
	}

	public function create($model = null, $options = array()) {
		$options["role"] = "form";
		$options["inputDefaults"] = array(
			"class" => "form-control",
			"div" => array("class" => "form-group"),
			"error" => array("attributes" => array("wrap" => "span", "class" => "help-block")),
			"label" => array("class" => "control-label")
		);
		return parent::create($model, $options);
	}

	public function input($fieldName, $options = array()) {
		return parent::input($fieldName, $options);
	}
}

?>