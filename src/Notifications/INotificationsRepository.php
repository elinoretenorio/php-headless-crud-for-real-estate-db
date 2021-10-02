<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

interface INotificationsRepository
{
    public function insert(NotificationsDto $dto): int;

    public function update(NotificationsDto $dto): int;

    public function get(int $notificationId): ?NotificationsDto;

    public function getAll(): array;

    public function delete(int $notificationId): int;
}