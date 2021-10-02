<?php

declare(strict_types=1);

namespace RealEstate\Tests\Notifications;

use PHPUnit\Framework\TestCase;
use RealEstate\Notifications\{ NotificationsDto, NotificationsModel };

class NotificationsModelTest extends TestCase
{
    private array $input;
    private NotificationsDto $dto;
    private NotificationsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "notification_id" => 1036,
            "notification_name" => "power",
            "notification_description" => "voice",
            "admin_id" => 3225,
        ];
        $this->dto = new NotificationsDto($this->input);
        $this->model = new NotificationsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new NotificationsModel(null);

        $this->assertInstanceOf(NotificationsModel::class, $model);
    }

    public function testGetNotificationId(): void
    {
        $this->assertEquals($this->dto->notificationId, $this->model->getNotificationId());
    }

    public function testSetNotificationId(): void
    {
        $expected = 6408;
        $model = $this->model;
        $model->setNotificationId($expected);

        $this->assertEquals($expected, $model->getNotificationId());
    }

    public function testGetNotificationName(): void
    {
        $this->assertEquals($this->dto->notificationName, $this->model->getNotificationName());
    }

    public function testSetNotificationName(): void
    {
        $expected = "production";
        $model = $this->model;
        $model->setNotificationName($expected);

        $this->assertEquals($expected, $model->getNotificationName());
    }

    public function testGetNotificationDescription(): void
    {
        $this->assertEquals($this->dto->notificationDescription, $this->model->getNotificationDescription());
    }

    public function testSetNotificationDescription(): void
    {
        $expected = "likely";
        $model = $this->model;
        $model->setNotificationDescription($expected);

        $this->assertEquals($expected, $model->getNotificationDescription());
    }

    public function testGetAdminId(): void
    {
        $this->assertEquals($this->dto->adminId, $this->model->getAdminId());
    }

    public function testSetAdminId(): void
    {
        $expected = 6712;
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