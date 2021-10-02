<?php

declare(strict_types=1);

namespace RealEstate\Agents;

class AgentsService implements IAgentsService
{
    private IAgentsRepository $repository;

    public function __construct(IAgentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(AgentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(AgentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $agentId): ?AgentsModel
    {
        $dto = $this->repository->get($agentId);
        if ($dto === null) {
            return null;
        }

        return new AgentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var AgentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new AgentsModel($dto);
        }

        return $result;
    }

    public function delete(int $agentId): int
    {
        return $this->repository->delete($agentId);
    }

    public function createModel(array $row): ?AgentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new AgentsDto($row);

        return new AgentsModel($dto);
    }
}