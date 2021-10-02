<?php

declare(strict_types=1);

namespace RealEstate\Admin;

use JsonSerializable;

class AdminModel implements JsonSerializable
{
    private int $adminId;
    private string $adminName;
    private string $adminContact;
    private string $adminAddress;
    private string $adminEmail;
    private string $username;
    private string $password;

    public function __construct(AdminDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->adminId = $dto->adminId;
        $this->adminName = $dto->adminName;
        $this->adminContact = $dto->adminContact;
        $this->adminAddress = $dto->adminAddress;
        $this->adminEmail = $dto->adminEmail;
        $this->username = $dto->username;
        $this->password = $dto->password;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    public function getAdminName(): string
    {
        return $this->adminName;
    }

    public function setAdminName(string $adminName): void
    {
        $this->adminName = $adminName;
    }

    public function getAdminContact(): string
    {
        return $this->adminContact;
    }

    public function setAdminContact(string $adminContact): void
    {
        $this->adminContact = $adminContact;
    }

    public function getAdminAddress(): string
    {
        return $this->adminAddress;
    }

    public function setAdminAddress(string $adminAddress): void
    {
        $this->adminAddress = $adminAddress;
    }

    public function getAdminEmail(): string
    {
        return $this->adminEmail;
    }

    public function setAdminEmail(string $adminEmail): void
    {
        $this->adminEmail = $adminEmail;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function toDto(): AdminDto
    {
        $dto = new AdminDto();
        $dto->adminId = (int) ($this->adminId ?? 0);
        $dto->adminName = $this->adminName ?? "";
        $dto->adminContact = $this->adminContact ?? "";
        $dto->adminAddress = $this->adminAddress ?? "";
        $dto->adminEmail = $this->adminEmail ?? "";
        $dto->username = $this->username ?? "";
        $dto->password = $this->password ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "admin_id" => $this->adminId,
            "admin_name" => $this->adminName,
            "admin_contact" => $this->adminContact,
            "admin_address" => $this->adminAddress,
            "admin_email" => $this->adminEmail,
            "username" => $this->username,
            "password" => $this->password,
        ];
    }
}