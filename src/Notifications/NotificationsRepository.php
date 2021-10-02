<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class NotificationsRepository implements INotificationsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(NotificationsDto $dto): int
    {
        $sql = "INSERT INTO `notifications` (`notification_name`, `notification_description`, `admin_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->notificationName,
                $dto->notificationDescription,
                $dto->adminId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(NotificationsDto $dto): int
    {
        $sql = "UPDATE `notifications` SET `notification_name` = ?, `notification_description` = ?, `admin_id` = ?
                WHERE `notification_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->notificationName,
                $dto->notificationDescription,
                $dto->adminId,
                $dto->notificationId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $notificationId): ?NotificationsDto
    {
        $sql = "SELECT `notification_id`, `notification_name`, `notification_description`, `admin_id`
                FROM `notifications` WHERE `notification_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$notificationId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new NotificationsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `notification_id`, `notification_name`, `notification_description`, `admin_id`
                FROM `notifications`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new NotificationsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $notificationId): int
    {
        $sql = "DELETE FROM `notifications` WHERE `notification_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$notificationId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}