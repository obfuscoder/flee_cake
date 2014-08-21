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

    public function date($fieldName, $options = array()) {
        $dateOptions = array(
            "dateFormat" => "DMY",
            "separator" => "",
            "col" => "col-sm-2");
        return parent::input($fieldName, array_merge($options, $dateOptions));
    }

    public function time($fieldName, $options = array()) {
        $timeOptions = array(
            "timeFormat" => 24,
            "separator" => "",
            "col" => "col-sm-6",
            "interval" => 15);
        return parent::input($fieldName, array_merge($options, $timeOptions));
    }

    public function date_time($fieldName, $options = array()) {
        $dateTimeOptions = array(
            "dateFormat" => "DMY",
            "timeFormat" => 24,
            "separator" => "",
            "col" => "col-sm-2",
            "interval" => 15);
        return parent::input($fieldName, array_merge($options, $dateTimeOptions));
    }

    public function dateTime($fieldName, $dateFormat = 'DMY', $timeFormat = '24', $attributes = array()) {
        $selects = parent::dateTime($fieldName, $dateFormat, $timeFormat, $attributes);
        return $this->Html->div("row", $selects);
    }

    public function day($fieldName = null, $attributes = array()) {
        $select = parent::day($fieldName, $attributes);
        return $this->Html->div($attributes["col"], $select);
    }

    public function month($fieldName = null, $attributes = array()) {
        $select = parent::month($fieldName, $attributes);
        return $this->Html->div($attributes["col"], $select);
    }

    public function year($fieldName, $minYear = null, $maxYear = null, $attributes = array()) {
        $select = parent::year($fieldName, $minYear, $maxYear, $attributes);
        return $this->Html->div($attributes["col"], $select);
    }

    public function hour($fieldName, $format24Hours = true, $attributes = array()) {
        $select = parent::hour($fieldName, true, $attributes);
        return $this->Html->div($attributes["col"], $select);
    }

    public function minute($fieldName = null, $attributes = array()) {
        $select = parent::minute($fieldName, $attributes);
        return $this->Html->div($attributes["col"], $select);
    }

    public function checkbox($fieldName, $options = array()) {
        $checkbox = parent::checkbox($fieldName, $options);
        $label = $this->Html->tag("label", $checkbox . __(Inflector::humanize(Inflector::underscore($fieldName))));
        return $this->Html->div("checkbox", $label);
    }

    public function deleteButton($title = null, $url = null, $warning = null, $options = array()) {
        $buttonClass = "btn btn-danger";
        $options["class"] = $buttonClass;
        $options["escape"] = false;
        if ($warning !== null) {
            $options["confirm"] = $warning;
        }
        $title = "<span class='glyphicon glyphicon-trash'></span> " . $title;
        return parent::postLink($title, $url, $options);
    }

}

?>