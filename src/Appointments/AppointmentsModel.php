<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

use JsonSerializable;

class AppointmentsModel implements JsonSerializable
{
    private int $appointmentId;
    private string $appointmentDescription;
    private string $appointmentDate;
    private int $clientId;
    private int $agentId;
    private int $appointmentStatus;
    private int $adminId;

    public function __construct(AppointmentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->appointmentId = $dto->appointmentId;
        $this->appointmentDescription = $dto->appointmentDescription;
        $this->appointmentDate = $dto->appointmentDate;
        $this->clientId = $dto->clientId;
        $this->agentId = $dto->agentId;
        $this->appointmentStatus = $dto->appointmentStatus;
        $this->adminId = $dto->adminId;
    }

    public function getAppointmentId(): int
    {
        return $this->appointmentId;
    }

    public function setAppointmentId(int $appointmentId): void
    {
        $this->appointmentId = $appointmentId;
    }

    public function getAppointmentDescription(): string
    {
        return $this->appointmentDescription;
    }

    public function setAppointmentDescription(string $appointmentDescription): void
    {
        $this->appointmentDescription = $appointmentDescription;
    }

    public function getAppointmentDate(): string
    {
        return $this->appointmentDate;
    }

    public function setAppointmentDate(string $appointmentDate): void
    {
        $this->appointmentDate = $appointmentDate;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getAgentId(): int
    {
        return $this->agentId;
    }

    public function setAgentId(int $agentId): void
    {
        $this->agentId = $agentId;
    }

    public function getAppointmentStatus(): int
    {
        return $this->appointmentStatus;
    }

    public function setAppointmentStatus(int $appointmentStatus): void
    {
        $this->appointmentStatus = $appointmentStatus;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    public function toDto(): AppointmentsDto
    {
        $dto = new AppointmentsDto();
        $dto->appointmentId = (int) ($this->appointmentId ?? 0);
        $dto->appointmentDescription = $this->appointmentDescription ?? "";
        $dto->appointmentDate = $this->appointmentDate ?? "";
        $dto->clientId = (int) ($this->clientId ?? 0);
        $dto->agentId = (int) ($this->agentId ?? 0);
        $dto->appointmentStatus = (int) ($this->appointmentStatus ?? 0);
        $dto->adminId = (int) ($this->adminId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "appointment_id" => $this->appointmentId,
            "appointment_description" => $this->appointmentDescription,
            "appointment_date" => $this->appointmentDate,
            "client_id" => $this->clientId,
            "agent_id" => $this->agentId,
            "appointment_status" => $this->appointmentStatus,
            "admin_id" => $this->adminId,
        ];
    }
}