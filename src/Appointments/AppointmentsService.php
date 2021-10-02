<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

class AppointmentsService implements IAppointmentsService
{
    private IAppointmentsRepository $repository;

    public function __construct(IAppointmentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(AppointmentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(AppointmentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $appointmentId): ?AppointmentsModel
    {
        $dto = $this->repository->get($appointmentId);
        if ($dto === null) {
            return null;
        }

        return new AppointmentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var AppointmentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new AppointmentsModel($dto);
        }

        return $result;
    }

    public function delete(int $appointmentId): int
    {
        return $this->repository->delete($appointmentId);
    }

    public function createModel(array $row): ?AppointmentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new AppointmentsDto($row);

        return new AppointmentsModel($dto);
    }
}