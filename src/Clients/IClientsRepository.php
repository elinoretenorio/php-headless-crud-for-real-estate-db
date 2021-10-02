<?php

declare(strict_types=1);

namespace RealEstate\Clients;

interface IClientsRepository
{
    public function insert(ClientsDto $dto): int;

    public function update(ClientsDto $dto): int;

    public function get(int $clientId): ?ClientsDto;

    public function getAll(): array;

    public function delete(int $clientId): int;
}