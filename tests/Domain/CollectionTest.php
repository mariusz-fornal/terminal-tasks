<?php

namespace App\Tests\Domain;

use App\Domain\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testEmptyArrayToArray()
    {
        $collection = new Collection([]);
        $this->assertSame([], $collection->toArray());
    }

    public function testToArray()
    {
        $collection = new Collection([1]);
        $this->assertSame([1], $collection->toArray());
    }

}
