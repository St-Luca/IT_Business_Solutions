<?php

namespace App\Models;

class User
{
    public string $id;
    public string $userName;
    public string $firstName;
    public string $lastName;

    public function __construct($id, $userName, $firstName, $lastName)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
