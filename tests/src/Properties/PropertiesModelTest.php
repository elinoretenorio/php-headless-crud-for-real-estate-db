<?php

declare(strict_types=1);

namespace RealEstate\Tests\Properties;

use PHPUnit\Framework\TestCase;
use RealEstate\Properties\{ PropertiesDto, PropertiesModel };

class PropertiesModelTest extends TestCase
{
    private array $input;
    private PropertiesDto $dto;
    private PropertiesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "property_id" => 5527,
            "property_name" => "everything",
            "description" => "around",
            "price" => 163.00,
            "property_type_id" => 2044,
            "agent_id" => 7326,
            "property_status" => 4339,
        ];
        $this->dto = new PropertiesDto($this->input);
        $this->model = new PropertiesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PropertiesModel(null);

        $this->assertInstanceOf(PropertiesModel::class, $model);
    }

    public function testGetPropertyId(): void
    {
        $this->assertEquals($this->dto->propertyId, $this->model->getPropertyId());
    }

    public function testSetPropertyId(): void
    {
        $expected = 1230;
        $model = $this->model;
        $model->setPropertyId($expected);

        $this->assertEquals($expected, $model->getPropertyId());
    }

    public function testGetPropertyName(): void
    {
        $this->assertEquals($this->dto->propertyName, $this->model->getPropertyName());
    }

    public function testSetPropertyName(): void
    {
        $expected = "rule";
        $model = $this->model;
        $model->setPropertyName($expected);

        $this->assertEquals($expected, $model->getPropertyName());
    }

    public function testGetDescription(): void
    {
        $this->assertEquals($this->dto->description, $this->model->getDescription());
    }

    public function testSetDescription(): void
    {
        $expected = "bed";
        $model = $this->model;
        $model->setDescription($expected);

        $this->assertEquals($expected, $model->getDescription());
    }

    public function testGetPrice(): void
    {
        $this->assertEquals($this->dto->price, $this->model->getPrice());
    }

    public function testSetPrice(): void
    {
        $expected = 249.40;
        $model = $this->model;
        $model->setPrice($expected);

        $this->assertEquals($expected, $model->getPrice());
    }

    public function testGetPropertyTypeId(): void
    {
        $this->assertEquals($this->dto->propertyTypeId, $this->model->getPropertyTypeId());
    }

    public function testSetPropertyTypeId(): void
    {
        $expected = 6359;
        $model = $this->model;
        $model->setPropertyTypeId($expected);

        $this->assertEquals($expected, $model->getPropertyTypeId());
    }

    public function testGetAgentId(): void
    {
        $this->assertEquals($this->dto->agentId, $this->model->getAgentId());
    }

    public function testSetAgentId(): void
    {
        $expected = 5945;
        $model = $this->model;
        $model->setAgentId($expected);

        $this->assertEquals($expected, $model->getAgentId());
    }

    public function testGetPropertyStatus(): void
    {
        $this->assertEquals($this->dto->propertyStatus, $this->model->getPropertyStatus());
    }

    public function testSetPropertyStatus(): void
    {
        $expected = 994;
        $model = $this->model;
        $model->setPropertyStatus($expected);

        $this->assertEquals($expected, $model->getPropertyStatus());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}