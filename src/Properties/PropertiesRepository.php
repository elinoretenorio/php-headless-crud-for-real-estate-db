<?php

declare(strict_types=1);

namespace RealEstate\Properties;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class PropertiesRepository implements IPropertiesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PropertiesDto $dto): int
    {
        $sql = "INSERT INTO `properties` (`property_name`, `description`, `price`, `property_type_id`, `agent_id`, `property_status`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->propertyName,
                $dto->description,
                $dto->price,
                $dto->propertyTypeId,
                $dto->agentId,
                $dto->propertyStatus
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PropertiesDto $dto): int
    {
        $sql = "UPDATE `properties` SET `property_name` = ?, `description` = ?, `price` = ?, `property_type_id` = ?, `agent_id` = ?, `property_status` = ?
                WHERE `property_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->propertyName,
                $dto->description,
                $dto->price,
                $dto->propertyTypeId,
                $dto->agentId,
                $dto->propertyStatus,
                $dto->propertyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $propertyId): ?PropertiesDto
    {
        $sql = "SELECT `property_id`, `property_name`, `description`, `price`, `property_type_id`, `agent_id`, `property_status`
                FROM `properties` WHERE `property_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$propertyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PropertiesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `property_id`, `property_name`, `description`, `price`, `property_type_id`, `agent_id`, `property_status`
                FROM `properties`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PropertiesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $propertyId): int
    {
        $sql = "DELETE FROM `properties` WHERE `property_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$propertyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}