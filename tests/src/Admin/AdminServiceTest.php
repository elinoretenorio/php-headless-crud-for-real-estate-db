<?php

declare(strict_types=1);

namespace RealEstate\Tests\Admin;

use PHPUnit\Framework\TestCase;
use RealEstate\Admin\{ AdminDto, AdminModel, IAdminService, AdminService };

class AdminServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private AdminDto $dto;
    private AdminModel $model;
    private IAdminService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Admin\IAdminRepository");
        $this->input = [
            "admin_id" => 2928,
            "admin_name" => "money",
            "admin_contact" => "trial",
            "admin_address" => "charge",
            "admin_email" => "omartinez@example.net",
            "username" => "star",
            "password" => "task",
        ];
        $this->dto = new AdminDto($this->input);
        $this->model = new AdminModel($this->dto);
        $this->service = new AdminService($this->repository);
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
        $expected = 6927;

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
        $expected = 1991;

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
        $adminId = 8587;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($adminId)
            ->willReturn(null);

        $actual = $this->service->get($adminId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $adminId = 1870;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($adminId)
            ->willReturn($this->dto);

        $actual = $this->service->get($adminId);
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
        $adminId = 7150;
        $expected = 8659;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($adminId)
            ->willReturn($expected);

        $actual = $this->service->delete($adminId);
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