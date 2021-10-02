<?php

declare(strict_types=1);

namespace RealEstate\Admin;

interface IAdminRepository
{
    public function insert(AdminDto $dto): int;

    public function update(AdminDto $dto): int;

    public function get(int $adminId): ?AdminDto;

    public function getAll(): array;

    public function delete(int $adminId): int;
}