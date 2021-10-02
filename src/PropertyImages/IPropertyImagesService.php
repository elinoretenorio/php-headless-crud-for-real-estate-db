<?php

declare(strict_types=1);

namespace RealEstate\PropertyImages;

interface IPropertyImagesService
{
    public function insert(PropertyImagesModel $model): int;

    public function update(PropertyImagesModel $model): int;

    public function get(int $propertyImageId): ?PropertyImagesModel;

    public function getAll(): array;

    public function delete(int $propertyImageId): int;

    public function createModel(array $row): ?PropertyImagesModel;
}