<?php

declare(strict_types=1);

namespace RealEstate\PropertyImages;

use JsonSerializable;

class PropertyImagesModel implements JsonSerializable
{
    private int $propertyImageId;
    private string $imageName;
    private string $imageDescription;
    private int $propertyId;

    public function __construct(PropertyImagesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->propertyImageId = $dto->propertyImageId;
        $this->imageName = $dto->imageName;
        $this->imageDescription = $dto->imageDescription;
        $this->propertyId = $dto->propertyId;
    }

    public function getPropertyImageId(): int
    {
        return $this->propertyImageId;
    }

    public function setPropertyImageId(int $propertyImageId): void
    {
        $this->propertyImageId = $propertyImageId;
    }

    public function getImageName(): string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageDescription(): string
    {
        return $this->imageDescription;
    }

    public function setImageDescription(string $imageDescription): void
    {
        $this->imageDescription = $imageDescription;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function toDto(): PropertyImagesDto
    {
        $dto = new PropertyImagesDto();
        $dto->propertyImageId = (int) ($this->propertyImageId ?? 0);
        $dto->imageName = $this->imageName ?? "";
        $dto->imageDescription = $this->imageDescription ?? "";
        $dto->propertyId = (int) ($this->propertyId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "property_image_id" => $this->propertyImageId,
            "image_name" => $this->imageName,
            "image_description" => $this->imageDescription,
            "property_id" => $this->propertyId,
        ];
    }
}