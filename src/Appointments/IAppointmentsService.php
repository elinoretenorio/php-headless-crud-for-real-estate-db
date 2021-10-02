<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

interface IAppointmentsService
{
    public function insert(AppointmentsModel $model): int;

    public function update(AppointmentsModel $model): int;

    public function get(int $appointmentId): ?AppointmentsModel;

    public function getAll(): array;

    public function delete(int $appointmentId): int;

    public function createModel(array $row): ?AppointmentsModel;
}