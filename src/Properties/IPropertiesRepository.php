<?php

declare(strict_types=1);

namespace RealEstate\Properties;

interface IPropertiesRepository
{
    public function insert(PropertiesDto $dto): int;

    public function update(PropertiesDto $dto): int;

    public function get(int $propertyId): ?PropertiesDto;

    public function getAll(): array;

    public function delete(int $propertyId): int;
}