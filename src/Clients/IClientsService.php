<?php

declare(strict_types=1);

namespace RealEstate\Clients;

interface IClientsService
{
    public function insert(ClientsModel $model): int;

    public function update(ClientsModel $model): int;

    public function get(int $clientId): ?ClientsModel;

    public function getAll(): array;

    public function delete(int $clientId): int;

    public function createModel(array $row): ?ClientsModel;
}