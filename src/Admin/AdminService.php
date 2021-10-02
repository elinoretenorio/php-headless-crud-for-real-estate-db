<?php

declare(strict_types=1);

namespace RealEstate\Admin;

class AdminService implements IAdminService
{
    private IAdminRepository $repository;

    public function __construct(IAdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(AdminModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(AdminModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $adminId): ?AdminModel
    {
        $dto = $this->repository->get($adminId);
        if ($dto === null) {
            return null;
        }

        return new AdminModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var AdminDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new AdminModel($dto);
        }

        return $result;
    }

    public function delete(int $adminId): int
    {
        return $this->repository->delete($adminId);
    }

    public function createModel(array $row): ?AdminModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new AdminDto($row);

        return new AdminModel($dto);
    }
}