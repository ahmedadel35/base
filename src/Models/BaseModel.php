<?php declare(strict_types = 1);

namespace App\Models;

abstract class BaseModel
{
    // protected $id;

    public function setId(int $id) : void
    {
    }

    public function __set(string $key, $value) : void
    {
        $this->key = htmlspecialchars((string)$value, ENT_QUOTES);
    }
}
