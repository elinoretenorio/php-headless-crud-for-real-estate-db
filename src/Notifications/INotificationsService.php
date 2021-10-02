<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

interface INotificationsService
{
    public function insert(NotificationsModel $model): int;

    public function update(NotificationsModel $model): int;

    public function get(int $notificationId): ?NotificationsModel;

    public function getAll(): array;

    public function delete(int $notificationId): int;

    public function createModel(array $row): ?NotificationsModel;
}