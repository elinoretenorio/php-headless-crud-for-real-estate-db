<?php

declare(strict_types=1);

namespace RealEstate\Tests\Appointments;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Appointments\{ AppointmentsDto, IAppointmentsRepository, AppointmentsRepository };

class AppointmentsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private AppointmentsDto $dto;
    private IAppointmentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "appointment_id" => 419,
            "appointment_description" => "whole",
            "appointment_date" => "2021-09-27",
            "client_id" => 9226,
            "agent_id" => 8669,
            "appointment_status" => 2368,
            "admin_id" => 509,
        ];
        $this->dto = new AppointmentsDto($this->input);
        $this->repository = new AppointmentsRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 448;

        $sql = "INSERT INTO `appointments` (`appointment_description`, `appointment_date`, `client_id`, `agent_id`, `appointment_status`, `admin_id`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->appointmentDescription,
                $this->dto->appointmentDate,
                $this->dto->clientId,
                $this->dto->agentId,
                $this->dto->appointmentStatus,
                $this->dto->adminId
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 7426;

        $sql = "UPDATE `appointments` SET `appointment_description` = ?, `appointment_date` = ?, `client_id` = ?, `agent_id` = ?, `appointment_status` = ?, `admin_id` = ?
                WHERE `appointment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->appointmentDescription,
                $this->dto->appointmentDate,
                $this->dto->clientId,
                $this->dto->agentId,
                $this->dto->appointmentStatus,
                $this->dto->adminId,
                $this->dto->appointmentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $appointmentId = 6135;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($appointmentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $appointmentId = 5986;

        $sql = "SELECT `appointment_id`, `appointment_description`, `appointment_date`, `client_id`, `agent_id`, `appointment_status`, `admin_id`
                FROM `appointments` WHERE `appointment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$appointmentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($appointmentId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `appointment_id`, `appointment_description`, `appointment_date`, `client_id`, `agent_id`, `appointment_status`, `admin_id`
                FROM `appointments`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $appointmentId = 4926;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($appointmentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $appointmentId = 7828;
        $expected = 5053;

        $sql = "DELETE FROM `appointments` WHERE `appointment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$appointmentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($appointmentId);
        $this->assertEquals($expected, $actual);
    }
}