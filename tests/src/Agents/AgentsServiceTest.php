<?php

declare(strict_types=1);

namespace RealEstate\Tests\Agents;

use PHPUnit\Framework\TestCase;
use RealEstate\Agents\{ AgentsDto, AgentsModel, IAgentsService, AgentsService };

class AgentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private AgentsDto $dto;
    private AgentsModel $model;
    private IAgentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Agents\IAgentsRepository");
        $this->input = [
            "agent_id" => 455,
            "agent_name" => "north",
            "agent_contact" => "that",
            "agent_email" => "sanchezadam@example.org",
            "agent_address" => "sense",
            "agent_image" => "Meeting difference risk end.",
            "agent_fb_account" => "dog",
            "username" => "seem",
            "password" => "them",
        ];
        $this->dto = new AgentsDto($this->input);
        $this->model = new AgentsModel($this->dto);
        $this->service = new AgentsService($this->repository);
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
        $expected = 9498;

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
        $expected = 7757;

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
        $agentId = 77;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($agentId)
            ->willReturn(null);

        $actual = $this->service->get($agentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $agentId = 1763;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($agentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($agentId);
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
        $agentId = 5363;
        $expected = 1154;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($agentId)
            ->willReturn($expected);

        $actual = $this->service->delete($agentId);
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