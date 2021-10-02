<?php

declare(strict_types=1);

namespace RealEstate\Appointments;

use RealEstate\Database\IDatabase;
use RealEstate\Database\DatabaseException;

class AppointmentsRepository implements IAppointmentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(AppointmentsDto $dto): int
    {
        $sql = "INSERT INTO `appointments` (`appointment_description`, `appointment_date`, `client_id`, `agent_id`, `appointment_status`, `admin_id`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->appointmentDescription,
                $dto->appointmentDate,
                $dto->clientId,
                $dto->agentId,
                $dto->appointmentStatus,
                $dto->adminId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(AppointmentsDto $dto): int
    {
        $sql = "UPDATE `appointments` SET `appointment_description` = ?, `appointment_date` = ?, `client_id` = ?, `agent_id` = ?, `appointment_status` = ?, `admin_id` = ?
                WHERE `appointment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->appointmentDescription,
                $dto->appointmentDate,
                $dto->clientId,
                $dto->agentId,
                $dto->appointmentStatus,
                $dto->adminId,
                $dto->appointmentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $appointmentId): ?AppointmentsDto
    {
        $sql = "SELECT `appointment_id`, `appointment_description`, `appointment_date`, `client_id`, `agent_id`, `appointment_status`, `admin_id`
                FROM `appointments` WHERE `appointment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$appointmentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new AppointmentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `appointment_id`, `appointment_description`, `appointment_date`, `client_id`, `agent_id`, `appointment_status`, `admin_id`
                FROM `appointments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new AppointmentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $appointmentId): int
    {
        $sql = "DELETE FROM `appointments` WHERE `appointment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$appointmentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}