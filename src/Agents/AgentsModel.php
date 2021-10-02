<?php

declare(strict_types=1);

namespace RealEstate\Agents;

use JsonSerializable;

class AgentsModel implements JsonSerializable
{
    private int $agentId;
    private string $agentName;
    private string $agentContact;
    private string $agentEmail;
    private string $agentAddress;
    private string $agentImage;
    private string $agentFbAccount;
    private string $username;
    private string $password;

    public function __construct(AgentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->agentId = $dto->agentId;
        $this->agentName = $dto->agentName;
        $this->agentContact = $dto->agentContact;
        $this->agentEmail = $dto->agentEmail;
        $this->agentAddress = $dto->agentAddress;
        $this->agentImage = $dto->agentImage;
        $this->agentFbAccount = $dto->agentFbAccount;
        $this->username = $dto->username;
        $this->password = $dto->password;
    }

    public function getAgentId(): int
    {
        return $this->agentId;
    }

    public function setAgentId(int $agentId): void
    {
        $this->agentId = $agentId;
    }

    public function getAgentName(): string
    {
        return $this->agentName;
    }

    public function setAgentName(string $agentName): void
    {
        $this->agentName = $agentName;
    }

    public function getAgentContact(): string
    {
        return $this->agentContact;
    }

    public function setAgentContact(string $agentContact): void
    {
        $this->agentContact = $agentContact;
    }

    public function getAgentEmail(): string
    {
        return $this->agentEmail;
    }

    public function setAgentEmail(string $agentEmail): void
    {
        $this->agentEmail = $agentEmail;
    }

    public function getAgentAddress(): string
    {
        return $this->agentAddress;
    }

    public function setAgentAddress(string $agentAddress): void
    {
        $this->agentAddress = $agentAddress;
    }

    public function getAgentImage(): string
    {
        return $this->agentImage;
    }

    public function setAgentImage(string $agentImage): void
    {
        $this->agentImage = $agentImage;
    }

    public function getAgentFbAccount(): string
    {
        return $this->agentFbAccount;
    }

    public function setAgentFbAccount(string $agentFbAccount): void
    {
        $this->agentFbAccount = $agentFbAccount;
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

    public function toDto(): AgentsDto
    {
        $dto = new AgentsDto();
        $dto->agentId = (int) ($this->agentId ?? 0);
        $dto->agentName = $this->agentName ?? "";
        $dto->agentContact = $this->agentContact ?? "";
        $dto->agentEmail = $this->agentEmail ?? "";
        $dto->agentAddress = $this->agentAddress ?? "";
        $dto->agentImage = $this->agentImage ?? "";
        $dto->agentFbAccount = $this->agentFbAccount ?? "";
        $dto->username = $this->username ?? "";
        $dto->password = $this->password ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "agent_id" => $this->agentId,
            "agent_name" => $this->agentName,
            "agent_contact" => $this->agentContact,
            "agent_email" => $this->agentEmail,
            "agent_address" => $this->agentAddress,
            "agent_image" => $this->agentImage,
            "agent_fb_account" => $this->agentFbAccount,
            "username" => $this->username,
            "password" => $this->password,
        ];
    }
}