<?php

declare(strict_types=1);

namespace RealEstate\Comments;

use JsonSerializable;

class CommentsModel implements JsonSerializable
{
    private int $commentId;
    private string $comment;
    private int $propertyId;
    private int $clientId;
    private string $commentTime;
    private string $commentDate;
    private int $commentStatus;
    private int $adminId;

    public function __construct(CommentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->commentId = $dto->commentId;
        $this->comment = $dto->comment;
        $this->propertyId = $dto->propertyId;
        $this->clientId = $dto->clientId;
        $this->commentTime = $dto->commentTime;
        $this->commentDate = $dto->commentDate;
        $this->commentStatus = $dto->commentStatus;
        $this->adminId = $dto->adminId;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function setCommentId(int $commentId): void
    {
        $this->commentId = $commentId;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getCommentTime(): string
    {
        return $this->commentTime;
    }

    public function setCommentTime(string $commentTime): void
    {
        $this->commentTime = $commentTime;
    }

    public function getCommentDate(): string
    {
        return $this->commentDate;
    }

    public function setCommentDate(string $commentDate): void
    {
        $this->commentDate = $commentDate;
    }

    public function getCommentStatus(): int
    {
        return $this->commentStatus;
    }

    public function setCommentStatus(int $commentStatus): void
    {
        $this->commentStatus = $commentStatus;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    public function toDto(): CommentsDto
    {
        $dto = new CommentsDto();
        $dto->commentId = (int) ($this->commentId ?? 0);
        $dto->comment = $this->comment ?? "";
        $dto->propertyId = (int) ($this->propertyId ?? 0);
        $dto->clientId = (int) ($this->clientId ?? 0);
        $dto->commentTime = $this->commentTime ?? "";
        $dto->commentDate = $this->commentDate ?? "";
        $dto->commentStatus = (int) ($this->commentStatus ?? 0);
        $dto->adminId = (int) ($this->adminId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "comment_id" => $this->commentId,
            "comment" => $this->comment,
            "property_id" => $this->propertyId,
            "client_id" => $this->clientId,
            "comment_time" => $this->commentTime,
            "comment_date" => $this->commentDate,
            "comment_status" => $this->commentStatus,
            "admin_id" => $this->adminId,
        ];
    }
}