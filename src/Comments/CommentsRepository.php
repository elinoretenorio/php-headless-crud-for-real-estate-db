<?php

declare(strict_types=1);

namespace RealEstate\Comments;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class CommentsRepository implements ICommentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CommentsDto $dto): int
    {
        $sql = "INSERT INTO `comments` (`comment`, `property_id`, `client_id`, `comment_time`, `comment_date`, `comment_status`, `admin_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->comment,
                $dto->propertyId,
                $dto->clientId,
                $dto->commentTime,
                $dto->commentDate,
                $dto->commentStatus,
                $dto->adminId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CommentsDto $dto): int
    {
        $sql = "UPDATE `comments` SET `comment` = ?, `property_id` = ?, `client_id` = ?, `comment_time` = ?, `comment_date` = ?, `comment_status` = ?, `admin_id` = ?
                WHERE `comment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->comment,
                $dto->propertyId,
                $dto->clientId,
                $dto->commentTime,
                $dto->commentDate,
                $dto->commentStatus,
                $dto->adminId,
                $dto->commentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $commentId): ?CommentsDto
    {
        $sql = "SELECT `comment_id`, `comment`, `property_id`, `client_id`, `comment_time`, `comment_date`, `comment_status`, `admin_id`
                FROM `comments` WHERE `comment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$commentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CommentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `comment_id`, `comment`, `property_id`, `client_id`, `comment_time`, `comment_date`, `comment_status`, `admin_id`
                FROM `comments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CommentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $commentId): int
    {
        $sql = "DELETE FROM `comments` WHERE `comment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$commentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}