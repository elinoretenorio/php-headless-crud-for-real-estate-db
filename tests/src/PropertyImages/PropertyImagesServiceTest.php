<?php

declare(strict_types=1);

namespace RealEstate\Tests\PropertyImages;

use PHPUnit\Framework\TestCase;
use RealEstate\PropertyImages\{ PropertyImagesDto, PropertyImagesModel, IPropertyImagesService, PropertyImagesService };

class PropertyImagesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PropertyImagesDto $dto;
    private PropertyImagesModel $model;
    private IPropertyImagesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\PropertyImages\IPropertyImagesRepository");
        $this->input = [
            "property_image_id" => 7943,
            "image_name" => "exist",
            "image_description" => "some",
            "property_id" => 9332,
        ];
        $this->dto = new PropertyImagesDto($this->input);
        $this->model = new PropertyImagesModel($this->dto);
        $this->service = new PropertyImagesService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 3021;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 8535;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $propertyImageId = 5315;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($propertyImageId)
            ->willReturn(null);

        $actual = $this->service->get($propertyImageId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $propertyImageId = 2203;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($propertyImageId)
            ->willReturn($this->dto);

        $actual = $this->service->get($propertyImageId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $propertyImageId = 6193;
        $expected = 8878;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($propertyImageId)
            ->willReturn($expected);

        $actual = $this->service->delete($propertyImageId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}