<?php

declare(strict_types=1);

namespace RealEstate\Admin;

interface IAdminService
{
    public function insert(AdminModel $model): int;

    public function update(AdminModel $model): int;

    public function get(int $adminId): ?AdminModel;

    public function getAll(): array;

    public function delete(int $adminId): int;

    public function createModel(array $row): ?AdminModel;
}