<?php

declare(strict_types=1);

namespace RealEstate\Tests\Comments;

use PHPUnit\Framework\TestCase;
use RealEstate\Comments\{ CommentsDto, CommentsModel, ICommentsService, CommentsService };

class CommentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CommentsDto $dto;
    private CommentsModel $model;
    private ICommentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("RealEstate\Comments\ICommentsRepository");
        $this->input = [
            "comment_id" => 6374,
            "comment" => "research",
            "property_id" => 9658,
            "client_id" => 2657,
            "comment_time" => "2021-10-04 10:46:45",
            "comment_date" => "2021-09-22",
            "comment_status" => 3831,
            "admin_id" => 7465,
        ];
        $this->dto = new CommentsDto($this->input);
        $this->model = new CommentsModel($this->dto);
        $this->service = new CommentsService($this->repository);
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
        $expected = 1558;

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
        $expected = 7569;

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
        $commentId = 2587;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($commentId)
            ->willReturn(null);

        $actual = $this->service->get($commentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $commentId = 4;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($commentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($commentId);
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
        $commentId = 5817;
        $expected = 6444;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($commentId)
            ->willReturn($expected);

        $actual = $this->service->delete($commentId);
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