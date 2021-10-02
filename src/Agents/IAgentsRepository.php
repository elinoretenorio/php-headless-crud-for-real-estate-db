<?php

declare(strict_types=1);

namespace RealEstate\Agents;

interface IAgentsRepository
{
    public function insert(AgentsDto $dto): int;

    public function update(AgentsDto $dto): int;

    public function get(int $agentId): ?AgentsDto;

    public function getAll(): array;

    public function delete(int $agentId): int;
}