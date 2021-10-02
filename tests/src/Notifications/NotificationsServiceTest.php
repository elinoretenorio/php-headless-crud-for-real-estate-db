<?php

declare(strict_types=1);

namespace RealEstate\Tests\Notifications;

use PHPUnit\Framework\TestCase;
use RealEstate\Notifications\{ NotificationsDto, NotificationsModel, INotificationsService, NotificationsService };

class NotificationsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private NotificationsDto $dto;
    private NotificationsModel $model;
    private INotificationsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Notifications\INotificationsRepository");
        $this->input = [
            "notification_id" => 1576,
            "notification_name" => "value",
            "notification_description" => "impact",
            "admin_id" => 1458,
        ];
        $this->dto = new NotificationsDto($this->input);
        $this->model = new NotificationsModel($this->dto);
        $this->service = new NotificationsService($this->repository);
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
        $expected = 2518;

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
        $expected = 9535;

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
        $notificationId = 7017;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($notificationId)
            ->willReturn(null);

        $actual = $this->service->get($notificationId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $notificationId = 3932;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($notificationId)
            ->willReturn($this->dto);

        $actual = $this->service->get($notificationId);
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
        $notificationId = 9162;
        $expected = 1366;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($notificationId)
            ->willReturn($expected);

        $actual = $this->service->delete($notificationId);
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