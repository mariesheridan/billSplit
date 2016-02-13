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
        $this->persons[preg_replace('/[^a-zA-Z0-9]/', '', $name)] = $name;
    }

    public function getArray()
    {
        return $this->persons;
    }

    public function toJSObject()
    {
        return JSConverter::toJSObject($this->persons);
    }
}