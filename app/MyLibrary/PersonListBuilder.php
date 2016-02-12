<?php

namespace App\MyLibrary;

use App\MyLibrary\JSConverter;

class PersonListBuilder
{
    private $persons = array();

    public function __construct()
    {

    }

    public function add($name)
    {
        ($this->persons)[str_replace(' ', '', $name)] = $name;
    }

    public function toJSObject()
    {
        return JSConverter::toJSObject($this->persons);
    }
}