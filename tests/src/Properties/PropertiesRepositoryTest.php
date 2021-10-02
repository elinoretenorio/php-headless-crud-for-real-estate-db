<?php

declare(strict_types=1);

namespace RealEstate\Tests\Properties;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Properties\{ PropertiesDto, IPropertiesRepository, PropertiesRepository };

class PropertiesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private PropertiesDto $dto;
    private IPropertiesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "property_id" => 84,
            "property_name" => "hospital",
            "description" => "pull",
            "price" => 749.40,
            "property_type_id" => 4663,
            "agent_id" => 5658,
            "property_status" => 9473,
        ];
        $this->dto = new PropertiesDto($this->input);
        $this->repository = new PropertiesRepository($this->db);
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
        $expected = 7552;

        $sql = "INSERT INTO `properties` (`property_name`, `description`, `price`, `property_type_id`, `agent_id`, `property_status`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->propertyName,
                $this->dto->description,
                $this->dto->price,
                $this->dto->propertyTypeId,
                $this->dto->agentId,
                $this->dto->propertyStatus
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
        $expected = 9552;

        $sql = "UPDATE `properties` SET `property_name` = ?, `description` = ?, `price` = ?, `property_type_id` = ?, `agent_id` = ?, `property_status` = ?
                WHERE `property_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->propertyName,
                $this->dto->description,
                $this->dto->price,
                $this->dto->propertyTypeId,
                $this->dto->agentId,
                $this->dto->propertyStatus,
                $this->dto->propertyId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $propertyId = 418;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($propertyId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $propertyId = 3138;

        $sql = "SELECT `property_id`, `property_name`, `description`, `price`, `property_type_id`, `agent_id`, `property_status`
                FROM `properties` WHERE `property_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$propertyId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($propertyId);
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
        $sql = "SELECT `property_id`, `property_name`, `description`, `price`, `property_type_id`, `agent_id`, `property_status`
                FROM `properties`";

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
        $propertyId = 9250;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($propertyId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $propertyId = 902;
        $expected = 8439;

        $sql = "DELETE FROM `properties` WHERE `property_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$propertyId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($propertyId);
        $this->assertEquals($expected, $actual);
    }
}