<?php

declare(strict_types=1);

namespace RealEstate\Tests\Admin;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Admin\{ AdminDto, IAdminRepository, AdminRepository };

class AdminRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private AdminDto $dto;
    private IAdminRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "admin_id" => 8583,
            "admin_name" => "person",
            "admin_contact" => "sport",
            "admin_address" => "direction",
            "admin_email" => "vmclaughlin@example.com",
            "username" => "Mr",
            "password" => "middle",
        ];
        $this->dto = new AdminDto($this->input);
        $this->repository = new AdminRepository($this->db);
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
        $expected = 3862;

        $sql = "INSERT INTO `admin` (`admin_name`, `admin_contact`, `admin_address`, `admin_email`, `username`, `password`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->adminName,
                $this->dto->adminContact,
                $this->dto->adminAddress,
                $this->dto->adminEmail,
                $this->dto->username,
                $this->dto->password
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
        $expected = 5417;

        $sql = "UPDATE `admin` SET `admin_name` = ?, `admin_contact` = ?, `admin_address` = ?, `admin_email` = ?, `username` = ?, `password` = ?
                WHERE `admin_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->adminName,
                $this->dto->adminContact,
                $this->dto->adminAddress,
                $this->dto->adminEmail,
                $this->dto->username,
                $this->dto->password,
                $this->dto->adminId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $adminId = 6551;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($adminId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $adminId = 5908;

        $sql = "SELECT `admin_id`, `admin_name`, `admin_contact`, `admin_address`, `admin_email`, `username`, `password`
                FROM `admin` WHERE `admin_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$adminId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($adminId);
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
        $sql = "SELECT `admin_id`, `admin_name`, `admin_contact`, `admin_address`, `admin_email`, `username`, `password`
                FROM `admin`";

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
        $adminId = 6555;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($adminId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $adminId = 9636;
        $expected = 3774;

        $sql = "DELETE FROM `admin` WHERE `admin_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$adminId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($adminId);
        $this->assertEquals($expected, $actual);
    }
}