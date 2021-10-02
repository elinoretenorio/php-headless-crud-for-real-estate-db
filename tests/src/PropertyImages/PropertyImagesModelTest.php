<?php

declare(strict_types=1);

namespace RealEstate\Tests\PropertyImages;

use PHPUnit\Framework\TestCase;
use RealEstate\PropertyImages\{ PropertyImagesDto, PropertyImagesModel };

class PropertyImagesModelTest extends TestCase
{
    private array $input;
    private PropertyImagesDto $dto;
    private PropertyImagesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "property_image_id" => 1556,
            "image_name" => "close",
            "image_description" => "me",
            "property_id" => 5491,
        ];
        $this->dto = new PropertyImagesDto($this->input);
        $this->model = new PropertyImagesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PropertyImagesModel(null);

        $this->assertInstanceOf(PropertyImagesModel::class, $model);
    }

    public function testGetPropertyImageId(): void
    {
        $this->assertEquals($this->dto->propertyImageId, $this->model->getPropertyImageId());
    }

    public function testSetPropertyImageId(): void
    {
        $expected = 5344;
        $model = $this->model;
        $model->setPropertyImageId($expected);

        $this->assertEquals($expected, $model->getPropertyImageId());
    }

    public function testGetImageName(): void
    {
        $this->assertEquals($this->dto->imageName, $this->model->getImageName());
    }

    public function testSetImageName(): void
    {
        $expected = "force";
        $model = $this->model;
        $model->setImageName($expected);

        $this->assertEquals($expected, $model->getImageName());
    }

    public function testGetImageDescription(): void
    {
        $this->assertEquals($this->dto->imageDescription, $this->model->getImageDescription());
    }

    public function testSetImageDescription(): void
    {
        $expected = "second";
        $model = $this->model;
        $model->setImageDescription($expected);

        $this->assertEquals($expected, $model->getImageDescription());
    }

    public function testGetPropertyId(): void
    {
        $this->assertEquals($this->dto->propertyId, $this->model->getPropertyId());
    }

    public function testSetPropertyId(): void
    {
        $expected = 8358;
        $model = $this->model;
        $model->setPropertyId($expected);

        $this->assertEquals($expected, $model->getPropertyId());
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