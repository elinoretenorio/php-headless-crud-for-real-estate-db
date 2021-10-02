<?php

declare(strict_types=1);

namespace RealEstate\Tests\Comments;

use PHPUnit\Framework\TestCase;
use RealEstate\Database\DatabaseException;
use RealEstate\Comments\{ CommentsDto, ICommentsRepository, CommentsRepository };

class CommentsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CommentsDto $dto;
    private ICommentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("RealEstate\Database\IDatabase");
        $this->result = $this->createMock("RealEstate\Database\IDatabaseResult");
        $this->input = [
            "comment_id" => 9233,
            "comment" => "lay",
            "property_id" => 483,
            "client_id" => 8232,
            "comment_time" => "2021-10-02 23:04:02",
            "comment_date" => "2021-09-21",
            "comment_status" => 2074,
            "admin_id" => 8637,
        ];
        $this->dto = new CommentsDto($this->input);
        $this->repository = new CommentsRepository($this->db);
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
        $expected = 1543;

        $sql = "INSERT INTO `comments` (`comment`, `property_id`, `client_id`, `comment_time`, `comment_date`, `comment_status`, `admin_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->comment,
                $this->dto->propertyId,
                $this->dto->clientId,
                $this->dto->commentTime,
                $this->dto->commentDate,
                $this->dto->commentStatus,
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
        $expected = 344;

        $sql = "UPDATE `comments` SET `comment` = ?, `property_id` = ?, `client_id` = ?, `comment_time` = ?, `comment_date` = ?, `comment_status` = ?, `admin_id` = ?
                WHERE `comment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->comment,
                $this->dto->propertyId,
                $this->dto->clientId,
                $this->dto->commentTime,
                $this->dto->commentDate,
                $this->dto->commentStatus,
                $this->dto->adminId,
                $this->dto->commentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $commentId = 6360;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($commentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $commentId = 4330;

        $sql = "SELECT `comment_id`, `comment`, `property_id`, `client_id`, `comment_time`, `comment_date`, `comment_status`, `admin_id`
                FROM `comments` WHERE `comment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$commentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($commentId);
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
        $sql = "SELECT `comment_id`, `comment`, `property_id`, `client_id`, `comment_time`, `comment_date`, `comment_status`, `admin_id`
                FROM `comments`";

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
        $commentId = 2428;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($commentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $commentId = 2407;
        $expected = 2262;

        $sql = "DELETE FROM `comments` WHERE `comment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$commentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($commentId);
        $this->assertEquals($expected, $actual);
    }
}