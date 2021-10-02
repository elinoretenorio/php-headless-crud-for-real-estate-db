<?php

declare(strict_types=1);

namespace RealEstate\Tests\Comments;

use PHPUnit\Framework\TestCase;
use RealEstate\Comments\{ CommentsDto, CommentsModel };

class CommentsModelTest extends TestCase
{
    private array $input;
    private CommentsDto $dto;
    private CommentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "comment_id" => 384,
            "comment" => "near",
            "property_id" => 3659,
            "client_id" => 1393,
            "comment_time" => "2021-10-09 01:53:20",
            "comment_date" => "2021-09-16",
            "comment_status" => 3399,
            "admin_id" => 7864,
        ];
        $this->dto = new CommentsDto($this->input);
        $this->model = new CommentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CommentsModel(null);

        $this->assertInstanceOf(CommentsModel::class, $model);
    }

    public function testGetCommentId(): void
    {
        $this->assertEquals($this->dto->commentId, $this->model->getCommentId());
    }

    public function testSetCommentId(): void
    {
        $expected = 9614;
        $model = $this->model;
        $model->setCommentId($expected);

        $this->assertEquals($expected, $model->getCommentId());
    }

    public function testGetComment(): void
    {
        $this->assertEquals($this->dto->comment, $this->model->getComment());
    }

    public function testSetComment(): void
    {
        $expected = "couple";
        $model = $this->model;
        $model->setComment($expected);

        $this->assertEquals($expected, $model->getComment());
    }

    public function testGetPropertyId(): void
    {
        $this->assertEquals($this->dto->propertyId, $this->model->getPropertyId());
    }

    public function testSetPropertyId(): void
    {
        $expected = 7843;
        $model = $this->model;
        $model->setPropertyId($expected);

        $this->assertEquals($expected, $model->getPropertyId());
    }

    public function testGetClientId(): void
    {
        $this->assertEquals($this->dto->clientId, $this->model->getClientId());
    }

    public function testSetClientId(): void
    {
        $expected = 6586;
        $model = $this->model;
        $model->setClientId($expected);

        $this->assertEquals($expected, $model->getClientId());
    }

    public function testGetCommentTime(): void
    {
        $this->assertEquals($this->dto->commentTime, $this->model->getCommentTime());
    }

    public function testSetCommentTime(): void
    {
        $expected = "2021-09-24 01:08:12";
        $model = $this->model;
        $model->setCommentTime($expected);

        $this->assertEquals($expected, $model->getCommentTime());
    }

    public function testGetCommentDate(): void
    {
        $this->assertEquals($this->dto->commentDate, $this->model->getCommentDate());
    }

    public function testSetCommentDate(): void
    {
        $expected = "2021-09-30";
        $model = $this->model;
        $model->setCommentDate($expected);

        $this->assertEquals($expected, $model->getCommentDate());
    }

    public function testGetCommentStatus(): void
    {
        $this->assertEquals($this->dto->commentStatus, $this->model->getCommentStatus());
    }

    public function testSetCommentStatus(): void
    {
        $expected = 9164;
        $model = $this->model;
        $model->setCommentStatus($expected);

        $this->assertEquals($expected, $model->getCommentStatus());
    }

    public function testGetAdminId(): void
    {
        $this->assertEquals($this->dto->adminId, $this->model->getAdminId());
    }

    public function testSetAdminId(): void
    {
        $expected = 3366;
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