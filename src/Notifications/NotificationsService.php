<?php

declare(strict_types=1);

namespace RealEstate\Notifications;

class NotificationsService implements INotificationsService
{
    private INotificationsRepository $repository;

    public function __construct(INotificationsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(NotificationsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(NotificationsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $notificationId): ?NotificationsModel
    {
        $dto = $this->repository->get($notificationId);
        if ($dto === null) {
            return null;
        }

        return new NotificationsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var NotificationsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new NotificationsModel($dto);
        }

        return $result;
    }

    public function delete(int $notificationId): int
    {
        return $this->repository->delete($notificationId);
    }

    public function createModel(array $row): ?NotificationsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new NotificationsDto($row);

        return new NotificationsModel($dto);
    }
}