<?php

declare(strict_types=1);

namespace RealEstate\Tests\Appointments;

use PHPUnit\Framework\TestCase;
use RealEstate\Appointments\{ AppointmentsDto, AppointmentsModel };

class AppointmentsModelTest extends TestCase
{
    private array $input;
    private AppointmentsDto $dto;
    private AppointmentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "appointment_id" => 6648,
            "appointment_description" => "law",
            "appointment_date" => "2021-10-13",
            "client_id" => 4709,
            "agent_id" => 4536,
            "appointment_status" => 636,
            "admin_id" => 8452,
        ];
        $this->dto = new AppointmentsDto($this->input);
        $this->model = new AppointmentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new AppointmentsModel(null);

        $this->assertInstanceOf(AppointmentsModel::class, $model);
    }

    public function testGetAppointmentId(): void
    {
        $this->assertEquals($this->dto->appointmentId, $this->model->getAppointmentId());
    }

    public function testSetAppointmentId(): void
    {
        $expected = 8361;
        $model = $this->model;
        $model->setAppointmentId($expected);

        $this->assertEquals($expected, $model->getAppointmentId());
    }

    public function testGetAppointmentDescription(): void
    {
        $this->assertEquals($this->dto->appointmentDescription, $this->model->getAppointmentDescription());
    }

    public function testSetAppointmentDescription(): void
    {
        $expected = "especially";
        $model = $this->model;
        $model->setAppointmentDescription($expected);

        $this->assertEquals($expected, $model->getAppointmentDescription());
    }

    public function testGetAppointmentDate(): void
    {
        $this->assertEquals($this->dto->appointmentDate, $this->model->getAppointmentDate());
    }

    public function testSetAppointmentDate(): void
    {
        $expected = "2021-10-03";
        $model = $this->model;
        $model->setAppointmentDate($expected);

        $this->assertEquals($expected, $model->getAppointmentDate());
    }

    public function testGetClientId(): void
    {
        $this->assertEquals($this->dto->clientId, $this->model->getClientId());
    }

    public function testSetClientId(): void
    {
        $expected = 1445;
        $model = $this->model;
        $model->setClientId($expected);

        $this->assertEquals($expected, $model->getClientId());
    }

    public function testGetAgentId(): void
    {
        $this->assertEquals($this->dto->agentId, $this->model->getAgentId());
    }

    public function testSetAgentId(): void
    {
        $expected = 4700;
        $model = $this->model;
        $model->setAgentId($expected);

        $this->assertEquals($expected, $model->getAgentId());
    }

    public function testGetAppointmentStatus(): void
    {
        $this->assertEquals($this->dto->appointmentStatus, $this->model->getAppointmentStatus());
    }

    public function testSetAppointmentStatus(): void
    {
        $expected = 5896;
        $model = $this->model;
        $model->setAppointmentStatus($expected);

        $this->assertEquals($expected, $model->getAppointmentStatus());
    }

    public function testGetAdminId(): void
    {
        $this->assertEquals($this->dto->adminId, $this->model->getAdminId());
    }

    public function testSetAdminId(): void
    {
        $expected = 6511;
        $model = $this->model;
        $model->setAdminId($expected);

        $this->assertEquals($expected, $model->getAdminId());
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