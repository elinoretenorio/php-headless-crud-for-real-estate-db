<?php

declare(strict_types=1);

namespace RealEstate\Properties;

class PropertiesDto 
{
    public int $propertyId;
    public string $propertyName;
    public string $description;
    public float $price;
    public int $propertyTypeId;
    public int $agentId;
    public int $propertyStatus;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->propertyId = (int) ($row["property_id"] ?? 0);
        $this->propertyName = $row["property_name"] ?? "";
        $this->description = $row["description"] ?? "";
        $this->price = (float) ($row["price"] ?? 0);
        $this->propertyTypeId = (int) ($row["property_type_id"] ?? 0);
        $this->agentId = (int) ($row["agent_id"] ?? 0);
        $this->propertyStatus = (int) ($row["property_status"] ?? 0);
    }
}