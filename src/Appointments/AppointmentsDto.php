<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

class AppointmentsDto 
{
    public int $appointmentId;
    public string $appointmentDescription;
    public string $appointmentDate;
    public int $clientId;
    public int $agentId;
    public int $appointmentStatus;
    public int $adminId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->appointmentId = (int) ($row["appointment_id"] ?? 0);
        $this->appointmentDescription = $row["appointment_description"] ?? "";
        $this->appointmentDate = $row["appointment_date"] ?? "";
        $this->clientId = (int) ($row["client_id"] ?? 0);
        $this->agentId = (int) ($row["agent_id"] ?? 0);
        $this->appointmentStatus = (int) ($row["appointment_status"] ?? 0);
        $this->adminId = (int) ($row["admin_id"] ?? 0);
    }
}