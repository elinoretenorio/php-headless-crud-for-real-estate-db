<?php

declare(strict_types=1);

namespace RealEstate\PropertyImages;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class PropertyImagesRepository implements IPropertyImagesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PropertyImagesDto $dto): int
    {
        $sql = "INSERT INTO `property_images` (`image_name`, `image_description`, `property_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->imageName,
                $dto->imageDescription,
                $dto->propertyId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PropertyImagesDto $dto): int
    {
        $sql = "UPDATE `property_images` SET `image_name` = ?, `image_description` = ?, `property_id` = ?
                WHERE `property_image_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->imageName,
                $dto->imageDescription,
                $dto->propertyId,
                $dto->propertyImageId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $propertyImageId): ?PropertyImagesDto
    {
        $sql = "SELECT `property_image_id`, `image_name`, `image_description`, `property_id`
                FROM `property_images` WHERE `property_image_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$propertyImageId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PropertyImagesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `property_image_id`, `image_name`, `image_description`, `property_id`
                FROM `property_images`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PropertyImagesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $propertyImageId): int
    {
        $sql = "DELETE FROM `property_images` WHERE `property_image_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$propertyImageId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}