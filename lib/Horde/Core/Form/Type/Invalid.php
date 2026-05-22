<?php

class Horde_Form_Type_invalid extends Horde_Form_Type
{
    public $message;

    public function init($message)
    {
        $this->message = $message;
    }

    public function isValid($var, $vars, $value, $message)
    {
        return false;
    }

}
