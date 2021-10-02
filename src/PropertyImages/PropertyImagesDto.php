<?php

declare(strict_types=1);

namespace RealEstate\PropertyImages;

class PropertyImagesDto 
{
    public int $propertyImageId;
    public string $imageName;
    public string $imageDescription;
    public int $propertyId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->propertyImageId = (int) ($row["property_image_id"] ?? 0);
        $this->imageName = $row["image_name"] ?? "";
        $this->imageDescription = $row["image_description"] ?? "";
        $this->propertyId = (int) ($row["property_id"] ?? 0);
    }
}