<?php

declare(strict_types=1);

namespace App\Domain;

use JsonSerializable;

class Collection implements JsonSerializable
{
    public function __construct(protected $items = []) { }

    public function findBy(string $field, $value): static
    {
        return $this->filter(
          fn ($item) => is_array($item) ? $item[$field] === $value : $item->$field === $value
        );
    }

    public function addItem($item): void
    {
        $this->items[] = $item;
    }

    public function dropItemById($id): void
    {
        unset($this->items[$id]);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return count($this->items) === 0;
    }

    public function jsonSerialize(): mixed
    {
        return $this->items;
    }

    public function first(): mixed
    {
        return $this->items[0];
    }

    public function filter($callback)
    {
        return new static(array_filter(
            $this->items,
            $callback
        ));
    }
}