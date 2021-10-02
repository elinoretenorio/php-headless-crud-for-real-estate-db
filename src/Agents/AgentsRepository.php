<?php

declare(strict_types=1);

namespace RealEstate\Agents;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class AgentsRepository implements IAgentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(AgentsDto $dto): int
    {
        $sql = "INSERT INTO `agents` (`agent_name`, `agent_contact`, `agent_email`, `agent_address`, `agent_image`, `agent_fb_account`, `username`, `password`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->agentName,
                $dto->agentContact,
                $dto->agentEmail,
                $dto->agentAddress,
                $dto->agentImage,
                $dto->agentFbAccount,
                $dto->username,
                $dto->password
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(AgentsDto $dto): int
    {
        $sql = "UPDATE `agents` SET `agent_name` = ?, `agent_contact` = ?, `agent_email` = ?, `agent_address` = ?, `agent_image` = ?, `agent_fb_account` = ?, `username` = ?, `password` = ?
                WHERE `agent_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->agentName,
                $dto->agentContact,
                $dto->agentEmail,
                $dto->agentAddress,
                $dto->agentImage,
                $dto->agentFbAccount,
                $dto->username,
                $dto->password,
                $dto->agentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $agentId): ?AgentsDto
    {
        $sql = "SELECT `agent_id`, `agent_name`, `agent_contact`, `agent_email`, `agent_address`, `agent_image`, `agent_fb_account`, `username`, `password`
                FROM `agents` WHERE `agent_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$agentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new AgentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `agent_id`, `agent_name`, `agent_contact`, `agent_email`, `agent_address`, `agent_image`, `agent_fb_account`, `username`, `password`
                FROM `agents`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new AgentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $agentId): int
    {
        $sql = "DELETE FROM `agents` WHERE `agent_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$agentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}