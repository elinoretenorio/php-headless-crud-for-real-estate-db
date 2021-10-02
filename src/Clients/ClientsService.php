<?php

declare(strict_types=1);

namespace RealEstate\Clients;

class ClientsService implements IClientsService
{
    private IClientsRepository $repository;

    public function __construct(IClientsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ClientsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ClientsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $clientId): ?ClientsModel
    {
        $dto = $this->repository->get($clientId);
        if ($dto === null) {
            return null;
        }

        return new ClientsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ClientsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ClientsModel($dto);
        }

        return $result;
    }

    public function delete(int $clientId): int
    {
        return $this->repository->delete($clientId);
    }

    public function createModel(array $row): ?ClientsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ClientsDto($row);

        return new ClientsModel($dto);
    }
}