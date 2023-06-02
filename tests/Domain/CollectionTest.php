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

    public function testAddItem()
    {
        $collection = new Collection();
        $collection->addItem('one');
        $this->assertSame(['one'], $collection->toArray());
    }

    public function testAddItem2()
    {
        $collection = new Collection();
        $collection->addItem('one');
        $this->assertNotSame(['two'], $collection->toArray());
    }

    public function testAddItem3()
    {
        $collection = new Collection();
        $collection->addItem('one');
        $collection->addItem('one');
        $collection->addItem('one');
        $this->assertSame(['one', 'one', 'one'], $collection->toArray());
    }
}
