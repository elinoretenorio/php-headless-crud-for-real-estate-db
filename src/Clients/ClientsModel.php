<?php

declare(strict_types=1);

namespace RealEstate\Clients;

use JsonSerializable;

class ClientsModel implements JsonSerializable
{
    private int $clientId;
    private string $clientName;
    private string $clientContact;
    private string $clientEmail;
    private string $clientAddress;
    private string $clientImage;
    private string $clientFbAccount;
    private string $username;
    private string $password;

    public function __construct(ClientsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->clientId = $dto->clientId;
        $this->clientName = $dto->clientName;
        $this->clientContact = $dto->clientContact;
        $this->clientEmail = $dto->clientEmail;
        $this->clientAddress = $dto->clientAddress;
        $this->clientImage = $dto->clientImage;
        $this->clientFbAccount = $dto->clientFbAccount;
        $this->username = $dto->username;
        $this->password = $dto->password;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function getClientContact(): string
    {
        return $this->clientContact;
    }

    public function setClientContact(string $clientContact): void
    {
        $this->clientContact = $clientContact;
    }

    public function getClientEmail(): string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): void
    {
        $this->clientEmail = $clientEmail;
    }

    public function getClientAddress(): string
    {
        return $this->clientAddress;
    }

    public function setClientAddress(string $clientAddress): void
    {
        $this->clientAddress = $clientAddress;
    }

    public function getClientImage(): string
    {
        return $this->clientImage;
    }

    public function setClientImage(string $clientImage): void
    {
        $this->clientImage = $clientImage;
    }

    public function getClientFbAccount(): string
    {
        return $this->clientFbAccount;
    }

    public function setClientFbAccount(string $clientFbAccount): void
    {
        $this->clientFbAccount = $clientFbAccount;
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

    public function toDto(): ClientsDto
    {
        $dto = new ClientsDto();
        $dto->clientId = (int) ($this->clientId ?? 0);
        $dto->clientName = $this->clientName ?? "";
        $dto->clientContact = $this->clientContact ?? "";
        $dto->clientEmail = $this->clientEmail ?? "";
        $dto->clientAddress = $this->clientAddress ?? "";
        $dto->clientImage = $this->clientImage ?? "";
        $dto->clientFbAccount = $this->clientFbAccount ?? "";
        $dto->username = $this->username ?? "";
        $dto->password = $this->password ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "client_id" => $this->clientId,
            "client_name" => $this->clientName,
            "client_contact" => $this->clientContact,
            "client_email" => $this->clientEmail,
            "client_address" => $this->clientAddress,
            "client_image" => $this->clientImage,
            "client_fb_account" => $this->clientFbAccount,
            "username" => $this->username,
            "password" => $this->password,
        ];
    }
}