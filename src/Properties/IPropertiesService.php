<?php

declare(strict_types=1);

namespace RealEstate\Properties;

interface IPropertiesService
{
    public function insert(PropertiesModel $model): int;

    public function update(PropertiesModel $model): int;

    public function get(int $propertyId): ?PropertiesModel;

    public function getAll(): array;

    public function delete(int $propertyId): int;

    public function createModel(array $row): ?PropertiesModel;
}