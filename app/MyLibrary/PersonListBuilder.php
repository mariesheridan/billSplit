<?php

namespace App\MyLibrary;

use App\MyLibrary\JSConverter;
use App\MyLibrary\Tools;

class PersonListBuilder
{
    private $personsWithEmail = array();

    public function __construct()
    {

    }

    public function copyArrayWithEmail($arrayWithEmail)
    {
        $this->personsWithEmail = $arrayWithEmail;
        asort($this->personsWithEmail);
    }

    public function appendArrayWithEmail($arrayWithEmail)
    {
        foreach ($arrayWithEmail as $key => $person)
        {
            $this->personsWithEmail[$key] = $person;
        }
        asort($this->personsWithEmail);
    }

    public function namesToJSObject()
    {
        $persons = array();
        foreach ($this->personsWithEmail as $key => $person)
        {
            $persons[$key] = $person['name'];
        }
        return JSConverter::toJSObject($persons);
    }

    public function add($name, $email, $status = "Unpaid")
    {
        $key = $this->removeSpaces($name);
        $this->personsWithEmail[$key]['name'] = $name;
        $this->personsWithEmail[$key]['email'] = $email;
        $this->personsWithEmail[$key]['status'] = $status;
        asort($this->personsWithEmail);
    }

    public function getEmailArray()
    {
        return $this->personsWithEmail;
    }

    public function getEmail($name)
    {
        $email = '';
        $key = $this->removeSpaces($name);
        if (array_key_exists($key, $this->personsWithEmail))
        {
            $email = $this->personsWithEmail[$key]['email'];
        }
        return $email;
    }

    public function getStatus($name)
    {
        $status = '';
        $key = $this->removeSpaces($name);
        if (array_key_exists($key, $this->personsWithEmail))
        {
            $status = $this->personsWithEmail[$key]['status'];
        }
        return $status;
    }

    public function removeSpaces($string)
    {
        return Tools::removeSpaces($string);
    }
}