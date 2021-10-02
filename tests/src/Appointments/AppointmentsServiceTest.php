<?php

declare(strict_types=1);

namespace RealEstate\Tests\Appointments;

use PHPUnit\Framework\TestCase;
use RealEstate\Appointments\{ AppointmentsDto, AppointmentsModel, IAppointmentsService, AppointmentsService };

class AppointmentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private AppointmentsDto $dto;
    private AppointmentsModel $model;
    private IAppointmentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Appointments\IAppointmentsRepository");
        $this->input = [
            "appointment_id" => 5694,
            "appointment_description" => "almost",
            "appointment_date" => "2021-10-04",
            "client_id" => 110,
            "agent_id" => 386,
            "appointment_status" => 6925,
            "admin_id" => 2289,
        ];
        $this->dto = new AppointmentsDto($this->input);
        $this->model = new AppointmentsModel($this->dto);
        $this->service = new AppointmentsService($this->repository);
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
        $expected = 4235;

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
        $expected = 4268;

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
        $appointmentId = 5406;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($appointmentId)
            ->willReturn(null);

        $actual = $this->service->get($appointmentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $appointmentId = 4866;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($appointmentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($appointmentId);
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
        $appointmentId = 3272;
        $expected = 8707;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($appointmentId)
            ->willReturn($expected);

        $actual = $this->service->delete($appointmentId);
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