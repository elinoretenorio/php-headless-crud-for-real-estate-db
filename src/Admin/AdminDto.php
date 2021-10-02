<?php

declare(strict_types=1);

namespace RealEstate\Admin;

class AdminDto 
{
    public int $adminId;
    public string $adminName;
    public string $adminContact;
    public string $adminAddress;
    public string $adminEmail;
    public string $username;
    public string $password;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->adminId = (int) ($row["admin_id"] ?? 0);
        $this->adminName = $row["admin_name"] ?? "";
        $this->adminContact = $row["admin_contact"] ?? "";
        $this->adminAddress = $row["admin_address"] ?? "";
        $this->adminEmail = $row["admin_email"] ?? "";
        $this->username = $row["username"] ?? "";
        $this->password = $row["password"] ?? "";
    }
}