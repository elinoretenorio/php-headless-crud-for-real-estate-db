<?php

declare(strict_types=1);

namespace RealEstate\Clients;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class ClientsRepository implements IClientsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ClientsDto $dto): int
    {
        $sql = "INSERT INTO `clients` (`client_name`, `client_contact`, `client_email`, `client_address`, `client_image`, `client_fb_account`, `username`, `password`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->clientName,
                $dto->clientContact,
                $dto->clientEmail,
                $dto->clientAddress,
                $dto->clientImage,
                $dto->clientFbAccount,
                $dto->username,
                $dto->password
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ClientsDto $dto): int
    {
        $sql = "UPDATE `clients` SET `client_name` = ?, `client_contact` = ?, `client_email` = ?, `client_address` = ?, `client_image` = ?, `client_fb_account` = ?, `username` = ?, `password` = ?
                WHERE `client_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->clientName,
                $dto->clientContact,
                $dto->clientEmail,
                $dto->clientAddress,
                $dto->clientImage,
                $dto->clientFbAccount,
                $dto->username,
                $dto->password,
                $dto->clientId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $clientId): ?ClientsDto
    {
        $sql = "SELECT `client_id`, `client_name`, `client_contact`, `client_email`, `client_address`, `client_image`, `client_fb_account`, `username`, `password`
                FROM `clients` WHERE `client_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$clientId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ClientsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `client_id`, `client_name`, `client_contact`, `client_email`, `client_address`, `client_image`, `client_fb_account`, `username`, `password`
                FROM `clients`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ClientsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $clientId): int
    {
        $sql = "DELETE FROM `clients` WHERE `client_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$clientId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}