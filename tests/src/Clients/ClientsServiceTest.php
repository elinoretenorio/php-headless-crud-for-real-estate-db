<?php

declare(strict_types=1);

namespace RealEstate\Tests\Clients;

use PHPUnit\Framework\TestCase;
use RealEstate\Clients\{ ClientsDto, ClientsModel, IClientsService, ClientsService };

class ClientsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ClientsDto $dto;
    private ClientsModel $model;
    private IClientsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Clients\IClientsRepository");
        $this->input = [
            "client_id" => 4519,
            "client_name" => "series",
            "client_contact" => "sound",
            "client_email" => "bethanydavis@example.org",
            "client_address" => "political",
            "client_image" => "Sing small painting east way best.",
            "client_fb_account" => "capital",
            "username" => "customer",
            "password" => "responsibility",
        ];
        $this->dto = new ClientsDto($this->input);
        $this->model = new ClientsModel($this->dto);
        $this->service = new ClientsService($this->repository);
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
        $expected = 9727;

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
        $expected = 9848;

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
        $clientId = 8683;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($clientId)
            ->willReturn(null);

        $actual = $this->service->get($clientId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $clientId = 2382;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($clientId)
            ->willReturn($this->dto);

        $actual = $this->service->get($clientId);
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
        $clientId = 9196;
        $expected = 6550;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($clientId)
            ->willReturn($expected);

        $actual = $this->service->delete($clientId);
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