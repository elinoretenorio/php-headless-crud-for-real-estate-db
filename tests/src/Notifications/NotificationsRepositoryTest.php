<?php

declare(strict_types=1);

namespace RealEstate\Tests\Notifications;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Notifications\{ NotificationsDto, INotificationsRepository, NotificationsRepository };

class NotificationsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private NotificationsDto $dto;
    private INotificationsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "notification_id" => 6285,
            "notification_name" => "consider",
            "notification_description" => "message",
            "admin_id" => 8846,
        ];
        $this->dto = new NotificationsDto($this->input);
        $this->repository = new NotificationsRepository($this->db);
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
        $expected = 8154;

        $sql = "INSERT INTO `notifications` (`notification_name`, `notification_description`, `admin_id`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->notificationName,
                $this->dto->notificationDescription,
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
        $expected = 9257;

        $sql = "UPDATE `notifications` SET `notification_name` = ?, `notification_description` = ?, `admin_id` = ?
                WHERE `notification_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->notificationName,
                $this->dto->notificationDescription,
                $this->dto->adminId,
                $this->dto->notificationId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $notificationId = 8408;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($notificationId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $notificationId = 5363;

        $sql = "SELECT `notification_id`, `notification_name`, `notification_description`, `admin_id`
                FROM `notifications` WHERE `notification_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$notificationId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($notificationId);
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
        $sql = "SELECT `notification_id`, `notification_name`, `notification_description`, `admin_id`
                FROM `notifications`";

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
        $notificationId = 8342;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($notificationId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $notificationId = 9598;
        $expected = 8967;

        $sql = "DELETE FROM `notifications` WHERE `notification_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$notificationId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($notificationId);
        $this->assertEquals($expected, $actual);
    }
}