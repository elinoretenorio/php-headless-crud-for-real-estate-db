<?php

declare(strict_types=1);

namespace RealEstate\Properties;

class PropertiesService implements IPropertiesService
{
    private IPropertiesRepository $repository;

    public function __construct(IPropertiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PropertiesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PropertiesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $propertyId): ?PropertiesModel
    {
        $dto = $this->repository->get($propertyId);
        if ($dto === null) {
            return null;
        }

        return new PropertiesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PropertiesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PropertiesModel($dto);
        }

        return $result;
    }

    public function delete(int $propertyId): int
    {
        return $this->repository->delete($propertyId);
    }

    public function createModel(array $row): ?PropertiesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PropertiesDto($row);

        return new PropertiesModel($dto);
    }
}