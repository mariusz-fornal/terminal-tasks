<?php

declare(strict_types=1);

namespace App\Domain;

class Context
{
    public function __construct(public string $name)
    {
    }
}