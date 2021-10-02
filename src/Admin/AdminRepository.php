<?php

declare(strict_types=1);

namespace RealEstate\Admin;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class AdminRepository implements IAdminRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(AdminDto $dto): int
    {
        $sql = "INSERT INTO `admin` (`admin_name`, `admin_contact`, `admin_address`, `admin_email`, `username`, `password`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->adminName,
                $dto->adminContact,
                $dto->adminAddress,
                $dto->adminEmail,
                $dto->username,
                $dto->password
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(AdminDto $dto): int
    {
        $sql = "UPDATE `admin` SET `admin_name` = ?, `admin_contact` = ?, `admin_address` = ?, `admin_email` = ?, `username` = ?, `password` = ?
                WHERE `admin_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->adminName,
                $dto->adminContact,
                $dto->adminAddress,
                $dto->adminEmail,
                $dto->username,
                $dto->password,
                $dto->adminId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $adminId): ?AdminDto
    {
        $sql = "SELECT `admin_id`, `admin_name`, `admin_contact`, `admin_address`, `admin_email`, `username`, `password`
                FROM `admin` WHERE `admin_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$adminId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new AdminDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `admin_id`, `admin_name`, `admin_contact`, `admin_address`, `admin_email`, `username`, `password`
                FROM `admin`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new AdminDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $adminId): int
    {
        $sql = "DELETE FROM `admin` WHERE `admin_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$adminId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}