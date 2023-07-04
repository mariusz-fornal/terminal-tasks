<?php

declare(strict_types=1);

namespace App\Domain;

class Collection
{
    public function __construct(protected $items = []) { }

    public function findBy(string $field, $value): mixed
    {
        return array_filter(
          $this->items,
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
        return count($this->items) > 0;
    }
}