<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

use JsonSerializable;

class NotificationsModel implements JsonSerializable
{
    private int $notificationId;
    private string $notificationName;
    private string $notificationDescription;
    private int $adminId;

    public function __construct(NotificationsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->notificationId = $dto->notificationId;
        $this->notificationName = $dto->notificationName;
        $this->notificationDescription = $dto->notificationDescription;
        $this->adminId = $dto->adminId;
    }

    public function getNotificationId(): int
    {
        return $this->notificationId;
    }

    public function setNotificationId(int $notificationId): void
    {
        $this->notificationId = $notificationId;
    }

    public function getNotificationName(): string
    {
        return $this->notificationName;
    }

    public function setNotificationName(string $notificationName): void
    {
        $this->notificationName = $notificationName;
    }

    public function getNotificationDescription(): string
    {
        return $this->notificationDescription;
    }

    public function setNotificationDescription(string $notificationDescription): void
    {
        $this->notificationDescription = $notificationDescription;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    public function toDto(): NotificationsDto
    {
        $dto = new NotificationsDto();
        $dto->notificationId = (int) ($this->notificationId ?? 0);
        $dto->notificationName = $this->notificationName ?? "";
        $dto->notificationDescription = $this->notificationDescription ?? "";
        $dto->adminId = (int) ($this->adminId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "notification_id" => $this->notificationId,
            "notification_name" => $this->notificationName,
            "notification_description" => $this->notificationDescription,
            "admin_id" => $this->adminId,
        ];
    }
}