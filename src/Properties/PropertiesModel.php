<?php

declare(strict_types=1);

namespace RealEstate\Properties;

use JsonSerializable;

class PropertiesModel implements JsonSerializable
{
    private int $propertyId;
    private string $propertyName;
    private string $description;
    private float $price;
    private int $propertyTypeId;
    private int $agentId;
    private int $propertyStatus;

    public function __construct(PropertiesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->propertyId = $dto->propertyId;
        $this->propertyName = $dto->propertyName;
        $this->description = $dto->description;
        $this->price = $dto->price;
        $this->propertyTypeId = $dto->propertyTypeId;
        $this->agentId = $dto->agentId;
        $this->propertyStatus = $dto->propertyStatus;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function setPropertyName(string $propertyName): void
    {
        $this->propertyName = $propertyName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPropertyTypeId(): int
    {
        return $this->propertyTypeId;
    }

    public function setPropertyTypeId(int $propertyTypeId): void
    {
        $this->propertyTypeId = $propertyTypeId;
    }

    public function getAgentId(): int
    {
        return $this->agentId;
    }

    public function setAgentId(int $agentId): void
    {
        $this->agentId = $agentId;
    }

    public function getPropertyStatus(): int
    {
        return $this->propertyStatus;
    }

    public function setPropertyStatus(int $propertyStatus): void
    {
        $this->propertyStatus = $propertyStatus;
    }

    public function toDto(): PropertiesDto
    {
        $dto = new PropertiesDto();
        $dto->propertyId = (int) ($this->propertyId ?? 0);
        $dto->propertyName = $this->propertyName ?? "";
        $dto->description = $this->description ?? "";
        $dto->price = (float) ($this->price ?? 0);
        $dto->propertyTypeId = (int) ($this->propertyTypeId ?? 0);
        $dto->agentId = (int) ($this->agentId ?? 0);
        $dto->propertyStatus = (int) ($this->propertyStatus ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "property_id" => $this->propertyId,
            "property_name" => $this->propertyName,
            "description" => $this->description,
            "price" => $this->price,
            "property_type_id" => $this->propertyTypeId,
            "agent_id" => $this->agentId,
            "property_status" => $this->propertyStatus,
        ];
    }
}