<?php

declare(strict_types=1);

namespace RealEstate\Tests\Agents;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Agents\{ AgentsDto, IAgentsRepository, AgentsRepository };

class AgentsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private AgentsDto $dto;
    private IAgentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "agent_id" => 6026,
            "agent_name" => "particularly",
            "agent_contact" => "small",
            "agent_email" => "kimberlyreed@example.org",
            "agent_address" => "send",
            "agent_image" => "Fight herself company ability many agent.",
            "agent_fb_account" => "concern",
            "username" => "economy",
            "password" => "argue",
        ];
        $this->dto = new AgentsDto($this->input);
        $this->repository = new AgentsRepository($this->db);
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
        $expected = 5312;

        $sql = "INSERT INTO `agents` (`agent_name`, `agent_contact`, `agent_email`, `agent_address`, `agent_image`, `agent_fb_account`, `username`, `password`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->agentName,
                $this->dto->agentContact,
                $this->dto->agentEmail,
                $this->dto->agentAddress,
                $this->dto->agentImage,
                $this->dto->agentFbAccount,
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
        $expected = 1656;

        $sql = "UPDATE `agents` SET `agent_name` = ?, `agent_contact` = ?, `agent_email` = ?, `agent_address` = ?, `agent_image` = ?, `agent_fb_account` = ?, `username` = ?, `password` = ?
                WHERE `agent_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->agentName,
                $this->dto->agentContact,
                $this->dto->agentEmail,
                $this->dto->agentAddress,
                $this->dto->agentImage,
                $this->dto->agentFbAccount,
                $this->dto->username,
                $this->dto->password,
                $this->dto->agentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $agentId = 424;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($agentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $agentId = 3316;

        $sql = "SELECT `agent_id`, `agent_name`, `agent_contact`, `agent_email`, `agent_address`, `agent_image`, `agent_fb_account`, `username`, `password`
                FROM `agents` WHERE `agent_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$agentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($agentId);
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
        $sql = "SELECT `agent_id`, `agent_name`, `agent_contact`, `agent_email`, `agent_address`, `agent_image`, `agent_fb_account`, `username`, `password`
                FROM `agents`";

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
        $agentId = 9153;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($agentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $agentId = 1743;
        $expected = 589;

        $sql = "DELETE FROM `agents` WHERE `agent_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$agentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($agentId);
        $this->assertEquals($expected, $actual);
    }
}