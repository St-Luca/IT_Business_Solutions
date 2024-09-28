<?php
class User
{
    public $id;
    public $name;
    public $email;
    public $address;

    public function __construct($id, $name, $email, $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
    }

    public function updateProfile($name, $email, $address)
    {
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
    }
}
