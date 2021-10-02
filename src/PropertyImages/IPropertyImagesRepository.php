<?php

declare(strict_types=1);

namespace RealEstate\PropertyImages;

interface IPropertyImagesRepository
{
    public function insert(PropertyImagesDto $dto): int;

    public function update(PropertyImagesDto $dto): int;

    public function get(int $propertyImageId): ?PropertyImagesDto;

    public function getAll(): array;

    public function delete(int $propertyImageId): int;
}