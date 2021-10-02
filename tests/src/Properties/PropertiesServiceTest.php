<?php

declare(strict_types=1);

namespace RealEstate\Tests\Properties;

use PHPUnit\Framework\TestCase;
use RealEstate\Properties\{ PropertiesDto, PropertiesModel, IPropertiesService, PropertiesService };

class PropertiesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PropertiesDto $dto;
    private PropertiesModel $model;
    private IPropertiesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Properties\IPropertiesRepository");
        $this->input = [
            "property_id" => 521,
            "property_name" => "tend",
            "description" => "goal",
            "price" => 799.00,
            "property_type_id" => 2581,
            "agent_id" => 5132,
            "property_status" => 4987,
        ];
        $this->dto = new PropertiesDto($this->input);
        $this->model = new PropertiesModel($this->dto);
        $this->service = new PropertiesService($this->repository);
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
        $expected = 4338;

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
        $expected = 7982;

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
        $propertyId = 6511;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($propertyId)
            ->willReturn(null);

        $actual = $this->service->get($propertyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $propertyId = 3787;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($propertyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($propertyId);
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
        $propertyId = 9286;
        $expected = 7766;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($propertyId)
            ->willReturn($expected);

        $actual = $this->service->delete($propertyId);
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