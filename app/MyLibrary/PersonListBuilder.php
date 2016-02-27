<?php

namespace App\MyLibrary;

use App\MyLibrary\JSConverter;

class PersonListBuilder
{
    private $persons = array();
    private $personsWithEmail = array();

    public function __construct()
    {

    }

    public function add($name)
    {
        $key = $this->removeSpaces($name);
        $this->persons[$key] = $name;
        asort($this->persons);
    }

    public function getArray()
    {
        return $this->persons;
    }

    public function copyArrayWithEmail($arrayWithEmail)
    {
        $this->personsWithEmail = $arrayWithEmail;
        foreach ($arrayWithEmail as $person)
        {
                $this->add($person['name']);
        }
    }

    public function toJSObject()
    {
        return JSConverter::toJSObject($this->persons);
    }

    public function addWithEmail($name, $email)
    {
        $key = $this->removeSpaces($name);
        $this->personsWithEmail[$key]['name'] = $name;
        $this->personsWithEmail[$key]['email'] = $email;
        asort($this->personsWithEmail);
    }

    public function getEmailArray()
    {
        return $this->personsWithEmail;
    }

    public function removeSpaces($string)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}