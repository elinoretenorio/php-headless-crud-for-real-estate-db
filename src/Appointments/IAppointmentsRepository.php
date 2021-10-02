<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

interface IAppointmentsRepository
{
    public function insert(AppointmentsDto $dto): int;

    public function update(AppointmentsDto $dto): int;

    public function get(int $appointmentId): ?AppointmentsDto;

    public function getAll(): array;

    public function delete(int $appointmentId): int;
}