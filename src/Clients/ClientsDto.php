<?php

declare(strict_types=1);

namespace RealEstate\Clients;

class ClientsDto 
{
    public int $clientId;
    public string $clientName;
    public string $clientContact;
    public string $clientEmail;
    public string $clientAddress;
    public string $clientImage;
    public string $clientFbAccount;
    public string $username;
    public string $password;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->clientId = (int) ($row["client_id"] ?? 0);
        $this->clientName = $row["client_name"] ?? "";
        $this->clientContact = $row["client_contact"] ?? "";
        $this->clientEmail = $row["client_email"] ?? "";
        $this->clientAddress = $row["client_address"] ?? "";
        $this->clientImage = $row["client_image"] ?? "";
        $this->clientFbAccount = $row["client_fb_account"] ?? "";
        $this->username = $row["username"] ?? "";
        $this->password = $row["password"] ?? "";
    }
}