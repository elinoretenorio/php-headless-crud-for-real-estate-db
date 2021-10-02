<?php

declare(strict_types=1);

namespace RealEstate\Agents;

interface IAgentsService
{
    public function insert(AgentsModel $model): int;

    public function update(AgentsModel $model): int;

    public function get(int $agentId): ?AgentsModel;

    public function getAll(): array;

    public function delete(int $agentId): int;

    public function createModel(array $row): ?AgentsModel;
}