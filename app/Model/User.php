<?php

class User extends AppModel
{
    public $validate = array(
        "password" => array("rule" => "notEmpty", "message" => "Bitte geben Sie ein Passwort ein."),
        "password_again" => array("rule" => array('equalToField', 'password')),
    );

    function equalToField($array, $field)
    {
        return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
    }
}
?>