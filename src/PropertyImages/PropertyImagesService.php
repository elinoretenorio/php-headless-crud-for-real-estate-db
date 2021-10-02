<?php

declare(strict_types=1);

namespace RealEstate\PropertyImages;

class PropertyImagesService implements IPropertyImagesService
{
    private IPropertyImagesRepository $repository;

    public function __construct(IPropertyImagesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PropertyImagesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PropertyImagesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $propertyImageId): ?PropertyImagesModel
    {
        $dto = $this->repository->get($propertyImageId);
        if ($dto === null) {
            return null;
        }

        return new PropertyImagesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PropertyImagesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PropertyImagesModel($dto);
        }

        return $result;
    }

    public function delete(int $propertyImageId): int
    {
        return $this->repository->delete($propertyImageId);
    }

    public function createModel(array $row): ?PropertyImagesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PropertyImagesDto($row);

        return new PropertyImagesModel($dto);
    }
}